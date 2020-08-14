@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Posts Dashboard</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li  class="active"><a href="{{ asset('admin/posts') }}"> Posts</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->


<div class="row">
        <div class="col-lg-3 col-sm-3 col-xs-12">
            <div class="white-box bg-green">
                <h3 class="box-title text-white">TODAY New POST</h3>
                <ul class="list-inline text-white two-part">
                    <li><i class="icon-people text-white"></i></li>
                    <li class="text-right"><span class="counter">23</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
            <div class="white-box bg-purple">
                <h3 class="box-title text-white">Weekly New Posts</h3>
                <ul class="list-inline  text-white two-part">
                    <li><i class="icon-folder text-white"></i></li>
                    <li class="text-right"><span class="counter">169</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
            <div class="white-box  bg-blue">
                <h3 class="box-title text-white">TOTAL POSTS</h3>
                <ul class="list-inline text-white two-part">
                    <li><i class="icon-folder-alt text-white"></i></li>
                    <li class="text-right"><span class="counter">311</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
            <div class="white-box text-white bg-black">
                <h3 class="box-title text-white">New Tags</h3>
                <ul class="list-inline two-part">
                    <li><i class="ti-wallet text-white"></i></li>
                    <li class="text-right"><span class="counter">117</span></li>
                </ul>
            </div>
        </div>
    </div>



@endsection


