<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->only('index');
    //     $this->middleware('auth:api')->only(['get_reports']);
    // }

    // public function index(Request $request){
    //     // Handle initial page load without filters
    
    //     // Jika tidak ada tanggal yang diberikan, atur default untuk rentang yang luas:
    //     $dari = $request->input('dari') ?? date('Y-m-01');
    //     $sampai = $request->input('sampai') ?? date('Y-m-d');
    
    //     // Ambil data order detail dari database sesuai dengan rentang tanggal
    //     $orderDetails = DB::table('order_details')
    //         ->join('shoes', 'shoes.id', '=', 'order_details.id_sepatu')
    //         ->select(
    //             'shoes.nama_sepatu',
    //             'shoes.nama_pemilik',
    //             'shoes.total as harga',
    //             'order_details.total as pendapatan'
    //         )
    //         ->whereBetween('order_details.created_at', [$dari, $sampai])
    //         ->get();
    
    //     // Kembalikan view dengan data order detail dan rentang tanggal untuk digunakan di form
    //     return view('report.index', compact('orderDetails', 'dari', 'sampai'));
    // }
    
}
