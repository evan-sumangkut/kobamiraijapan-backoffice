<?php

namespace App\Http\Controllers;

use App\{ Peserta, PesertaKesehatan, PesertaOrangTua, PesertaPekerjaan, PesertaPendidikan };
use DB;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $get_data = Peserta::all();
      $params = [
          'title'=>'Magang',
          'data'=>$get_data
      ];
      return view('backoffice.magang.view')->with($params);
    }

    public function create()
    {
      $params = [
          'title'=>'Tambah Peserta'
      ];
      return view('backoffice.magang.create')->with($params);
    }

    public function add(Request $request)
    {
      $input = $request->all();
      $input['peserta_id'] = null;
      try {
        DB::beginTransaction();
        $peserta = Peserta::create($input);
        $input['peserta_id'] = $peserta->id;
        PesertaKesehatan::create($input);
        PesertaPendidikan::create($input);
        PesertaOrangTua::create($input);
        PesertaPekerjaan::create($input);
        if(Count($input['pengalaman_kerja_periode'])){
          for ($x = 0; $x <= Count($input['pengalaman_kerja_periode']) - 1; $x++) {
            $put = [
              'peserta_id'=>$input['peserta_id'],
              'periode'=>$input['pengalaman_kerja_periode'][$x],
              'perusahaan'=>$input['pengalaman_kerja_namaperusahaan'][$x],
              'gaji_bulanan'=>$input['pengalaman_kerja_gaji'][$x],
              'jenis_pekerjaan'=>$input['pengalaman_kerja_jenis'][$x],
            ];
            if($put['periode']){
              PesertaPekerjaan::create($put);
            }
          }
        }
        DB::commit();
        return redirect()->route('magang')->with('success','Berhasil menambahkan peserta magang');
      } catch (\Exception $e) {
        B::rollBack();
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function edit($id)
    {
      $get_data = Peserta::whereId($id)->first();
      $params = [
          'title'=>'Edit Peserta',
          'data'=>$get_data
      ];
      return view('backoffice.magang.edit')->with($params);
    }

    public function update(Request $request,$id)
    {
      $input = $request->all();
      $input['peserta_id'] = $id;
      try {
        DB::beginTransaction();
        $peserta = Peserta::whereId($id)->firstOrFail();
        $peserta->update($input);
        $PesertaKesehatan = PesertaKesehatan::wherePeserta_id($id)->first();
        $PesertaKesehatan->update($input);
        $PesertaPendidikan = PesertaPendidikan::wherePeserta_id($id)->first();
        $PesertaPendidikan->update($input);
        $PesertaOrangTua = PesertaOrangTua::wherePeserta_id($id)->first();
        $PesertaOrangTua->update($input);
        $PesertaPekerjaan = PesertaPekerjaan::wherePeserta_id($id)->first();
        $PesertaPekerjaan->update($input);
        PesertaPekerjaan::where('peserta_id',$id)->delete();
        if(Count($input['pengalaman_kerja_periode'])){
          for ($x = 0; $x <= Count($input['pengalaman_kerja_periode']) - 1; $x++) {
            $put = [
              'peserta_id'=>$input['peserta_id'],
              'periode'=>$input['pengalaman_kerja_periode'][$x],
              'perusahaan'=>$input['pengalaman_kerja_namaperusahaan'][$x],
              'gaji_bulanan'=>$input['pengalaman_kerja_gaji'][$x],
              'jenis_pekerjaan'=>$input['pengalaman_kerja_jenis'][$x],
            ];
            if($put['periode']){
              PesertaPekerjaan::create($put);
            }
          }
        }
        DB::commit();
        return redirect()->back()->with('success','Berhasil menambahkan peserta magang');
      } catch (\Exception $e) {
        B::rollBack();
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function delete(Request $request)
    {
      $data = Peserta::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function pembayaran(Request $request)
    {
      $data = Peserta::whereId($request->get('stateId'))->firstOrFail();
      try {
        if($data->status_pembayaran==1){
          $put['status_pembayaran'] = 0;
        }else{
          $put['status_pembayaran'] = 1;
        }
        $data->update($put);
        return redirect()->back()->with('success','Status pembayaran berhasil diperbarui');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
