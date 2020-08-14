@extends('layouts.auth')
@section('content')
<section id="wrapper" class="new-login-register">
   <div class="lg-info-panel" style="background-image: url('{{ asset('img/articleLarge.jpg')  }}'); background-repeat: no-repeat;">
      <div class="inner-panel">
         <a href="javascript:void(0)" class="p-20 di"><img src=""></a>
         <div class="lg-content">
            <a href="{{ asset('login') }}" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Login <i class="fa fa-arrow-right"></i></a> 
         </div>
      </div>
   </div>
   <div class="new-login-box">
      <div class="white-box--">
         <h3 class="box-title m-b-20 text-left">REGISTER</h3>
         <br>
         <form method="POST" action="{{ route('register') }}">
            @csrf

<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->


            <div class="row m-b-5">
               <div class="col-md-6">
                  <div class="form-group text-left  m-b-5">
                     <label>First Name</label>
                     <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control " name="fname" id="fname" placeholder="First Name" maxlength="20"value="{{ old('fname') }}">
                     </div>
                  </div>
                   @if($errors->has('fname')) <div class="text-danger"> {{$errors->first('fname')}} </div> @endif
               </div>
               <div class="col-md-6 ">
                  <div class="form-group text-left  m-b-5">
                     <label>Last Name</label>
                     <div class="input-group">
                        <input type="text" class="form-control " name="lname" id="lname" placeholder="Last Name" maxlength="20" value="{{ old('lname') }}">
                     </div>
                  </div>
              @if($errors->has('lname')) <div class="text-danger"> {{$errors->first('lname')}} </div> @endif

               </div>
            </div>
            <div class="form-group text-left m-b-10 {{ $errors->has('email') ? ' has-error' : '' }}">
               <label>Email Address</label>
               <div class="input-group">
                  <span class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                  </span>
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
               </div>
               @if($errors->has('email')) <div class="text-danger"> {{$errors->first('email')}} </div> @endif
            </div>
            <div class="form-group text-left m-b-10">
               <label>Mobile &nbsp; </label>
               <div class="input-group">
                  <span class="input-group-addon">
                  +91
                  </span>
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" maxlength="15" value="{{ old('mobile') }}">
               </div>
                @if($errors->has('mobile')) <div class="text-danger"> {{$errors->first('mobile')}} </div> @endif
            </div>
            <div class="form-group text-left  m-b-10">
               <label>Password</label>
               <div class="input-group">
                  <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                  </span>
                 <input type="password" class="form-control" name="password">

               </div>
               @if($errors->has('password')) <div class="text-danger"> {{$errors->first('password')}} </div> @endif
            </div>
            <div class="form-group text-left  m-b-10">
               <label>Confirm Password  </label>
               <div class="input-group">
                  <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                  </span>
                 <input type="password" class="form-control" name="password_confirmation" id="confirm_password" placeholder="Confirm Password">
               </div>
              @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
                                
            </div>
            <div class="form-group text-left m-b-10">
               <div class="input-group">
                  <label>I accept the <a href="#" target="_blank">Terms & Conditions.</a></label>
               </div>
            </div>
            <div class="form-group text-left margin-top-10">
               <button type="submit" id="register_with_cspl" class="btn btn-primary">Create Account</button>
            </div>
         </form>
      </div>
   </div>
</section>

@endsection
