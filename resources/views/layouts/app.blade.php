<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Most viral, funny and humorous memes, pictures and GIFs in India. Upload, Share and Earn.</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{!! csrf_token() !!}">
      <meta name="description" content="Discover most funny, humorous and amazing things on internet !" />
      <meta name="keywords" content="zhamber,memes, funny, gifs, pictures, funny memes, funny pictures, funny photos, funny videos, funny jokes, hindi jokes, viral, viral videos, Jokes in english, earn money online, make money online, memes in hindi, funny GIFs, funny memes in hindi, funny images, laugh, amazing, viral image, monetize, beautiful images" />
      <link rel="canonical" href="{{ \Request::fullUrl() }}">
      <meta property=author content="Zhamber" /> 
      <meta property=article:author content="Zhamber" /> 
      <meta property=article:publisher content="https://www.facebook.com/zhamberofficial"> 


      @if(Request::is('p/*') || Request::is('tag/*/*'))
      
      <?php 
      $img = asset('storage/posts/images/'.$post->image);
      list($width, $height, $type, $attr) = getimagesize($img);
      ?>

      <meta property=og:site_name       content="Zhamber" />
      <meta property="og:url"           content="{{ \Request::fullUrl() }}" />
      <meta property="og:image:secure_url" content="..." />
      <meta property="og:type"          content="website" />
      <meta property="og:title"         content="www.zhamber.com" />
      <meta property="og:description"   content="{{ $post->title }}" />
      <meta property="og:image:type"    content="image/jpeg">
      <meta property="og:image"         content="{{ asset('storage/posts/images/'.$post->image) }}"/>
      <meta property="og:image:secure_url" content="{{ asset('storage/posts/images/'.$post->image) }}"/>

      <meta property="og:image:width"   content="<?php echo $width; ?>" />
      <meta property="og:image:height"  content="<?php echo $height; ?>>" />
      <meta property="fb:app_id"        content="257112448983214" />

      <meta name=twitter:title content="Zhamber" /> 
      <meta name=twitter:site content="@zhamber" /> 
      <meta name=twitter:domain content="zhamber.com" /> 
      <meta name=twitter:card content="" /> 
      <meta name=twitter:description content="{{ $post->title }}"/> 
      <meta name=twitter:image:src content="{{ asset('storage/posts/images/'.$post->image) }}"/> 
      <meta name=twitter:image:height content="<?php echo $width; ?>"  />
      <meta name=twitter:image:width content="<?php echo $height; ?>"  /> 



      
      @endif
      
      <link rel="icon" href="{{ asset('web/images/fevicon.png') }}" type="image/png" sizes="16x16">
      <link rel="stylesheet" href="{{ asset('web/css/main.min.css') }}"> 
      <link rel="stylesheet" href="{{ asset('web/css/style.min.css') }}">
      <link rel="stylesheet" href="{{ asset('web/css/custom.css') }}"> 
      
      <script type="text/javascript" src="{{ asset('web/js/jquery-3.3.1.min.js') }}"></script>
      <script type="text/javascript">
         var APP_URL = {!! json_encode(url('/')) !!} 
         var FTOKEN = {!! json_encode(csrf_token()) !!}
      </script>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167544475-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-167544475-1');
      </script>
      <!-- FB LOGIN -->
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '257112448983214',
            cookie     : true,
            xfbml      : true,
            version    : 'v7.0'
          });
          FB.AppEvents.logPageView();   
        };

        (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "https://connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>

    </head>
   <body>
      <!--<div class="se-pre-con"></div>-->

   
      <div class="theme-layout">

         <div class="postoverlay"></div>
         
          @include('layouts._mmenu')
    
    
      <div class="topbar stick">
         <div class="logo">
         	
            <a title="" href="{{ asset('') }}"><img src="{{ asset('web/images/logo.svg') }}" alt=""></a>
         </div>
         <div class="top-area">
             
             <div class="top-langbox">

             <a href="javascript::" data-toggle="modal" data-target="#langModal" class="btn btn-deep-orange btn-sm text-white bold">
                   <i class="fa fa-language" aria-hidden="true"></i>  My Language   
                  </a>

             </div>
    
       <div class="top-search">
           <form method="post" class="multiple-datasets" >
          <input type="text" class="typeahead" placeholder="Search tags, users">
          <button type="button" data-ripple><i class="ti-search"></i></button>
        </form>

      
            
            </div>

            
                <ul class="setting-area" style="padding-left:15px;">
               <li>
                   @if(isset(Auth::guard('web')->user()->id)) 
                 <a href="{{ asset('post/new') }}" class="btn btn-info btn-sm text-white bold">
                     <i class="ti-plus"></i> New Post 
                  </a>
                 @else

                 <a href="javascript::" data-toggle="modal" data-target="#AllSignInUp" class="btn btn-info btn-sm text-white bold">
                     <i class="ti-plus"></i> New Post 
                  </a>
                  
                 @endif
               </li>
            </ul> 
            @if(isset(Auth::guard('web')->user()->id)) 
            
            <div class="user-img">
              @if( Auth::guard('web')->user()->avatar)
              <img src="{{ asset('storage/avatar/'.Auth::guard('web')->user()->avatar) }}" alt="" width="50px;">
               @else
              <img src="{{ asset('img/av_73x73.jpg') }}" alt="" width="50px;">   
              @endif
            

            <span>{{ Auth::guard('web')->user()->username }}</span>
            <div class="user-setting">
              <a href="{{ asset('profile') }}" title="view profile"><i class="ti-user"></i> My Profile</a>
               <a href="{{ asset('profile/edit') }}" title="Edit Profile"><i class="ti-pencil-alt"></i>edit profile</a>
                <a href="{{ asset('profile/change-password') }}" title="Edit Profile"><i class="ti-pencil-alt"></i>change password</a>
               
                           <a href="{{ url('/logout') }}" title="Logout" 
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="ti-power-off"></i>log out</a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          @csrf
                        </form>
                     

                        
            </div>
         </div>


            @else

            <div class="user-img">
               <a href="javascript::" data-toggle="modal" data-target="#AllSignInUp"  class="btn btn-sm btn-deep-orange text-white bold" > 
                    <i class="ti-user"></i> Login / Signup</a>
            </div>

            @endif
            

         </div>
      </div>
      <!-- topbar -->
      

        @yield('content')

@if(_chkMobOrDesk() == 'D') 
       <div class="zpp-box left">
  <a href="{{ asset('zpp') }}" class="zpp">Earn with Us</a> 
  
</div>
       <div class="social-box">
 
  <a href="https://www.facebook.com/zhamberofficial" target="_new" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="https://www.twitter.com/zhamberofficial" target="_new" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="https://www.instagram.com/zhamberofficial" target="_new" class="instagram"><i class="fa fa-instagram"></i></a>
  
  
</div>
 @endif


<div class="bottombar fixed-footer" id="footer_box">
  <div class="container">
    @if(_chkMobOrDesk() == 'D') 
      <div class="row">
         <div class="col-sm  text-left">
            <span class="copyright">© Zhamber 2020. All rights reserved.</span>
         </div>
         <div class="col-sm btmlink text-right">
            <a href="{{ asset('contact-us') }}">Contact Us </a> |
            <a href="{{ asset('privacy-policy') }}">Privacy Policy </a> |
            <a href="{{ asset('terms-of-service') }}">Terms of service </a> |
             <a href="{{ asset('rules') }}">Site Rules </a> 
          <!--   <a href="{{ asset('advertise') }}">Advertise </a>  -->
         </div>
      </div>
     @else
      
       <div class="row">
         <div class="col-sm text-center btmlink" style="text-align: center !important;">
            <a href="{{ asset('') }}" class="text-center">© Zhamber 2020. All rights reserved.</a>
         </div>
         <div class="col-sm btmlink text-center">
            <a href="{{ asset('contact-us') }}">Contact Us </a> |
            <a href="{{ asset('privacy-policy') }}">Privacy Policy </a> |
            <a href="{{ asset('terms-of-service') }}">Terms of service </a> |
             <a href="{{ asset('rules') }}">Site Rules </a> 
          <!--   <a href="{{ asset('advertise') }}">Advertise </a>  -->
         </div>
      </div>

     @endif 
   </div>
</div> 
<!-- footer -->
</div><!-- theme-layout -->

<div class="moverlay"></div>




@include('_sign_in_up')
@include('_lang_modal')  
@include('layouts._sidebar')
@if(isset(Auth::guard('web')->user()->id)) 

<div class="modal fade" id="aModelLink" tabindex="-1" role="dialog" aria-labelledby="aModelLinkTitle" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content bg-444"> <div class="modal-header"> <h5 class="modal-title" id="exampleModalLongTitle">{{ Auth::guard('web')->user()->username }}</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body" style="padding: 0px 15px 0px 15px "> <ul class="tutor-links"> <li><a href="{{ asset('profile') }}" title=""><i class="fa fa-dashboard"></i> My Porfile</a></li> <li><a href="{{ asset('profile/edit') }}" title=""><i class="fa fa-pencil"></i> Edit Profile</a></li> <!-- <li><a href="#" title=""><i class="ti-settings"></i> Account Settings</a></li> --> <li><a href="{{ asset('profile/change-password') }}" title=""><i class="ti-key"></i> Change Password</a></li> <li> <a href="{{ url('/logout') }}" title="Logout"onclick="event.preventDefault(); document.getElementById('plogout-form').submit();"> <i class="ti-power-off"></i> log out</a> <form id="plogout-form" action="{{ url('/logout') }}" method="POST" style="display: none;"> @csrf </form> </li> </ul> </div> </div> </div> </div> 
@endif



<script src="{{ asset('web/bootstrap/assets/js/vendor/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/js/plugins.js') }}"></script>  
<script src="{{ asset('web/js/script.js') }}"></script>


<script type="text/javascript" src="{{ asset('js/typeahead.bundle.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('web/css/typeahead.min.css') }}">


<link rel="stylesheet" type="text/css" href="{{ asset('web/css/jquery.mCustomScrollbar.min.css') }}">
<script type="text/javascript" src="{{ asset('web/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('web/js/custom.js') }}"></script> 


  
  </body>
</html>