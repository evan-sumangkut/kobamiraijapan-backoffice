@extends('_layouts.admin')

@section('link')
<ol class="breadcrumb">
        <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{$title}}</li>
</ol>
@endsection
@section('content')
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice{color:black;}
</style>

<?php
$no = 1;
?>
<div class="box">
<div class="box-body">
<h3>{{$title}}</h3>
<a href="{{route('survey.form.confirmation',$survey_form_id)}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>
<div class="">
  <hr />
  <form method="POST" action="{{route('survey.form.confirmation.add')}}">
    @csrf
    <input type="hidden" name="survey_form_id" value="{{$survey_form_id}}"/>
    <input type="hidden" name="survey_form_question_id" value="{{$survey_form_question_id}}"/>
    <input type="hidden" name="method" value="{{$condition}}"/>
    <input type="hidden" name="to_survey_form_id" value={{$to_survey_form_id}} />
    <h4>Method: {{$condition}}</h4>
    @if($condition=='score_all')
    <div id="score_all">
      <div class="row">
        <div class="form-group col-md-2">
            <label>Operation </label>
            <select class="form-control" name="operation">
              <option value=">=">>=</option>
              <option value=">">></option>
              <option value="==">==</option>
              <option value="<"><</option>
              <option value="<="><=</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Score</label>
            <input type="number" class="form-control" name="if_score" placeholder="" value="" required>
        </div>
      </div>
    </div>
    @endif
    @if($condition=='score_form')
    <div id="score_form">
      <div class="row">
        <div class="form-group col-md-2">
            <label>Operation </label>
            <select class="form-control" name="operation">
              <option value=">=">>=</option>
              <option value=">">></option>
              <option value="==">==</option>
              <option value="<"><</option>
              <option value="<="><=</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Score</label>
            <input type="number" class="form-control" name="if_score" placeholder="" value="" required>
        </div>
      </div>
    </div>
    @endif
    @if($condition=='respond')
    <div id="respond">
      @foreach($survey_form->form->questions as $s)
        @php
        $choices = explode("~",$s->choice);
        $choices_description = explode("~",$s->choice_description);
        @endphp
      <div class="form-group">
          <label>{{$s->question->content}} </label>
          <br />
          @for ($i = 0; $i <= count($choices) - 1; $i++)
          <input type="radio" name="respond_id" value="{{$s->id}}-{{$choices[$i]}}"/> {{$choices[$i]}}.{{$choices_description[$i]}} <br />
          @endfor
      </div>
      @endforeach
    </div>
    @endif
    <br />
    <div class="row">
      <div class="col-md-8">
        <button type="submit" class="btn btn-primary form-control" style="font-weight:600"><i class="fa fa-save"></i> Save Validation</button>
      </div>
    </div>
  </form>
</div>
<hr>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2({
      // theme: "bootstrap"
    });
});

</script>
@endsection
