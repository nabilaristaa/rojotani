<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Produk;

class ProdukController extends Controller
{
    //
    public function tambah_produk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'harga'=> 'required',
            'stok'=>'required',
            'satuan'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => 0,
                'pesan'     =>$validator->errors()], 401);
        }

        if($request->file('gambar')){
            $image = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('public/storage/app/post-image', $image);
        }
        $image = null;

        $produk = new Produk([
        'gambar' =>  $image,
        'penjual_id'=> $request->penjual_id,
        'nama' => $request->nama,
        'harga'=> $request->harga,
        'stok'=>$request->stok,
        'satuan'=>$request->satuan,
        'jenis'=>$request->jenis,
        'deskripsi'=>$request->deskripsi,
        ]);

        $data = $produk->save();

        if ($data) {
            return response()->json([
                'produk' => $produk,
                'success' => 1,
                'message' => 'Berhasil Ditambahkan'
            ], 201);
        }

        return response()->json([
            'produk' => $produk,
            'success' => 0,
            'message' => 'Gagal Ditambahkan'
        ], 201);

    }

    public function tampil_produk($id){
        $produk = new Produk();
        $produk = $produk->where('penjual_id', $id)->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$produk,
        ];

        return response()->json($data);
    }

    public function tampil_semua(){
        $produk=new Produk();
        $produk=$produk->get();
        $data=[
            "msg"=>"Berhasil",
            "status"=>200,
            "data"=>$produk,
            "total"=>$produk->count()
        ];
        return response()->json($data);
    }
}
