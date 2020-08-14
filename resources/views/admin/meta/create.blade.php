@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Meta Detail</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li ><a href="{{ asset('admin/meta')}}">Meta Detail</a></li>
         <li  class="active"><a href="">Add New  Meta Detail</a></li>
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
         <div class="panel-heading">Add Page META </div>
         <div class="panel-body">
            <form  action="{{ route('admin.meta.store') }}" method="post"  enctype="multipart/form-data">
               @csrf
               

                <div class="form-group required">
                     <label class="control-label required" for="name"> Page URL</label>
                      <input placeholder="about-us" class="form-control" name="page_url" id="page_url" value="{!! old('page_url') !!}" required="">
                      <small class="help-block">http://wwww.abc.com/<strong>about-us</strong>  (Only put paramiter)</small>
                     @if ($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }} @endif
                </div>
                
               

                 
                       <div class="form-group required">
                   <label for="Title" class="control-label required" >Meta Title </label>
                    <input class="form-control" type="text"  name="meta_title" id="meta_title" value="{{ old('meta_title') }}" placeholder=" Meta Title"  autocomplete="Off" >
                  
                </div>

                   

                       <div class="form-group required">
                   <label for="Title" class="control-label required" >Meta Keywords </label>
                    <input class="form-control" type="text"  name="meta_keywords" id="meta_keywords" value="{{ old('meta_title') }}" placeholder=" Meta Keywords, wtih comma"  autocomplete="Off">                  
                </div>

                  <div class="form-group required">
                   <label class="control-label required" >Meta Content </label>
                     <textarea class="form-control " rows="3" name="meta_content"></textarea>  
                 </div>




                <div class="form-group">
                     <button type="sumit" class="btn btn-primary">Save </button>
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

</script>

@endsection
