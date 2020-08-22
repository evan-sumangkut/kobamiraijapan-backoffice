<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaPekerjaan extends Model
{
    protected $table = 'peserta_pekerjaan';
    protected $fillable = [
         'peserta_id', 'periode','perusahaan','gaji_bulanan','jenis_pekerjaan'
    ];
}
