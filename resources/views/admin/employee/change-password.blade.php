@extends('layouts.admin')
@section('content')


<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Change Password </h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li  class="active"><a href="{{ asset('') }}">Change Password</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row">
     <div class="col-md-8 col-xs-12 col-md-offset-2">

      @if (session('error'))
            <div class="alert alert-danger">
               {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
               {{ session('success') }}
            </div>
            @endif


        <div class="panel panel-default">
   <div class="panel-body">

     <form class="form-horizontal" name="changePasswordForm" id="changePasswordForm" method="post">
                  <div class="form-group{{ $errors->has('cpassword') ? ' has-error' : '' }}">
                     <label for="new-password" class="col-md-4 control-label">Current Password</label>
                     <div class="col-md-6">
                        <input id="cpassword" type="password" class="form-control" name="cpassword" required placeholder="Current Password">
                        @if ($errors->has('cpassword'))
                        <span class="help-block">
                        <strong>{{ $errors->first('cpassword') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                     <label for="new-password" class="col-md-4 control-label">New Password</label>
                     <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="New Password">
                        @if ($errors->has('new-password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('new-password') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                     <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="New Confirmation Password">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-6 col-md-offset-4">
                        <button type="button" id="btnChangePass" class="btn btn-primary">
                        Change Password
                        </button>
                     </div>
                  </div>
               </form>

   </div>
</div>
    </div>
 </div>

 <script type="text/javascript">


$(document).on('click','body #btnChangePass',function(e){
  //e.preventDefault();
$.ajax({
      headers: {'X-CSRF-TOKEN': FTOKEN },
      type: 'POST',
      url:APP_URL + '/admin/changePassword',
      data: $('#changePasswordForm').serialize(),
      success: function(resp){

          console.log(resp.responseText);
          var resp = $.parseJSON(resp);
        
          if(resp.status === 'S'){
            tostMsg('success',resp.msg);
          }else{
             tostMsg('error',resp.msg);
          }

          $("#password_confirmation").val('');
          $("#cpassword").val('');
          $("#password").val('');


      },
      error: function (request, status, error) {
         console.log('request.responseText');
         var json = $.parseJSON(request.responseText);
         console.log(json.message);
         tostMsg('error',json.message);
      }
    });

});
</script>       
@endsection
