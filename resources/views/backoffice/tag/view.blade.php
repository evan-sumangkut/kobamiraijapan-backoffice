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
<h4>{{$tag ? $tag->parents($tag->id) : null}}</h4>
@if($tag_id)
  @if($tag->tag_id)
  <a href="{{route('tag.look',$tag->tag_id)}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
  @else
  <a href="{{route('tag')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
  @endif
  <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">New Tag</a>
@else
  @if(!Auth::user()->branch_id)
  <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">New Tag</a>
  @endif
@endif
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Tag</th>
        <!-- <th>Relation Tag</th> -->
        <th>Description</th>
        <th>Child</th>
        <th>Used</th>
        <th>Created by</th>
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->name }}</td>
            <!-- <td>{{ $d->tag ? '#'.$d->tag->name : '-' }}</td> -->
            <td>{{ $d->description }}</td>
            <td>{{$d->tag_childs->count()}}</td>
            <td>{{$d->tag_used($d->name)}}</td>
            <td>{{ $d->branch ? $d->branch->name : "-"}}</td>
            <td width="200">
                <a href="{{route('tag.look',$d->id)}}" title="look" type="button" class="btn btn-info btn-xs">
                  <i class="fa fa-search"></i>
                </a>
                @if(!Auth::user()->branch_id)
                <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateTagId="{{$d->tag_id}}" stateName="{{$d->name}}" stateDescription="{{$d->description}}">
                  <i class="fa fa-edit"></i>
                </button>
                <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->name}}">
                  <i class="fa fa-trash"></i>
                </button>
                @elseif(Auth::user()->branch_id==$d->branch_id)
                <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateTagId="{{$d->tag_id}}" stateName="{{$d->name}}" stateDescription="{{$d->description}}">
                  <i class="fa fa-edit"></i>
                </button>
                <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->name}}">
                  <i class="fa fa-trash"></i>
                </button>
                @endif
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
      <form role="form" method="POST" action="{{route('tag.add') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="tag_id" value="{{$tag_id}}"/>
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Form</h4>
        </div>
        <div class="modal-body" >
          <!-- <div class="form-group">
              <label>Relation Rag </label>
              <select class="select2 form-control" name="tag_id">
                <option value="">---</option>
                @foreach($data as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
          </div> -->
          <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Without #" value="" required>
          </div>
          <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control" name="description" placeholder="About Tag" value="" required>
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
  <div class="modal-dialog" role="document">
    <form id="formModalEdit" method="post" action="{{route('tag.update')}}" accept-charset="UTF-8" style="margin:0 auto">
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
          <!-- <div class="form-group">
              <label>Relation Rag </label>
              <select id="edit_tag" class="select2 form-control" name="tag_id">
                <option value="">---</option>
                @foreach($data as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
          </div> -->
          <div class="form-group">
              <label>Name</label>
              <input type="text" id="edit_name" class="form-control" name="name" placeholder="Without #" value="" required>
          </div>
          <div class="form-group">
              <label>Description</label>
              <input type="text" id="edit_description" class="form-control" name="description" placeholder="About Tag" value="" required>
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
    <form id="formModalDelete" method="post" action="{{route('tag.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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
  $(document).ready(function() {
      $('.select2').select2({
        theme: "bootstrap"
      });
  });

  $(".btn-modal-edit").click(function(){
    $('#stateIdUpdate').val($(this).attr('stateId'));
    $('#edit_tag').val($(this).attr('stateTagId')).change();
    $('#edit_name').val($(this).attr('stateName'));
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
