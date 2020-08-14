@extends('layouts.admin')
@section('content')
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Profile - {{ $user->name }}</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
     
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
             <li><a href="{{ asset('admin/users') }}">Users</a></li>
            <li class="active">{{ $user->name }} </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- .row -->
<div class="row">
    <div class="col-md-4 col-xs-12">
       @include('admin.users._aside')
      
    </div>
    <div class="col-md-8 col-xs-12">
      
        <div class="row">
           <div class="col-md-12 col-lg-12 col-sm-12">
              


              


             <div class="panel panel-default">
              <div class="panel-heading">{{ strtoupper($user->name) }} BOOKINGS</div>
              <div class="panel-body">
                <table class="table table-bordered " id="table2">
          <thead>
            <tr>
              <th>Book #</th>
              <th>Current Staus</th>
            
              <th>Service Center</th>
              <th>Tol. Booking Amt.</th>
              <th>Booking Date.</th>
             
            </tr>
           </thead>
           <tbody> 
             @foreach($user->Booking as $row)
            <tr>
             <td>
            <a href="{{ asset('admin/booking/show/'.$row->book_ref_id) }}" data-toggle="tooltip" data-original-title="View Booking Detail">
              <span class="label label-success label-rounded">{{ $row->book_ref_id }}</span>
            </a>
             <p class="p-t-10 text-info">
            @if($row->b_pk_type == 'S')
              SCHEDULED 
              @else
              INSTANT BOOKING
              @endif
           </p>
         
             </td>
              <td> {{ $row->BStatus->st_name }}</td>
           
             <td>{{ $row->SCenter->name }}</td>
             <td>{{ $row->b_grand_amt }} <br>
            
            <small>
              Rs. {{ $row->BookingDetail->sum('s_price') }} ({{ $row->BookingDetail->count() }} Service ) 
              + {{ $row->b_delivery_charge_amt }} 
              @if($row->b_pk_inst_charge_amt != '')
              +  {{ $row->b_pk_inst_charge_amt }} (Inst. Charge) 
              @endif

            </small>

             </td>
             <td>{{ $row->created_at }}</td>
            
               
            </tr>
            @endforeach
          <tbody>   
         </table>

               
                 
                 
              </div>
              </div>

             
             
           </div>
        </div>



    </div>
</div>
<!-- /.row -->

<script type="text/javascript">

</script>
@endsection