@extends('layouts.app')
@section('content')

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
                   
                    </div>
                     <div class="col-lg-6">

                            <span id="form_message"></span>
                      <div class="central-meta bg-1e2833">
                         <div class="about">
                            <div class="personal">
                               <h5 class="f-title"> <i class="ti-info-alt"></i> About Me </h5>
                            </div>
                            <div class="dark-form">
                               <form id="aboutme_form" action="#" name="aboutme_form" method="post" novalidate="novalidate"  autocomplete="off">
                                  @csrf 
                                  <div class="">
                                     <div class="newpst-input">
                                        <textarea rows="2" name="aboutme" id="aboutme"  placeholder="Tell us something about yourself" data-parsley-error-message="Please tell us about you" data-parsley-trigger="focusout" data-parsley-required=""  autocomplete="off">{{ $user->aboutme }}</textarea>
                                        <div class="attachments">
                                           <ul>
                                              <li> <button type="btn btn-deep-orange">Save</button> </li>
                                           </ul>
                                        </div>
                                     </div>
                                  </div>
                               </form>
                            </div>
                         </div>
                       </div>
                       <!-- /abtme -->

                       <span id="edit_form_message"></span>
                        <div class="central-meta bg-1e2833">
                           <div class="editing-info dark-form">
                              <h5 class="f-title"><i class="ti-info-alt"></i> Edit Basic Information</h5>

                               <form id="updateUserInfoForm"  name="updateUserInfoForm" method="post" novalidate="novalidate"  autocomplete="off" enctype="multipart/form-data">
                                    @csrf


                              <div class="form-radio">
                                <div class="radio">
                                 <label>
                                   <input type="radio"  name="gender" value="Male" {{ ($user->gender == 'Male')?'checked':'' }}>
                                   <i class="check-box"></i>Male
                                 </label>
                                </div>
                                <div class="radio">
                                 <label>
                                   <input type="radio" name="gender" value="Female" {{ ($user->gender == 'Female')?'checked':'' }}>
                                   <i class="check-box"></i>Female
                                 </label>
                                </div>
                              </div>

                               <div class="form-group">
                              <input type="text" class="form-control rmspace"  id="eusername" name="username" placeholder="Username" data-parsley-type="alphanum"  data-parsley-error-message=" letters and numbers only" data-parsley-trigger="focusout" data-parsley-required="" value="{{ $user->username }}" readonly="" >
                              <small id="r_eusername" class="form-text text-danger">
                              </small> 
                           </div>
                           
                           <div class="form-group">
                              <input type="text" class="form-control"  id="emobile" name="mobile" placeholder=" Mobile" data-parsley-type="number"  placeholder="adasds"   data-parsley-error-message="Please enter a valid mobile number" data-parsley-trigger="focusout" data-parsley-required="" maxlength="15" value="{{ $user->mobile }}">
                              <small id="r_emobile" class="form-text text-danger">
                              </small> 
                           </div>
                           <div class="form-group">
                              <input type="email" class="form-control"  id="eemail" name="email" placeholder="Email Address" data-parsley-type="email"    data-parsley-error-message="Please enter a valid email address" data-parsley-trigger="focusout" data-parsley-required=""  value="{{ $user->email }}">
                              <small id="r_eemail" class="form-text text-danger"> </small> 
                           </div>


                            <div class="form-group">
                              <input type="text" class="form-control"  id="name" name="name" placeholder="Full Name" value="{{ $user->name }}" >
                            </div>

                            <div class="form-group">
                              <input type="text" class="form-control"  id="city" name="city" placeholder="Your City" value="{{ $user->city }}"  >
                            </div>

                            <div class="form-group">
                              <select class="custom-form-control" name="id_country">
                                 <option value="">Select County</option>
                                 @foreach($countries as $list)
                                    <option value="{{ $list->id }}"
                                      {{ ($user->id_country == $list->id)?'selected':'' }}
                                      >{{ $list->name }}</option>
                                     
                                 @endforeach
                              </select>
                            </div>
                            
                        

                             <div class="form-group">
                               <button type="submit" class="btn btn-deep-orange"><span>Update</span></button>
                            </div>

                                 
                               
                              </form>
                           </div>
                        </div> 


                     </div>
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

@endsection
