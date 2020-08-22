@section('javascript')
<!-- jQuery 2.2.3 -->
<script src="{{ asset('template/adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('template/adminlte/plugins/ckeditor/ckeditor.js')}}"></script>

<script>
  $(function(){
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editorContent');
  });
</script>
@endsection
