@extends('layouts.auth')
@section('content')

<section id="wrapper" style="background: url({{ asset('img/login-register.jpg') }}) center center/cover no-repeat!important;height:100%;position: fixed;">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" action="{{ route($loginRoute) }}" method="post">
        @csrf
        <h3 class="box-title m-b-20 text-center">{{ $title }}</h3>

       
        <br>
      


        <div class="form-group ">
          <div class="col-xs-12">
            <input id="email" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus placeholder="Email">

                @if ($errors->has('login'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('login') }}</strong>
                    </span>
                @endif
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
             <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
            @if ($errors->has('password'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
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
                       
                         @if (Route::has('password.request'))
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
