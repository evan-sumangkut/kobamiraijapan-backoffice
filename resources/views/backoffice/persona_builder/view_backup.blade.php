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
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Branch</th>
        <th>Total Persona</th>
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->name }}</td>
            <td>proses</td>
            <td width="200">
                <a href="{{route('persona.builder.open',$d->id)}}" title="open branch persona" class="btn btn-info btn-xs">
                  <i class="fa fa-search"></i>
                </a>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection
