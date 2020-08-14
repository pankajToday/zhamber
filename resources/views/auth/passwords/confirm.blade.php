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
                  <br><br><br>
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <div class="central-meta">
                    <div class="editing-info dark-form">
                      <h5 class="f-title"><i class="ti-lock"></i> {{ __('Confirm Password') }}</h5>
                        
                         {{ __('Please confirm your password before continuing.') }}
                        <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                           
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group  mb-0">
                           
                                <button type="submit" class="btn btn-deep-orange">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ asset('password/request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                           
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