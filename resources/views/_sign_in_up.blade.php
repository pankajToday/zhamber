<div class="modal fade" id="AllSignInUp" tabindex="-1" role="dialog" aria-labelledby="AllSignInUpTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="background: #434343;">
         <div class="modal-body pdng0">
            <div class="row merged">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                  <div id="OR" class="d-none d-sm-none">  OR </div>
                  <div class="log-social-area">
                     <h2 >Sign in or sign up</h2>
                     <p>Sign in or sign up with your social media account</p>
                     <div class="social-btn text-center">
                        <a href="{{ url('redirect', ['facebook']) }}" class="btn btn-primary btn-block btn-lg"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
                       <!--  <a href="{{ url('redirect', ['twitter']) }}" class="btn btn-info btn-block btn-lg"><i class="fa fa-twitter"></i> Sign in with <b>Twitter</b></a>  -->
                        <a href="{{ url('redirect', ['google']) }}" class="btn btn-danger btn-block btn-lg"><i class="fa fa-google"></i> Sign  in with <b>Google</b></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="login-reg-bg">
                     <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                     <i class="fa fa-close"></i>
                     </button>
                     <div class="log-reg-area sign dark-form">
                        <h2 class="log-title">Login</h2>
                        <p>Sign in with zhamber</p>
                        <form  method="post" name="signin_with_account_form" id="signin_with_account_form" novalidate="novalidate"  autocomplete="off">
                           @csrf
                           <br> <span id="errmessage" class="mb-10"></span> 
                           <div class="form-group">
                              <input class="form-control"  name="login" id="login" placeholder="Username Or email" maxlength="90" type="text" data-parsley-error-message="" data-parsley-trigger="focusout" data-parsley-required=""  autocomplete="off">
                           </div>
                           <div class="form-group">
                              <input class="form-control" name="password" id="password" placeholder="Password" maxlength="25" type="password" data-parsley-error-message="" data-parsley-trigger="focusout"  required=""  autocomplete="off">
                           </div>
                           <div class="form-group clearfix">
                              <button type="submit" id="signin_with_account" class="btn btn-deep-orange    btn-block  ">
                              Login   </button> 
                           </div>
                           <div class="form-group clearfix">
                              <div class="forget-password">
                                 <h6>Forgot your password </h6>
                                 <p> no worries, 
                                    <a href="{{ asset('password/reset') }}" class="text-sblue" > click here </a>to reset your password. 
                                 </p>
                              </div>
                           </div>
                           <div class="form-group clearfix">
                              <a href="javascript::"   class="text-sblue signup">
                             Don't have an account yet? Create one!!
                              </a>
                           </div>
                        </form>
                     </div>
                     <div class="log-reg-area reg dark-form">
                        <h2 class="log-title">Sign UP</h2>
                        <p>
                        Register with Zhamber
                        </p>
                       
                        <form method="post"   name="signup_with_account_form" id="signup_with_account_form" novalidate="novalidate" autocomplete="off">
                           @csrf
                           <div class="form-group mb-10 mt-10">
                              <input type="text" class="form-control rmspace"  id="username" name="username" placeholder="Username" data-parsley-type="alphanum"  data-parsley-error-message=" letters and numbers only" data-parsley-trigger="focusout" data-parsley-required="" >
                              <small id="r_username" class="form-text text-danger">
                              </small> 
                           </div>
                           
                          <!--  <div class="form-group mb-10 mt-10">
                              <input type="text" class="form-control"  id="mobile" name="mobile" placeholder=" Mobile" data-parsley-type="number"  placeholder="adasds"   data-parsley-error-message="Pleae enter valid mobile number" data-parsley-trigger="focusout" data-parsley-required="" maxlength="15" >
                              <small id="r_mobile" class="form-text text-danger">
                              </small> 
                           </div>
                            -->
                           <div class="form-group mb-10 mt-10">
                              <input type="email" class="form-control"  id="email" name="email" placeholder="Email Address" data-parsley-type="email"    data-parsley-error-message="Plese enter valid email address" data-parsley-trigger="focusout" data-parsley-required=""  >
                              <small id="r_email" class="form-text text-danger"> </small> 
                           </div>
                           <div class="form-group mb-10 mt-10">
                               <input type="password" class="form-control" name="password" id="signuppassword" placeholder="Password"  data-parsley-error-message="password should not empty" data-parsley-trigger="focusout"  required="">
                               <small id="r_password" class="form-text text-danger">
                              </small> 

                           </div>
                           <div class="form-group mb-10 mt-10">
                             <input class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"  type="password" data-parsley-equalto="#signuppassword"  data-parsley-error-message="This confirmation password should be the same of password" data-parsley-trigger="focusout"  required="">
                             <small id="r_password_confirmation" class="form-text text-danger">
                              </small> 
                           </div>

                           <div class="form-group mb-3">
                     <div class="input-group">
                        <input type="hidden" id="captchaCode" name="captchaCode" value=""  /> 
                        <div class="input-group-prepend" style="background: #333;"> <span class="input-group-text"  id="captchaShowArea" style=" text-align:center; border:none;font-weight:bold;color:red;background: #333; font-family:Modern; font-size:16px;" ></span> </div>

                        <div class="input-group-prepend"> <span class="input-group-text pointer" style="background: #333;cursor: pointer;border:none;color: #fff;" onclick="genCaptcha('captcha');"><i class="fa fa-refresh"></i> </span> </div>
                        <input type="text" class="form-control" style="height: 33px;" name="captcha" id="captcha"  required data-parsley-equalto="#captchaCode" data-parsley-trigger="keyup" data-parsley-error-message="Please enter your captcha number" placeholder="Captcha Number"  data-parsley-errors-container="#captcha_err_msg" > 
                     </div>
                     <div id="captcha_err_msg" class="margin-bottom-10"></div>
                  </div>


                           <div class="form-group ">
                              <button class="btn btn-deep-orange btn-block" id="btn_signup_with_account" type="submit"><span> Create Account </span></button>
                           </div>
                           <div class="form-group">
                              <label><a href="#" title="" class="already-have">Already have an account</a>
                              </label>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>






