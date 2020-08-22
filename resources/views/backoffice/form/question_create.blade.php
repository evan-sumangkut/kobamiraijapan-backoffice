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
<div id="form-jawaban">
  <div class="row">
    <div class="form-group col-md-2">
        <label>Choice</label>
        <input type="text" class="form-control" name="choice[]" placeholder="Example: 1 or A" value="">
    </div>
    <div class="form-group col-md-8">
        <label>Choice Description</label>
        <input type="text" class="form-control" name="choice_description[]" placeholder="Keterangan pilihan" value="">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <a href="#" id="tambah_opsi_jawaban" class="btn btn-default form-control" style="font-weight:600"><i class="fa fa-plus-circle"></i> Tambah Opsi Jawaban</a>
  </div>
</div>
<br />
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

  $( "#tambah_opsi_jawaban" ).click(function() {
    let id = $.now();
    $("#form-jawaban").append('<div class="row '+id+'"><div class="form-group col-md-2"><label>Choice</label><input type="text" class="form-control" name="choice[]" placeholder="Example: 1 or A" value=""></div><div class="form-group col-md-8"><label>Choice Description</label><input type="text" class="form-control" name="choice_description[]" placeholder="Keterangan pilihan" value=""></div><div class="form-group col-md-2"> <label>Aksi</label><br /> <a href="#" class="btn btn-danger" onclick="myFunction('+id+')"><i class="fa fa-trash"></i></a> </div> </div>');
  });

  function myFunction(id) {
    $("."+id).remove();
  }

</script>
@endsection
