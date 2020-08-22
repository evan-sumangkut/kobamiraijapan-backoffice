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
  <a href="{{route('form.question',$form_id)}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
<div class="">
<hr />
<form role="form" method="POST" action="{{route('form.question.add',$form_id) }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="question_id" value="{{$question->id}}"/>
<input type="hidden" name="qid" value="{{$qid}}"/>
<div class="form-group">
    <label>Question</label>
    <input type="text" class="form-control" value="{{$question->content}}" readonly>
</div>
<!-- <div class="form-group">
    <label>Tag</label>
    <input type="text" class="form-control" value="">
</div> -->
<!-- <div class="form-group">
    <label>Tag </label>
    <select class="select2 form-control" name="tags_id[]" multiple>
      @foreach($tag as $d)
      <option value="{{$d->name}}">{{$d->name}}</option>
      @endforeach
    </select>
</div> -->
<div class="row">
  <div class="col-md-6">
      <label>Choice</label>
  </div>
  <div class="col-md-2">
      <label>Score</label>
  </div>
</div>
@for ($i = 0; $i <= count($choice) - 1; $i++)
<div class="row">
  <div class="col-md-6 form-group">
      <input type="text" readonly value="{{$choice[$i]}}.{{$choice_description[$i]}}" class="form-control"/>
  </div>
  <div class="col-md-2 form-group">
      <input type="number" name="scoring[]" class="form-control" required placeholder=""/>
  </div>
</div>
@endfor
<button type="submit" class="form-control btn-success">Submit</button>
</form>
</div>
<hr>
</div>


<script type="text/javascript">



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
