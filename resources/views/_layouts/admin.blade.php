<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KOBA MIRAI JAPAN</title>
  <meta name="author" content="Rizky Awlia Fajrin (Evan Sumangkut)">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('template/adminlte/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- Pace style -->
  <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/pace/pace.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('template/adminlte/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('snippet/sweetalert/dist/sweetalert.css')}}">
  <!-- DataTables -->
 <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

 <style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice{color:black;}
 </style>

@yield('head')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>KMJ</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Koba Mirai Japan</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Messages: style can be found in dropdown.less-->

                  <!-- Notifications: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('img/avatar5.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('img/avatar5.png')}}" class="img-circle" alt="User Image">

                <p>
                  {{Request()->ip()}}<br/>
                  {{Auth::user()->name}}
                  <small>{{Auth::user()->email}}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a data-toggle="modal" data-target="#settinguser" class="btn btn-default btn-flat">Pengaturan</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}"
                        class="btn btn-default btn-flat"  onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('img/avatar5.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="GET" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="key" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      @include('_navigasi.admin')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">

    @yield('link')
    </section>
    <br />
    <section class="content">
      @include('_plugin.pesan')
        @yield('content')
      <!-- /.box -->
    </section>

<div class="modal modal-default" id="settinguser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" style="text-align:center">Pengaturan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="name" placeholder="Nama" value="{{Auth::user()->name}}" required />
            </div>
            <div class="form-group">
              <label>Email ss</label>
              <input type="text" class="form-control" name="email" placeholder="Email" value="{{Auth::user()->email}}" required />
            </div>
            <div class="form-group">
              <label>Password Lama</label>
              <input type="password" class="form-control" name="password_lama" placeholder="old password" />
            </div>
            <div class="form-group">
              <label>Password Baru</label>
              <input type="password" class="form-control" name="password" placeholder="new password"/>
            </div>
            <div class="form-group">
              <label>Ulangi Password Baru</label>
              <input type="password" class="form-control" name="password_ulang" placeholder="confirmation password"/>
            </div>
            <div class="form-group">
              <label>Note:</label>
              <p>Jika hanya ingin memperbarui nama atau email, maka kosongkan kolom password.</p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin memperbarui data user?');">Perbaharui</button>
          </div>

        </div>
        </form>
        <!-- /.modal-content-->
      </div>
      <!-- /.modal-dialog -->
  </div>
<!--isi-->
<!-- Main content -->

<!-- /.content -->
<!--/isi-->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020 Koba</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@yield('javascript')
@yield('datavalue')
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{asset('snippet/sweetalert/dist/sweetalert.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('template/adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/adminlte/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('template/adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/adminlte/dist/js/demo.js')}}"></script>
<!-- PACE -->
<script src="{{ asset('template/adminlte/plugins/pace/pace.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
  $(function () {
    $("#datatable").DataTable();
    $('#datatableExcel').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ]
    } );

    $('.select2').select2({
      // theme: "bootstrap"
    });

    $('.select2-modal').select2({
        dropdownParent: $('.modal')
    });

    // $.fn.modal.Constructor.prototype.enforceFocus = function() {};
  });

</script>


</body>
</html>
