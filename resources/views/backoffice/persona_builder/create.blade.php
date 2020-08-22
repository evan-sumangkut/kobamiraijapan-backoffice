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
<!-- <a href="{{route('question')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a> -->
<div class="">
  <hr />
  <form method="POST" action="{{route('persona.builder.add')}}">
    @csrf
    <input type="hidden" name="m_persona_id" value="{{$data->id}}" />
    <input type="hidden" name="branch_id" value="{{$branch_id}}" />
    <div class="row">
      <div class="form-group col-md-4">
          <label>Field</label>
          <input type="text" class="form-control"  value="{{$data->field}}" disabled>
      </div>
    </div>
    <div class="form-group">
        <label>Custom Question</label>
        <input type="text" class="form-control" name="custom_question"  value="{{$data->question}}" required>
    </div>
    <br />
    <div class="row">
      <div class="col-md-8">
        <button type="submit" class="btn btn-primary form-control" style="font-weight:600"><i class="fa fa-save"></i> Submit</button>
      </div>
    </div>
  </form>
</div>
<hr>
</div>
@endsection
