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
<h3>{{$title}}</h3>
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
          <th>No.</th>
          <th>Sender</th>
          <th>FormID</th>
          <th>Last Active</th>
          <th>Set From</th>
          <th>Submit</th>
          <th>Generate Profile</th>
          <th>Status Profile</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($data as $d)
          <tr>
              <td width="10px" style="text-align: center" >{{ $no++ }}</td>
              <td>{{ $d->sender }}</td>
              <td>{{ $d->formid }}</td>
              <td>{{ $d->last_active }}</td>
              <form method="POST" action="{{route('daftar_user_update_form',$d->sender)}}">
                @csrf
              <td>
                <select class="form-control" name="formid">
                  @foreach($msform as $m)
                  <option {{ $m->formid==$d->formid ? 'selected' : null}} value="{{$m->formid}}">
                    {{$m->form_desc}}
                  </option>
                  @endforeach
                </select>
              </td>
              <td><button type="submit" class="btn btn-info">Submit</button></td>
              </form>
              <td>
                @php
                  $transaction = App\transaction::select('formid')->whereSender($d->sender)->distinct('formid')->get();
                @endphp
                @foreach($transaction as $t)
                  FormID = {{$t->formid}} <br />
                  <form method="POST" action="{{route('daftar_user_generate',[$d->sender,$t->formid])}}">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-xs">generate form-answer {{$t->formid}} into profile {{$d->sender}}</button>
                  </form>
                  <br /><br />
                @endforeach
              </td>
              <td>
                @php
                  $profile_static = App\profile_static::whereSender($d->sender)->count();
                @endphp
                {{$profile_static}}
              </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
@endsection
