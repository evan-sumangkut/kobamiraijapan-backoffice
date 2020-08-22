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
        <th>Time</th>
        <th>Branch</th>
        <!-- <th>TrxID</th> -->
        <th>Via</th>
        <th>Responden</th>
        <th>Type</th>
        <th>Jenis Form</th>
        <th>Tag</th>
        <th>Scenario Name</th>
        <th>Form Name</th>
        <th>Keterangan</th>
        <th>Refferensi/Value</th>
        <th>Respons Time(s)</th>
        <th>Score</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $d->created_at }}</td>
            <td>{{ $d->branch->name }}</td>
            <!-- <td>{{ $d->question_id }}</td> -->
            <td>{{ $d->via }}</td>
            <td>{{ $d->responden }}</td>
            <td>{{ $d->type }}</td>
            <td>{{ $d->type_form }}</td>
            <td>{{ $d->tag }}</td>
            <td>{{ $d->scenario_name }}</td>
            <td>{{ $d->form_name }}</td>
            <td>{{ $d->description }}</td>
            <td>{{ $d->value ? $d->value : $d->reference }}</td>
            <td>{{ $d->response_time }}</td>
            <td>{{ $d->score ? $d->score : '-' }}</td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>


@endsection
