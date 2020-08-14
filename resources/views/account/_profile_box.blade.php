<section>
   <div class="gap gray-bg">
      <div class="container">
         <div class="row " >
            <div class="col-lg-12">
               <div class="card bg-dark" style="padding:20px;margin-bottom:0px;border-bottom:solid 1px #333;">
                  <div class="card-block">
                     <div class="row">
                        <div class="col-12 col-md-3 col-sm-6 text-center">
                            <form name="upAvatarImgForm" id="upAvatarImgForm" method="post" enctype="multipart/form-data">
                              @csrf
                           <div class="user-avatar">
                             
                                 <div class="avatar-upload">
                                      <div class="avatar-edit">
                                          <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                          <label for="imageUpload"></label>
                                      </div>
                                      <div class="avatar-preview">
                                       @if( Auth::guard('web')->user()->avatar)
                                       <div id="imagePreview" style="background-image: url({{ asset('storage/avatar/'.Auth::guard('web')->user()->avatar) }});">
                                          </div>
                                       @else
                                       <div id="imagePreview" style="background-image: url({{ asset('img/av_400x400.jpg') }});">
                                          </div>
                                       @endif
                               
                                          
                                      </div>
                                  </div>
                               <button type="submit" id="bntUpImg" class="bnt btn-primary avupload">Save</button>
                             </div>

                          
                        </form>      
                           
                        </div>
                        <div class="col-12 col-md-6 col-sm-6">
                           <h3 class="card-title mb-2">{{ Auth::guard('web')->user()->username }}</h3>
                           <!--   <p class="card-text mb-1">Username:{{ Auth::guard('web')->user()->username }} </p> -->
                           <p class="card-text mb-1">Name: 
                              @if(Auth::guard('web')->user()->name != '')
                              {{ Auth::guard('web')->user()->name }} 
                              @else
                              <a href="{{ asset('profile/edit') }}" style="color:#088dcd"> <i class="fa fa-pencil"></i> Update Now </a>
                              @endif
                           </p>
                             @if(Auth::guard('web')->user()->mobile != '')
                             <p class="card-text mb-1">Mobile No: 
                                {{    Auth::guard('web')->user()->mobile }} 
                             </p>
                            @else
                              <p class="card-text mb-1">Mobile No: 
                                 <a href="{{ asset('profile/edit') }}" style="color:#088dcd"> <i class="fa fa-pencil"></i> Update Now </a>
                             </p>
                           @endif
                           <p class="card-text mb-1">Email Id: {{ Auth::guard('web')->user()->email }} </p>
                           <!--  <p style="height:80px;" >{{ Auth::guard('web')->user()->aboutme }}</p> -->
                           <div class="row" style="margin-top: 2.2rem!important"> 
                              <div class="col-4 col-md-3 col-sm-6 text-center">
                                 <h5><strong> {{ $user->Post->count() }} </strong></h5>
                                 <p><i class="fa fa-image"></i> Posts</p>
                              </div>
                              <div class="col-4 col-md-3 col-sm-6 text-center">
                                 <h5><strong>{{ _userVote(Auth::guard('web')->user()->id,'up') }}</strong></h5>
                                 <p><i class="fa fa-arrow-up"></i> Upvotes</p>
                              </div>
                              <div class="col-4 col-md-3 col-sm-6 text-center ">
                                 <h5><strong>{{ _userVote(Auth::guard('web')->user()->id,'down') }}</strong></h5>
                                 <p><i class="fa fa-arrow-down"></i> Downvotes</p>
                              </div>
                           </div>
                        </div>
                        <div class=" d-none d-sm-none d-md-block col-md-3 col-sm-3 text-left">
                           <h5>My Account</h5>
                           <hr>
                           <ul class="tutor-links">
                              <li><a href="{{ asset('profile') }}" title=""><i class="fa fa-dashboard"></i> My Porfile</a></li>
                              <li><a href="{{ asset('profile/edit') }}" title=""><i class="fa fa-pencil"></i> Edit Profile</a></li>
                              <!-- <li><a href="#" title=""><i class="ti-settings"></i> Account Settings</a></li> -->
                              <li><a href="{{ asset('profile/change-password') }}" title=""><i class="ti-key"></i> Change Password</a></li>
                              <li>
                                 

                                 <a href="{{ url('/logout') }}" title="Logout" 
                           onclick="event.preventDefault();
                           document.getElementById('plogout-form').submit();">
                           <i class="ti-power-off"></i>log out</a>
                        <form id="plogout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          @csrf
                        </form>

                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="timeline-info">
                  <ul class="text-center">
                     <li class="admin-name d-none">
                        <h5><i class="ti-user"></i> {{ Auth::guard('web')->user()->username }}</h5>
                         <span>{{ Auth::guard('web')->user()->mobile }}</span>
                     </li>
                     <li>
                       
                        <a class="{{ (request()->is('profile')) ? 'current' : '' }} " 
                           href="{{ asset('profile') }}" data-ripple="">ALL POSTS</a>
                        
                        <a class="{{ (request()->is('profile/pending-posts')) ? 'current' : '' }} text-info" href="{{ asset('profile/pending-posts') }}"  data-ripple="">PENDING</a>
                        
                        <a class="{{ (request()->is('profile/approved-posts')) ? 'current' : '' }} text-success" href="{{ asset('profile/approved-posts') }}"  data-ripple="">APPROVED</a>
                        
                        <a class="{{ (request()->is('profile/rejected-posts')) ? 'current' : '' }} text-danger" href="{{ asset('profile/rejected-posts') }}" " data-ripple="">REJECTED</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<style type="text/css">

</style>
