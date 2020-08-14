<div class="post-item" data-postid="{{ $row->id }}" data-csrf="{!! csrf_token() !!}">
   <div class="card text-white bg-dark post " style="border-bottom: solid 1px #A9A9A9; padding:0px 0px 5px 0px;" >
      @if(_chkMobOrDesk() == 'M') 
      <div class="card-body  p-2">
         <div class="row m-0">
            <div class="col-2 p-0">
               <div class="d-flex puser text-center">
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
                        {{ $row->title }}
                     </div>
                  </a>
                  <span class="text-muted pm-username">
                  <a href="{{ asset('user/'.$row->User->username) }}" >
                  {{ $row->User->username }}
                  </a>
                  </span>
               </div>
            </div>
         </div>
      </div>
      @endif 
      <a href="{{ asset('p/'.$row->iunique) }}" >
      <img class="card-img-bottom "  src="{{ asset('storage/posts/images/'.$row->image) }}" alt="{!! $row->title !!}"> 
      </a>
      @if(_chkMobOrDesk() == 'D') 
      <div class="card-body p-2">
         <a href="{{ asset('p/'.$row->iunique) }}" >
            <p class="card-text">{{ $row->title }}</p>
         </a>
      </div>
      @endif 
      <div class="card-footer post-foot text-center">
         <div class="row">
            <div class="col-4 pl-2 pr-2">
               <div class="d-flex">
                  @if(isset(Auth::guard('web')->user()->id)) 
                  <a  href="javascript:;" class="align-self-center {{  (_chkVoted($row->id,'up') == 'Y')?'text-success':'text-white' }}  updp_cbox" data-val="up" data-id="{{ $row->id }}" data-toggle="tooltip" title="Upvotes">
                  
                  @if(isset($row->v_type) && $row->v_type == 'up')   
                  <span id="up_c_{{ $row->id }}" class="text-success">
                  @else
                  <span id="up_c_{{ $row->id }}" >
                  @endif   

                     <i class="ti-arrow-up"></i>
                     {{ $row->n_like }}</span>
                  </a>  
                  @else
                  <a  href="javascript:;" class="align-self-center lbox" data-toggle="modal" data-target="#AllSignInUp" >
                  <i class="ti-arrow-up"></i>{{ $row->n_like }}
                  </a>  
                  @endif
               </div>
            </div>
            <div class="col-4 pl-2 pr-2">
               <div class="d-flex align-items-start">
                  @if(isset(Auth::guard('web')->user()->id)) 
                  <a  href="javascript:;" class="align-self-center {{  (_chkVoted($row->id,'down') == 'Y')?'text-success':'text-white' }} updp_cbox" data-val="down" data-id="{{ $row->id }}" data-toggle="tooltip" title="Downvotes">
                 
                 @if(isset($row->v_type) && $row->v_type == 'down')   
                    <span id="down_c_{{ $row->id }}" class="text-danger">
                  @else
                   <span id="down_c_{{ $row->id }}" >
                  @endif 
                
                      <i class="ti-arrow-down"></i>
                      {{ $row->n_dlike }}
                   </span>
                  </a>  
                  @else
                  <a  href="javascript:;" class="align-self-center lbox" data-toggle="modal" data-target="#AllSignInUp" >
                    <i class="ti-arrow-down"></i>{{ $row->n_dlike }}
                  </a>  
                  @endif
               </div>
            </div>
            <div class="col-4 pl-2 pr-2">
               <div class="d-flex lbox">
                  <a href="{{ asset('p/'.$row->iunique) }}">
                  <div class="align-self-center"><i class="ti-eye"></i>{{ $row->n_views }}</div>
               </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
