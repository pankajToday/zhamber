@extends('layouts.app')
@section('content')

<script async src="{{ asset('web/js/jquery.visible.min.js') }}"></script>
<script src="{{ asset('web/js/infinite-scroll.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/imagesloaded.pkgd.min.js') }}"></script>
<a href="{{ asset('sabse-bada-memer-kaun') }}" >
<img src="{{ asset('web/images/sabse-bada-memer-kaun.jpg') }}">
</a> 

<!-- <section style="background: #1e2833;padding-top: 15px; padding-bottom:15px;" >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="faq-top">
            <h1 style="font-size:1.25rem;margin-bottom: 0px;font-weight: 500;">Discover most funny, humorous and amazing things on internet !</h1>
           
          </div>
        </div>
    </div>
    </div>
  </section> 
 -->

@include('posts._head_tags') 


@if(collect($posts)->isNotEmpty())

<section class="fgap bg-444 stick-filter" >
   <div class="container">


 @include('posts._filter_box')
</div>
</section>
@endif

<section style="padding-bottom: 100px;">
   <div class="gap gray-bg">
      <div class="container">
         @if(collect($posts)->isNotEmpty())
         <div class="row " >
            <div class="col-lg-12">
               <div class="grid are-images-unloaded" id="grid" data-uri="{{ $page_url }}">
                  <div class="grid__col-sizer"></div>
                  <div class="grid__gutter-sizer"></div>
                  
                  @foreach($posts as $key => $row)

                  @include('posts._pbox')     

                  @endforeach
                
                 <div class="pagination_next"></div>

                  @if($posts_count > _itemPerPage())
                    <div class="pagination_next"></div> 
                  @endif 

               </div>
            </div>
            <!-- /col-12 -->
            <div class="col-lg-12 mt-5 mb-5 pt-5 pb-5">
               <input type="hidden" name="" id="total_pages" value="{{ $total_pages }}">
              <input type="hidden" name="" id="posts_count" value="{{ $posts_count }}">
              <input type="hidden" name="" id="item_per_page" value="{{ _itemPerPage() }}">


               <div class="page-load-status text-center">
                  <div class="infinite-scroll-request">
                    
                   <div class="svg-loader"> <svg class="svg-circular"> <circle class="svg-path" cx="50" cy="50" r="40" fill="none" stroke-width="2" stroke-miterlimit="10"/> </svg> </div>
                  

                  </div>
                  <p class="infinite-scroll-last">There are no more posts to show</p>
                  <p class="infinite-scroll-error">There are no more posts to show</p>
               </div>
            </div>
            <!-- /col-12 -->
         </div>
         @else
         <div class="row pad5">
            <div class="col-md-12">
               <div class="central-meta bg-dark">
                  <div class="personal">
                     <h5 class="f-title"><i class="ti-info-alt text-info"></i> Oops! </h5>
                     <p> Looks like we couldn't find any matches. Tray agian or browse on closets.</p>
                  </div>
                  <a href="{{ asset('') }}" class="btn btn-primary "><span class="glyphicon glyphicon-home"></span>
                  Take Me Home </a>
               </div>
            </div>
         </div>
         @endif
      </div>
   </div>
</section>


<script src="{{ asset('web/js/zscroller.js') }}"></script>


<style>

.is-loading {
  background-color: black;
  background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/loading.gif');
}

.is-broken {
  background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/broken.png');
  background-color: #be3730;

}

.is-loading img,
.is-broken img {
  opacity: 0;
}

</style>

@endsection
