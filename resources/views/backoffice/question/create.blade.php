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
<a href="{{route('question')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>
<div class="">
  <hr />
  <form method="POST" action="{{route('question.add')}}">
    @csrf
    @if(!Auth::user()->branch_id)
    <div class="row">
      <div class="form-group col-md-6">
          <label>Branch</label>
          <select name="branch_id" class="form-control">
            <option value="">Tanpa Branch</option>
            @foreach($branch as $d)
            <option value="{{$d->id}}">{{$d->name}}</option>
            @endforeach
          </select>
      </div>
    </div>
    @endif
    <div class="form-group">
        <label>Tag </label>
        <select class="select2 form-control" name="tags_id[]">
          @foreach($tag as $d)
          <option value="{{$d->id}}">{{parentsTag($d->id)}}</option>
          @endforeach
        </select>
    </div>

    <!-- <div class="form-group">
        <label>Type Content</label>
        <select name="type_content" class="form-control">
          <option value="information">Information</option>
          <option selected value="single_choice">Single Choice</option>
          <option value="multiple_choice">Multiple Choice</option>
          <option value="essay">Essay</option>
          <option value="range">Range</option>
        </select>
    </div> -->
    <div class="form-group">
        <label>Content</label>
        <input type="text" class="form-control" name="content" placeholder="Tentang pertanyaan" value="" required>
    </div>
    <!-- <div id="form-jawaban">
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
    </div> -->
    <br />
    <div class="row">
      <div class="col-md-8">
        <button type="submit" class="btn btn-primary form-control" style="font-weight:600"><i class="fa fa-save"></i> Buat Pertanyaan</button>
      </div>
    </div>
  </form>
</div>
<hr>
</div>

<script type="text/javascript">


// $( "#tambah_opsi_jawaban" ).click(function() {
//   let id = $.now();
//   $("#form-jawaban").append('<div class="row '+id+'"><div class="form-group col-md-2"><label>Choice</label><input type="text" class="form-control" name="choice[]" placeholder="Example: 1 or A" value=""></div><div class="form-group col-md-8"><label>Choice Description</label><input type="text" class="form-control" name="choice_description[]" placeholder="Keterangan pilihan" value=""></div><div class="form-group col-md-2"> <label>Aksi</label><br /> <a href="#" class="btn btn-danger" onclick="myFunction('+id+')"><i class="fa fa-trash"></i></a> </div> </div>');
// });
//
// function myFunction(id) {
//   $("."+id).remove();
// }

</script>
@endsection
