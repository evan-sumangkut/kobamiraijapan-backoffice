@section('head')
<!-- Select2 -->
<!-- <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/select2/select2.min.css')}}"> -->
@endsection
@section('javascript')
<!-- jQuery 2.2.3 -->
<script src="{{ asset('template/adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('template/adminlte/plugins/ckeditor2/ckeditor.js')}}"></script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editorContent');
  });
</script>

<!-- Select2 -->
<!-- <script src="{{ asset('template/adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script>
$(function () {
  //Initialize Select2 Elements
  $(".select2").select2();

});
</script> -->
@endsection
