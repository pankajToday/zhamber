@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">System Employee</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li  class="active"><a href="{{ asset('') }}">System Employee</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->

@if ($message = Session::get('success'))
<div class="alert alert-success">
  {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif




<div class="white-box">

 @can('systemuser-create')    
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <a href="{{ route('admin.employee.create') }}" class="btn btn-outline btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add New Employee </a>
        </div>
    </div>
    <div class="col-sm-6 text-right">
        <div class="form-group"> </div>
    </div>
</div>
@endcan

<div class="row">
   <div class="col-md-12">
      <div class="table-responsive">
         <table class="table"  id="table2">
          <thead>
            <tr>
               <th>No</th>
               <th>Name</th>
               <th>Email</th>
               <th>Roles</th>
               <th width="280px">Action</th>
            </tr>
           </thead>
           <tbody> 
            @foreach ($data as $key => $employee)
            <tr>
               <td>{{ ++$i }}</td>
               <td>{{ $employee->name }}</td>
               <td>{{ $employee->email }}</td>
               <td>
                  @if(!empty($employee->getRoleNames()))
                  @foreach($employee->getRoleNames() as $v)
                  <label class="badge badge-success">{{ $v }}</label>
                  @endforeach
                  @endif
               </td>
               <td>
                  <form action="{{ route('admin.employee.destroy',$employee->id) }}" method="POST"  class="form-horizontal">
                     <a  href="{{ route('admin.employee.edit',$employee->id) }}" class="btn btn-info btn-outline btn-circle btn-sm" data-toggle="tooltip" data-original-title="Edit User Detail"><i class="fa fa-pencil"></i></a>
                     
                     @can('employee-edit')
                     <a  href="{{ route('admin.employee.edit',$employee->id) }}" class="btn btn-info btn-outline btn-circle btn-sm" data-toggle="tooltip" data-original-title="Edit User Detail"><i class="fa fa-pencil"></i></a>
                     @endcan       
                     @can('employee-delete')
                     @csrf
                     @method('DELETE')
                     <button type="button" class="btn btn-danger btn-outline btn-circle btn-sm" data-toggle="tooltip" data-original-title="Remove row" ><i class="fa fa-trash"></i></button>
                  </form>
                  @endcan   
               </td>
            </tr>
            @endforeach
          <tbody>   
         </table>
         {!! $data->render() !!}
      </div>
   </div>
</div>

</div>






@endsection