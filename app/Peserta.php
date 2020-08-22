<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $fillable = [
         'nama', 'tempat_lahir','tanggal_lahir','no_ktp','agama','jenis_kelamin','status_perkawinan'
         ,'kewarganegaraan','alamat','rt','rw','kelurahan','kecamatan','kabupaten','provinsi','telepon','email'
         ,'status_pembayaran'
    ];

    public function kesehatan()
    {
        return $this->hasOne('App\PesertaKesehatan','peserta_id','id');
    }

    public function pekerjaan()
    {
        return $this->hasMany('App\PesertaPekerjaan','peserta_id','id');
    }

    public function pendidikan()
    {
        return $this->hasOne('App\PesertaPendidikan','peserta_id','id');
    }

    public function orang_tua()
    {
        return $this->hasOne('App\PesertaOrangTua','peserta_id','id');
    }
}
