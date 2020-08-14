@extends('layouts.app')
@section('content')


<section>
   <div class="gap gray-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-3 d-none d-sm-block">
            <aside class="sidebar static">
               <div class="widget">
                  <h4 class="widget-title">featured</h4>
                  <ul class="naves">
                     <li>
                        <i class="ti-shift-right"></i>
                        <a href="{{ asset('?type=popular') }}" title="popular">Popular</a>
                     </li>
                     <li>
                        <i class="ti-shift-right"></i>
                        <a href="{{ asset('?type=recent') }}" title="Top Shared">Recent</a>
                     </li>
                     <li>
                        <i class="ti-shift-right"></i>
                        <a href="{{ asset('?type=most-viewed') }}" title="Most Viewed">Most Viewed</a>
                     </li>
                  </ul>
               </div>
               <!-- Shortcuts -->
               @include('account/_widget_top_tags')         
            </aside>
         </div>
         <!-- sidebar -->
         <div class="col-lg-6" >
            @include('posts._post_item')       
         </div>
         <!-- /col-6 -->
         <div class="col-lg-3 d-none d-sm-block">
            <aside class="sidebar static">
               <!-- /we -->     
              <div class="advertisment-box">
                  <h4 class="">advertisment</h4>
                  <figure>
                     <a title="Advertisment" href="#"><img alt="" src="{{ asset('web/images/ad-widget.gif') }}"></a>
                  </figure>
               </div>
               <div class="advertisment-box">
                  <h4 class=""></h4>
                  <figure>
                     <a title="Advertisment" href="#"><img alt="" src="{{ asset('web/images/ad2.gif') }}"></a>
                  </figure>
               </div> 
            </aside>
         </div>
       
      </div>
   </div>
</section>

@if(_chkMobOrDesk() == 'D') 
<section class="">
   <div class="gap gray-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
           <h5 class="f-title"> People Also Viewed This </h5>
         </div>
      </div>
      <div class="row">
         
         @foreach($alsoViewed as $row)
            <div class="col-lg-3 col-sm-6">
               <a href="{{ _pstURL($row->iunique) }}" >
                  <div class="card text-white bg-dark post" >
                     @if(_chkMobOrDesk() == 'M') 
                     <div class="card-body p-2">
                        <p class="card-text">{{ $row->title }}</p>
                     </div>
                     @endif 
                     <img class="card-img-bottom" src="{{ asset('storage/posts/images/'.$row->image) }}" > 
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
                  </div>
               </a>
            </div>
            @endforeach
      </div>
   </div>
</section>
@else

<section class="block-ad">
   <div class="gap gray-bg">
       <div class="container-fluid">
       <div class="row">
         <div class="col-lg-12">
           <img src="{{ asset('web/images/gads.gif') }}" width="100%">
         </div>   
      </div>
   </div>
</section>
@endif



<script src="{{ asset('js/share.js') }}"></script>

@endsection
