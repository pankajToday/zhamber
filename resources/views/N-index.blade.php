@extends('layouts.app')
@section('content')

<section style="background: #1e2833;padding-top: 15px; padding-bottom:15px;" >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="faq-top">
            <h5>Discover most funny, humorous and amazing things on internet !</h5>
           
          </div>
        </div>
    </div>
    </div>
  </section>

 @include('posts._head_tags') 

@if(collect($posts)->isNotEmpty())

<section class="fgap bg-444 stick-filter" >
   <div class="container">
 @include('posts._filter_box')
</div>
</section>
@endif

<section style="margin-bottom: 200px;">
   <div class="gap gray-bg">
   <div class="container">



       @if(collect($posts)->isNotEmpty())

    <div class="row merged20" style="min-height: 500px;margin-top: 0px;z-index: ">
      <div class="col-lg-12">

             <div class="row pad5 masonry"  id="results"></div>
             <input type="hidden" id="pageno" value="0">
             <input type="hidden" id="all" value="{{ $posts_count }}">
             <form id="load_result_form" name="#">
                  @csrf
                  @foreach($refine as $key => $val)
                  <input type="hidden" value="{{$val}}" name="{{$key}}" id="{{$key}}"> 
                  @endforeach
                 <!--  @if(array_key_exists('type',$refine) == 0)
                   <input type="hidden" name="type" id="type" value="popular" />
                  @endif -->
               </form>
               <button class="loadingbox"> <i class="ti-reload fa  fa-spin"></i></button> 


      </div> 
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

 <script type="text/html" id="photo-item-template"> <div class="col-md-15 col-sm-3"> <div class="g-post-classic bg-444"> <figure> <a href="((post_d_url))"> <img class="lazy" data-original="((image))" src="{{ asset('web/images/blank.gif') }}"> </a> <i class="fa fa-image"></i> </figure> <div class="g-post-meta"> <div class="post-title"> <a href="((post_d_url))"> <p>((title)) </p> </a> </div> <div class="g-post-ranking"> <a title="" href="#" class="likes"><i class="fa fa-arrow-up"></i>  ((n_like)) </a> <a title="" href="#" class="coments"><i class="fa fa-arrow-down"></i> ((n_dlike)) </a> <a title="" href="#" class="coments"><i class="ti-eye"></i> ((n_views)) </a> </div> </div> </div> </div> </script>



<script src="{{ asset('web/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/imagesloaded.pkgd.js') }}"></script>
<script src="{{ asset('web/js/loadmore.js') }}"></script> 
<script type="text/javascript">
$(document).ready(function() {
  
var $grid = $('.masonry').masonry({
        percentPosition: true,
        isFitWidth: false,
        columnWidth: '.col-md-15'
});

var pageno = parseInt(1); 
loadMore(pageno);
$(".masonry").animate({opacity: 1});

});
</script>



@endsection
