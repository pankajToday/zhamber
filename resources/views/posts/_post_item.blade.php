

<div class="card text-white bg-dark">
  <div class="card-header bg-dark" style="padding: 0.8rem 1.25rem 0.3rem 1.25rem">
    <h4>{{ $post->title }}</h4>
  </div>
  <div class="card-body" style="padding: 0.3rem 1.25rem 0.8rem 1.25rem">
    <div class="row">
      <div class="col-7">
        
       <div class="user-details">
            <!-- Logo -->
            <div class="user-logo d-none d-sm-block">
             @if(!empty($post->avatar))
                    <img src="{{ asset('storage/avatar/'.$post->avatar) }}" width="50" alt="">
                  @else
                    <img src="{{ asset('img/av_73x73.jpg') }}" alt="">
                  @endif 
            </div>

            <!-- Details -->
            <div class="user-info">
              <h4 class="user-title">
                By <a href="{{ asset('user/'.$post->username) }}" class="text-info">{{ $post->username  }}</a></h4>
               <h6 class="user-datetime">{{ date('M, d Y',strtotime($post->created_at) )}}
                      <span>{{ date('H:i A ',strtotime($post->created_at) )}}</span> </h6>
            </div>
          </div>


      </div>
      <div class="col-5 text-right">
       <div class="btn-group" role="group" aria-label="Basic example">
                 @if(!empty($prevURL))
                 <a href="{{ $prevURL }}"  class="btn btn-sm btn-outline-light"><i class="ti-angle-left"></i> Prev</a>
                
                 @endif
                @if(!empty($nextURL))
                 <a href="{{ $nextURL }}"  class="btn btn-sm btn-deep-orange ">Next  <i class="ti-angle-right"></i></a>
                 @endif
              </div>
      </div>
    </div>  
  </div>
  <!-- /body -->
@if(_chkMobOrDesk() == 'D') 
<div class="card-body">
@include('posts._post_desk_vote') 
</div>
@endif 
<img class="card-img-bottom" src="{{ asset('storage/posts/images/'.$post->image) }}" alt="">
@if(_chkMobOrDesk() == 'M') 
<div class="card-body">
@include('posts._post_mob_vote') 
</div>
@endif 
<div class="card-body">

   @foreach($post->PostTag as $key => $tag)
                           <a href="{{ asset('tag/'.$tag->name) }}" class="btn btn-sm {{ _btnRandom() }}  mb-10">
                              {{ $tag->name }}
                           </a>   
                        @endforeach

</div>

</div>
<!-- card -->



<style type="text/css">
  .user-details {
    flex-grow: 1;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
   /* padding: 30px;*/
    /*padding-right: 40px;*/
}

 .user-logo {
    max-width: 56px;
    margin-right: 14px;
    top: 1px;
    flex: 0 0 56px;
    
}

 .user-logo img {
    border-radius: 4px;
    transform: translate3d(0,0,0);
    height: 55px;
    width: 60px;
}

.user-info {
    flex: 1;
    padding-top: 3px;
}

.user-datetime {
    font-size: 12px;
    color: gray;
}

.user-title {
    font-size: 17px;
    line-height: 18px;
    color: #fff;
}
</style>