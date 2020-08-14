@extends('layouts.app')
@section('content')

<section style="margin-bottom: 200px;">
   <div class="gap gray-bg">
   <div class="container">

 <div class="row merged20" style="min-height:200px;margin-top: 0px;z-index: ">
      <div class="col-lg-12">

<div class="grid are-images-unloaded" id="grid" data-uri="{{ asset('grid?') }}">
  <div class="grid__col-sizer"></div>
  <div class="grid__gutter-sizer"></div>
  @foreach($posts as $key => $row)

  <div class="post-item" data-postid="{{ $row->id }}" data-csrf="{!! csrf_token() !!}">
  	<a href="{{ asset('p/'.$row->iunique) }}" >
      <div class="card text-white bg-dark post " style="border-bottom: solid 1px #A9A9A9; padding:0px 0px 5px 0px;" >
         @if(_chkMobOrDesk() == 'M') 
         <div class="card-body p-2">
            <p class="card-text">{{ $row->title }}</p>
         </div>
         @endif 
         <img class="card-img-bottom "  src="{{ asset('storage/posts/images/'.$row->image) }}"> 
         @if(_chkMobOrDesk() == 'D') 
         <div class="card-body p-2">
            <p class="card-text">{{ $row->title }}</p>
         </div>
         @endif 
         <div class="card-footer post-foot text-center">
            <div class="row">
               <div class="col-4">
                  <div class="d-flex">
                     <div class="align-self-center"><i class="ti-arrow-up"></i>{{ $row->n_like }}</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="d-flex align-items-start">
                     <div class="align-self-center"><i class="ti-arrow-down"></i>{{ $row->n_dlike }}</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="d-flex">
                     <div class="align-self-center"><i class="ti-eye"></i>{{ $row->n_views }}</div>
                  </div>
               </div>
            </div>
         </div>
          @if(_pstStatus($row->id) == 'R')
                          <div class="r-msg text-danger" style="border-top: solid 1px #535353;padding-top: 5px;margin-top: 5px;">
                            {{ $row->rejected_reason }}
                          </div>
                         @endif 
      </div>
   </a>
  </div>



  @endforeach

    <div class="pagination_next"></div> 


</div>


</div>

<div class="col-lg-12">
    <input type="text" name="" id="total_pages" value="{{ $total_pages }}">


  <div class="page-load-status text-center">
  <div class="infinite-scroll-request">
    <!--  <button class="loadingbox"> <i class="ti-reload fa  fa-spin"></i></button>  -->

    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 307.7 97.3" enable-background="new 0 0 307.7 97.3" xml:space="preserve">
<circle class="circle"fill="none" stroke="#8e44ad" stroke-width="7" stroke-miterlimit="10"  stroke-linecap="round" cx="74.6" cy="47" r="18.5"/>
<g>
  <path class="one" d="M50.4,58.9v9.4H20.6V26.4h10v32.4H50.4z"/>
  <path class="two" d="M127.4,61.7h-16.5l-2.4,6.6H97.7l16.7-41.8h9.5l16.7,41.8h-10.8L127.4,61.7z M124.2,52.9l-3-8.1c-0.9-2.4-2-6.2-2-6.2h-0.1
    c-0.1,0-1.1,3.8-2,6.2l-3,8.1H124.2z"/>
  <path class="three" d="M162.4,26.4c11.9,0,21.6,8.5,21.6,21.1s-9.7,20.7-21.6,20.7h-18.3V26.4H162.4z M162.4,58.9c6,0,11.2-4.2,11.2-11.3
    c0-7.2-5.2-11.7-11.2-11.7h-8.2v23.1H162.4z"/>
  <path class="four" d="M188.2,68.2V26.4h10v41.8H188.2z"/>
  <path class="five" d="M240.9,26.4v41.8h-9.4l-8.5-11.6c-3.8-5.3-9.4-13.2-9.5-13.2h-0.1c-0.1,0,0.1,6.4,0.1,15.6v9.3h-10V26.4h9.4l8.9,11.9
    c2.7,3.6,9.1,12.6,9.1,12.6h0.1c0.1,0-0.1-7.4-0.1-15v-9.6H240.9z"/>
  <path class="six" d="M278.1,64.8c-2.4,2.6-7.2,4.2-11.3,4.2c-12,0-21.7-9.1-21.7-21.7c0-12.6,9.7-21.7,21.7-21.7c8.1,0,15.2,4.3,19,11.1
    l-10.2,2.7c-2-2.4-5.5-3.9-8.8-3.9c-6.9,0-11.2,5-11.2,11.8c0,7.3,5,11.9,11.8,11.9c6.7,0,9.6-3.5,10.8-6.6v-0.1h-11v-8.1h19.5
    v23.7h-8.6C278.1,65.5,278.2,64.9,278.1,64.8L278.1,64.8z"/>
</g>
</svg>


  </div>
