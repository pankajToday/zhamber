@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Manage Meta Detail</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li  class="active"><a href="{{ asset('admin/meta') }}"> Meta Detail</a></li>
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

  
<div class="row">
    <div class="col-sm-6">
      
          
       
    </div>
    <div class="col-sm-6 text-right">
 
           <a href="{{ route('admin.meta.create') }}" class="btn  btn-info btn-sm" data-toggle="tooltip" data-original-title="Add New Page Meta"><i class="fa fa-plus" aria-hidden="true"></i> Add   Page Meta </a>

    </div>
</div>
<Br>


<div class="row">
   <div class="col-md-12">
      <div class="table-responsive">
         <table class="table table-bordered">
          <thead>
            <tr>
                
                <th class="col-md-2">Page URL</th>
                  <th>Meta Title </th>
                <th >Action</th>
            </tr>
           </thead>
           <tbody> 
            @foreach ($facilities as $key => $row)
            <tr>
              
              <td>{{ $row->page_url }}</td>
               <td>{{ $row->meta_title }}</td>
              <td>
                  <form action="{{ route('admin.meta.destroy',$row->id) }}" method="POST"  class="form-horizontal">
                    
                    <a  href="{{ route('admin.meta.edit',$row->id) }}" class="btn btn-info btn-outline btn-circle btn-sm" data-toggle="tooltip" data-original-title="Edit meta row"><i class="fa fa-pencil"></i></a>

                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger btn-outline btn-circle btn-sm" data-toggle="tooltip" data-original-title="Remove meta row" ><i class="fa fa-trash"></i></button>
                  </form>
                  
               </td>
            </tr>
            @endforeach
          <tbody>   
         </table>
        
      </div>
   </div>
</div>

</div>


<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>


<script type="text/javascript">
$('#table2').DataTable({ 
    "order": [[0, "desc"]],
});
</script>
@endsection
