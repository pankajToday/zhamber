@extends('layouts.app')
@section('content')

 @include('posts._head_tags') 

@if(collect($posts)->isNotEmpty())

<section class="fgap bg-444 stick-filter" >
   <div class="container">

   



<div class="row" id="stickyTop">
    <div class="col-6 col-lg-3"> 
      <a href="{{ asset('posts/popular') }}"  class="btn btn-info btn-block   {{ ($refine['type'] == 'popular')?'active':'' }}" >
      Popular
      </a>
    </div>
    <div class="col-6 col-lg-3">
       <a href="{{ asset('posts/recent') }}"  class="btn btn-info btn-block  {{ ($refine['type'] == 'recent')?'active':'' }}">
      Recent
      </a>
    </div>
    <div class="col-6 col-lg-3">   
      <a href="{{ asset('posts/most-viewed') }}"  class="btn btn-info btn-block  {{ ($refine['type'] == 'most-viewed')?'active':'' }}">
      Most Viewed
      </a>
    </div>
    <div class="col-6 col-lg-3"> 
       <div class="btn-group d-flex">
         <button type="button" class="btn btn-info w-100 dropdown-toggle  {{ ($refine['type'] == 'highest-scoring')?'active':'' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
         Highest Scoring
         </button>
         <div class="dropdown-menu hlike-menu dropdown-menu-right w-100">
            <a href="{{ asset('posts/highest-scoring/today') }}" class="dropdown-item" >Today</a>
            <a href="{{ asset('posts/highest-scoring/week') }}" class="dropdown-item" >This Week</a>
            <a href="{{ asset('posts/highest-scoring/month') }}" class="dropdown-item" >This Month</a>
            <a href="{{ asset('posts/highest-scoring/ever') }}" class="dropdown-item" >Ever</a>
         </div>
      </div>
   </div>
  </div>


  <style type="text/css">
    @media all and (max-width:480px) {
       .type { width: 100%; display:block; font-size: 12px;  margin-bottom: 10px;}
       #hlike { width: 100%; display:block; font-size: 12px;  margin-bottom: 10px;}
    }  

    .type{
      margin-bottom: 5px;
    } 

  </style>


  </div>
</section>
@endif



<section style="margin-bottom: 200px;">
   <div class="gap gray-bg">
   <div class="container">
      <div class="row merged20" style="min-height: 500px" >
         <!-- sidebar -->
         <div class="col-lg-12" >
          
             @if(collect($posts)->isNotEmpty())
                <div class="row pad5 masonry"  id="results"></div>

               <input type="hidden" id="pageno" value="1">
                <input type="hidden" id="all" value="{{ ceil($posts_count/25) }}}">
               
               <form id="load_result_form" name="#">
                  @csrf
                  @foreach($refine as $key => $val)
                  <input type="hidden" value="{{$val}}" name="{{$key}}" id="{{$key}}"> 
                  @endforeach
                  
               </form>

               <button class="loadingbox"> <i class="ti-reload fa  fa-spin"></i></button> 
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
               <!-- /row -->
           
         </div>
         <!-- /col-9 -->
      </div>
   </div>
  </div> 
</section>

 <script type="text/html" id="photo-item-template"> <div class="col-md-15 col-sm-3 "> <a href="((post_d_url))" > <div class="card text-white bg-dark post" style="border-bottom: solid 1px #A9A9A9; " > @if(_chkMobOrDesk() == 'M') <div class="card-body p-2"> <p class="card-text">((title))</p> </div> @endif <img class="card-img-bottom lazy" data-original="((image))" src="{{ asset('web/images/blank.gif') }}"> @if(_chkMobOrDesk() == 'D') <div class="card-body p-2"> <p class="card-text">((title))</p> </div> @endif <div class="card-footer post-foot text-center"> <div class="row"> <div class="col-4"> <div class="d-flex"> <div class="align-self-center"><i class="ti-arrow-up"></i>((n_like))</div> </div> </div> <div class="col-4"> <div class="d-flex align-items-start"> <div class="align-self-center"><i class="ti-arrow-down"></i>((n_dlike))</div> </div> </div> <div class="col-4"> <div class="d-flex"> <div class="align-self-center"><i class="ti-eye"></i>((n_views))</div> </div> </div> </div> </div> </div> </a> </div> </script>


<script src="{{ asset('web/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/imagesloaded.pkgd.js') }}"></script>
<script src="{{ asset('web/js/loadmore.js') }}"></script> 
<script type="text/javascript">
var $grid = $('.masonry').masonry();

var pageno = parseInt(1); 
loadMore(pageno);

</script>

@endsection
