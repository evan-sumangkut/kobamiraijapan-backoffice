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
  <a href="{{route('persona.builder')}}"  class="btn btn-default"><i class="fa fa-reply"></i> Back</a>
  <hr>
<!-- <div class="table-responsive">
  <hr />

</div> -->

<div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <!-- <h3 class="box-title">Direct Chat</h3> -->

                </div>
                <!-- /.box-header -->

                <div class="box-footer">
                  <!-- <form action="#" method="GET"> -->
                    <div class="input-group">
                      <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat btn-send"><i class="fa fa-paper-plane"></i> Send</button>
                          </span>
                    </div>
                  <!-- </form> -->
                </div>
                <div class="box-body">
                  <div class="direct-chat-messages" style="height:25em" id="form-chatbot">

                  </div>
                </div>
              </div>


</div>



<script type="text/javascript">

$('#message').keydown(function (e){
    if(e.keyCode == 13){
        chatbot()
    }
})

$( ".btn-send" ).click(function() {
  chatbot()
});

function chatbot(){
  const msg = $("#message").val();
  if(!msg){
    alert('message masih kosong');
    return
  }
  // me
  $("#form-chatbot").prepend('<div class="direct-chat-msg right"> <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Me</span> </div> <img class="direct-chat-img" src="{{asset('img/avatar5.png')}}" alt="message user image"> <div class="direct-chat-text direct-chat-default"> '+msg+' </div> </div>');

  const survey_id = '{{$survey_id}}';
  const username = '{{Auth::user()->email}}';
  const via = 'tester';
  const branch = 1;
  let url = '{{env("API_CHATBOT","http://localhost:8080")}}/survey?branch='+branch+'&via='+via+'&username='+username+'&push_survey='+survey_id+'&respond='+msg;
  // $.ajax({
  //   url: url,
  //   cache: false,
  //   success: function(res){
  //     $("#message").val(null);
  //     let question = res.data.question
  //     let choice = res.data.choice ? res.data.choice.split("~") : null;
  //     let choice_description = res.data.choice_description ? res.data.choice_description.split("~") : null;
  //     let respond = ''
  //     if(choice){
  //       for (i = 0; i < choice.length; i++) {
  //         respond += choice[i] + "."+choice_description[i]+"<br />";
  //       }
  //     }
  //     let msg = question+'<br />'+respond
  //     if(res.status=='success'){
  //       if(res.path=='finish'){
  //         $("#form-chatbot").prepend('<div class="direct-chat-msg"> <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">Chatbot</span> </div> <img class="direct-chat-img" src="{{asset('img/chatbot.png')}}" alt="message user image"> <div class="direct-chat-text"> '+res.message+' </div> </div>');
  //         return
  //       }
  //     }else{
  //         $("#form-chatbot").prepend('<div class="direct-chat-msg"> <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">Chatbot</span> </div> <img class="direct-chat-img" src="{{asset('img/chatbot.png')}}" alt="message user image"> <div class="direct-chat-text"> '+res.message+' </div> </div>');
  //     }
  //     $("#form-chatbot").prepend('<div class="direct-chat-msg"> <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">Chatbot</span> </div> <img class="direct-chat-img" src="{{asset('img/chatbot.png')}}" alt="message user image"> <div class="direct-chat-text"> '+msg+' </div> </div>');
  //   }
  // });
}
</script>
@endsection
