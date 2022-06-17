<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjual;
use Illuminate\Support\Facades\Auth;

class PenjualController extends Controller
{
    public function register_penjual(Request $req) {
    $validataData = $req->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'no_rekening' => 'required',
        'email'       => 'required|email|unique:penjuals',
        'password' => 'required|confirmed',
    ]);

    // input register
    $penjual = Penjual::create([
        'nama'              => $req->get('nama'),
        'alamat'            => $req->get('alamat'),
        'email'             => $req->get('email'),
        'password'          => bcrypt($req->get('password')),
        'no_rekening'       => $req->get('no_rekening'),
    ]);

        $penjual->save();

        return response()->json([
            'penjual' => $penjual,
            'success' => true
        ], 201);
    }
    //end of register


    // public function register_penjual(Request $request){
    //     $validator = Validator::make($request->all(), [
    //     'nama' => 'required',
    //     'alamat' => 'required',
    //     'no_rekening' => 'required',
    //     'email'       => 'required|email|unique:penjuals',
    //     'password' => 'required|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success'   => 0,
    //             'pesan'     =>$validator->errors()], 401);
    //     }

    //     // input register
    //     $penjual = Penjual::create([
    //         'nama'              => $request->get('nama'),
    //         'alamat'            => $request->get('alamat'),
    //         'email'             => $request->get('email'),
    //         'password'          => bcrypt($request->get('password')),
    //         'no_rekening' => $request->get('no_rekening'),
    //     ]);

    //     $penjual->save();

    //     return response()->json([
    //         'penjual' => $penjual,
    //         'success' => true
    //     ], 201);
    // }

    public function login_penjual(Request $request) {

        $validataData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $login_detail = request(['email', 'password']);

        if(!Auth::attempt($login_detail)){
            return response()->json(['error' => 'login failed!']);
        }

        $penjual = $request->penjual();

        $tokenResult = $penjual->createToken('AccessToken');
        $token = $tokenResult->token;
        $token->save();

        //pada login belum memiliki key sukses maka harus ditambahi
        //tambahi key token dan user sesuai pada api.dart agar dapat digunakan

        return response()->json([
            'access_token' => 'Bearer' . $tokenResult->accessToken,
            'token_id' => $token->id,
            'user_id' => $penjual->id,
            'nama' => $penjual->nama,
            'email' => $penjual->email,
            'success' => true,
            'token' => $tokenResult->accessToken,
            'user' => $penjual->nama
        ], 200);
    }
    // end login

    //Logout
    //berikut adalah tambahan logout function
    //kemudian tambahkan ke route api
    public function logout_penjual(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil',
        ]);
    }

    public function get(Penjual $penjual){
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$penjual,
        ];
        return response()->json($data);
    }

    public function get_all(){
        $penjual=new Penjual();
        $penjual=$penjual->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$penjual,
            "total"=>$penjual->count()
        ];
        return response()->json($data);
    }

    public function delete(Penjual $penjual){
        $penjual->delete();
        $data=[
            "msg"=>"data telah di hapus",
            "status"=>200,
        ];
        return response()->json($data);
    }

    public function update(Penjual $penjual){
        $penjual->update([
            'password' =>  bcrypt($penjual->password),
        ]);

        return response()->json($penjual, 201);
    }
}
