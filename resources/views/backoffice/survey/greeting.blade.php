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
    <a href="{{route('scenario.greeting.edit',$id)}}"  class="btn btn-primary">Update Greeting</a>
    <h4>Default Message:</h4>
    {!!nl2br($greeting->text)!!}
  </div>

  <div class="table-responsive">
    <hr />
      <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">Add Response Greeting</a>
      <br /><br />
  <table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
          <th>Key</th>
          <th>Type</th>
          <th>Survey</th>
          <th>Text</th>
          <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($data as $d)
          <tr>
              <td width="10px" style="text-align: center" >{{ $d->key }}</td>
              <td>{{ $d->type }}</td>
              <td>{!! $d->type== 'connect_survey' ? '<b>'.$d->survey->name.'</b>' : null!!}</td>
              <td>{{ $d->text }}</td>
              <td width="200">
                  <button title="edit order" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateKey="{{$d->key}}" stateType="{{$d->type}}" stateText="{{$d->text}}" stateSurveyId="{{$d->survey_id}}">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->key}}" >
                    <i class="fa fa-trash"></i>
                  </button>
              </td>
          </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>


<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice{color:black;}
</style>

<!-- MODAL ADD -->
<div class="modal modal fade" id="modalAddMajor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <form role="form" method="POST" action="{{route('scenario.greeting.add',$id) }}" enctype="multipart/form-data">
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Form</h4>
        </div>
        <div class="modal-body" >
          <div class="row">
            <div class="form-group col-md-4">
                <label>Key</label>
                <input type="text" name="key" class="form-control" />
            </div>
          </div>
          <div class="form-group">
              <label>Type</label>
              <select id="type_form" name="type" class="form-control">
                <option value="information">Information</option>
                <option value="connect_survey">Connect to Survey</option>
              </select>
          </div>
          <div class="form-group form-information">
              <label>Text</label>
              <textarea class="form-control" rows="10" name="text"></textarea>
          </div>
          <div class="form-group form-survey">
              <label>Survey</label>
              <select name="survey_id" class="form-control">
                @foreach($survey as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
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
    <form id="formModalEdit" method="post" action="{{route('scenario.greeting.information_update')}}" accept-charset="UTF-8" style="margin:0 auto">
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
            <div class="row">
              <div class="form-group col-md-4">
                  <label>Key</label>
                  <input id="stateKey" type="text" name="key" class="form-control" />
              </div>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select id="stateType" name="type" class="form-control">
                  <option value="information">Information</option>
                  <option value="connect_survey">Connect to Survey</option>
                </select>
            </div>
            <div class="form-group">
                <label>Text</label>
                <textarea id="stateText" class="form-control" rows="10" name="text"></textarea>
            </div>
            <div class="form-group form-edit-survey">
                <label>Survey</label>
                <select id="stateSurveyId" name="survey_id" class="form-control">
                  @foreach($survey as $d)
                  <option value="{{$d->id}}">{{$d->name}}</option>
                  @endforeach
                </select>
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
    <form id="formModalDelete" method="post" action="{{route('scenario.greeting.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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
          <br />
          <div class="form-group text-center">
            <h3>Delete key <b><span class="info-delete"></span></b> ?</h3>
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

<script type="text/javascript">
  $(".btn-modal-edit").click(function(){
    $(".form-edit-survey").hide()
    if($(this).attr('stateType')=='connect_survey'){
      $(".form-edit-survey").show()
    }
    $('#stateIdUpdate').val($(this).attr('stateId'));
    $('#stateKey').val($(this).attr('stateKey'));
    $('#stateText').val($(this).attr('stateText'));
    $('#stateType').val($(this).attr('stateType'));
    $('#stateSurveyId').val($(this).attr('stateSurveyId'));
    $('#modalEdit').modal('toggle');
  });
  $(document).ready(function() {
      $('.select2').select2({
        // theme: "bootstrap"
      });
      $(".form-survey").hide()
  });
  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });
  $(function () {
    $('.select2-bootstrap').select2({
      theme: "bootstrap"
    });
  });

  $("#stateType").change(function(){
    var cond = $("#stateType" ).val();
    console.log(cond);
    if(cond=='information'){
      // $(".form-information").show()
      $(".form-edit-survey").hide()
    }else{
      $(".form-edit-survey").show()
      // $(".form-information").hide()
    }
  });

  $("#type_form").change(function(){
    var cond = $("#type_form" ).val();
    console.log(cond);
    if(cond=='information'){
      // $(".form-information").show()
      $(".form-survey").hide()
    }else{
      $(".form-survey").show()
      // $(".form-information").hide()
    }
  });
</script>
@endsection
