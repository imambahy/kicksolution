<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubTreatment;
use App\Models\Treatment;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

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

    public function list(){
        $treatments = Treatment::all();
        $subtreatments = SubTreatment::all();
        $shoes = Shoe::all();
        
        // Buat kode unik sebelum menampilkan formulir
        $kodeUnik = $this->generateUniqueCode();

        return view('home.index', compact('treatments', 'subtreatments', 'kodeUnik', 'shoes'));
    }    

    public function index(){
        return view('layout.home');
    }

    public function store(Request $request)
    {
        // Validasi input dengan pesan kustom
        $validator = Validator::make($request->all(), [
            'id_treatment' => 'required',
            'id_subtreatment' => 'required',
            'nama_pemilik' => ['required', 'regex:/^[^0-9]+$/'], // Memastikan nama pemilik tidak mengandung angka
            'nama_sepatu' => 'required',
            'alamat' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp',
            'deskripsi' => 'required',
            'ukuran' => 'required',
            'warna' => ['required', 'regex:/^[^0-9]+$/'], // Memastikan warna tidak mengandung angka
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Ambil semua data dari request
        $input = $request->all();

        // Proses penyimpanan gambar dan lainnya
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads', $nama_gambar);
            $input['gambar'] = $nama_gambar;
        }

        // Hitung total berdasarkan harga pada sepatu, treatment, dan subtreatment
        $hargaTreatment = 0;
        $treatment = Treatment::find($input['id_treatment']);
        if ($treatment) {
            $hargaTreatment = $treatment->harga;
        }

        $subtreatment = SubTreatment::find($input['id_subtreatment']);
        if ($subtreatment) {
            $hargaTreatment += $subtreatment->harga;
        }

        // Total dihitung berdasarkan harga treatment dan subtreatment
        $total = $hargaTreatment;

        $input['total'] = $total;

        // Simpan data sepatu
        $shoe = Shoe::create($input);

        // Simpan kode unik ke dalam order
        $kodeUnik = $this->generateUniqueCode();

        // Buat order baru
        $order = Order::create([
            'id_sepatu' => $shoe->id,
            'kode_unik' => $kodeUnik,
            'total' => $total,
            'status_pesanan' => 'Baru',
        ]);

        // Mengembalikan data kode_unik sebagai respons JSON
        return response()->json(['success' => true, 'kode_unik' => $kodeUnik], 200);
    }

    public function checkOrder(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_unik' => 'required',
        ]);

        // Temukan pesanan berdasarkan kode unik dengan eager loading
        $order = Order::where('kode_unik', $request->kode_unik)->with('shoe')->first();

        // Jika kode unik tidak valid
        if (!$order && !$request->has('kode_unik')) {
            return redirect()->back()->with('errors', 'Kode unik tidak valid.');
        }

        // Jika pesanan tidak ditemukan
        if (!$order) {
            return redirect()->back()->with('errors', 'Pesanan tidak ditemukan.');
        }

        // Passing data ke view tanpa menyimpan di session
        return redirect()->back()->with([
            'success' => 'Pesanan ditemukan.',
            'kode_unik' => $order->kode_unik,
            'nama_pemilik' => $order->shoe->nama_pemilik,
            'status_pesanan' => $order->status_pesanan,
        ]);
    }
}
