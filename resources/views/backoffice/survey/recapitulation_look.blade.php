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
  <a href="{{route('survey.recapitulation',$survey_id)}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Responden</th>
        <th>Question</th>
        <th>Score</th>
        <th>Created At</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data->transaction_survey_value as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->responden->username }}</td>
            <td>{{ $d->survey_form_question->form_question->question->content }}</td>
            <td>{{ $d->score }}</td>
            <td>{{ $d->created_at }}</td>

        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection
