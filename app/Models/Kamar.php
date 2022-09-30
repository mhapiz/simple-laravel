<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'tb_kamar';
    protected $primaryKey = 'id_kamar';
    protected $fillable = [
        'nama_kamar',
        'jenis_kamar',
        'harga_kamar',
        'ketersediaan',
    ];
}
