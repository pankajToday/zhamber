@extends('layouts.app')
@section('content')

<script async src="{{ asset('web/js/jquery.visible.min.js') }}"></script>
<script src="{{ asset('web/js/infinite-scroll.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/imagesloaded.pkgd.min.js') }}"></script>




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

<section style="padding-bottom: 100px;">
   <div class="gap gray-bg">
      <div class="container">
         @if(collect($posts)->isNotEmpty())
         <div class="row merged20" >
            <div class="col-lg-12">
               <div class="grid are-images-unloaded" id="grid" data-uri="{{ $page_url }}">
                  <div class="grid__col-sizer"></div>
                  <div class="grid__gutter-sizer"></div>
                  @foreach($posts as $key => $row)
                  <div class="post-item" data-postid="{{ $row->id }}" data-csrf="{!! csrf_token() !!}">
                      
                        <div class="card text-white bg-dark post " style="border-bottom: solid 1px #A9A9A9; padding:0px 0px 5px 0px;" >

                @if(_chkMobOrDesk() == 'D') 
                           <div class="card-body p-2">
                              <div class="row m-0">
                                  <div class="col-2 p-0">
                                    <div class="d-flex puser">
                                      <a href="{{ asset('user/'.$row->User->username) }}" >
                                      @if($row->User->avatar == '')
                                      {!! _charColor($row->User->username) !!}
                                      @else
                                      <img src="{{ asset('storage/avatar/'.$row->User->avatar) }}" >
                                      @endif
                                    
                                     </a>
                                    </div>
                                   </div>  
                                   <div class="col-10 pl-0">
                                    <div class="d-flex">
                                        <a href="{{ asset('p/'.$row->iunique) }}" >
                                           <div class="card-text pm-text">
                                            {{ $row->title }}</div>
                                         </a>   
                                           <span class="text-muted">
                                              <a href="{{ asset('user/'.$row->User->username) }}" >
                                             {{ $row->User->username }}
                                           </a>
                                           </span>
                                    </div>
                                   </div>   
                              </div>
                           </div>
                        @endif  
                        
                          <?php

                         $img_with_path =  asset('storage/posts/images/'.$row->image);
                         $base64_encode_str =  _loadImg($img_with_path);

                          echo "<img class='card-img-bottom b-lazy' src='data:image/png;base64,".$base64_encode_str. "' data-src=".$img_with_path." />";
                          ?>

                           @if(_chkMobOrDesk() == 'D') 
                           <div class="card-body p-3">
                              <p class="card-text">{{ $row->title }}</p>

                           </div>
                           @endif 


                           <div class="card-footer post-foot text-center">
                              <div class="row">
                                 <div class="col-4">
                                    <div class="d-flex">

                                       @if(isset(Auth::guard('web')->user()->id)) 

                                        <a  href="javascript:;" class="align-self-center {{  (_chkVoted($row->id,'up') == 'Y')?'text-success':'text-white' }} updp_cbox" data-val="up" data-id="{{ $row->id }}" data-toggle="tooltip" title="Upvotes">
                                        <i class="ti-arrow-up"></i>
                                        <span id="up_c_{{ $row->id }}">{{ $row->n_like }}</span>
                                      </a>  

                                       @else
                                       <a  href="javascript:;" class="align-self-center" data-toggle="modal" data-target="#AllSignInUp" >
                                        <i class="ti-arrow-up"></i>{{ $row->n_like }}
                                      </a>  
                                       @endif

                                       

                                     
                                    </div>
                                 </div>
                                 <div class="col-4">
                                    <div class="d-flex align-items-start">
                                      
                                       @if(isset(Auth::guard('web')->user()->id)) 

                                        <a  href="javascript:;" class="align-self-center {{  (_chkVoted($row->id,'down') == 'Y')?'text-success':'text-white' }} updp_cbox" data-val="down" data-id="{{ $row->id }}" data-toggle="tooltip" title="Downvotes">
                                        <i class="ti-arrow-up"></i>
                                        <span id="down_c_{{ $row->id }}">{{ $row->n_dlike }}</span>
                                      </a>  

                                       @else
                                       <a  href="javascript:;" class="align-self-center" data-toggle="modal" data-target="#AllSignInUp" >
                                        <i class="ti-arrow-up"></i>{{ $row->n_dlike }}
                                      </a>  
                                       @endif

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


<script type="text/javascript" src="https://dinbror.dk/blazy/blazy.js"></script>
<script src="{{ asset('web/js/zscroller.js') }}"></script>
<script type="text/javascript">
   var bLazy = new Blazy({});
</script>


@endsection
