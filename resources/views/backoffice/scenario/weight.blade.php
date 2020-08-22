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
<form method="post" action="{{route('scenario.weight.update')}}" accept-charset="UTF-8" style="margin:0 auto">
  @csrf
  @method('patch')
<div class="box">
<div class="box-body">
<h3>{{$title}}</h3>
  <a href="{{route('scenario')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
  <button type="submit" class="btn btn-primary">Update Scenario</button>
  <!-- <a type="button"  data-toggle="modal" data-target="#modalAddMajorS"  class="btn btn-info">Add Result</a> -->
<div class="table-responsive">
<hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>QID</th>
        <th>Content</th>
        <th>Tag</th>
        <th>Choice</th>
        <th>Score</th>
        <th>Bobot</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        @php
          $choices = explode("~",$d->question->choice);
          $choices_description = explode("~",$d->question->choice_description);
          $scorings = explode("~",$d->scoring);
          $tags = explode(",",$d->tag);
        @endphp
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->qid }}</td>
            <td>{{ $d->question->content }}</td>
            <td>
              @for ($i = 0; $i <= count($tags) - 1; $i++)
                @if($tags[$i])
                  #{{$tags[$i]}},
                @endif
              @endfor
               </td>
            <td>
              @for ($i = 0; $i <= count($choices) - 1; $i++)
              {{$choices[$i]}}.{{$choices_description[$i]}}<br />
              @endfor
            </td>
            <td>
              @for ($i = 0; $i <= count($choices) - 1; $i++)
              {{$scorings[$i]}}<br />
              @endfor
            </td>
            <td>
              <input type="hidden" name="form_question_ids[]" value="{{$d->id}}"/>
              <input type="number" name="bobots[]" class="form-control" value="{{$d->bobot}}" />
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
</div>
</form>

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
              <label>Question</label>
              <select id="form_question" name="question_id" class="form-control">
                <option value="">-----------</option>
                @foreach($question as $d)
                <option value="{{$d->id}}">{{$d->content}}</option>
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

<!-- MODAL ADD -->
<div class="modal modal fade" id="modalAddMajorS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <form role="form" method="GET" action="{{route('form.question.create',$form->id) }}" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Result</h4>
        </div>
        <div class="modal-body" >
          <div class="row">
            <div class="col-md-2 form-group">
                <label>Bobot Akhir</label>
                <input type="text" class="form-control" name="qid" placeholder="Nilai Bobot" value="" required>
            </div>
          </div>
          <div class="form-group">
              <label>Hasil</label>
              <input type="text" class="form-control" name="qid" placeholder="Hasil akhir (keterangan)" value="" required>
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


