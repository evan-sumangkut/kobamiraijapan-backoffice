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
  <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">New Persona</a>
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Field</th>
        <th>Question</th>
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->field }}</td>
            <td>{{ $d->question }}</td>
            <td width="200">
                <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateField="{{$d->field}}" stateQuestion="{{$d->question}}">
                  <i class="fa fa-edit"></i>
                </button>
                <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->name}}">
                  <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>


<!-- MODAL ADD -->
<div class="modal modal fade" id="modalAddMajor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <form role="form" method="POST" action="{{route('persona.add') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Persona</h4>
        </div>
        <div class="modal-body" >
          <div class="form-group">
              <label>Field</label>
              <input type="text" class="form-control" name="field" placeholder="field" value="" required>
          </div>
          <div class="form-group">
              <label>Question</label>
              <input type="text" class="form-control" name="question" placeholder="question" value="" required>
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
    <form id="formModalEdit" method="post" action="{{route('persona.update')}}" accept-charset="UTF-8" style="margin:0 auto">
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
              <label>Field</label>
              <input type="text" id="stateField" class="form-control" name="field" placeholder="field" value="" required>
          </div>
          <div class="form-group">
              <label>Question</label>
              <input type="text" id="stateQuestion" class="form-control" name="question" placeholder="question" value="" required>
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
    <form id="formModalDelete" method="post" action="{{route('persona.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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
    $('#stateField').val($(this).attr('stateField'));
    $('#stateQuestion').val($(this).attr('stateQuestion'));
    $('#modalEdit').modal('toggle');
  });

  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });
</script>
@endsection
