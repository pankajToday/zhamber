@extends('layouts.admin')
@section('content')

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Roles</h4> 
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="active">Roles </li>
    </ol>
  </div>
</div>

<div class="white-box">
  


<div class="row">
    <div class="col-sm-6">
        @can('role-create')    
        <div class="form-group">
          <a href="{{ route('admin.roles.create') }}" class="btn btn-outline btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add New Role </a>
        </div>
        @endcan
    </div>
    <div class="col-sm-6 text-right">
      
    </div>
</div>




<div class="row">
  <div class="col-sm-12">


    <table class="table table-bordered"  id="table2">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>

<td>

<form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST"> 



@can('role-edit')
<a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
@endcan

 @can('role-delete')
  @csrf
   @if($role->id != 2) 
  @method('DELETE')
 <button type="submit"  class="btn btn-danger btn-circle" data-toggle="tooltip" data-original-title="Remove Role Form System">
  <i class="fa fa-trash"></i>
 </button>
 @endif
@endcan



</form>
</td>

        
    </tr>
    @endforeach
</table>


  </div>
</div>

</div>

{!! $roles->render() !!}



@endsection