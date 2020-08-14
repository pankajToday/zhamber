@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Meta Details</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li ><a href="{{ asset('admin/meta')}}">Meta Details</a></li>
         <li  class="active"><a href="">Update  Page Meta</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->

@if ($errors->any())
    <div class="alert alert-danger">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-default">
         <div class="panel-heading">Update Page Meta </div>
         <div class="panel-body">
            <form  action="{{ route('admin.meta.update',$metum->id) }}" method="post"  enctype="multipart/form-data">
               @csrf
    @method('PUT')
               
                <div class="form-group required">
                     <label class="control-label required" for="name"> Page URL</label>
                      <input placeholder="about-us" class="form-control" name="page_url" id="page_url" value="{!! $metum->page_url !!}" required="" >
                      <small class="help-block">http://wwww.abc.com/<strong>about-us</strong>  (Only put paramiter)</small>
                     @if ($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }} @endif
                </div>
                
               

                 
                       <div class="form-group required">
                   <label for="Title" class="control-label required" >Meta Title </label>
                    <input class="form-control" type="text"  name="meta_title" id="meta_title" value="{{ $metum->meta_title }}" placeholder=" Meta Title"  autocomplete="Off" >
                  
                </div>

                   

                       <div class="form-group required">
                   <label for="Title" class="control-label required" >Meta Keywords </label>
                    <input class="form-control" type="text"  name="meta_keywords" id="meta_keywords" value="{{ $metum->meta_keywords }}" placeholder=" Meta Keywords, wtih comma"  autocomplete="Off">                  
                </div>

                  <div class="form-group required">
                   <label class="control-label required" >Meta Content </label>
                     <textarea class="form-control " rows="3" name="meta_content">{{ $metum->meta_content }}</textarea>  
                 </div>


                <div class="form-group">
                     <button type="sumit" class="btn btn-primary">Save Facility</button>
                </div>

            </form>
         </div>
      </div>
   </div>
</div>

<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
 <script>
       CKEDITOR.replace( 'editor' );
    </script>

<script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}">

<script type="text/javascript">
  $('.dropify').dropify();

$(document).ready(function(){
    $('input[name="is_link"]').click(function(){
        var inputValue = $(this).attr("id");
    
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});



$('.rm_image').on('click', function() {
  var img = $(this).attr('id');


  
  var id_meta = $(this).data('id');
  $.ajax({
        url: APP_URL + "/admin/meta/rmFacilityImg",
        data: {
            _token: FTOKEN,
            id_meta: id_meta,
            id_meta_img: img,
        },
        type: "post",
        dataType: "json",
        success: function(b) {

              var el = document.getElementById(img);
              el.remove(); 
              tostMsg("success", "Facility image  has been remove successfully.");
              
        },
        error: function(a) {
            alert("Something went wrong.!");
        }
    });
});  


</script>

@endsection
