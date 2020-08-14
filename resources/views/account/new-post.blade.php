@extends('layouts.app')
@section('content')

<section>
<div class="gap gray-bg">
  <div class="container">
     <div class="row">
        <div class="col-lg-12">
           <div class="row merged20" id="page-contents">
              <div class="col-lg-3 d-none d-sm-block">
                 <aside class="sidebar ">
                  
                  @include('account/_widget_top_tags')
                 </aside>
              </div>
              <!-- sidebar -->
              <!-- style="background: #1e2833" -->
              <div class="col-lg-6" id="newPostFormPanel">
              
             @if ($message = Session::get('success'))
 
              <div class="central-meta" style="background-color: green"> <div class="about"> <div class="personal"> <h5 class="f-title text-white "> <i class="text-white ti-check"></i> Thank You!! </h5> <h5><strong> Awesome !</strong> Your post has been submitted successfully.</h5> <p> It is under moderation. It will be approved and published if it compiles with the content rules. Thanks you ! </p> </div> </div> </div>

                @else


                 <div class="central-meta new-pst" style="background: #1e2833;margin-bottom: 300px"  >
                    <div class="personal">
                       <h5 class="f-title"><i class="ti-info-alt"></i> Add New Post</h5>
                       <p>
                       </p>
                    </div>
                    <div class="new-postbox">
                       <form method="post" name="new_post_form" id="new_post_form" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class=" mb-2">
                          <label>Post Title</label>
                          <textarea rows="2" maxlength="150" name="title"  placeholder="Your post title">{!! old('title') !!}</textarea>
                          
                          <span id="err_title">
                           @if ($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
                          </span>
                        </div>  
                        
                         <div class="mb-2"> 
                          <input type="file"  class="dropify" data-height="200" name="image" data-max-file-size="10M" data-min-height="200" data-allowed-file-extensions="jpg wepb png jpeg gif" data-max-file-size-preview="5M"  data-errors-position="outside"   />

                           <span id="err_image">
                           @if ($errors->has('image')) <span class="text-danger">{{ $errors->first('image') }} </span> @endif
                           </span>
                         </div> 
                         
                         <div class="mb-3 tag-control"> 
                           <label>Post Tags</label>
                           <input type="text" value="" class="rmspace" name="description" id="tags-input" data-role="tagsinput" placeholder="Add Tag" />
                         </div>

                         <div class="mb-5"> 
                          <label>Post Language</label>
                           <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="language[]" data-placeholder="Choose Language">
                                 @foreach(_langList() as $key => $row)
                                    <option value="{{ $row->name }}"
                                     
                                     >{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <span id="err_language">
                             @if ($errors->has('language')) <span class="text-danger">{{ $errors->first('language') }} </span>
                             @endif
                             </span>

                        </div>  

                       


                        <div class="mb-3 text-center">
                         <button type="submit" class="btn btn-deep-orange">Submit Post</button>
                       </div>
                      
                       </form>
                    </div>
                 </div>
                 <!-- add post new box -->

                 @endif

              </div>
              <!-- centerl meta -->
              <div class="col-lg-3 d-none d-sm-block">
                <aside class="sidebar static">
                     @include('account/_widget_settings')

                     @include('account/_widget_posts')
                 </aside>
    

              </div>
              <!-- sidebar -->
           </div>
        </div>
     </div>
  </div>
</div>
</section>

<script src="{{ asset('plugins/select2/js/select2.full.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2-bootstrap.css') }}">

<script type="text/javascript">
  $.fn.select2.defaults.set( "theme", "bootstrap" );
var placeholder = "Select  Language";
 $( ".select2-single, .select2-multiple" ).select2( {
        placeholder: placeholder,
        width: null,
        containerCssClass: ':all:'
      } );
</script>

<script src="{{ asset('web/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}">
<script type="text/javascript">
  $('.dropify').dropify({
      error: {
         'fileSize': 'The file size is too big 5MB max.',
         'imageFormat': 'The image format is not allowed (jpg,jpeg,png,gif only).'
       }

  });

</script>

<script type="text/javascript" src="{{ asset('js/typeahead.bundle.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('web/css/typeahead.css') }}">

<script src="{{ asset('web/js/bootstrap-tagsinput.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('web/css/bootstrap-tagsinput.css') }}">


 <script>

var ttttURL = APP_URL + '/callTagsHints';

var tagTeamsName = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  //prefetch: tagURL,
  remote: {
     url: ttttURL + '?keyword=%QUERY%',
     wildcard: '%QUERY%',
  }
});

$('#tags-input').tagsinput({
    cancelConfirmKeysOnEmpty: false,
    trimValue: true,
    maxTags:10,
    maxChars:20,
    confirmKeys:[13, 32,44],
    itemText: function(item) {
       return item.replace(/\s+/g, '');
    },
    typeaheadjs: {
      name: 'countries',
      displayKey: 'name',
      valueKey: 'name',
      source: tagTeamsName.ttAdapter()
    }
});

 $('input[name=description]').tagsinput();
$('.bootstrap-tagsinput input').keydown(function( event ) {
    if ( event.which == 13 ) {
        $(this).blur();
        $(this).focus();
        return false;
    }
})


jQuery(document).on("submit", "#new_post_form", function(e) {
      
      loadBox('newPostFormPanel');

      e.preventDefault();
      jQuery.ajax({
          type: "POST",
          url: APP_URL + '/submitNewPost',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          dataType: "json",
          success: function(r) {

             $("#loaderbox").remove();
               if(r.status == 'S'){

                    $(".postoverlay").fadeOut(500);

                    $("#newPostFormPanel").html('<div class="central-meta new-pst" style="background-color: green"> <div class="about"> <div class="personal"> <h5 class="f-title text-white "> <i class="text-white ti-check"></i> Thank You!! </h5> <h5><strong> Awesome !</strong> Your post has been submitted successfully.</h5> <p> It is under moderation. It will be approved and published if it compiles with the content rules. Thanks you ! </p> </div> </div> </div>'); 

                    setTimeout(function(){  location.reload(true); }, 3000);
                } 
            
          },
          error: function(edata) {
               $("#loaderbox").remove();
              console.log('errors',edata);
              var myObj = JSON.parse(edata.responseText);
              var errors = myObj.errors;
              for(key in errors){
                  $("#err_"+key).html(''); 
                  $("#err_"+key).html('<span class="text-danger">'+ errors[key]+'</span>');  
              }
         }
      });
      
    
});



</script>



<style type="text/css">

select {
    background: #393939 none repeat scroll 0 0;
    border-color: transparent;
    color: #eee;
    border-radius: 0px;
}
.select2-dropdown{
  background: #393939;
  color: #fff;
}

</style>

@endsection
