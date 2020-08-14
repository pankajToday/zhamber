<section>
   <div class="gap gray-bg">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="card bg-dark" style="padding:20px 20px 0px 20px;margin-bottom:0px;border-bottom:solid 1px #333;">
                  <div class="card-block">
                     <div class="row">
                        <div class="col-12 col-md-3 col-sm-4 text-center">
                          <div class="user-avatar">
                             
                                 <div class="user-upload">
                                      
                                      <div class="user-preview">
                                       @if($user->avatar)
                                       <div id="imagePreview" style="background-image: url({{ asset('storage/avatar/'.$user->avatar) }});">
                                          </div>
                                       @else
                                       <div id="imagePreview" style="background-image: url({{ asset('img/av_400x400.jpg') }});">
                                          </div>
                                       @endif
                               
                                          
                                      </div>
                                  </div>
                               <button type="submit" id="bntUpImg" class="bnt btn-primary avupload">Save</button>
                             </div>

                        </div>
                        <div class="col-12 col-md-6 col-sm-8">
                           <h1 class=" mb-2">
                              {{ $user->username }}</h2>
                          
                          
                              @if($user->aboutme != '')
                               <p class="card-text mb-1" style="min-height: 70px;">
                              {{ $user->aboutme }}
                              </p>
                              @else
                              <br>
                             @endif
                           
                          
                           <div class="row ">
                              <div class="col-4 col-md-3 col-sm-6 text-center">
                                 <h5><strong> {{ $user->Post->count() }} </strong></h5>
                                 <p><i class="fa fa-image"></i> Posts</p>
                              </div>
                              <div class="col-4 col-md-3 col-sm-6 text-center">
                                 <h5><strong>{{ _userVote($user->id,'up') }}</strong></h5>
                                 <p><i class="fa fa-arrow-up"></i> Upvotes</p>
                              </div>
                             <div class="col-4 col-md-3 col-sm-6 text-center">
                                 <h5><strong>{{ _userVote($user->id,'down') }}</strong></h5>
                                 <p><i class="fa fa-arrow-down"></i> Downvotes</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3 col-sm-3 text-left">
                           

                          
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
                   <div class="col-md-12">
               <div class="timeline-info">
                  <ul class="text-center">
                     <li class="admin-name d-none">
                        <h5><i class="ti-user"></i> </h5>
                         <span></span>
                     </li>
                     <li>
                       
                        <a class="" href="javascript::" data-ripple="">ALL POSTS</a>
                        
                     
                     </li>
                  </ul>
               </div>
            </div>

         </div>
      </div>
   </div>
</section>


<style type="text/css">
  .user-upload {
  position: relative;
  max-width: 150px;
  margin: 10px auto;
}
.user-upload .user-edit {
  position: absolute;
  right: 12px;
  z-index: 1;
  top: 10px;
}
.user-upload .user-edit input {
  display: none;
}
.user-upload .user-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #ff7043;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
  color: #fff;
}
.user-upload .user-edit input + label:hover {
  background: #ff7043;
  border-color: #fff;
}
.user-upload .user-edit input + label:after {
  content: "\f040";
  font-family: 'FontAwesome';
  color: #fff;
  position: absolute;
  top: 5px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;

}
.user-upload .user-preview {
  width: 152px;
  height: 152px;
  position: relative;
  border-radius: 100%;
 /* border: 6px solid #F8F8F8;*/
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.user-upload .user-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
</style>