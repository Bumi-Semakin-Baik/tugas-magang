<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{

    public $table = "anggota";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'nik_anggota',
        'nama_anggota',
        'jk_anggota',
        'tgl_lahir'

    ];
}
