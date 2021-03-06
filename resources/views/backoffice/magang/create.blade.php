@extends('_layouts.admin')

@section('link')
<ol class="breadcrumb">
        <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{$title}}</li>
</ol>
@endsection
@section('content')

<?php
$no = 1;
?>
<div class="box">
<div class="box-body">
<h3>{{$title}}</h3>
<a href="{{route('magang')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
<div class="">
  <hr />
  <form method="">
  </form>

  <style media="screen">
    .f_size_20{
      text-align: center;
      font-size: 2em;
      font-weight: 500;
    }
  </style>

  <div class="contact_form">

                            <form class="contact_form_box" method="POST" action="{{route('magang.add')}}" id="contactForm">
                              @csrf
                                <h6 class="f_p f_size_20 t_color3 f_500 mb_20">DATA DIRI</h6>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Nama lengkap">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label for="tanggal_lahir">Tanggal lahir</label> <br>
                                            <input class="form-control" type="date" name="tanggal_lahir">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label>No. KTP</label>
                                            <input type="text" class="form-control" name="no_ktp" placeholder="No KTP">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label>Agama</label>
                                            <input type="text" class="form-control" name="agama" placeholder="Agama">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group text_box">

                                            <div class="f_p text_c f_400">
                                                <label>Jenis Kelamin</label>
                                              </div>

                                            <input type="radio" name="jenis_kelamin" value="laki-laki">
                                            <label for="laki-laki">Laki-laki</label>
                                            <br>
                                            <input type="radio" name="jenis_kelamin" value="perempuan">
                                            <label for="perempuan">Perempuan</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group text_box">
                                            <div class="f_p text_c f_400">
                                                <label>Status Perkawinan</label>
                                              </div>
                                            <input type="radio" name="status_perkawinan" value="Belum Menikah">
                                            <label>Belum Menikah</label>
                                            <br>
                                            <input type="radio" name="status_perkawinan" value="Perempuan">
                                            <label>Menikah</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group text_box">
                                            <div class="f_p text_c f_400">
                                                <label>Kewarganegaraan</label>
                                              </div>
                                            <input type="radio" name="kewarganegaraan" value="WNI">
                                            <label>WNI</label>
                                            <br>
                                            <input type="radio" name="kewarganegaraan" value="WNA">
                                            <label>WNA</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group text_box">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" name="alamat" cols="30" rows="5" placeholder="Alamat"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group text_box">
                                                    <input type="text" class="form-control" name="rt" placeholder="RT">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group text_box">
                                                    <input type="text" class="form-control" name="rw" placeholder="RW">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group text_box">
                                                    <input type="text" class="form-control" name="kelurahan" placeholder="Desa/Kelurahan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group text_box">
                                                    <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group text_box">
                                                    <input type="text" class="form-control" name="kabupaten" placeholder="Kab./kota">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group text_box">
                                                    <input type="text" class="form-control" name="provinsi" placeholder="Propinsi">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label>Telepon / HP</label>
                                            <input type="text" class="form-control" name="telepon" placeholder="Telepon / HP">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
<hr>
                                <h6 class="f_p f_size_20 t_color3 f_500 mb_20">RIWAYAT PENDIDIKAN</h6>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label>Pendidikan Terakhir</label>
                                            </div>
                                            <div class="col-lg-1"> : </div>
                                            <div class="col-lg-8">
                                                <div class="form-group text_box">
                                                    <input type="radio" name="pendidikan_terakhir" value="SMA/SMK">
                                                    <label>SMA/SMK</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="pendidikan_terakhir" value="D-3">
                                                    <label>D-3</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="pendidikan_terakhir" value="S-1">
                                                    <label>S-1</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label> a. SD </label>
                                            </div>
                                            <div class="col-lg-1"> : </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text_box">
                                                            <label for="sd">SD</label>
                                                            <input type="text" class="form-control" name="sd">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="sd_masuk" placeholder="tahun masuk">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="sd_keluar" placeholder="tahun lulus">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label> b. SMP </label>
                                            </div>
                                            <div class="col-lg-1"> : </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text_box">
                                                            <label for="smp">SMP</label>
                                                            <input type="text" class="form-control" name="smp">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="smp_masuk" placeholder="tahun masuk">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="smp_keluar" placeholder="tahun lulus">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label> c. SMA/SMK </label>
                                            </div>
                                            <div class="col-lg-1"> : </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text_box">
                                                            <label for="sma_smk">SMA/SMK</label>
                                                            <input type="text" class="form-control" name="sma">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="sma_jurusan" placeholder="jurusan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="sma_masuk" placeholder="tahun masuk">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="sma_keluar" placeholder="tahun lulus">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label> d. D3/S1 </label>
                                            </div>
                                            <div class="col-lg-1"> : </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text_box">
                                                            <label for="d3/s1">Kuliah</label>
                                                            <input type="text" class="form-control" name="kuliah">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="kuliah_jurusan" placeholder="jurusan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="kuliah_masuk" placeholder="tahun masuk">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group text_box">
                                                            <input type="text" class="form-control" name="kuliah_keluar" placeholder="tahun lulus">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                    </div>

                                </div>
