<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shoe;
use App\Models\SubTreatment;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShoeController extends Controller
{

    public function list(){
        // Ambil data sepatu beserta relasinya dengan treatments dan subtreatments
        $shoes = Shoe::with('treatments', 'subtreatments')->get();
        
        // Ambil data kode_unik dari tabel order
        $kode_uniks = Order::pluck('kode_unik', 'id_sepatu');
        
        // Menggabungkan data sepatu dengan kode_unik
        $shoesWithKodeUnik = $shoes->map(function ($shoe) use ($kode_uniks) {
            // Mengambil kode_unik berdasarkan id_sepatu sepatu saat ini
            $kode_unik = $kode_uniks->get($shoe->id);
    
            // Menambahkan kode_unik ke dalam objek sepatu
            $shoe->kode_unik = $kode_unik;
    
            return $shoe;
        });
    
        // Mengirimkan data ke tampilan shoe.index
        return view('shoe.index', compact('shoesWithKodeUnik'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $shoes = Shoe::with('treatments', 'subtreatments')->get();

        return response()->json([
            'data' => $shoes
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showFormTambahSepatu()
    {
        $treatments = Treatment::all();
        $subtreatments = SubTreatment::all();

        return view('shoe.index', [
            'treatments' => $treatments,
            'subtreatments' => $subtreatments,
        ]);
    }

    public function store(Request $request)
    {
        // // Generate unique code for the order
        // $kodeUnik = $this->generateUniqueCode();

        // // Validasi input
        // $validator = Validator::make($request->all(), [
        //     'id_treatment' => 'required',
        //     'id_subtreatment' => 'required',
        //     'nama_pemilik' => 'required',
        //     'nama_sepatu' => 'required',
        //     'alamat' => 'required',
        //     'gambar' => 'required|image|mimes:jpg,png,jpeg,webp',
        //     'deskripsi' => 'required',
        //     'ukuran' => 'required',
        //     'warna' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // // Ambil semua data dari request
        // $input = $request->all();

        // // Proses penyimpanan gambar dan lainnya
        // if ($request->hasFile('gambar')) {
        //     $gambar = $request->file('gambar');
        //     $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
        //     $gambar->move('uploads', $nama_gambar);
        //     $input['gambar'] = $nama_gambar;
        // }

        // // Hitung total berdasarkan harga pada sepatu, treatment, dan subtreatment
        // $hargaTreatment = 0;
        // $treatment = Treatment::find($input['id_treatment']);
        // if ($treatment) {
        //     $hargaTreatment = $treatment->harga;
        // }

        // $subtreatment = Subtreatment::find($input['id_subtreatment']);
        // if ($subtreatment) {
        //     $hargaTreatment += $subtreatment->harga;
        // }

        // // Total dihitung berdasarkan harga treatment dan subtreatment
        // $total = $hargaTreatment;

        // $input['total'] = $total;

        // // Simpan data sepatu
        // $shoe = Shoe::create($input);

        // // Generate unique code for the order
        // $kodeUnik = $this->generateUniqueCode();

        // // Buat order baru
        // $order = Order::create([
        //     'id_sepatu' => $shoe->id,
        //     'kode_unik' => $kodeUnik,
        //     'total' => $total,
        //     'status_pesanan' => 'Baru',
        // ]);

        //  // Simpan kode unik ke dalam order
        //  $order->kode_unik = $kodeUnik;
        //  $order->save();
 
        //  // Redirect atau kirim respons sukses
        //  return redirect()->back()->with('success', 'Pesanan berhasil! Kode unik Anda: ' . $kodeUnik);
    }

    // Fungsi untuk menghasilkan kode unik
    private function generateUniqueCode()
    {
        $length = 10;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function show(Shoe $shoe)
    {
        return response()->json([
            'data' => $shoe
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shoe = Shoe::find($id);

        return $shoe;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_treatment' => 'required',
            'id_subtreatment' => 'required',
            'nama_sepatu' => 'required',
            'nama_pemilik' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), 422]);
        }

        $id = Auth::user()->id;

        $id_treatment = $request->input('id_treatment');
        $id_subtreatment = $request->input('id_subtreatment');
        $nama_sepatu = $request->input('nama_sepatu');
        $nama_pemilik = $request->input('nama_pemilik');
        $alamat = $request->input('alamat');
        $deskripsi = $request->input('deskripsi');
        $harga = $request->input('harga');
        $ukuran = $request->input('ukuran');
        $warna = $request->input('warna');

        $shoe = Shoe::find($id);

        $result = $shoe->update([
            'id_treatment' => $id_treatment,
            'id_subtreatment' => $id_subtreatment,
            'nama_sepatu' => $nama_sepatu,
            'nama_pemilik' => $nama_pemilik,
            'alamat' => $alamat,
            'deskripsi' => $deskripsi,
            'ukuran' => $ukuran,
            'warna' => $warna
        ]);

        if (!$result) {
            // Handle the failure, log, etc.
            return response()->json(['error' => 'Failed to update shoe. Please try again.'], 500);
        }

        return redirect()->back()->with('success', 'Ubah Data berhasil!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $shoe)
    {
        $shoe->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
