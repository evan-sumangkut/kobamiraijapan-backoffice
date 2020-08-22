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
  <!-- <a type="button"  data-toggle="modal" data-target="#modalAddMajor"  class="btn btn-primary">New Form</a> -->
<div class="table-responsive">
  <hr />
<table id="datatable" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>No.</th>
        <th>Form</th>
        <th>Description</th>
        <th>Bobot</th>
        <th>Schedule</th>
        <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($data as $d)
        <tr>
            <td width="10px" style="text-align: center" >{{ $no++ }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->description }}</td>
            <td>{{$d->bobot_scenario($d->id)}}</td>
            <td></td>
            <td width="200">
                <a href="{{route('scenario.weight',$d->id)}}" title="edit bobot" class="btn btn-warning btn-xs">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('scenario.schedule',$d->id)}}" title="Edit Schedule" type="button" class="btn btn-info btn-xs">
                  <i class="fa fa-clock-o"></i>
                </a>
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
          <label for="">Jadwal</label>
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

<script type="text/javascript">

</script>
@endsection
