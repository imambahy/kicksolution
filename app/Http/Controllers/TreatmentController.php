<?php

namespace App\Http\Controllers;

use App\Models\SubTreatment;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TreatmentController extends Controller
{
    public function list(){
        return view('treatment.index');
    }
    public function index()
    {
        $treatment = Treatment::all();

        return response()->json([
            'data' => $treatment
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_treatment' => 'required|regex:/^[^0-9]+$/',
            'deskripsi' => 'required',
            'harga' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors(), 422
            ]);
        }
        $input = $request->all();
        $treatment = Treatment::create($input);
        return redirect()->back()->with('success', 'Input Data berhasil!');
    }
    public function show(Treatment $treatment)
    {
        return response()->json([
            'data' => $treatment
        ]);
    }
    public function edit($id)
    {
        $data = Treatment::find($id);
        return $data;
    }
    public function update(Request $request, Treatment $treatment)
    {
        $input = $request->all();

        $data = Treatment::find($request->id_treatment);
        if ($request->harga) {
            $data->update([
                'nama_treatment' => $request->nama_treatment,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga
            ]);
        }
        return redirect()->back()->with('success', 'Ubah Data berhasil!');
    }
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }
}
