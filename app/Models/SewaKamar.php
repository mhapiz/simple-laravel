<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaKamar extends Model
{
    use HasFactory;

    protected $table = 'tb_sewa_kamar';
    protected $primaryKey = 'id_sewa_kamar';
    protected $fillable = [
        'nama_pemesan',
        'alamat_pemesan',
        'kamar_id',
        'tgl_cekin',
        'lama_menginap',
        'tgl_cekout',
        'biaya_denda',
        'biaya_tambahan',
        'keterangan',
        'total_bayar',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id_kamar');
    }
}
