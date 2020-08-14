@extends('layouts.admin')
@section('content')
<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Contact Enquiries</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      
   </div>
</div>


<div class="white-box">


<div class="row">
   <div class="col-md-12">
      <div class="table-responsive">
         <table class="table table-hover" id="table2">
          <thead>
            <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Mobile</th>
               <th>Message</th>
               <th>Reg. Date</th>
             
            </tr>
           </thead>
           <tbody> 
            @foreach ($enquiries as $key => $row)
            <tr>
               

                <td>{{ $row->name }}</td>
               <td>{{ $row->email }}</td>
               <td>{{ $row->mobile }}</td>
               <td>{{ $row->message }}</td>
               <td>{{ $row->created_at }}</td>
               
            </tr>
            @endforeach
          </tbody>   
         </table>
        
      </div>
   </div>
</div>

</div>


<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
$('#table2').DataTable({ 
  "pageLength": 20,
   "order": []
});
</script>      
@endsection
