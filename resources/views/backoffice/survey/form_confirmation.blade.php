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
  <a href="{{route('survey.form',$survey_id)}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
<div class="table-responsive">
<hr />
@if(Count($form_question))
<table id="datatable" class="table table-bordered table-striped">
<thead>
    <tr>
      <th>No.</th>
      <th>Question</th>
      <th>Condition</th>
      <th>Action</th>
    </tr>
</thead>
<tbody>
  @foreach ($form_question as $d)
      <tr>
          <td width="10px" style="text-align: center" >{{ $no++ }}</td>
          <td>{{ $d->form_question->question->content }}</td>
          <td>
            @foreach($d->survey_form_confirmation as $f)
            <button class="btn btn-warning btn-xs btn-modal-edit-condition" stateId="{{$f->id}}">{{$f->method}} {{ $f->to_survey_form ? $f->to_survey_form->form->name : null }} {{$f->operation}} {{$f->if_score}}
               {{ $f->to_form_question ? '- '. $f->to_form_question->question->content.' = ' : null }} {{$f->if_respond}}
            </button>
            @endforeach
          </td>
          <td width="200">
              <button title="edit" type="button" class="btn btn-info btn-xs btn-modal-edit" stateId="{{$d->id}}">
                <i class="fa fa-plus"></i> Condition
              </button>
          </td>
      </tr>
  @endforeach
</tbody>
</table>
@else
<div style="text-align:center">
  <h3>Score harus dibuat lebih dulu</h3>
</div>
@endif
</div>
<hr>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalEdit" method="get" action="{{route('survey.form.confirmation.create',$survey_form_id)}}" accept-charset="UTF-8" style="margin:0 auto">
      <input type="hidden" name="stateId" value="" id="stateIdUpdate" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <div class="form-group">
            <label>Condition</label>
            <select class="form-control" id="condition" name="condition">
              <option value="score_all">Score all Form</option>
              <option value="score_form">Score by Form</option>
              <option value="respond">From Respond</option>
            </select>
          </div>
          <div class="form-group survey_form">
              <label>Form </label>
              <select class="form-control" name="to_survey_form_id">
                @foreach($survey_form as $d)
                <option value="{{$d->id}}">{{$d->form->name}}</option>
                @endforeach
              </select>
          </div>
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- MODAL EDIT CONDITION -->
<div class="modal fade" id="modalEditCondition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalEditCondition" method="POST" action="{{route('survey.form.confirmation.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
      @csrf
      @method('delete')
      <input type="hidden" name="stateId" value="" id="stateIdCondition" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group" style="text-align:center">
              <h4>Hapus Condition ?</h4>
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
  var cond = $("#condition" ).val();
  if(cond=='score_all'){
    $(".survey_form").hide()
  }else{
    $(".survey_form").show()
  }
  $('#stateIdUpdate').val($(this).attr('stateId'));
  $('#modalEdit').modal('toggle');
});

$(".btn-modal-edit-condition").click(function(){
  $('#stateIdCondition').val($(this).attr('stateId'));
  $('#modalEditCondition').modal('toggle');
});

$("#condition").change(function(){
  var cond = $("#condition" ).val();
  if(cond=='score_all'){
    $(".survey_form").hide()
  }else{
    $(".survey_form").show()
  }
});

</script>
@endsection
