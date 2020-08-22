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

<div class="row">
  <div class="col-md-12" style="padding-left:2em">
    <h3>{{$title}}</h3>
  </div>
</div>
<br />

<div class="row">
  <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            @foreach ($data as $d)
            <li>
              <i class="fa bg-aqua" style="font-weight:bold">{{$no++}}</i>
              <div class="timeline-item">
                <span class="time">
                </span>
                <h3 class="timeline-header"><a href="#">{{$d->name}}</a></h3>

                <div class="timeline-body">
                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3>{{$d->branch_persona->count()}}</h3>
                          <p>Persona</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text"></i>
                        </div>
                        <a href="{{route('persona.builder.open',$d->id)}}" class="small-box-footer">
                          Manage <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>-</h3>
                          <p>Chatbot</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-android"></i>
                        </div>
                        <a href="{{route('persona.builder.chatbot',$d->id)}}" class="small-box-footer">
                          Testing <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            @endforeach
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
</div>
@endsection
