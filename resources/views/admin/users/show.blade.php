@extends('layouts.admin')
@section('content')
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Profile - {{ $user->name }}</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
     
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">{{ $user->name }} </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- .row -->
<div class="row">
    <div class="col-md-4 col-xs-12">
     @include('admin.users._aside')
      
    </div>
    <div class="col-md-8 col-xs-12">
      
        <div class="row">
           <div class="col-md-12 col-lg-12 col-sm-12">

              <div class="panel panel-default">
                  <div class="panel-heading">User Stat </div>
                  <div class="panel-body b-b">
                      <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong> No of Posts</strong>
                            <hr>
                            <p class="text-muted"> <strong>{{ $user->Post->count() }}  </strong></p>
                        </div>
                        <div class="col-md-3 col-xs-6"> 
                            <strong>No. of Vote</strong>
                            <hr>
                            <p class="text-muted">
                              <strong> {{ $user->Vote->count() }} </strong>
                            </p>
                        </div>
                         <div class="col-md-3 col-xs-6"> <strong>No. of upvote</strong>
                            <hr>
                            <p class="text-muted">
                               <strong><i class="fa fa-arrow-up"></i>
                              {{ $n_like_count }}
                               </strong>
                            </p>  
                            
                        </div>
                         <div class="col-md-3 col-xs-6"> <strong>No. of downvote</strong>
                            <hr>
                            <p class="text-muted">
                              <strong><i class="fa fa-arrow-down"></i> {{ $n_dlike_count }}</strong>
                            </p>
                        </div>
                       
                        
                    </div>
                  </div>
                  
              </div>
              <!-- /panel -->
              
              <div class="panel panel-default">
                  <div class="panel-heading">Personal Detail </div>
                  <div class="panel-body b-b">
                      <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong> Username</strong>
                            <br>
                            <p class="text-muted">{{ $user->username }}</p>
                        </div>
                        <div class="col-md-2 col-xs-6 b-r"> <strong>Mobile</strong>
                            <br>
                            <p class="text-muted">{{ $user->mobile }}</p>
                        </div>
                        <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
                            <br>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                         <div class="col-md-3 col-xs-6"> <strong>Joining Date</strong>
                            <br>
                            <p class="text-muted">{{ date('d M, Y',strtotime($user->created_at)) }}</p>
                        </div>
                    </div>
                  </div>
                   <div class="panel-body">
                      <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Gender</strong>
                            <br>
                            <p class="text-muted">
                               @if($user->gender != '')
                                {{ $user->gender }}
                              @else
                              --
                              @endif
                            </p>
                        </div>

                        <div class="col-md-3 col-xs-6 b-r"> <strong> Name</strong>
                            <br>
                            <p class="text-muted">
                              @if($user->name != '')
                                {{ $user->name }}
                              @else
                              --
                              @endif
                            </p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>City</strong>
                            <br>
                            <p class="text-muted">
                               @if($user->city != '')
                                {{ $user->city }}
                              @else
                              --
                              @endif
                            </p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Country</strong>
                            <br>
                            <p class="text-muted">
                               @if($user->id_country != '')
                                {{ $user->id_country }}
                              @else
                              --
                              @endif
                            </p>
                        </div>
                         
                    </div>
                  </div>
              </div>
              <!-- /panel -->

              <div class="panel panel-default">
                  <div class="panel-heading">About User </div>
                  <div class="panel-body b-b">

                      @if($user->aboutme != '')
                                {{ $user->aboutme }}
                              @else
                             Not updated yet
                              @endif
                  </div>
              </div>    



              


            

             
             
           </div>
        </div>



    </div>
</div>
<!-- /.row -->

<script type="text/javascript">

</script>
@endsection