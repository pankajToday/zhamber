<div class="white-box">
        <div class="user-bg"> 
            <div class="overlay-box">
                <div class="user-content">
                    <a href="javascript:void(0)">
                      @if($user->avatar != '')
                      <img src="{{ asset('storage/avatar/'.$user->avatar)  }}" class="thumb-lg img-circle" alt="img">
                      @else
                      <img src="{{ asset('img/avatar-sm.png') }}" class="thumb-lg img-circle" alt="img">
                      @endif
                    </a>
                    <h4 class="text-white">{{ $user->username }}</h4>
                    <h5 class="text-white">{{ $user->email }}</h5> </div>
            </div>
        </div>
       <div class="user-btm-box">
            <div class="col-md-6 col-sm-6 text-center b-r">
                <p class="text-purple">No. of Posts</p>
                <h3>{{ $user->Post->count() }}</h3> 
            </div>
            <div class="col-md-6 col-sm-6 text-center ">
                <p class="text-blue">No of Votes</p>
                <h3>{{ $user->Vote->count() }}</h3> 
              </div>
            
        </div>
    </div>
