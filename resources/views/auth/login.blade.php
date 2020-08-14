@extends('layouts.auth')
@section('content')
<section id="wrapper" class="new-login-register">
   <div class="lg-info-panel" style="background-image: url({{ asset("img/login-register-.jpg")  }}); background-repeat: no-repeat;background-position: center; background-attachment: fixed;">
   <div class="inner-panel">
      <a href="javascript:void(0)" class="p-20 di"><img src=""></a>
      <div class="lg-content">
         <h2>BEYOND CLEAN AND MORE THAN JUST SHINE!</h2>
         <p class="text-muted">"It's a never ending battle of making your cars better and also trying to be better yourself." -Dale Earnhardt</p>
         <!-- <a href="{{ asset('register') }}" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Register Now <i class="fa fa-arrow-right"></i></a>  -->
      </div>
   </div>
   </div>
   <div class="new-login-box">
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

      <div class="white-box-- p-30">
         <form class="form-horizontal  form-material" id="loginform" action="{{ route($loginRoute) }}" method="post">
            @csrf
            <h3 class="box-title m-b-20 text-center">{{ $title }}</h3>
            <div class="form-group">
               <div class="col-xs-12 text-center">
                  <div class="user-thumb text-center"> <img alt="thumbnail" class="img-circle" width="100" src="{{ asset('img/avatar-sm.png') }}">
                  </div>
               </div>
            </div>
            <div class="form-group ">
               <div class="col-xs-12">
                  <input id="login" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus placeholder="Mobile Or Email">
                  @if ($errors->has('login'))
                  <span class="text-danger" role="alert">
                  {{ $errors->first('login') }}
                  </span>
                  @endif
               </div>
            </div>
            <div class="form-group">
               <div class="col-xs-12">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                  @if ($errors->has('password'))
                  <span class="text-danger" role="alert">
                  {{ $errors->first('password') }}
                  </span>
                  @endif
               </div>
            </div>
            <div class="form-group">
               <div class="col-md-12">
                  <div class="checkbox checkbox-info pull-left p-t-0">
                     <input id="checkbox-signup" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                     <label for="checkbox-signup">  {{ __('Remember Me') }} </label>
                  </div>
                  @if (Route::has('center.password.request'))
                  <a href="{{ route($forgotPasswordRoute) }}" class="text-dark pull-right">
                  <i class="fa fa-lock m-r-5"></i>  {{ __('Forgot Your Password?') }}
                  </a>
                  @endif
               </div>
            </div>
            <div class="form-group text-center m-t-20">
               <div class="col-xs-12">
                  <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                  {{ __('Login') }}
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>
@endsection