<hr>
                                <h6 class="f_p f_size_20 t_color3 f_500 mb_20">PENGALAMAN PEKERJAAN</h6>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_periode">Periode</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_periode[]" placeholder="2001-2008">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_namaperusahaan">Nama Perusahaan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_namaperusahaan[]" placeholder="Nama Perusahaan">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_gaji">Gaji Bulanan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_gaji[]" placeholder="Rp.3.500.000">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_jenis">Jenis Pekerjaan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_jenis[]" placeholder="Jenis Pekerjaan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_periode">Periode</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_periode[]" placeholder="2001-2008">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_namaperusahaan">Nama Perusahaan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_namaperusahaan[]" placeholder="Nama Perusahaan">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_gaji">Gaji Bulanan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_gaji[]" placeholder="Rp.3.500.000">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_jenis">Jenis Pekerjaan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_jenis[]" placeholder="Jenis Pekerjaan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_periode">Periode</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_periode[]" placeholder="2001-2008">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_namaperusahaan">Nama Perusahaan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_namaperusahaan[]" placeholder="Nama Perusahaan">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_gaji">Gaji Bulanan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_gaji[]" placeholder="Rp.3.500.000">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text_box">
                                                <label for="pengalaman_kerja_a_jenis">Jenis Pekerjaan</label>
                                                <input type="text" class="form-control" name="pengalaman_kerja_jenis[]" placeholder="Jenis Pekerjaan">
                                            </div>
                                        </div>
                                    </div>

<hr>
                                <h6 class="f_p f_size_20 t_color3 f_500 mb_20">DATA KESEHATAN</h6>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="">Berat Badan</label>
                                        <div class="form-group text_box">
                                            <input type="text" class="form-control" name="berat_badan" placeholder="Kg">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Tinggi Badan</label>
                                        <div class="form-group text_box">
                                            <input type="text" class="form-control" name="tinggi_badan" placeholder="Cm">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Golongan Darah</label>
                                        <div class="form-group text_box">
                                            <select name="golongan_darah" class="form-control">
                                                <option value="O"> O </option>
                                                <option value="B"> B </option>
                                                <option value="A"> A </option>
                                                <option value="AB"> AB </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group text_box">
                                            <div class="f_p text_c f_400"><label>Riwayat Penyakit</label></div>
                                            <input type="radio" name="riwayat_penyakit" value="Ada">
                                            <label>Ada</label>
                                            <br>
                                            <input type="radio" name="riwayat_penyakit" value="Tidak">
                                            <label>Tidak</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group text_box">
                                            <label for="penyakit">Jenis Penyakit (jika ada)</label>
                                            <input type="text" class="form-control" name="jenis_penyakit">
                                        </div>
                                    </div>
                                </div>
<hr>
                                <h6 class="f_p f_size_20 t_color3 f_500 mb_20">DATA ORANGTUA / WALI</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Data Ayah</label>
                                        <div class="form-group text_box">
                                            <input type="text" class="form-control" name="ayah" placeholder="Nama Ayah">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group text_box">
                                                        <div class="f_p text_c f_400">
                                                            <label>Alamat</label></div>
                                                        <textarea class="form-control" name="ayah_alamat" cols="30" rows="5" placeholder="Alamat"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_rt" placeholder="RT">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_rw" placeholder="RW">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_kelurahan" placeholder="Desa/Kelurahan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_kecamatan" placeholder="Kecamatan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_kabupaten" placeholder="Kab./kota">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_provinsi" placeholder="Propinsi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_pekerjaan" placeholder="Pekerjaan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_telepon" placeholder="Nomor Telepon">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ayah_hp" placeholder="Nomor HP">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label>Keadaan Ayah</label>
                                                        </div>
                                                        <div class="col-lg-1"> : </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group text_box">
                                                                <input type="radio" name="ayah_keadaan" value="Masih Hidup">
                                                                <label>Masih Hidup</label>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <input type="radio" name="ayah_keadaan" value="Sudah Meninggal">
                                                                <label>Sudah Meninggal</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label> Data Ibu</label>
                                        <div class="form-group text_box">
                                            <input type="text" class="form-control" name="ibu" placeholder="Nama Ibu">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group text_box">
                                                        <div class="f_p text_c f_400">
                                                            <label>Alamat</label></div>
                                                        <textarea class="form-control" name="ibu_alamat" cols="30" rows="5" placeholder="Alamat"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_rt" placeholder="RT">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_rw" placeholder="RW">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_kelurahan" placeholder="Desa/Kelurahan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_kecamatan" placeholder="Kecamatan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_kabupaten" placeholder="Kab./kota">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_provinsi" placeholder="Propinsi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_pekerjaan" placeholder="Pekerjaan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_telepon" placeholder="Nomor Telepon">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group text_box">
                                                        <input type="text" class="form-control" name="ibu_hp" placeholder="Nomor HP">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label>Keadaan Ibu</label>
                                                        </div>
                                                        <div class="col-lg-1"> : </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group text_box">
                                                                <input type="radio" name="ibu_keadaan" value="Masih Hidup">
                                                                <label>Masih Hidup</label>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <input type="radio" name="ibu_keadaan" value="Sudah Meninggal">
                                                                <label>Sudah Meninggal</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="form-control btn btn-success" type="submit" class="btn_three">Submit Peserta</button>
                            </form>
                        </div>
</div>
<hr>
</div>
@endsection
