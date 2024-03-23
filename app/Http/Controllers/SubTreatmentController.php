<?php

namespace App\Http\Controllers;

use App\Models\SubTreatment;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubTreatmentController extends Controller
{

    public function list(){
        return view('subtreatment.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtreatment = SubTreatment::all();

        return response()->json([
            'data' => $subtreatment
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_subtreatment' => 'required',
            'deskripsi' => 'required',
            'harga' => 'nullable|numeric' // Mengizinkan nilai kosong atau numerik (termasuk 0)
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors(), 422
            ]);
        }

        $input = $request->all();

        // if($request->has('gambar')){
        //     $gambar = $request->file('gambar');
        //     $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
        //     $gambar->move('uploads', $nama_gambar);
        //     $input['gambar'] = $nama_gambar;
        // }

        $subtreatment = SubTreatment::create($input);

        return redirect()->back()->with('success', 'Input Data berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubTreatment  $subtreatment
     * @return \Illuminate\Http\Response
     */
    public function show(SubTreatment $subtreatment)
    {
        return response()->json([
            'data' => $subtreatment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubTreatment  $subtreatment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SubTreatment::find($id);
        return response()->json($data->toArray());
    }

    public function update(Request $request, SubTreatment $subtreatment)
    {
        $input = $request->all();
    
        $data = SubTreatment::find($request->id_subtreatment);
        if ($request->has('harga')) { // Memeriksa apakah input harga disediakan
            if ($request->harga === null) { // Jika harga adalah null, atur nilainya menjadi 0
                $harga = 0;
            } else {
                $harga = $request->harga;
            }
            
            $data->update([
                'nama_subtreatment' => $request->nama_subtreatment,
                'deskripsi' => $request->deskripsi,
                'harga' => $harga // Gunakan variabel harga yang telah ditentukan
            ]);
        }
        return redirect()->back()->with('success', 'Ubah Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubTreatment  $subtreatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubTreatment $subtreatment)
    {
        File::delete('uploads/' . $subtreatment->gambar);
        $subtreatment->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
