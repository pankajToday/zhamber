@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Manage Post</h4>
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
                  MANAGE USERS POSTS
               </div>
               <div class="col-sm-6 text-right">
                  <a href="{{ route('admin.posts.create') }}" class="btn  btn-info btn-sm" data-toggle="tooltip" data-original-title="Add New  Facility"><i class="fa fa-plus" aria-hidden="true"></i> Add New  Post </a>
               </div>
            </div>
         </div>
         <div class="panel-body">
            <table class="table table-hover manage-u-table" id="table2">
               <thead>
                  <tr>
                    
                     <th>IMAGE</th>
                    <th>TITLE</th>
                    
                     <th>STATUS</th>
                     <th>ADDED</th>
                    
                     <th >MANAGE</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($posts as $key => $row)
                  <tr>
                     <td><img src="{{ asset('storage/posts/images/'.$row->image) }}" width="90" style="height: 90px;"></td>
                    
                     <td>
                        <a href="#" class="btn btn-outline btn-primary btn-sm">{{ _pfix($row->id) }}</a>
                         <a href="#" class="btn btn-outline btn-info btn-sm">By:  Admin </a>
                         <br><br>
                       <span class="text-muted"> {{ $row->title }} </span>
                     </td>
                     
                     <td> 




                      <!--   @if($row->is_active == 1)
                        <span class="label btn-lg label-success label-rounded">Active</span>
                        @else
                        <span class="label label-danger label-rounded">Disable</span>
                        @endif -->

                        

                        <div class="input-group">
            <div  class="btn-group is_rejected">
              <a class="btn btn-primary  {{ ($row->is_active == 1)?'active':'notActive' }}" data-id="{{ $row->id }}" data-toggle="is_rejected_{{ $row->id }}" data-title="1" >Approved</a>

              <a class="btn btn-primary  {{ ($row->is_rejected_== 1)?'active':'notActive' }}" data-id="{{ $row->id }}" data-toggle="is_rejected_{{ $row->id }}" data-title="0">Reject</a>
            </div>
            <input type="hidden" name="is_rejected" id="is_rejected_{{ $row->id }}">
          </div>


                       <!--   @if($row->is_active == 0)
                    <input type="checkbox" data-id="{{ $row->id }}" class="js-switch" data-color="#78b83e" data-secondary-color="#f96262"   data-size="large"/>
                   @else
                     <input type="checkbox" data-id="{{ $row->id }}" class="js-switch" data-color="#78b83e" data-secondary-color="#f96262"   data-size="large"/>
                  @endif   -->

                    </td>
                    <td>
                      {{ date('d M Y',strtotime($row->created_at)) }}
                      <br>
                      <span class="text-muted">{{ date('h:i A',strtotime($row->created_at)) }}</span>
                    </td>
                    
                     <td>

                       
                         <form action="{{ route('admin.posts.destroy',$row->id) }}" method="POST"  class="form-horizontal">
                    
                  
                   
                  <a  href="{{ route('admin.posts.show',$row->id) }}" class="btn btn-primary btn-outline btn-circle btn-lg" data-toggle="tooltip" data-original-title="View Post  - {{ _pfix($row->id) }}"><i class="fa fa-eye"></i></a>

                    <a  href="{{ route('admin.posts.edit',$row->id) }}" class="btn btn-info btn-lg btn-outline btn-circle" data-toggle="tooltip" data-original-title="Edit Post - {{ _pfix($row->id) }} "><i class="fa fa-pencil"></i></a>

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

         tostMsg('success','User post has been approved.!');
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

var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
$('.js-switch').each(function() {
    new Switchery($(this)[0], $(this).data());
});



$('.js-switch').on("change" , function() {
  var dataId =  $(this).data("id");
  if($(this).is(':checked')){
    var is_active = true; 
    tostMsg('success','User post has been approved.!');
  }else{
    var is_active = false;

    var url = APP_URL + '/admin/post_reject_form/' + dataId;
   
    $('#modelHeading').html('REJECT POST');
    $.ajaxModal('#view_modal',url);

  }

});


</script>
@endsection