<p class="infinite-scroll-last">There are no more posts to show</p>
<p class="infinite-scroll-error">There are no more posts to show</p>
</div>
</div>


</div>
</div>
</div>
</section>




<script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.min.js"></script>
<script src="https://unpkg.com/infinite-scroll@3.0.5/dist/infinite-scroll.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4.1.4/imagesloaded.pkgd.min.js"></script>

<script type="text/javascript">
var initPage = parseInt(getParameterByName('pg') || 1, 10);
var uri = document.getElementById("grid").getAttribute('data-uri');

function getUserwallPath() {

   
    var pgnumber = (parseInt(this.pageIndex, 10) + initPage);
    var total_pages = parseInt($("#total_pages").val());
    if(pgnumber <= total_pages){
      return uri + 'pg=' + (parseInt(this.pageIndex, 10) + initPage);
    }else{
      $('.pagination_next').hide();
    }
    
   

    //return uri + 'pg=' + (parseInt(this.pageIndex, 10) + initPage);
}
var msnry;
jQuery(document).ready(function($) {
    var grid = document.querySelector('.grid');
    msnry = new Masonry(grid, {
        itemSelector: 'none',
        columnWidth: '.grid__col-sizer',
        gutter: '.grid__gutter-sizer',
        percentPosition: true,
        transitionDuration: 0
    });
    imagesLoaded(grid, function() {
        grid.classList.remove('are-images-unloaded');
        msnry.options.itemSelector = '.post-item';
        var items = grid.querySelectorAll('.post-item');
        msnry.appended(items);
       
    });
    msnry.on('layoutComplete', function(items) {
      /// loadYoutubeVideos();
       
    });
    var infScroll = new InfiniteScroll(grid, {
        path: getUserwallPath,
        status: '.page-load-status',
        outlayer: msnry,
        append: '.post-item',
        checkLastPage: '.pagination_next'
    });
});

function makeid(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    for (var i = 0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function getBoard(url) {
    if (!url) url = window.location.href;
    var regex = new RegExp('[/]board\/([^&#?]*)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[1]) return '';
    return results[1];
}

function loadYoutubeVideos() {
    var div, n, v = document.getElementsByClassName("youtube-player");
    for (n = 0; n < v.length; n++) {
        div = document.createElement("div");
        div.setAttribute("data-id", v[n].dataset.id);
        div.innerHTML = labnolThumb(v[n].dataset.id);
        div.onclick = labnolIframe;
        v[n].appendChild(div);
    }
};

function labnolThumb(id) {
    var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
        play = '<div class="play"></div>';
    return thumb.replace("ID", id) + play;
}

function labnolIframe() {
    var iframe = document.createElement("iframe");
    var embed = "https://www.youtube.com/embed/ID?autoplay=1";
    iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
    iframe.setAttribute("frameborder", "0");
    iframe.setAttribute("allowfullscreen", "1");
    this.parentNode.replaceChild(iframe, this);
}
</script>


<style type="text/css">

.grid {
	width: 100%
}

.grid.are-images-unloaded {
	opacity: 0
}

.grid.are-images-unloaded .image-post-item {
	opacity: 0
}

.post-item {
	margin-bottom: 10px;
	float: left
}

.post-item,
.grid__col-sizer {
	width: 100%
}

.grid__gutter-sizer {
	width: 1%
}

@media(min-width:540px) {
	.post-item,
	.grid__col-sizer {
		width: 19%
	}
}

@media(min-width:1150px) {
	.post-item,
	.grid__col-sizer {
		width: 19%
	}
}

.post-item-hover {
	box-shadow: 0 0 15px rgba(0, 0, 0, .1);
	border-radius: 8px;
	transition: all .3s
}

.post-item-hover:hover {
	transform: translateY(-6px);
	box-shadow: 0 6px 15px rgba(0, 0, 0, .2)
}

html {
  height: 100%;
  background: #222;
}

svg {
  width: 200px;
  transform: translateX(-50%) translateY(-50%);
  position: absolute;
  top: 50%;
  left: 50%;
  display: block;
}

@keyframes draw {
  0% { stroke: #2980b9; }
  100% { stroke-dashoffset: 300; }
}

@keyframes letterflash {
  0% { fill: #2980b9; }
  100% { fill: #8e44ad; }
}

@keyframes spinnerflash {
  0% { stroke: #2980b9; }
  100% { stroke: #8e44ad; }
}
.circle {
  stroke-dasharray: 150;
  animation: draw 2s linear infinite;
}

.one, .two, .three, .four, .five, .six {
  animation: letterflash 2s ease-in-out infinite;
}

.six   { animation-delay: 0.5s; }
.five  { animation-delay: 0.4s; }
.four  { animation-delay: 0.3s; }
.three { animation-delay: 0.2s; }
.two   { animation-delay: 0.1s; }
.one   { animation-delay: 0s; }

</style>

@endsection
