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
<form method="GET" action="{{route('hasil_interview')}}">
  <div class="row">
    <div class="form-group col-md-4">
      <label>Field</label>
      <select class="form-control" name="field" required>
        <option {{$condition=='sender' ? 'selected' : null}} value="sender">sender</option>
        <option {{$condition=='tag' ? 'selected' : null}} value="tag">tag</option>
        <option {{$condition=='content' ? 'selected' : null}} value="content">pertanyaan</option>
        <option {{$condition=='answer' ? 'selected' : null}} value="answer">jawaban</option>
        <option {{$condition=='scoring' ? 'selected' : null}} value="scoring">scoring</option>
        <option {{$condition=='startquestiondate' ? 'selected' : null}} value="startquestiondate">start question</option>
        <option {{$condition=='questiondate' ? 'selected' : null}} value="questiondate">complete answer</option>
        <option {{$condition=='formid' ? 'selected' : null}} value="formid">form</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label>Condition</label>
      <select class="form-control" name="condition" required>
        <option value="">Pilih kondisi</option>
        <option {{$condition=='=' ? 'selected' : null}} value="=">Equal</option>
        <option {{$condition=='like' ? 'selected' : null}}  value="like">mengandung kata </option>
        <option {{$condition=='>' ? 'selected' : null}}  value=">">Lebih besar dari</option>
        <option {{$condition=='>=' ? 'selected' : null}}  value=">=">Lebih besar atau sama dengan</option>
        <option {{$condition=='<' ? 'selected' : null}}  value="<">Lebih kecil dari</option>
        <option {{$condition=='<=' ? 'selected' : null}}  value="<=">Lebih kecil atau sama dengan</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label>Value</label>
      <input type="text" class="form-control" name="value" value="{{$value}}" required/>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <a href="{{route('hasil_interview')}}" class="btn btn-danger form-control" style="font-weight:600"><i class="fa fa-repeat"></i> Reset Form</a>
    </div>
    <div class="col-md-8">
      <button type="submit" class="btn btn-primary form-control" style="font-weight:600"><i class="fa fa-search-plus"></i> Custom Search</button>
    </div>
  </div>
</form>
<hr>
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
          <th>No.</th>
          <th>Sender</th>
          <th>Tag</th>
          <th>Pertanyaan</th>
          <th>Jawaban</th>
          <th>Scoring</th>
          <th>Start Question</th>
          <th>Completed Answer</th>
          <th>Response Time</th>
          <th>Form</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($data as $d)
          <tr>
              <td width="10px" style="text-align: center" >{{ $no++ }}</td>
              <td>{{ $d->sender }}</td>
              <td>{{ $d->tag }}</td>
              <td>{{ $d->content }}</td>
              <td>{{ $d->answer }}</td>
              <td>{{ $d->scoring }}</td>
              <td>{{ $d->startquestiondate }}</td>
              <td>{{ $d->questiondate }}</td>
              <td>{{ selisihWaktu($d->startquestiondate,$d->questiondate) }}</td>
              <td>{{ $d->formid }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
@endsection
