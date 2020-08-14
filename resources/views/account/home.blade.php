@extends('layouts.app')
@section('content')

@include('account/_profile_box')



<section style="padding-bottom: 100px;">
   <div class="gap gray-bg pt-1">
      <div class="container">
         @if(collect($posts)->isNotEmpty())
         <div class="row" >
            <div class="col-lg-12">
               <div class="grid are-images-unloaded" id="grid" data-uri="{{ $page_url }}">
                  <div class="grid__col-sizer"></div>
                  <div class="grid__gutter-sizer"></div>
                  @foreach($posts as $key => $row)
                  <div class="post-item bt4-{{ _pstStatusColor($row->id) }}" data-postid="{{ $row->id }}" data-csrf="{!! csrf_token() !!}">
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
        
         <div class="row">
            <div class="col-md-12">
               <div class="central-meta bg-dark">
                  @if($is_chk_post == 'P')
                  <div class="personal">
                     <h5 class="f-title"><i class="ti-info-alt text-info"></i> PENDING POSTS </h5>
                     <h6> No pending post avaliable.!!</h6>
                     
                  </div>
                  @endif

                  @if($is_chk_post == 'R')
                  <div class="personal">
                     <h5 class="f-title"><i class="ti-info-alt text-info"></i> REJECTED POSTS </h5>
                     <h6>
                       No rejected post avaliable.!!
                     </h6>
                  </div>
                  @endif

                  @if($is_chk_post == 'A')
                  <div class="personal">
                     <h5 class="f-title"><i class="ti-info-alt text-info"></i> APPROVED POSTS </h5>
                     <h6>
                       No approved post avaliable.!!
                     </h6>
                  </div>
                  @endif

                  @if($is_chk_post == 'ALL')
                  <div class="personal">
                     <h5 class="f-title"><i class="ti-info-alt text-info"></i>  POSTS </h5>
                     <h6>
                       No post avaliable. Please <a href="{{ asset('post/new') }}">check here </a> to create new post.
                     </h6>
                  </div>
                  @endif


               </div>      
            </div>
         </div>   


         @endif
      </div>
   </div>
</section>

 @if(collect($posts)->isNotEmpty())
<script async src="{{ asset('web/js/jquery.visible.min.js') }}"></script>
<script src="{{ asset('web/js/infinite-scroll.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('web/js/zscroller.js') }}"></script>
@endif


<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
        $("#bntUpImg").show();
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

jQuery(document).on("submit", "#upAvatarImgForm", function(e) {
    e.preventDefault(); 
    $.ajax({
            url: APP_URL + "/upAvatarImg",
            data: new FormData(this),
            type: "POST",
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function(r) {
                $("#loaderbox").remove();
                 $("#bntUpImg").hide();
            },
            error: function(a) {
               $("#loaderbox").remove();
                console.log("errors", a);
               
            }
        });
});
</script>

@endsection