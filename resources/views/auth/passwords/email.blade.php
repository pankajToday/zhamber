@extends('layouts.app')
@section('content')


    <section>
      <div class="gap gray-bg" style="min-height: 550px;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="row" id="page-contents">
                <div class="col-lg-3"></div><!-- sidebar -->
                <div class="col-lg-6">
                  <br><br>
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <div class="central-meta">
                    <div class="editing-info dark-form">
                      <h5 class="f-title"><i class="ti-lock"></i> {{ __('Reset Password') }}</h5>
                      
                      <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="form-group  mb-0">
                           
                                <button type="submit" class="btn btn-deep-orange">
                                   Send Link
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