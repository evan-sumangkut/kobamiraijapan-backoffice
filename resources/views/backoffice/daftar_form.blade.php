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
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
          <th>No.</th>
          <th>Form id</th>
          <th>Form Desc</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($data as $d)
          <tr>
              <td width="10px" style="text-align: center" >{{ $no++ }}</td>
              <td>{{ $d->formid }}</td>
              <td>{{ $d->form_desc }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
@endsection
