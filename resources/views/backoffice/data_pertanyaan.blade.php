@extends('_layouts.admin')

@include('_plugin.table')
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
<form method="GET" action="{{route('data_pertanyaan')}}">
  <div class="row">
    <div class="col-md-4">
      <select class="form-control" name="formid">
        <option value="">Semua</option>
        @foreach($msform as $d)
        <option {{ $formid==$d->formid ? 'selected' : null}} value="{{$d->formid}}">
          {{$d->form_desc}}
        </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-5">
      <button type="submit" class="btn btn-primary">Pilih Form</button>
    </div>
    <div class="col-md-3" style="text-align:right">
      <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-edit"></i> Kelola Pertanyaan</a>
    </div>

  </div>
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="GET" action="{{route('buat_pertanyaan')}}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Untuk Form:</label>
        <select class="form-control" name="formid">
          @foreach($msform as $d)
          <option {{ $formid==$d->formid ? 'selected' : null}} value="{{$d->formid}}">
            {{$d->form_desc}}
          </option>
          @endforeach
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>
<hr>
<div class="table-responsive">
  <table id="exampleExcel" class="table table-bordered table-striped">
    <thead>
        <tr>
          <th>No.</th>
          <th>Form id</th>
          <th>QID</th>
          <th>Konten Pertanyaan</th>
          <th>Number Response</th>
          <th>Option Jawaban</th>
          <th>Next QID</th>
          <th>Tag</th>
          <th>Value Response</th>
          <th>Scoring</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($data as $d)
          <tr>
              <td style="text-align: center" >{{ $no++ }}</td>
              <td>{{ $d->formid }}</td>
              <td>{{ $d->qid }}</td>
              <td>{{ $d->content }}</td>
              <td>{{ $d->numberresponse }}</td>
              <td>{{ $d->optionjawaban }}</td>
              <td>{{ $d->nextqid }}</td>
              <td>{{ $d->tag }}</td>
              <td>{{ $d->valueresponse }}</td>
              <td>{{ $d->scoring }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
@endsection
