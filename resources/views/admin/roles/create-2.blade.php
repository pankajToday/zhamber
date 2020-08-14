@extends('layouts.app')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Designation</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li ><a href="{{ route('roles.index') }}">Designation</a></li>
         <li  class="active"><a href="">Edit Role</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="white-box">

<form action="{{ route('roles.store') }}" method="POST">
 @csrf
  
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <input class="form-control" type="text"  name="name" id="name" value="{{ old('name') }}"  autocomplete="Off"   >
        </div>
    </div>
</div>
<div class="row">

  @foreach($md_with_permission as $key => $row)
  <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="panel panel-default">
              <div class="panel-heading">{{ $row['module'] }}
                  <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
              </div>
             
            <div class="panel-body row">

               @foreach($row['permissions'] as $value)
   <div class="col-xs-12 col-sm-4 col-md-3 text-left">
<div class="checkbox checkbox-info">
  <input type="checkbox" name="permission[]" id="{{ $value->name }}" value="{{ $value->id }}" >
  <label for="{{ $value->name }}">{{ $value->text }} </label>
</div>

       </div>
   @endforeach

               
            </div>
      </div>

    
  </div> 
  @endforeach
</div>
<!-- /row -->


</form>
</div>
<!-- /white-bx -->



@endsection

