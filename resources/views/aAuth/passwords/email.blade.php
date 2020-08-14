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
  <!--     @if ($errors->any())
      <div class="alert alert-danger">
         <strong>Whoops!</strong> There were some problems with your input.<br><br>
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif -->

      <div class="white-box-- p-30">

       
         <h3 class="box-title m-b-30 text-left"> {{ __('Reset Password') }}</h3>

 @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('center.password.email') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                         
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class=" row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>

      </div>
   </div>
</section>
@endsection