@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Current Month Post</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li  class="active"><a href="{{ asset('admin/posts') }}"> Posts</a></li>
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

<div class="row">
   <div class="col-md-12">
      <div class="panel">
         <div class="panel-heading">
            <div class="row">
               <div class="col-sm-6">
                  Current Month Posts
               </div>
               <div class="col-sm-6 text-right">
                 
               </div>
            </div>
         </div>
         <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-hover " id="table2">
               <thead>
                  <tr>
                    
                     <th>IMAGE</th>
                    <th>TITLE</th>
                      <th>TAGS</th>
                    
                     <th>STATUS</th>
                     <th>ADDED</th>
                    
                     <th >MANAGE</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($posts as $key => $row)
                  <tr>
                     <td>
<a href="{{ asset('storage/posts/images/'.$row->image) }}" data-toggle="lightbox" data-gallery="multiimages" data-title="{{ $row->title }}" data-footer="{{ $row->description }}">
  <img src="{{ asset('storage/posts/images/'.$row->image) }}"  width="90" style="height: 90px;" alt="gallery" class="all studio" /> 
</a>


                    </td>
                    
                     <td>
                        <a href="#" class="btn  btn-primary btn-sm">{{ _pfix($row->id) }}</a>
                        <a href="{{ asset('admin/users/'. $row->User->id) }}" class="btn btn-outline btn-warning btn-sm">By:  {{ $row->User->username }} </a>
                         <br><br>
                       <span class="text-muted"> {{ $row->title }} </span>
                     </td>
                     <td>
                        @foreach($row->PostTag as $key => $tag)
                     <span  class="label label-warning">#{{$tag->name }}</span>
                     @endforeach
                     </td>
                   
                     <td> 
                      
                 <div class="input-group">
            <div  class="btn-group is_rejected">
              <a class="btn btn-success  {{ ($row->is_active == 1)?'active disabled':'notActive' }}" data-id="{{ $row->id }}" data-toggle="is_rejected_{{ $row->id }}" data-title="1" >Approved</a>

              <a class="btn btn-danger  {{ ($row->is_active == 0)?'active disabled':'notActive' }}" data-id="{{ $row->id }}" data-toggle="is_rejected_{{ $row->id }}" data-title="0">Reject</a>
            </div>
            <input type="hidden" name="is_rejected" id="is_rejected_{{ $row->id }}">
          </div>

          @if($row->is_rejected == 1 &&  $row->is_active == 0)
            <span class="text-danger p-t-10">Rejected Reason: {{ $row->rejected_reason }}</span>
          @endif

                   
                    </td>
                    <td>
                      {{ date('d M Y',strtotime($row->created_at)) }}
                      <br>
                      <span class="text-muted">{{ date('h:i A',strtotime($row->created_at)) }}</span>
                    </td>
                    
                     <td>

                       
                         <form action="{{ route('admin.posts.destroy',$row->id) }}" method="POST"  class="form-horizontal">
                    
                  
                   
                  <a  href="{{ route('admin.posts.show',$row->id) }}" class="btn btn-primary btn-outline btn-circle btn-lg" data-toggle="tooltip" data-original-title="View Post  - {{ _pfix($row->id) }}"><i class="fa fa-eye"></i></a>

                  <!--   <a  href="{{ route('admin.posts.edit',$row->id) }}" class="btn btn-info btn-lg btn-outline btn-circle" data-toggle="tooltip" data-original-title="Edit Post - {{ _pfix($row->id) }} "><i class="fa fa-pencil"></i></a> -->

                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger btn-outline btn-circle btn-lg" data-toggle="tooltip" data-original-title="Remove Post" ><i class="fa fa-trash"></i></button>
                  </form>
                     </td>
                  </tr>
                @endforeach  
               </tbody>
            </table>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="view_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog " id="modal-data-application">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
        </div>
        <div class="modal-body">
            Loading...
        </div>
       
    </div>
</div>
</div>



<script src="{{ asset('plugins/switchery/dist/switchery.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/switchery/dist/switchery.min.css') }}">


<style type="text/css">
  .is_rejected .notActive{
    color: #3276b1;
    background-color: #fff;
}

.table > tbody > tr > td {
     vertical-align: middle;
}

</style>

<script type="text/javascript">

$('.is_rejected a').on('click', function(){
    var dataId = $(this).data('id');
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
  

    if(sel === 1){
    
        $('#'+tog).prop('value', sel);
        $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        
       $.ajax({
            url: APP_URL + "/admin/savePostApproved",
            data:{
              '_token':FTOKEN,
              id_post:dataId
            },
            type: "POST",
            dataType: "json",
            success: function(r) {
                $("#loaderbox").remove();
                if(r.status == 'S'){
                 tostMsg('success',r.msg); 
                }   
                 
            },
            error: function(a) {
                 $("#loaderbox").remove();
                var b = a.responseJSON;
                console.log(b);
                $("#errmessage").html('<div class="alert alert-danger p-10">' + b.message + "</div>");
            }
        });

    }else{
        
    var url = APP_URL + '/admin/post_reject_form/' + dataId;
   
      $('#modelHeading').html('REJECT POST');
      $.ajaxModal('#view_modal',url);        
    }

   
})


$.ajaxModal = function(selector, url, onLoad) {
    console.log(url);
   
    $(selector).removeData('modal').modal({
        remote: url,
        show: true
    });
  
    // Trigger to do stuff with form loaded in modal
    $(document).trigger("ajaxPageLoad");

    // Call onload method if it was passed in function call
    if (typeof onLoad != "undefined") {
        onLoad();
    }
    
   $(selector).on('hidden.bs.modal', function () {
        $(this).find('.modal-body').html('Loading...');
        $(this).find('.modal-footer').html('<button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>');
        $(this).data('bs.modal', null);
    });
    
};




jQuery(document).on("submit", "#postRejectForm", function(e) {
  e.preventDefault();
    var rejected_reason = $("#rejected_reason").val();

  var id_post = this.id_post.value;

    if(rejected_reason == ''){
      $("#rejected_reason").after('<span class="text-danger">Please enter rejection reason</span>');
      return false;
    }

    jQuery.ajax({
          type: "POST",
          url: APP_URL + '/admin/savePostRejection',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          dataType: "json",
          success: function(r) {
            
            if(r.status == 'S'){
                 tostMsg('success',r.msg); 
                 var  tog =  'is_rejected_'+id_post;

                $('#is_rejected_'+id_post).prop('value', 0);
                $('a[data-toggle="'+tog+'"]').not('[data-title="0"]').removeClass('active').addClass('notActive');
                $('a[data-toggle="'+tog+'"][data-title="0"]').removeClass('notActive').addClass('active disabled');
                


            }  

          },
          error: function(a) {
             var b = a.responseJSON;
              alert('Something went wrong! Please try again.!');
          }
      });
      return false;
    
});
</script>


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
@endsection
