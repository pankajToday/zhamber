@extends('layouts.app')
@section('content')

   <div class="container">
      
   </div>   
   <section>
         <div class="gap gray-bg">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="row merged20" id="page-contents">
                        <div class="col-lg-3 d-none d-sm-block">
                           <aside class="sidebar static">
                              
                                          @include('account/_widget_top_tags')                  
                           </aside>
                        </div><!-- sidebar -->
                        <div class="col-lg-6">
                           <div id="form_message"></div>
                           <div class="central-meta bg-1e2833">
                              <div class="editing-info dark-form">
                                 <h5 class="f-title"><i class="ti-lock"></i>Change Password</h5>
                                 
                                 

  <form action="#" method="post"   name="changePasswordForm" id="changePasswordForm" novalidate="novalidate" autocomplete="off">
                           @csrf
                

                  <div class="form-group">
                    
                    
                        <input id="cpassword" type="password" class="form-control" name="cpassword" placeholder="Current Password" data-parsley-error-message="Current password should not empty" data-parsley-trigger="focusout"  required="">
                          <small id="r_cpassword" class="form-text text-danger"></small> 
                       
                    
                  </div>
                  <div class="form-group">
                   
                     
                        <input id="cc_password" type="password" class="form-control" name="cc_password" required placeholder="New Password"  data-parsley-error-message="Password should not empty" data-parsley-trigger="focusout"  required="">
                          <small id="r_cc_password" class="form-text text-danger"></small> 
                    
                  </div>
                  <div class="form-group">
                   
                        <input id="cc_password_confirmation" type="password" class="form-control" name="cc_password_confirmation" required placeholder="New Confirmation Password">
                     <small id="r_cc_password_confirmation" class="form-text text-danger"></small> 
                  </div>
                  <div class="form-group">
                     <Br>
                        <button type="submit"  class="btn  btn-deep-orange ">
                        Change Password
                        </button>
                    
                  </div>
               </form>

                              </div>
                           </div>   
                        </div><!-- centerl meta -->
                        <div class="col-lg-3 d-none d-sm-block">
                           <aside class="sidebar static">
                              @include('account/_widget_settings')

                          @include('account/_widget_posts')
                             
                              
                           </aside>
                        </div><!-- sidebar -->
                     </div>   
                  </div>
               </div>
            </div>
         </div>   
      </section>

</section>
@endsection
