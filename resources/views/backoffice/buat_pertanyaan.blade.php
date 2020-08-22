@extends('_layouts.admin')

@include('_plugin.table')
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
<h3>{{$title}} di Form <b>{{$form->form_desc}} ({{$form->formid}})</b></h3>

<hr>
<form method="POST" action="{{route('buat_pertanyaan_post',$formid)}}">
  @csrf
  <div class="row">
    <div class="form-group col-md-2">
      <label>QID</label>
      <input name="qid" type="text" class="form-control"  required placeholder="id pertanyaan"/>
    </div>
    <div class="form-group col-md-2">
      <label>TAG</label>
      <input name="tag" type="text" class="form-control"  required placeholder="Tag Penyimpanan"/>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label>Konten Pertanyaan</label>
      <textarea name="content" class="form-control"  required  placeholder="Isi pertanyaan yang akan disampaikan ke user..."></textarea>
    </div>
  </div>
  <div id="form-jawaban">
    <div class="row">
      <div class="form-group col-md-2">
        <label>Option Jawaban</label>
        <input type="text" class="form-control" name="option_jawaban[]" placeholder="Diketik responden"  required/>
      </div>
      <div class="form-group col-md-4">
        <label>Value Response</label>
        <input type="text" class="form-control" name="value_response[]" placeholder="Informasi jawaban"  required/>
      </div>
      <div class="form-group col-md-2">
        <label>Scoring</label>
        <input type="text" class="form-control" name="scorings[]" placeholder="bobot jawaban"  required/>
      </div>
      <div class="form-group col-md-2">
        <label>Next QID</label>
        <input type="text" class="form-control" name="next_qid[]" placeholder="Lompat ke QID ?"  required/>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-3">
      <a href="#" id="tambah_opsi_jawaban" class="btn btn-default form-control" style="font-weight:600"><i class="fa fa-plus-circle"></i> Tambah Opsi Jawaban</a>
    </div>
  </div>
  <br />
  <div class="row">
    <div class="col-md-8">
      <button type="submit" class="btn btn-primary form-control" style="font-weight:600"><i class="fa fa-save"></i> Buat Pertanyaan</button>
    </div>
  </div>
</form>
<hr>
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
          <th>No.</th>
          <th>QID</th>
          <th>Tag</th>
          <th>Konten Pertanyaan</th>
          <th>Option Jawaban</th>
          <th>Value Response</th>
          <th>Scoring</th>
          <th>Next QID</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($data as $d)
          <tr>
              <td style="text-align: center" >{{ $no++ }}</td>
              <td style="text-align: center" >{{ $d->qid }}</td>
              <td>{{ $d->tag }}</td>
              <td>{{ $d->content }}</td>
              <td>{{ $d->optionjawaban }}</td>
              <td>{{ $d->valueresponse }}</td>
              <td>{{ $d->scoring }}</td>
              <td>{{ $d->nextqid }}</td>
              <td><a href="#" data-toggle="modal" data-target="#exampleModal{{$d->id}}" class="btn btn-warning"><i class="fa fa-edit"></i> </a></td>
          </tr>

          <div class="modal fade" id="exampleModal{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form method="POST" action="{{route('update_pertanyaan',$d->id)}}">
                  @csrf
                  @method('PATCH')
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>QID:</label>
                    <input type="text" class="form-control" name="qid" value="{{$d->qid}}"/>
                  </div>
                  <div class="form-group">
                    <label>Tag:</label>
                    <input type="text" class="form-control" name="tag" value="{{$d->tag}}"/>
                  </div>
                  <div class="form-group">
                    <label>Content:</label>
                    <input type="text" class="form-control" name="content" value="{{$d->content}}"/>
                  </div>
                  <div class="form-group">
                    <label>Option Jawaban:</label>
                    <input type="text" class="form-control" name="optionjawaban" value="{{$d->optionjawaban}}"/>
                  </div>
                  <div class="form-group">
                    <label>Value Response:</label>
                    <input type="text" class="form-control" name="valueresponse" value="{{$d->valueresponse}}"/>
                  </div>
                  <div class="form-group">
                    <label>Scoring:</label>
                    <input type="text" class="form-control" name="scoring" value="{{$d->scoring}}"/>
                  </div>
                  <div class="form-group">
                    <label>Next QID:</label>
                    <input type="text" class="form-control" name="nextqid" value="{{$d->nextqid}}"/>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
              </div>
            </div>
          </div>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>

<script type="text/javascript">
$( "#tambah_opsi_jawaban" ).click(function() {
  let id = $.now();
  $("#form-jawaban").append('<div class="row '+id+'"> <div class="form-group col-md-2"> <label>Option Jawaban</label> <input type="text" class="form-control" required name="option_jawaban[]" placeholder="Diketik responden"/> </div> <div class="form-group col-md-4"> <label>Value Response</label> <input type="text" class="form-control" required name="value_response[]" placeholder="Informasi jawaban"/> </div> <div class="form-group col-md-2"> <label>Scoring</label> <input type="text" required class="form-control" name="scorings[]" placeholder="bobot jawaban"/> </div> <div class="form-group col-md-2"> <label>Next QID</label> <input type="text" required class="form-control" name="next_qid[]" placeholder="Lompat ke QID ?"/> </div> <div class="form-group col-md-2"> <label>Aksi</label><br /> <a href="#" class="btn btn-danger" onclick="myFunction('+id+')"><i class="fa fa-trash"></i></a> </div> </div>');
});

function myFunction(id) {
  $("."+id).remove();
}

</script>
@endsection
