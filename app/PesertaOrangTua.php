<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaOrangTua extends Model
{
    protected $table = 'peserta_orang_tua';
    protected $fillable = [
         'peserta_id'
         ,'ayah','ayah_alamat','ayah_rt','ayah_rw','ayah_kelurahan','ayah_kecamatan'
         ,'ayah_kabupaten','ayah_provinsi','ayah_pekerjaan','ayah_telepon','ayah_hp','ayah_keadaan'
         ,'ibu','ibu_alamat','ibu_rt','ibu_rw','ibu_kelurahan','ibu_kecamatan'
         ,'ibu_kabupaten','ibu_provinsi','ibu_pekerjaan','ibu_telepon','ibu_hp','ibu_keadaan'
    ];
}
