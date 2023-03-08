<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $data = Anggota::all();
        if($data == null){
            return response()->json([
                'code' => 404,
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $data
            ]);
    }
    public function showById($id)
    {
        $data = Anggota::where('nik_anggota',$id)->first();
        if($data == null){
            return response()->json([
                'code' => 404,
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $data
            ]);
    }
    public function store(Request $request)
    {
        // dd($request);
        Anggota::create($request->all());

        return response()->json([
            'code' => '200',
            'message' => 'success',
            'data' => $request->all()
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $anggota = Anggota::where('nik_anggota', $id);

        if($anggota == null){
            return response()->json([
                'code' => 404,
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        $anggota = $anggota->delete($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $anggota
            ]);
    }

    public function update(Request $request,$id)
    {
        //
        $data = Anggota::where('nik_anggota',$id);

        if($data == null){
            return response()->json([
                'code' => 404,
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        $data = $data->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $data
            ]);


    }
    // public function showNik($id){

    //     // $data = peminjaman::join('anggota', 'anggota.id_peminjaman', '=', 'peminjaman.id_peminjaman')
    //     //                 ->get([ 'anggota.nik_anggota', 'anggota.nama_anggota']);
    //     $data = anggota::where('id_anggota',$id)->first();
    //     $data = anggota::select(array('id_anggota','nik_anggota','nama_anggota'))->get();
    //     if($data == null){
    //         return response()->json([
    //             'code' => 404,
    //             'message' => 'Data not found',
    //             'data' => null
    //         ]);
    //     }
    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'success',
    //         'data' => $data
    //         ]);
    //     }

}
