@extends('layouts.app')
@section('content')


    <section>
      <div class="gap gray-bg" style="min-height: 550px;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="row" id="page-contents">
                <div class="col-lg-3">
                 
                </div><!-- sidebar -->
                <div class="col-lg-6">
                  
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <div class="central-meta">
                    <div class="dark-form">
                      <h5 class="f-title"><i class="ti-lock"></i> {{ __('Reset Password') }}</h5>
                        
                        <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                           
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group ">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                           
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                           
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            
                        </div>

                        <div class="form-group  mb-0">
                           
                                <button type="submit" class="btn btn-deep-orange">
                                    {{ __('Reset Password') }}
                                </button>
                           
                        </div>
                    </form>

                    </div>
                  </div>  
                </div><!-- centerl meta -->
                <div class="col-lg-3">
                  
                </div><!-- sidebar -->
              </div>  
            </div>
          </div>
        </div>
      </div>  
    </section>

@endsection