<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\anggota;
use App\Models\BukuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $query = DB::table('buku')
        ->where('kode_buku',$request->kode_buku);

        $query->decrement('stok_buku', 1);

        return response()->json([
            'code' => '200',
            'message' => 'success',
            'data' => $request->all()
        ]);
    }
    public function showName(){

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
    public function getBuku(){

        // $data = peminjaman::join('anggota', 'anggota.id_peminjaman', '=', 'peminjaman.id_peminjaman')
        //                 ->select(array('id_anggota','nik_anggota','nama_anggota'))->get();
        $data = BukuModel::select(array('kode_buku','nama_buku'))
                            ->where('stok_buku','>',0)
                            ->get();


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
        $query = DB::table('buku')
        ->where('kode_buku',$request->kode_buku);

        $query->increment('stok_buku', 1);

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

    public function count_ongoing(){

        $data = peminjaman::select(array('id_peminjaman'))
                        ->where('status','Dipinjam')
                        ->get();
        $count = count($data);

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
            'data' => $count
            ]);
    }

}
