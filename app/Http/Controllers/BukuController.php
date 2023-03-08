<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    //get buku
    public function get_buku(){
        $buku = BukuModel::all();
        return response()->json($buku);
    }

    //insert buku
    public function insert_buku(Request $request)
    {
        BukuModel::create($request->all());

        return response()->json([
            'code' => '200',
            'message' => 'success',
            'data' => $request->all()
        ]);
    }



    //delete buku
    public function delete_buku(Request $request, $kode_buku)
    {
        $buku = BukuModel::where('kode_buku',$kode_buku);

        if($buku == null){
            return response()->json([
                'code' => '404',
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        $buku = $buku->delete($request -> all());

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $buku
        ]);
    }

    public function update_buku(Request $request, $kode_buku)
    {
        $buku = BukuModel::where('kode_buku',$kode_buku);

        if($buku == null){
            return response()->json([
                'code' => '404',
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        $buku = $buku->update($request -> all());

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $buku
        ]);
    }

    
}
