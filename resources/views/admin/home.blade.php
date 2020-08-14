@extends('layouts.admin')
@section('content')
<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Dashboard</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      
   </div>
</div>


<div class="row">

     <div class="col-lg-3 col-sm-3 col-xs-12">
             <a href="{{ asset('admin/posts') }}">
            <div class="white-box  bg-blue">
                <h3 class="box-title text-white">TOTAL POSTS</h3>
                <ul class="list-inline text-white two-part">
                    <li><i class="mdi mdi-folder-multiple-image text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $total_post_c }}</span></li>
                </ul>
            </div>
        </a>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
            <a href="{{ asset('admin/posts/today') }}">
            <div class="white-box bg-green">
                <h3 class="box-title text-white">TODAY New POST</h3>
                <ul class="list-inline text-white two-part">
                    <li><i class="mdi mdi-image-area text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $today_post_c }}</span></li>
                </ul>
            </div>
         </a>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
             <a href="{{ asset('admin/posts/this-week') }}">
            <div class="white-box bg-purple">
                <h3 class="box-title text-white">Weekly New Posts</h3>
                <ul class="list-inline  text-white two-part">
                    <li><i class="mdi mdi-image-filter text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $week_post_c }}</span></li>
                </ul>
            </div>
        </a>
        </div>
       
        <div class="col-lg-3 col-sm-3 col-xs-12">
              <a href="{{ asset('admin/posts/this-month') }}">
            <div class="white-box text-white bg-lime">
                <h3 class="box-title text-white">Month New Posts</h3>
                <ul class="list-inline two-part">
                    <li><i class="mdi mdi-folder-multiple"></i></li>
                    <li class="text-right"><span class="counter">{{ $month_post_c }}</span></li>
                </ul>
            </div>
              <a href="{{ asset('admin/posts') }}">
        </div>
    </div>


        <div class="row">
        <div class="col-lg-3 col-sm-3 col-xs-12">
              <a href="{{ asset('admin/posts/pending') }}"> 
            <div class="white-box bg-amber">
                <h3 class="box-title text-white">Action Needed</h3>
                <ul class="list-inline text-white two-part">
                    <li><i class="mdi mdi-image-multiple text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $pending_post_c }}</span></li>
                </ul>
            </div>
        </a>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
             <a href="{{ asset('admin/users') }}"> 
            <div class="white-box bg-teal">
                <h3 class="box-title text-white">Total Users</h3>
                <ul class="list-inline  text-white two-part">
                    <li><i class="mdi mdi-account-card-details text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $tol_users_c  }}</span></li>
                </ul>
            </div>
        </a>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
             <a href="{{ asset('admin/users/banned') }}"> 
            <div class="white-box  bg-danger">
                <h3 class="box-title text-white ">Banned Users</h3>
                <ul class="list-inline text-white two-part">
                    <li><i class="mdi mdi-account-off text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $tol_banned_c }}</span></li>
                </ul>
            </div>
        </a>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
             <a href="{{ asset('admin/tags-list') }}"> 
            <div class="white-box text-white bg-black">
                <h3 class="box-title text-white">Tags List </h3>
                <ul class="list-inline two-part">
                    <li><i class="mdi mdi-tag-multiple text-white"></i></li>
                    <li class="text-right"><span class="counter">117</span></li>
                </ul>
            </div>
        </a>
        </div>
    </div>

<div class="row">
    <div class="col-lg-6 col-sm-6 col-xs-12">


        <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-12">
              <a href="{{ asset('admin/posts/rejected') }}"> 
            <div class="white-box bg-warning">
                <h3 class="box-title text-white">Rejected Posts</h3>
                <ul class="list-inline text-white two-part">
                    <li><i class="mdi mdi-image-broken text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $rejected_post_c }}</span></li>
                </ul>
            </div>
        </a>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-12">
             <a href="{{ asset('admin/posts/approved') }}"> 
            <div class="white-box bg-success">
                <h3 class="box-title text-white">Approved Posts</h3>
                <ul class="list-inline  text-white two-part">
                    <li><i class="mdi mdi-image-area text-white"></i></li>
                    <li class="text-right"><span class="counter">{{ $approved_post_c  }}</span></li>
                </ul>
            </div>
        </a>
        </div>

       </div> 

    </div> 
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">Last 5 Enquiries
                <div class="pull-right">
                    <a href="{{ asset('admin/contact-enquiry') }}">View All </a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <tbody> 
            @foreach ($last_5_enq as $key => $row)
            <tr>
               

                <td>{{ $row->name }}</td>
               <td>{{ $row->email }}</td>
               <td>{{ $row->mobile }}</td>
              
               <td>{{ $row->created_at }}</td>
               
            </tr>
            @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>            
@endsection