<!-- MODAL ADD BACKUP -->
<div class="modal modal fade" id="modalAddMajorBackup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <form role="form" method="POST" action="{{route('form.question.add',$form->id) }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Build Question</h4>
        </div>
        <div class="modal-body" >
          <div class="row">
            <div class="col-md-4 form-group">
                <label>QID</label>
                <input type="text" class="form-control" name="qid" placeholder="Example: 1" value="" required>
            </div>
          </div>
          <div class="form-group">
              <label>Question</label>
              <select id="form_question" name="question_id" class="form-control">
                <option value="">-----------</option>
                @foreach($question as $d)
                <option value="{{$d->id}}">{{$d->content}}</option>
                @endforeach
              </select>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Type Question</label>
                <select id="form_type_question" class="form-control" disabled>
                  <option value=""></option>
                  @foreach($question as $d)
                  <option value="{{$d->id}}">{{$d->type_content}}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Choice</label>
                <select id="form_choice" class="form-control" disabled>
                  <option value=""></option>
                  @foreach($question as $d)
                  <option value="{{$d->id}}">{{$d->choice}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-8 form-group">
                <label>Choice Description</label>
                <select id="form_choice_description" class="form-control" disabled>
                  <option value=""></option>
                  @foreach($question as $d)
                  <option value="{{$d->id}}">{{$d->choice_description}}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Choice Next QID</label>
                <input type="text" name="choice_next_qid" placeholder="Example: 2~3~4~5" class="form-control"/>
            </div>
            <div class="col-md-4 form-group">
                <label>Scoring</label>
                <input type="text" name="scoring" class="form-control" placeholder="Example: 20~40~50~70"/>
            </div>
            <div class="col-md-4 form-group">
                <label>Duration (Minutes)</label>
                <input type="text" name="duration" class="form-control" placeholder="Example: 5"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Next QID</label>
                <input type="text" name="next_qid" class="form-control" placeholder="Example: 2"/>
            </div>
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
              <select id="stateQuestion" readonly name="question_id" class="form-control">
                <option value="">-----------</option>
                @foreach($question as $d)
                <option value="{{$d->id}}">{{$d->content}}</option>
                @endforeach
              </select>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Scoring</label>
                <input id="stateScoring" type="text" name="scoring" class="form-control" placeholder="Example: 20~40~50~70"/>
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

<!-- MODAL EDIT BACKUP-->
<div class="modal fade" id="modalEditBackup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="col-md-4 form-group">
                <label>QID</label>
                <input id="stateQidBackup" type="text" class="form-control" name="qid" placeholder="Example: 1" value="" required>
            </div>
          </div>
          <div class="form-group">
              <label>Question</label>
              <select id="stateQuestionBackup" name="question_id" class="form-control">
                <option value="">-----------</option>
                @foreach($question as $d)
                <option value="{{$d->id}}">{{$d->content}}</option>
                @endforeach
              </select>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Type Question</label>
                <select id="stateTypeQuestion" class="form-control" disabled>
                  <option value=""></option>
                  @foreach($question as $d)
                  <option value="{{$d->id}}">{{$d->type_content}}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Choice</label>
                <select id="stateChoice" class="form-control" disabled>
                  <option value=""></option>
                  @foreach($question as $d)
                  <option value="{{$d->id}}">{{$d->choice}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-8 form-group">
                <label>Choice Description</label>
                <select id="stateDescription" class="form-control" disabled>
                  <option value=""></option>
                  @foreach($question as $d)
                  <option value="{{$d->id}}">{{$d->choice_description}}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Choice Next QID</label>
                <input id="stateChoiceNextQid" type="text" name="choice_next_qid" placeholder="Example: 2~3~4~5" class="form-control"/>
            </div>
            <div class="col-md-4 form-group">
                <label>Scoring</label>
                <input id="stateScoringBackup" type="text" name="scoring" class="form-control" placeholder="Example: 20~40~50~70"/>
            </div>
            <div class="col-md-4 form-group">
                <label>Duration (Minutes)</label>
                <input id="stateDuration" type="text" name="duration" class="form-control" placeholder="Example: 5"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
                <label>Next QID</label>
                <input id="stateNextQid" type="text" name="next_qid" class="form-control" placeholder="Example: 2"/>
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
  $(".btn-modal-edit").click(function(){
    $('#stateIdUpdate').val($(this).attr('stateId'));
    $('#stateQid').val($(this).attr('stateQid'));
    $('#stateQuestion').val($(this).attr('stateQuestion'));
    $('#stateScoring').val($(this).attr('stateScoring'));
    $('#modalEdit').modal('toggle');
  });

  // $(".btn-modal-edit").click(function(){
  //   $('#stateIdUpdate').val($(this).attr('stateId'));
  //   $('#stateQid').val($(this).attr('stateQid'));
  //   $('#stateQuestion').val($(this).attr('stateQuestion'));
  //   $('#stateTypeQuestion').val($(this).attr('stateQuestion'));
  //   $('#stateChoice').val($(this).attr('stateQuestion'));
  //   $('#stateChoiceDescription').val($(this).attr('stateQuestion'));
  //   $('#stateChoiceNextQid').val($(this).attr('stateChoiceNextQid'));
  //   $('#stateScoring').val($(this).attr('stateScoring'));
  //   $('#stateDuration').val($(this).attr('stateDuration'));
  //   $('#stateNextQid').val($(this).attr('stateNextQid'));
  //   $('#modalEdit').modal('toggle');
  // });

  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });

  $('#form_question').on('change', function() {
    $('#form_type_question').val(this.value);
    $('#form_choice').val(this.value);
    $('#form_choice_description').val(this.value);
  });

  $('#stateQuestion').on('change', function() {
    $('#stateTypeQuestion').val(this.value);
    $('#stateChoice').val(this.value);
    $('#stateChoiceDescription').val(this.value);
  });



</script>
@endsection
