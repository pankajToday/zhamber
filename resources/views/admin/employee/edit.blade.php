@extends('layouts.admin')
@section('content')


<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">System Employee</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li  class="active"><a href="{{ asset('admin/employee') }}">Employee</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->

@if ($errors->any())
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
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
   <div class="panel-body">

    <form action="{{ route('admin.employee.update',$admin->id) }}" method="POST">
    @csrf
    @method('PUT')

         <div class="form-group">
            <label class="control-label required" for="name">First Name</label>
            <input class="form-control" type="text"  name="name" id="name" value="{{ $admin->name }}"  autocomplete="Off" tabindex="2" minlength="2"  >
         </div>
         <div class="form-group">
            <label class="control-label required" for="first_name">E-mail</label>
            <input class="form-control" type="text"  name="email" id="email" value="{{ $admin->email }}"  autocomplete="Off" tabindex="4" maxlength="32" >
         </div>
         <div class="form-group">
            <label class=" control-label required" for="mobile" >Mobile No</label>
            <input class="form-control" type="number"  name="mobile" id="mobile" value="{{ $admin->mobile }}"  autocomplete="Off" tabindex="5" maxlength="10" >
            <span id="errmsg1"></span>
         </div>
         <div class="form-group">
            <label class="control-label required" for="pswd">Password</label>
            <input class="form-control" type="password" name="password" id="password" value="" tabindex="6" autocomplete="Off" size="24" maxlength="20"  >
         </div>
         <div class="form-group">
            <label class="control-label required" for="cpswd"  >Confirm Password</label>
            <input class="form-control" name="confirm-password" id="confirm-password" value="" type="password" tabindex="7" autocomplete="Off" size="24" maxlength="20" >
         </div>
         <div class="form-group">
            <label class="control-label required" for="cpswd"  >Confirm Password</label>
            <select name="roles[]" class="form-control multiple">
               @foreach($roles as $r)
               <option value="{{ $r }}">{{ $r }}</option>
               @endforeach
            </select>
         </div>
         <div class="form-group m-t-20">
         <button class="btn  btn-primary" type="submit">Update Employee Detail</button>
         
           </div> 
      </form>
   </div>
</div>
    </div>
 </div>
</div>

        
@endsection
