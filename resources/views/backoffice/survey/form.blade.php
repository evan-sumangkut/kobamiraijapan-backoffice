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
  <a href="{{route('survey',$branch_id)}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
  <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">Add Form</a>
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Form</th>
        <th>Type</th>
        <th>Score In</th>
        <th>Min Score - Max Score</th>
        <th>Order</th>
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->form->name }}</td>
            <td>{{ ucfirst($d->type) }}</td>
            <td>{{$d->survey_form_question->count()}}/{{$d->form->questions->count()}} Question</td>
            <td>{{$d->min}} - {{$d->max}}</td>
            <td>{{$d->order}}</td>
            <td width="200">
                @if($d->type=='confirmation')
                <a href="{{route('survey.form.confirmation',$d->id)}}" title="edit confirmation" type="button" class="btn btn-info btn-xs">
                  <i class="fa fa-check-square"></i>
                </a>
                @endif
                <a href="{{route('survey.form.question',$d->id)}}" title="edit score" type="button" class="btn btn-warning btn-xs">
                  <i class="fa fa-file-text"></i>
                </a>
                <button title="edit order" type="button" class="btn btn-primary btn-xs btn-modal-edit" stateId="{{$d->id}}" stateName="{{$d->form->name}}" stateOrder="{{$d->order}}">
                  <i class="fa fa-sort"></i>
                </button>
                <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->form->name}}">
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
      <form role="form" method="POST" action="{{route('survey.form.add',$id) }}" enctype="multipart/form-data">
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
                <label>Order</label>
                <input type="number" name="order" class="form-control" value="{{$order}}"/>
            </div>
          </div>
          <div class="form-group">
              <label>Form</label><br />
              <select id="survey_form" name="form_id" class="select2 form-control" required>
                <option value="">-----------</option>
                @foreach($form as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label>Type</label>
              <select id="type_form" name="type" class="form-control">
                <option value="question">Question</option>
                <option value="confirmation">Confirmation</option>
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
    <form id="formModalEdit" method="post" action="{{route('survey.form.update')}}" accept-charset="UTF-8" style="margin:0 auto">
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
          <div class="form-group">
            <label>Form</label>
            <input id="stateName" readonly class="form-control"/>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
                <label>Order</label>
                <input id="stateOrder" type="number" name="order" class="form-control" value=""/>
            </div>
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
    <form id="formModalDelete" method="post" action="{{route('survey.form.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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

<script type="text/javascript">
  $(".btn-modal-edit").click(function(){
    $('#stateIdUpdate').val($(this).attr('stateId'));
    $('#stateName').val($(this).attr('stateName'));
    $('#stateOrder').val($(this).attr('stateOrder'));
    $('#modalEdit').modal('toggle');
  });
  $(document).ready(function() {
      $('.select2').select2({
        // theme: "bootstrap"
      });
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
</script>
@endsection
