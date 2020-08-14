 @extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Banned Customers</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
           @if(collect($data)->isNotEmpty())
                 
                    <!--  <a href="{{ asset('admin/export-customer-report') }}" class="btn btn-outline btn-info btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Export Excel </a>  -->
                 
               @endif
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
   <div class="col-md-12">
      <div class="table-responsive">
         <table class="table table-hover" id="table2">
          <thead>
            <tr>
               <th>Photo</th>
               <th>Username</th>
               <th>Email</th>
               <th>Mobile</th>
               <th>Address</th>
               
               <th>Reg. Date</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
           </thead>
           <tbody> 
            @foreach ($data as $key => $user)
            <tr>
               <td>


                @if($user->avatar != '')
               <a href="{{ asset('storage/avatar/'.$user->avatar) }}" data-toggle="lightbox" data-gallery="multiimages" data-title="{{ $user->username }}">
  <img src="{{ asset('storage/avatar/'.$user->avatar) }}"  width="60" style="height:60px;" alt="gallery" class="all studio" /> 
</a>

                @else
                <img src="{{ asset('img/av_63x63.jpeg') }}" width="60">
                @endif
               </td> 
               <td>
                 <a href="{{ asset('admin/users/'. $user->id) }}" class="btn btn-outline btn-warning btn-sm">
                  {{ $user->username }}
                </a>
                <br><br>
                 <a href="{{ asset('admin/users/posts/'. $user->id) }}" >
                  <span  class="label label-info">
                  {{ $user->Post->count() }} Posts
                </span>
                </a> 
                
                <a href="{{ asset('admin/users/'. $user->id) }}"  style="margin-left: 10px; ">
                  <span  class="label label-success">
                  {{ $user->Vote->count() }} Votes
                </span>
                </a> 

              </td>
               <td>{{ $user->email }}</td>
               <td>{{ $user->mobile }}</td>
               <td>
                {{ $user->city }}
                {{ $user->id_country }}
               </td>
                
               <td>{{ $user->created_at }}</td>
               <td>
                  @if($user->is_active == 1)
                  <span class="label label-success label-rounded pointer is_active" data-toggle="tooltip" data-original-title="Click To Disable" id="act_{{ $user->id }}" data-id="act_{{ $user->id }}">Active</span>
                  @else
                  <span class="label label-danger label-rounded pointer is_active"  data-toggle="tooltip" data-original-title="Click To Active" id="dis_{{ $user->id }}" data-id="dis_{{ $user->id }}">Disable</span>
                  @endif
               </td>
               <td>
                     
                     @can('user-show')

                       <a  href="{{ asset('admin/users/posts/'.$user->id) }}" class="btn btn-primary btn-outline btn-circle btn-lg" data-toggle="tooltip" data-original-title="View User Posts"><i class="mdi mdi-image-filter"></i></a>

                     <a  href="{{ asset('admin/users/'.$user->id) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" data-original-title="View User Detail"><i class="fa fa-eye"></i></a>

                    

                     @endcan
               </td>
            </tr>
            @endforeach
          </tbody>   
         </table>
        
      </div>
   </div>
</div>

</div>


<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox/ekko-lightbox.min.css') }}">

<script type="text/javascript" src="{{ asset('plugins/fancybox/ekko-lightbox.min.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function($) {
        // delegate calls to data-toggle="lightbox"
        $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
            event.preventDefault();
            return $(this).ekkoLightbox({
                onShown: function() {
                    if (window.console) {
                        return console.log('Checking our the events huh?');
                    }
                },
                onNavigate: function(direction, itemIndex) {
                    if (window.console) {
                        return console.log('Navigating ' + direction + '. Current item: ' + itemIndex);
                    }
                }
            });
        });
        //Programatically call
        $('#open-image').click(function(e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#open-youtube').click(function(e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        // navigateTo
        $(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {
            event.preventDefault();
            var lb;
            return $(this).ekkoLightbox({
                onShown: function() {
                    lb = this;
                    $(lb.modal_content).on('click', '.modal-footer a', function(e) {
                        e.preventDefault();
                        lb.navigateTo(2);
                    });
                }
            });
        });
    });
   


</script>


<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
$('#table2').DataTable({ 
  "pageLength": 20,
   "order": []
});
</script>
<script type="text/javascript">



 jQuery(".is_active").click(function() {
    var a = $(this).attr("id");
    var b = a.split("_");
    var c = b[0];
    var d = b[1];
    if ("act" == c) {
        var e = 0;
        var f = confirm("do you want disable this user?");
    } else {
        var e = 1;
        var f = confirm("do you want active this user?");
    }
    if (false == f) return false;
    $.ajax({
        url: APP_URL + "/admin/users/activeOrDisable",
        data: {
            _token: FTOKEN,
            id_user: d,
            upStatus: e
        },
        type: "post",
        dataType: "json",
        success: function(b) {
            if ("S" == b.status) if (1 == e) {
                tostMsg("success", "User is active now");
                $("#" + a).removeClass("label-danger").addClass("label-success").html("Active");
                $("#" + a).attr("data-id", "act_" + d);
                $("#" + a).attr("id", "act_" + d);
            } else {
                tostMsg("success", "User is disable now");
                $("#" + a).removeClass("label-success").addClass("label-danger").html("Disable");
                $("#" + a).attr("data-id", "dis_" + d);
                $("#" + a).attr("id", "dis_" + d);
            }
        },
        error: function(a) {
            alert("Something went wrong.!");
        }
    });
});

 
</script>

<style type="text/css">
  .is_rejected .notActive{
    color: #3276b1;
    background-color: #fff;
}

.table > tbody > tr > td {
     vertical-align: middle;
}

</style>
@endsection