<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    public $table = "buku";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'kode_buku',
        'nama_buku',
        'pengarang',
        'genre'
    ];
}
