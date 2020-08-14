@extends('layouts.app')
@section('content')


<section>
      <div class="feature-photo">
         <figure><img src="{{ asset('web/images/cover-photo.jpeg') }}" style="height:280px;" alt=""></figure>
         <div class="add-btn">
            <span>1205 posts</span>
            <a href="#" title="" data-ripple="">Add Post</a>
         </div>
         <form class="edit-phto">
            <i class="fa fa-camera-retro"></i>
            <label class="fileContainer">
               Edit Cover Photo
            <input type="file"/>
            </label>
         </form>
         <div class="container-fluid">
            <div class="row merged">
               <div class="col-lg-2 col-sm-3">
                  <div class="user-avatar">
                     <figure>
                        <img src="{{ asset('img/av_150x150.jpg') }}" alt="">
                        <form class="edit-phto">
                           <i class="fa fa-camera-retro"></i>
                          <!--  <label class="fileContainer">
                              Edit Display Photo
                              <input type="file"/>
                           </label> -->
                        </form>
                     </figure>
                  </div>
               </div>
               <div class="col-lg-10 col-sm-9">
                  <div class="timeline-info">
                     <ul>
                        <li class="admin-name">
                          <h5>{{ Auth::guard('web')->user()->username }}</h5>
                          <span>LNo. 1234</span>
                        </li>
                        <li>
                           <a class="" href="time-line.html" title="" data-ripple="">All Post</a>
                           <a class="text-info" href="timeline-photos.html" title="" data-ripple="">Pending</a>
                           <a class="text-success" href="timeline-videos.html" title="" data-ripple="">Approved</a>
                           <a class="text-danger" href="timeline-friends.html" title="" data-ripple="">Rejected</a>
                          
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section><!-- top area -->




<section>
<div class="gap gray-bg">
<div class="container">
   <div class="row merged20" id="page-contents">
     
      <!-- sidebar -->
      <div class="col-lg-12" >
         <div class="blog-sec">
                     <!--  <div class="bg424242 p-10 mb-10 text-center">
							<a href=""><u>All</u></a> | <a href="" style="color: yellow;">Pending </a> | <a href="" style="color: green;">Approved </a> | <a href="" style="color: red;">Rejected</a>
                        </div> -->
            
            <div class="row masonry pad5">
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/BZ1biU0.jpeg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">The man, the myth, the legend</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/hiFkave.jpeg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">LOCKDOWN time can be useful! One hell of a sorting addict!</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/YLWCf7F.gif') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">KIKI'S Delivery service</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/sRmDc32.jpg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Downvote me to hell, I don't care.</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/nD4hs3d.jpg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Don’t give up</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/C9F2IrR.jpeg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Dump With Me and We Will Be Dumpless!</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/BdoYQyl.jpeg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">She’s like a ninja with a bean addiction</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/J5NqoYs.jpeg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">I can feel this photo</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/vVLAMRk.gif') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Mrw, after getting into an argument with.....</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/vVLAMRk.gif') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Mrw, after getting into an argument with.....</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/sRmDc32.jpg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Downvote me to hell, I don't care.</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/sRmDc32.jpg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Downvote me to hell, I don't care.</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/nD4hs3d.jpg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Don’t give up</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/C9F2IrR.jpeg') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">Dump With Me and We Will Be Dumpless!</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-angle-double-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-angle-double-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     <!-- /col-3 -->
                           <div class="col-lg-2 col-sm-6">
                              <div class="g-post-classic">
                                 <figure>
                                    <img alt="" src="{{ asset('web/images/post/YLWCf7F.gif') }}">
                                    <i class="fa fa-image"></i>
                                 </figure>
                                 <div class="g-post-meta">
                                    <div class="post-title">
                                       <h4><a title="" href="#">KIKI'S Delivery service</a></h4>
                                    </div>
                                    <div class="g-post-ranking">
                                       <a title="" href="#" class="likes"><i class="ti-arrow-circle-up"></i><br>10 </a>
                                       <a title="" href="#" class="coments"><i class="ti-arrow-circle-down"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-eye"></i><br>5 </a>
                                       <a title="" href="#" class="coments"><i class="ti-share"></i><br>5 </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /col-3 -->
                     
                     
                        </div>
                        <!-- /row -->
                        
            <button class="btn-view btn-load-more">Load More</button>
         </div>
         <!-- /blog-sec --> 
      </div>
      <!-- /col-9 -->
	  
   </div>
</div>
</section>

@endsection
