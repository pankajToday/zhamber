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
    <div class="col-xs-12 col-sm-12 col-md-12">
    </div>
</div>

  
<div class="row">

<div class="col-xs-12 col-sm-12 col-md-12 text-left">
  <div class="checkbox checkbox-info">
      <input type="checkbox" id="checkAll"  >
      <label for="checkAll">Check All</label>
  </div>
  
<hr>
</div>


   
    @foreach($permission as $value)
   <div class="col-xs-12 col-sm-4 col-md-3 text-left">
<div class="checkbox checkbox-info">
  <input type="checkbox" name="permission[]" id="{{ $value->name }}" value="{{ $value->id }}" >
  <label for="{{ $value->name }}">{{ str_replace('-',' ',$value->name) }} </label>
</div>

       </div>
   @endforeach
   
</div>

  
<div class="row">
  <br>
  <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div> 
   
</div>

</div>



</form>

<script type="text/javascript">

$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

@endsection

