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
        <th>Via</th>
        <th>Responden aa</th>
        <th>Survey</th>
        <th>Score Question</th>
        <th>Score Confirmation</th>
        <th>Created At</th>
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->responden->via }}</td>
            <td>{{ $d->responden->username }}</td>
            <td>{{ $d->survey->name }}</td>
            <td>{{ $d->score_question($d->id) }}</td>
            <td>{{ $d->score_confirmation($d->id) }}</td>
            <td>{{ $d->created_at }}</td>
            <td width="200">
                <a href="{{route('survey.recapitulation.look',$d->id)}}" title="look data survey" type="button" class="btn btn-info btn-xs btn-modal-edit" stateId="{{$d->id}}" stateName="{{$d->responden->id}}">
                  <i class="fa fa-search"></i>
                </a>
                <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->responden->username}}">
                  <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalDelete" method="post" action="{{route('survey.recapitulation.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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
            <h3>Delete  <b><span class="info-delete"></span></b>'s survey data ?</h3>
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
    $('#edit_name').val($(this).attr('stateName'));
    $('#modalEdit').modal('toggle');
  });

  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });
</script>
@endsection
