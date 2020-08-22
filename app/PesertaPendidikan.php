<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaPendidikan extends Model
{
    protected $table = 'peserta_pendidikan';
    protected $fillable = [
         'peserta_id', 'pendidikan_terakhir','sd','sd_masuk','sd_keluar','smp','smp_masuk'
         ,'smp_keluar','sma','sma_masuk','sma_keluar','kuliah','kuliah_masuk','kuliah_keluar','sma_jurusan','kuliah_jurusan'
    ];
}
