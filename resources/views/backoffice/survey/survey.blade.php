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

<!-- <div class="callout callout-warning">
                <h4>I am a danger callout!</h4>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.</p>
              </div> -->
<div class="row">
  <div class="col-md-12" style="padding-left:2em">
    <h3>{{$title}}</h3><a href="{{route('scenario')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
    <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">New Scenario</a>
  </div>
</div>
<br />

<div class="row">
  <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <li>
              <i class="fa bg-aqua" style="font-weight:bold">{{$no++}}</i>
              <div class="timeline-item">
                <span class="time">
                  <button title="make it opening" type="button" class="btn btn-success btn-xs">
                    Registration Account
                  </button>
                </span>
                <h3 class="timeline-header"><a href="#">Persona</a></h3>

                <div class="timeline-body">
                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3>0</h3>
                          <p>Persona</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text"></i>
                        </div>
                        <a href="{{route('persona.builder.open',$id)}}" class="small-box-footer">
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
                        <a href="#" class="small-box-footer">
                          Testing <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>0</h3>
                          <p>Recapitulation</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            @foreach ($data as $d)
            <li>
              <i class="fa bg-aqua" style="font-weight:bold">{{$no++}}</i>
              <div class="timeline-item">
                <span class="time">
                  <button title="make it active" type="button" class="btn {{$d->is_active ? 'btn-success' : 'btn-default' }} btn-xs btn-modal-active" stateId="{{$d->id}}" stateName="{{$d->name}}" stateStatus="{{$d->is_active}}">
                    {{$d->is_active ? 'Active' : 'Draft' }}
                  </button>
                </span>
                <h3 class="timeline-header"><a href="#">{{$d->name}}</a></h3>

                <div class="timeline-body">
                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3>{{$d->survey_forms->count()}}</h3>
                          <p>Forms</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text"></i>
                        </div>
                        <a href="{{route('survey.form',$d->id)}}" class="small-box-footer">
                          Manage <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <!-- <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>0</h3>
                          <p>Crob Job</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <a href="{{route('survey.cronjob',$d->id)}}" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div> -->
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>-</h3>
                          <p>Chatbot</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-android"></i>
                        </div>
                        <a href="{{route('survey.chatbot',$d->id)}}" class="small-box-footer">
                          Testing <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>{{$d->transaction_survey->count()}}</h3>
                          <p>Recapitulation</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('survey.recapitulation',$d->id)}}" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3><i class="fa fa-ban"></i></h3>
                          <p>Greetings</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-info"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fa fa-a rrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div>
                    Branch: <b>{{$d->branch ? $d->branch->name : '-'}}</b>
                  </div>
                  <div>
                    Description: <b>{{$d->description}}</b>
                  </div>
                </div>
                <div class="timeline-footer">
                  <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateName="{{$d->name}}" stateDescription="{{$d->description}}" stateBranch="{{$d->branch_id}}">
                    <i class="fa fa-edit"></i> Edit
                  </button>
                  <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->name}}">
                    <i class="fa fa-trash"></i> Delete
                  </button>
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

<!-- MODAL ADD -->
<div class="modal modal fade" id="modalAddMajor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <form role="form" method="POST" action="{{route('survey.add') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Form</h4>
        </div>
        <div class="modal-body" >
          @if(!Auth::user()->branch_id)
          <div class="form-group">
            <label>Branch</label>
            <select class="form-control" name="branch_id">
              <option value="">---</option>
              @foreach($branch as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
              @endforeach
            </select>
          </div>
          @endif
          <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Survey Name" value="" required>
          </div>
          <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control" name="description" placeholder="About Survey" value="" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" onclick="return confirm('Apakah data telah benar?');">Submit</button>
        </div>
      </div>
      </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalEdit" method="post" action="{{route('survey.update')}}" accept-charset="UTF-8" style="margin:0 auto">
      @csrf
      @method('patch')
      <input type="hidden" name="stateId" value="" id="stateIdUpdate" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if(!Auth::user()->branch_id)
          <div class="form-group">
              <label>Branch</label>
              <select id="stateBranch" name="branch_id" class="form-control">
                <option value="">Tanpa Branch</option>
                @foreach($branch as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
          </div>
          @endif
          <div class="form-group">
              <label>Name</label>
              <input type="text" id="edit_name" class="form-control" name="name" placeholder="Without #" value="" required>
          </div>
          <div class="form-group">
              <label>Description</label>
              <input type="text" id="edit_description" class="form-control" name="description" placeholder="About Survey" value="" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalDelete" method="post" action="{{route('survey.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
      @csrf
      @method('delete')
      <input type="hidden" name="stateId" value="" id="stateIdDelete" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group text-center">
            <h3>Delete <b><span class="info-delete"></span></b> ?</h3>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- MODAL OPENING -->
<div class="modal fade" id="modalOpening" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalOpening" method="post" action="{{route('survey.opening')}}" accept-charset="UTF-8" style="margin:0 auto">
      @csrf
      @method('patch')
      <input type="hidden" name="stateId" value="" id="stateIdOpening" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group text-center">
            <h3>Make it <b><span class="info-opening"></span></b> is <b><span class="info-opening-status"></span></b> ?</h3>
          </div>
          <div>
            <br />
            note: the opening can only be for 1 form
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- MODAL ACTIVE -->
<div class="modal fade" id="modalActive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalActive" method="post" action="{{route('survey.active')}}" accept-charset="UTF-8" style="margin:0 auto">
      @csrf
      @method('patch')
      <input type="hidden" name="stateId" value="" id="stateIdActive" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group text-center">
            <h3>Make it <b><span class="info-active"></span></b> is <b><span class="info-active-status"></span></b> ?</h3>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  $(".btn-modal-edit").click(function(){
    $('#stateIdUpdate').val($(this).attr('stateId'));
    $('#edit_name').val($(this).attr('stateName'));
    $('#stateBranch').val($(this).attr('stateBranch'));
    $('#edit_description').val($(this).attr('stateDescription'));
    $('#modalEdit').modal('toggle');
  });

  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });

  $(".btn-modal-opening").click(function(){
    $( ".info-opening" ).text($(this).attr('stateName'));
    $('#stateIdOpening').val($(this).attr('stateId'));
    if($(this).attr('stateStatus')==1){
      $( ".info-opening-status" ).text('Not Opening');
    }else{
      $( ".info-opening-status" ).text('Opening');
    }
    $('#modalOpening').modal('toggle');
  });

  $(".btn-modal-active").click(function(){
    $( ".info-active" ).text($(this).attr('stateName'));
    $('#stateIdActive').val($(this).attr('stateId'));
    if($(this).attr('stateStatus')==1){
      $( ".info-active-status" ).text('Draft');
    }else{
      $( ".info-active-status" ).text('Active');
    }
    $('#modalActive').modal('toggle');
  });
</script>
@endsection
