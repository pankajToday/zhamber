@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>


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


{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
  
</div>

<div class="row">
     @foreach ($permission as $key => $row)
   <div class="col-sm-6 col-md-6 col-xs-12">
    
    <div class="panel panel-default">
      <div class="panel-heading">{{ $row['mname'] }}</div>
      <div class="panel-body">

        
            @foreach ($row['mlist'] as $list)
      <div class="checkbox checkbox-inline" style="margin-bottom: 10px;">
                   <input type="checkbox" id="{{ $list->id }}" name="sdf">
                   <label for="{{ $list->id }}"> {{ $list->name }} </label>
                </div>
 @endforeach 


             
                
               
      </div>
    </div>

   </div>
  @endforeach


</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    </div> 
</div>

{!! Form::close() !!}


@endsection