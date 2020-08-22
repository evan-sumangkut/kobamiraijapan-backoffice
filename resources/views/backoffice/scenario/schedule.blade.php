@extends('_layouts.admin')

@section('link')
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice{color:black;}
</style>

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
  <a href="{{route('scenario')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>&nbsp;
  <button type="submit" class="btn btn-primary">Update Schedule</button>
<div class="">
<hr />
<form role="form" method="POST" action="#" enctype="multipart/form-data">
@csrf
<!-- <div class="form-group">
    <label>Tag</label>
    <input type="text" class="form-control" value="">
</div> -->
<div class="form-group">
    <label>Minggu ke </label><br />
    <input type="checkbox" name="minggu_ke[]" value="1"> 1 | <input type="checkbox" name="minggu_ke[]" value="2"> 2 | <input type="checkbox" name="minggu_ke[]" value="3"> 3 | <input type="checkbox" name="minggu_ke[]" value="4"> 4 | <input type="checkbox" name="minggu_ke[]" value="5"> 5
</div>
<div class="form-group">
    <label>Hari</label><br />
    <input type="checkbox" name="minggu_ke[]" value="1"> Senin | <input type="checkbox" name="minggu_ke[]" value="2"> Selasa | <input type="checkbox" name="minggu_ke[]" value="3"> Rabu | <input type="checkbox" name="minggu_ke[]" value="4"> Kamis | <input type="checkbox" name="minggu_ke[]" value="5"> Jum'at | <input type="checkbox" name="minggu_ke[]" value="5"> Sabtu | <input type="checkbox" name="minggu_ke[]" value="5"> Minggu
</div>
<div class="form-group">
    <label>Jam ke </label><br />
    <input type="time" name="jam_ke"/>
</div>
<div class="form-group">
    <a href="#" id="tambah_opsi_jawaban" class="btn btn-default" style="font-weight:600"><i class="fa fa-plus-circle"></i> Tambah Jadwal</a>
</div>
<!-- <button type="submit" class="form-control btn-success">Submit</button> -->
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
