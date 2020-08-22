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
  <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">New Form</a>
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Branch</th>
        <th>Form</th>
        <th>Description</th>
        <th>Scheduler</th>
        <th>Total Question</th>
        <th>Created at</th>
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{$d->branch ? $d->branch->name : "-"}}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->description }}</td>
            <td>-</td>
            <td>{{count($d->questions)}}</td>
            <td>{{$d->created_at}}</td>
            <td width="200">
                <a href="{{route('form.question',$d->id)}}" class="btn btn-primary btn-xs" title="Question">
                  <i class="fa fa-file-archive-o"></i>
                </a>
                <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateName="{{$d->name}}" stateDescription="{{$d->description}}" stateBranch="{{$d->branch_id}}">
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
      <form role="form" method="POST" action="{{route('form.add') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Form</h4>
        </div>
        <div class="modal-body" >
          @if(!Auth::user()->branch_id)
          <div class="form-group">
            <label>Branch</label>
            <select class="form-control" name="branch_id">
              <option value="">---</option>
              @foreach($branch as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
              @endforeach
            </select>
          </div>
          @endif
          <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Example: Greeting Form" value="" required>
          </div>
          <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control" name="description" placeholder="About Form" value="" required>
          </div>
          <!-- <div class="form-group">
              <label>Apakah pengulangan ?</label>
              <select class="form-control" name="pengulangan">
                <option value="tidak">Tidak</option>
                <option value="ya">Ya</option>
              </select>
          </div> -->
          <!-- <label for="">Jadwal</label>
          <div class="row">
            <div class="form-group col-md-4">
                <label>Minggu ke </label><br />
                1 <input type="checkbox" name="minggu_ke[]" value="1"> | 2 <input type="checkbox" name="minggu_ke[]" value="2"> | 3 <input type="checkbox" name="minggu_ke[]" value="3"> | 4 <input type="checkbox" name="minggu_ke[]" value="4"> | 5 <input type="checkbox" name="minggu_ke[]" value="5">
            </div>
            <div class="form-group col-md-4">
                <label>Jam ke </label><br />
                <input type="time" name="jam_ke"/>
            </div>
          </div>
          <div class="form-group">
              <a href="#" id="tambah_opsi_jawaban" class="btn btn-default" style="font-weight:600"><i class="fa fa-plus-circle"></i> Tambah Jadwal</a>
          </div> -->

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
    <form id="formModalEdit" method="post" action="{{route('form.update')}}" accept-charset="UTF-8" style="margin:0 auto">
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
          @if(!Auth::user()->branch_id)
          <div class="form-group">
              <label>Branch</label>
              <select id="stateBranch" name="branch_id" class="form-control">
                <option value="">Tanpa Branch</option>
                @foreach($branch as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
          </div>
          @endif
          <div class="form-group">
              <label>Name</label>
              <input type="text" id="edit_name" class="form-control" name="name" placeholder="Example: Greeting Form" value="" required>
          </div>
          <div class="form-group">
              <label>Description</label>
              <input type="text" id="edit_description" class="form-control" name="description" placeholder="About Form" value="" required>
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
    <form id="formModalDelete" method="post" action="{{route('form.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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
    $('#edit_name').val($(this).attr('stateName'));
    $('#stateBranch').val($(this).attr('stateBranch'));
    $('#edit_description').val($(this).attr('stateDescription'));
    $('#modalEdit').modal('toggle');
  });

  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });
</script>
@endsection
