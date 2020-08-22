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
  <a href="{{route('scenario')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
  <!-- <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">Add Form</a> -->
<div>
<hr />
<form id="formModalEdit" method="post" action="{{route('scenario.greeting.update',$id)}}" accept-charset="UTF-8" style="margin:0 auto">
@csrf
@method('patch')
<textarea class="form-control" rows="10" name="greeting">
{!!$greeting->text!!}
</textarea>
<br />
<button type="submit" class="form-control btn btn-success">Update</button>
</form>
</div>
</div>
</div>

@endsection
