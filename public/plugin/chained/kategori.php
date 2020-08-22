@extends('_layouts.admin')
@include('_plugin.table')
@section('link')
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Kategori SPJ Rutin</li>
</ol>
@endsection
@section('content')
<?php
$no = 1;
?>

<div class="box">

<div class="box-body table-responsive">
<p>
<a data-toggle="modal" data-target="#modalAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kategori SPJ</a>
</p>
    <div class="modal modal-primary fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form role="form" method="POST" enctype="multipart/form-data" action="{{route('kategori_save')}}" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Kategori SPJ</h4>
            </div>
            <div class="modal-body" >
                <div class="form-group">
                    <label>Kategori SPJ</label>
                    <input type="text" class="form-control" name="kategori" placeholder="Masukkan Kategori" required>
                </div>
                <div class="form-group">
                    
                    <label class="pull-left">Kode Akun</label>

                    <select id="sub_output" class="form-control" name="sub_output_id" value="{{ old('sub_output_id') }}" required>
                            @foreach ($sub_output as $d)
                            @if($d->sirabi_output->kode_output == 994)
                            <option value="{{ $d->id }}">5742.{{ $d->sirabi_output->kode_output }}</option>
                            @else
                            <option value="{{ $d->id }}">5742.{{ $d->sirabi_output->kode_output }}.{{ $d->kode_sub_output }}</option>
                            @endif
                            @endforeach
                    </select> <br>

                    <select id="input" class="form-control" name="input_id" value="{{ old('input_id') }}" required>
                            @foreach ($input as $d)
                            <option data-chained="{{$d->sub_output_id}}" value="{{ $d->id }}">{{ $d->kode_input }}</option>
                            @endforeach
                    </select> <br>
                    <select id="mak" class="form-control" name="mak" value="{{ old('mak') }}" required>
                            @foreach ($akun as $d)
                            <option value="{{ $d->id }}">{{ $d->kode_akun }}</option>
                            @endforeach
                    </select> <br>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline" onclick="return confirm('Apakah data telah benar?');">Submit</button>
            </div>
            </div>
            </form>
        </div>
    </div>


<table id="example2" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Kategori SPJ</th>
        <th style="width:15%">Aksi</th>
      </tr>
      <tbody>
        @foreach($kategori as $data)
            <tr>
                <th>{{ $no++ }}</th>
                <th>{{ $data->kategori }}</th>
                
                <th>
                    <form method="POST" action="{{route('master_rutin_kategori_delete',$data->id)}}" accept-charset="UTF-8">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                        <a href="{{route('master_rutin_spj',$data->id)}}" class="btn btn-info" title="SPJ"><i class="fa fa-folder"></i></a>
                        <a data-toggle="modal" data-target="#modalEdit{{$data->id}}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                            
                        <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin akan menghapus data?');"><i class="fa  fa-trash-o"></i></button>
                    </form> 
                    
                </th>
            </tr>
            <div class="modal modal-primary fade" id="modalEdit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{route('master_rutin_kategori_update', $data->id)}}" >
                        <input name="_method" type="hidden" value="PATCH">
                        {{ csrf_field() }}
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Kategori SPJ</h4>
                        </div>
                        
                        <div class="modal-body" >
                            <div class="form-group">
                                <label>Kategori SPJ</label>
                                <input type="text" class="form-control" name="kategori" placeholder="Masukkan Kategori" required value="{{ $data->kategori }}">
                            </div>
                            <div class="form-group">
                                
                                <label class="pull-left">Kode Akun</label>

                                <select id="sub_output" class="form-control" name="sub_output_id" value="{{ old('sub_output_id') }}" required>
                                        @foreach ($sub_output as $d)
                                        @if($d->sirabi_output->kode_output == 994)
                                        <option value="{{ $d->id }}">5742.{{ $d->sirabi_output->kode_output }}</option>
                                        @else
                                        <option value="{{ $d->id }}">5742.{{ $d->sirabi_output->kode_output }}.{{ $d->kode_sub_output }}</option>
                                        @endif
                                        @endforeach
                                </select> <br>

                                <select id="input" class="form-control" name="input_id" value="{{ old('input_id') }}" required>
                                        @foreach ($input as $d)
                                        <option data-chained="{{$d->sub_output_id}}" value="{{ $d->id }}">{{ $d->kode_input }}</option>
                                        @endforeach
                                </select> <br>
                                <select id="mak" class="form-control" name="mak" value="{{ old('mak') }}" required>
                                        @foreach ($akun as $d)
                                        <option value="{{ $d->id }}">{{ $d->kode_akun }}</option>
                                        @endforeach
                                </select> <br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline" onclick="return confirm('Apakah data telah benar?');">Submit</button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
        @endforeach
      </tbody>
  </thead>
  
</table>
</div>
</div>


@endsection
@section('tambah_script')
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<script src="{{ asset('js/jquery.chained.js?v=1.0.0') }}" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
  $(function() {

    /* For jquery.chained.js */
    $("#input").chained("#sub_output");
    
    
  });
</script>
@endsection