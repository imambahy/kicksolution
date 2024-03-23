<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->only(['list', 'dikonfirmasi_list', 'dicuci_list', 'dikirim_list', 'diterima_list', 'selesai_list']);
    //     $this->middleware('auth:api')->only('store', 'update', 'ubah_status', 'baru', 'dikonfirmasi', 'dikemas', 'dikirim', 'diterima', 'selesai');
    // }

    public function list(){
        return view('pesanan.index');
    }

    public function dikonfirmasi_list(){
        return view('pesanan.dikonfirmasi');
    }

    public function dicuci_list(){
        return view('pesanan.dicuci');
    }

    public function dikirim_list(){
        return view('pesanan.dikirim');
    }

    public function diterima_list(){
        return view('pesanan.diterima');
    }

    public function selesai_list(){
        return view('pesanan.selesai');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('member')->get();

        return response()->json([
            'data' => $order
        ]);
    }

    public function getStatus($memberId)
    {
        $order = Order::where('id_member', $memberId)
                      ->orderBy('created_at', 'desc')
                      ->first();

        if ($order) {
            return $order->status;
        }

        return null;
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
            'id_member' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors(), 422
            ]);
        }

        $input = $request->all();
        $order = Order::create($input);

        for($i = 0; $i < count($input['id_produk']); $i++){
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_produk' => $order['id_produk'][$i],
                'jumlah' => $order['jumlah'][$i],
                'ukuran' => $order['ukuran'][$i],
                'warna' => $order['warna'][$i],
                'total' => $order['total'][$i],
            ]);
        }

        return response()->json([
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json([
            'data' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors(), 422
            ]);
        }

        $input = $request->all();

        $order->update($input);

        OrderDetail::where('id_order', $order['id'])->delete();

        for($i = 0; $i < count($input['id_produk']); $i++){
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_produk' => $order['id_produk'][$i],
                'jumlah' => $order['jumlah'][$i],
                'ukuran' => $order['ukuran'][$i],
                'warna' => $order['warna'][$i],
                'total' => $order['total'][$i],
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function ubah_status(Request $request, Order $order){
        $order->update([
            'status_pesanan' => $request->status
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function baru()
    {
        $order = Order::with('shoe')->where('status_pesanan', 'Baru')->get();

        return response()->json([
            'data' => $order
        ]);
    }

    public function dikonfirmasi()
    {
        $order = Order::with('shoe')->where('status_pesanan', 'Dikonfirmasi')->get();

        return response()->json([
            'data' => $order
        ]);
    }

    public function dicuci()
    {
        $order = Order::with('shoe')->where('status_pesanan', 'Dicuci')->get();

        return response()->json([
            'data' => $order
        ]);
    }

    public function dikirim()
    {
        $order = Order::with('shoe')->where('status_pesanan', 'Dikirim')->get();

        return response()->json([
            'data' => $order
        ]);
    }

    public function diterima()
    {
        $order = Order::with('shoe')->where('status_pesanan', 'Diterima')->get();

        return response()->json([
            'data' => $order
        ]);
    }

    public function selesai()
    {
        $order = Order::with('shoe')->where('status_pesanan', 'Selesai')->get();

        return response()->json([
            'data' => $order
        ]);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
