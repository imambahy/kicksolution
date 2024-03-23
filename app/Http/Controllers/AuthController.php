<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    
    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);

        if(auth()->attempt($credentials)){
            $token = Auth::guard('api')->attempt($credentials);
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'token' => $token
            ]); 
        }

        return response()->json([
            'success' => false,
            'message' => 'email atau password salah'
        ]);
    }

     /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    // public function register_member(){
    //     return view('auth.register_member');
    // }

    // public function register_member_action(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nama_lengkap' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Buat record member
    //     $member = Member::create([
    //         'nama_lengkap' => $request->nama_lengkap,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //     ]);

    //     // Redirect ke halaman login atau tampilkan pesan sukses
    //     Session::flash('success', 'Account Successfully Created!');
    //     return redirect('/login_member');
    // }

    // public function login_member(){
    //     return view('auth.login_member');
    // }

    // public function login_member_action(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         Session::flash('errors', $validator->errors()->toArray());
    //         return redirect('/login_member')->withErrors($validator);
    //     }

    //     $member = Member::where('email', $request->email)->first();

    //     if ($member) {
    //         if (Hash::check($request->password, $member->password)) {
    //             // Ambil informasi order terbaru dari tabel Order
    //             $order = $member->order()->latest()->first();

    //             // Set session data
    //             $request->session()->put('nama_lengkap', $member->nama_lengkap);
    //             $request->session()->put('status_pesanan', $order ? $order->status_pesanan : null);

    //             $dataBarang = [
    //                 'nama_lengkap' => $member->nama_lengkap,
    //                 'status_pesanan' => $order ? $order->status_pesanan : null,
    //             ];

    //             return view('home.home_member', compact('dataBarang'));
    //         } else {
    //             return response()->json([
    //                 'message' => 'failed',
    //                 'data' => 'Your Password is wrong.'
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => 'failed',
    //             'data' => 'Your Email is wrong.'
    //         ]);
    //     }
    // }


    public function logout(){
        Session::flush();
        return redirect('/login');
    }


    // public function logout_member(){
    //     Auth::logout(); // Melakukan logout pengguna
    //     Session::flush(); // Menghapus semua data sesi
    //     return redirect('/'); // Mengarahkan pengguna kembali ke halaman utama
    // }

}
