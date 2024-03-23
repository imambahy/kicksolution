<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

// class MemberController extends Controller
// {

//     public function __construct()
//     {
//         $this->middleware('auth:api', ['except' => 'index']);
//     }
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $member = Member::all();

//         return response()->json([
//             'data' => $member
//         ]);
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         $validator = Validator ::make($request->all(), [
//             'nama_member' => 'required',
//             'provinsi' => 'required',
//             'kota' => 'required',
//             'detail_alamat' => 'required',
//             'email' => 'required|email',
//             'password' => 'required|same:konfirmasi_password',
//             'konfirmasi_password' => 'required|same:password',
//             'no_hp' => 'required',
//         ]);

//         if($validator->fails()){
//             return response()->json([
//                 $validator->errors(), 422
//             ]);
//         }

//         $input = $request->all();
//         $input['password'] = bcrypt($request->password);
//         unset($input['konfirmasi_password']);
//         $member = Member::create($input);

//         return response()->json([
//             'data' => $member
//         ]);
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\Models\Member  $member
//      * @return \Illuminate\Http\Response
//      */
//     public function show(Member $member)
//     {
//         return response()->json([
//             'data' => $member
//         ]);
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  \App\Models\Member  $member
//      * @return \Illuminate\Http\Response
//      */
//     public function edit(Member $member)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \App\Models\Member  $member
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, Member $member)
//     {

//         $validator = Validator::make($request->all(), [
//             'nama_member' => 'required',
//             'provinsi' => 'required',
//             'kota' => 'required',
//             'detail_alamat' => 'required',
//             'email' => 'required',
//             'password' => 'required',
//             'no_hp' => 'required',
//         ]);

//         if($validator->fails()){
//             return response()->json([
//                 $validator->errors(), 422
//             ]);
//         }

//         $input = $request->all();

//         $member->update($input);

//         return response()->json([
//             'message' => 'success',
//             'data' => $member
//         ]);
//     }

//     public function getMemberData()
//     {
//         $user = auth()->user();

//         if ($user) {
//             $memberData = Member::find($user->id);

//             return $memberData; // Kembalikan data member
//         }

//         return null; // Kembalikan null jika user tidak ditemukan
//     }


//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\Models\Member  $member
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(Member $member)
//     {
//         $member->delete();

//         return response()->json([
//             'message' => 'success'
//         ]);
//     }
// }
