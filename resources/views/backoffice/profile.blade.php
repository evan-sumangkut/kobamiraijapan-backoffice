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
  <table id="exampleExcel" class="table table-bordered table-striped">
    <thead>
      {!!$th!!}
    </thead>
    <tbody>
      {!!$td!!}
    </tbody>
  </table>
</div>
</div>
</div>
@endsection
