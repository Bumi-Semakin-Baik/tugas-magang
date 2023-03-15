<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table ="peminjaman";
    use HasFactory;
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'id_peminjaman',
        'kode_buku',
        'nik_anggota',
        'tgl_peminjaman',
        'estimasi_pengembalian',
        'tgl_pengembalian',
        'status',
        'id_admin'
    ];
}
