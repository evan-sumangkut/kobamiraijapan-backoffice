 @section('head')
@endsection




@section('javascript')
<!-- DataTables -->

<!-- <script src="{{ asset('template/adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script> -->



<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $('#exampleExcel').DataTable( {
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
  });
</script>
 @endsection
