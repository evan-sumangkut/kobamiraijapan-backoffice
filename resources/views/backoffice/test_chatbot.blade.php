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
<form method="GET" action="{{route('test_chatbot')}}">
<div class="row">
  <div class="form-group col-md-5">
    <label>Sender</label>
    <input value="{{$sender}}" required id="sender" type="text" placeholder="Isi dengan nomor hape: 6281xxxxxx" name="sender" class="form-control" />
  </div>
  <div class="form-group col-md-5">
    <label>Messages</label>
    <input type="text" required placeholder="Ketik pesan..." name="messages" class="form-control" />
  </div>
  <div class="form-group col-md-2" style="padding-top:1.7em">
    <button class="btn btn-info form-control" style="font-weight:600"><i class="fa fa-send"></i> Send</button>
  </div>
</div>
</form>
<hr>
<h4 style="font-weight:600">Response:</h4>
@if(isset($response))
  {{$response}}
@endif
<hr />
<h4 style="font-weight:600">Response HTML:</h4>
@if(isset($response_html))
  {!!$response_html!!}
@endif
</div>
</div>
@endsection
