<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaKesehatan extends Model
{
    protected $table = 'peserta_kesehatan';
    protected $fillable = [
         'peserta_id', 'berat_badan','tinggi_badan','golongan_darah','riwayat_penyakit','jenis_penyakit'
    ];
}
