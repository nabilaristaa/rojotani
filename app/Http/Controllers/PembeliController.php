<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\user_pembeli;

class PembeliController extends Controller
{
    public function index()
    {
        $user_pembelis = user_pembeli::all();
        return view('admin.datapembeli.index', compact('user_pembelis'));
    }

   

    public function get_all(){
        $user=new user_pembeli();
        $user=$user->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$user,
            "total"=>$user->count()
        ];
        return response()->json($data);
    }


}
