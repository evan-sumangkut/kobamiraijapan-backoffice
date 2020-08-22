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
  <a href="{{route('question.create')}}"  class="btn btn-primary">New Question</a>
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Branch</th>
        <th>Tag</th>
        <th>Content</th>
        <!-- <th>Choice</th> -->
        <th>Created at</th>
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
            <td>{{ $d->branch ? $d->branch->name : '-' }}</td>
            <td>
              {{$d->tag_id ? parentsTag($d->tag_id) : null}}
            </td>
            <td>{{ $d->content }}</td>
            <!-- <td>
              @for ($i = 0; $i <= count($choices) - 1; $i++)
              {{$choices[$i]}}.{{$choices_description[$i]}}<br />
              @endfor
            </td> -->
            <td>{{$d->created_at}}</td>
            <td width="50">
                @if(!Auth::user()->branch_id)
                    <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateBranch="{{$d->branch_id}}" stateTag="{{$d->tag_id}}" stateContent="{{$d->content}}" stateTypeContent="{{$d->type_content}}" stateChoice="{{$d->choice}}" stateChoiceDescription="{{$d->choice_description}}">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->content}}">
                      <i class="fa fa-trash"></i>
                    </button>
                @elseif(Auth::user()->branch_id==$d->branch_id)
                    <button title="edit" type="button" class="btn btn-warning btn-xs btn-modal-edit" stateId="{{$d->id}}" stateBranch="{{$d->branch_id}}" stateTag="{{$d->tag_id}}" stateContent="{{$d->content}}" stateTypeContent="{{$d->type_content}}" stateChoice="{{$d->choice}}" stateChoiceDescription="{{$d->choice_description}}">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button title="delete" type="button" class="btn btn-danger btn-xs btn-modal-delete" stateId="{{$d->id}}" stateName="{{$d->content}}">
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
      <form role="form" method="POST" action="{{route('question.add') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Form</h4>
        </div>
        <div class="modal-body" >
          <div class="form-group">
              <label>Branch</label>
              <select name="branch_id" class="form-control">
                <option value="">Tanpa Branch</option>
                @foreach($branch as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label>Tag</label>
              <select name="tag" class="form-control">
                <option value="">Tanpa Tag</option>
                @foreach($tag as $d)
                <option value="{{$d->name}}">#{{$d->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label>Type Content</label>
              <select name="type_content" class="form-control">
                <option value="information">Information</option>
                <option value="single_choice">Single Choice</option>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="essay">Essay</option>
                <option value="range">Range</option>
              </select>
          </div>
          <div class="form-group">
              <label>Content</label>
              <input type="text" class="form-control" name="content" placeholder="Tentang pertanyaan" value="" required>
          </div>
          <div class="form-group">
              <label>Choice</label>
              <input type="text" class="form-control" name="choice" placeholder="Example: 1~2~3~4" value="">
          </div>
          <div class="form-group">
              <label>Choice Description</label>
              <input type="text" class="form-control" name="choice_description" placeholder="Example: Opsi A ~ Opsi B ~ Opsi C ~ Opsi D" value="">
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
  <div class="modal-dialog" role="document">
    <form id="formModalEdit" method="post" action="{{route('question.update')}}" accept-charset="UTF-8" style="margin:0 auto">
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
              <label>Tag</label>
              <select id="stateTag" name="tag_id" class="form-control">
                <option value="">Tanpa Tag</option>
                @foreach($tag as $d)
                <option value="{{$d->id}}">{{parentsTag($d->id)}}</option>
                @endforeach
              </select>
          </div>
          <!-- <div class="form-group">
              <label>Type Content</label>
              <select id="stateTypeContent" name="type_content" class="form-control">
                <option value="information">Information</option>
                <option selected value="single_choice">Single Choice</option>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="essay">Essay</option>
                <option value="range">Range</option>
              </select>
          </div> -->
          <div class="form-group">
              <label>Content</label>
              <input id="stateContent" type="text" class="form-control" name="content" placeholder="Tentang pertanyaan" value="" required>
          </div>
          <!-- <div class="form-group">
              <label>Choice</label>
              <input id="stateChoice" type="text" class="form-control" name="choice" placeholder="Example: 1~2~3~4" value="" required>
          </div>
          <div class="form-group">
              <label>Choice Description</label>
              <input id="stateChoiceDescription" id="stateContent" type="text" class="form-control" name="choice_description" placeholder="Example: Opsi A ~ Opsi B ~ Opsi C ~ Opsi D" value="" required>
          </div> -->
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
    <form id="formModalDelete" method="post" action="{{route('question.delete')}}" accept-charset="UTF-8" style="margin:0 auto">
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
    $('#stateBranch').val($(this).attr('stateBranch'));
    $('#stateTag').val($(this).attr('stateTag')).change();
    $('#stateContent').val($(this).attr('stateContent'));
    $('#stateTypeContent').val($(this).attr('stateTypeContent'));
    $('#stateChoice').val($(this).attr('stateChoice'));
    $('#stateChoiceDescription').val($(this).attr('stateChoiceDescription'));
    $('#modalEdit').modal('toggle');
  });

  $(".btn-modal-delete").click(function(){
    $( ".info-delete" ).text($(this).attr('stateName'));
    $('#stateIdDelete').val($(this).attr('stateId'));
    $('#modalDelete').modal('toggle');
  });
</script>
@endsection
