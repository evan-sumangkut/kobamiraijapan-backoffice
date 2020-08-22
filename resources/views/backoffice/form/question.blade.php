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
  <a href="{{route('form')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
  <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">Add Question</a>
  <!-- <a type="button"  data-toggle="modal" data-target="#modalAddMajorS"  class="btn btn-info">Add Result</a> -->
<div class="table-responsive">
<hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Question <br />Sequence</th>
        <th>Content</th>
        <!-- <th>Bobot</th> -->
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        @php
          $choices = explode("~",$d->choice);
          $choices_description = explode("~",$d->choice_description);
        @endphp
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->qid }}</td>
            <td>{{$d->question->branch ? $d->question->branch->name.' - ' : ''}} {{ $d->question->content }}</td>
            <td>
              @for ($i = 0; $i <= count($choices) - 1; $i++)
              {{$choices[$i]}}. {{$choices_description[$i]}}<br />
              @endfor
            </td>
            <!-- <td></td> -->
            <td width="50">
                <!-- <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateQuestion="{{$d->question_id}}" stateQid="{{$d->qid}}"
                  stateChoiceNextQid="{{$d->choice_next_qid}}" stateScoring="{{$d->scoring}}" stateDuration="{{$d->duration}}" stateNextQid="{{$d->next_qid}}">
                  <i class="fa fa-edit"></i>
                </button> -->
                <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateQuestion="{{$d->question->content}}" stateQid="{{$d->qid}}"
                  stateChoiceNextQid="{{$d->choice_next_qid}}" stateNextQid="{{$d->next_qid}}" stateChoice="{{$d->choice}}" stateChoiceDescription="{{$d->choice_description}}">
                  <i class="fa fa-edit"></i>
                </button>
                <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->qid}}">
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
    <div class="modal-dialog modal-lg" role="document">
      <form role="form" method="GET" action="{{route('form.question.create',$form->id) }}" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Question</h4>
        </div>
        <div class="modal-body" >
          <div class="row">
            <div class="col-md-2 form-group">
                <label>QID</label>
                <input type="text" class="form-control" name="qid" placeholder="Example: 1" value="{{$last_qid}}" required>
            </div>
          </div>
          <div class="form-group">
              <label>Question</label><br />
              <select id="form_question" name="question_id" class="select2-bootstrap form-control">
                <option value="">-----------</option>
                @foreach($question as $d)
                <option value="{{$d->id}}">{{$d->branch ? $d->branch->name.' - ' : ''}} {{$d->content}}</option>
                @endforeach
              </select>
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

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="formModalEdit" method="post" action="{{route('form.question.update')}}" accept-charset="UTF-8" style="margin:0 auto">
      @csrf
      @method('patch')
      <input type="hidden" name="stateId" value="" id="stateIdUpdate" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <div class="row">
            <div class="col-md-2 form-group">
                <label>QID</label>
                <input id="stateQid" type="text" class="form-control" name="qid" placeholder="Example: 1" value="" required>
            </div>
          </div>
          <div class="form-group">
              <label>Question</label>
              <input id="stateQuestion" type="text" class="form-control" placeholder="" value="" readonly>
          </div>
          <!-- <div class="form-group">
              <label>Question</label>
              <select id="stateQuestion" readonly name="question_id" class="form-control">
                <option value="">-----------</option>
                @foreach($question as $d)
                <option value="{{$d->id}}">{{$d->content}}</option>
                @endforeach
              </select>
          </div> -->
          <!-- <div class="row">
            <div class="col-md-4 form-group">
                <label>Scoring</label>
                <input id="stateScoring" type="text" name="scoring" class="form-control" placeholder="Example: 20~40~50~70"/>
            </div>
        </div> -->
        <div class="row">
          <div class="col-md-4 form-group">
              <label>Choice</label>
              <input id="stateChoice" type="text" name="choice" class="form-control" placeholder="Example: 20~40~50~70"/>
          </div>
          <div class="col-md-8 form-group">
              <label>Choice Description</label>
              <input id="stateChoiceDescription" type="text" name="choice_description" class="form-control" placeholder="Example: Opsi A ~ Opsi B ~ Opsi C ~ Opsi D"/>
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
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formModalDelete" method="post" action="{{route('form.question.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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
            <h3>Delete QID <b><span class="info-delete"></span></b> ?</h3>
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
  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });

  $(".btn-modal-edit").click(function(){
    $('#stateIdUpdate').val($(this).attr('stateId'));
    $('#stateQid').val($(this).attr('stateQid'));
    $('#stateQuestion').val($(this).attr('stateQuestion'));
    // $('#stateScoring').val($(this).attr('stateScoring'));
    $('#stateChoice').val($(this).attr('stateChoice'));
    $('#stateChoiceDescription').val($(this).attr('stateChoiceDescription'));
    $('#modalEdit').modal('toggle');
  });
  $(function () {
    $('.select2-bootstrap').select2({
      theme: "bootstrap"
    });
  });

</script>
@endsection
