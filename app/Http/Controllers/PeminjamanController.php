<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\anggota;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{

    public function index()
    {
        $peminjaman = Peminjaman::join('anggota', 'anggota.nik_anggota', '=', 'peminjaman.nik_anggota')
                        ->join('buku','buku.kode_buku','=','peminjaman.kode_buku')
                        ->select(array('peminjaman.kode_buku','anggota.nama_anggota','tgl_peminjaman','tgl_pengembalian','status'))
                        ->get();
            if($peminjaman == null){
                return response()->json([
                    'code' => 404,
                    'message' => 'Data not found',
                    'data' => null
                ]);
            }

            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $peminjaman
                ]);

    }

    public function store(Request $request)
    {
        // dd($request);
        // Peminjaman::create($request->all());

        $current_date_time = date('Y-m-d H:i:s');

        $data = array("kode_buku" => $request->kode_buku,
                    "nik_anggota" => $request->nik_anggota,
                    "tgl_peminjaman" => $current_date_time,
                    "estimasi_pengembalian" => $request->estimasi_pengembalian,
                    "status" => $request->status,
                    "id_admin" => $request->id_admin);

        Peminjaman::create($data);

        return response()->json([
            'code' => '200',
            'message' => 'success',
            'data' => $request->all()
        ]);
    }
    public function showName($id){

        // $data = peminjaman::join('anggota', 'anggota.id_peminjaman', '=', 'peminjaman.id_peminjaman')
        //                 ->select(array('id_anggota','nik_anggota','nama_anggota'))->get();
        $data = anggota::select(array('nik_anggota','nama_anggota'))->get();


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

    public function update_status(Request $request, $id)
    {
        $data = Peminjaman::where('id_peminjaman',$id);

        if($data == null){
            return response()->json([
                'code' => '404',
                'message' => 'Data not found',
                'data' => null
            ]);
        }

        $current_date_time = date('Y-m-d H:i:s');

        $data_update = array("tgl_pengembalian" => $current_date_time,
        "status" => $request->status);

        $data = $data->update($data_update);

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $data
        ]);
        // $data = Peminjaman::where('id_peminjaman',$id);

        // if($data->status = "Dikembalikan")
        // {
        //     Peminjaman::where('id_peminjaman',$id)
        //                 ->update(['status' => 'Dipinjam']);
        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'success',
        //         'data' => $data->status

        //         ]);
        // }

        // else if($data->status = "Dipinjam")
        // {
        //     Peminjaman::where('id_peminjaman',$id)
        //                 ->update(['status' => 'Dikembalikan']);
        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'success',
        //         'data' => $data->status

        //         ]);
        // }


        // else
        // {
        //     Peminjaman::where('id_peminjaman',$id)
        //                 ->update(['status' => 'Dipinjam']);
        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'success',
        //         'data' => $data->status

        //         ]);
        // }

    }


}
