<div class="central-meta no-radius  pb-5 mb-0 bg-1e2833" >
     <div class="user-post">
        <h5 class="mb-4" style="font-size: 20px;">{{ $post->title }}</h5>
      </div>
</div>        
<div class="central-meta no-radius  pb-5 mb-0">
     <div class="user-post">
      
        <div class="row" s>
           <div class="col-7 col-lg-7">
              <div class="friend-info">
                 <figure>
                  @if(!empty($post->avatar))
                    <img src="{{ asset('storage/avatar/'.$post->avatar) }}" alt="">
                  @else
                    <img src="{{ asset('img/av_73x73.jpg') }}" alt="">
                  @endif  
                 </figure>
                 <div class="friend-name">
                    <ins><a href="{{ asset('user/'.$post->username) }}" title="">{{ $post->username  }}</a></ins>
                    <span>

                      <span class="d-none d-sm-none"> published: </span> {{ date('M, d Y',strtotime($post->created_at) )}}
                      <span>{{ date('H:i A ',strtotime($post->created_at) )}}</span>

                   </span>
                 </div>
              </div>
           </div>
           <div class="col-5 col-lg-5 text-right">
              <div class="btn-group" role="group" aria-label="Basic example">
                 @if (!empty($prevURL))
                 <a href="{{ $prevURL }}"  class="btn btn-sm btn-outline-light"><i class="ti-angle-left"></i> Prev</a>
                
                 @endif
                @if(!empty($nextURL))
                 <a href="{{ $nextURL }}"  class="btn btn-sm btn-deep-orange ">Next  <i class="ti-angle-right"></i></a>
                 @endif
              </div>
           </div>
        </div>
      </div>

  </div>

    @if(_chkMobOrDesk() == 'D')  
  <div class="central-meta no-radius item p-0 mb-0 d-none d-sm-block">
    @include('posts._post_desk_vote') 
  </div>
  @endif
  <div class="central-meta no-radius mt-0 pt-0 pb-0 mb-0 item">
     <div class="user-post">
         <img src="{{ asset('storage/posts/images/'.$post->image) }}" alt="">

         <div class="description">
                {!! _str2HashtagStrLink($post->description) !!}
         </div>

      </div>
  </div>
   @if(_chkMobOrDesk() == 'M')  
  <div class="central-meta no-radius item mt-0 p-0 mb-0">
    
               @include('posts._post_mob_vote') 
     
  </div>
   @endif
   <div class="central-meta no-radius mt-0 pt-0 pb-0 mb-0 item">
     <div class="user-post">
         <div class="description">
                        @foreach($post->PostTag as $key => $tag)
                           <a href="{{ asset('tag/'.$tag->name) }}" class="btn {{ _btnRandom() }}  mb-10">
                              {{ $tag->name }}
                           </a>   
                        @endforeach
                     </div>
      </div>
  </div>


<style type="text/css">
  .bg-1e2833{
    background: #1e2833;
  }
</style>