@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Manage  Posts</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li ><a href="{{ asset('admin/posts')}}">Manage  Posts</a></li>
         <li  class="active"><a href="">Update Post</a></li>
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
         <div class="panel-heading">Update  Post </div>
         <div class="panel-body">
            <form  action="{{ route('admin.posts.update',$post->id) }}" method="post"  enctype="multipart/form-data">
               @csrf
    @method('PUT')
               <div class="form-group">
                  <div class="radio-list hidden">
                     <label class="radio-inline p-l-0" >
                        <div class="radio radio-info">
                           <input type="radio" name="is_active" id="radio1" value="1" {{ ($post->is_active == 1)?'checked':'' }}>
                     <label for="radio1">Active</label>
                     </div>
                     </label>
                     <label class="radio-inline">
                        <div class="radio radio-info">
                           <input type="radio" name="is_active" id="radio2" value="0" {{ ($post->is_active == 0)?'checked':'' }}>
                     <label for="radio2">Disable </label>
                     </div>
                     </label>
                  </div>
               </div>
               <div class="form-group required">
                  <label class="control-label required" for="name"> Post Title</label>
                  <input class="form-control" type="text"  name="title" id="title" value="{{ $post->title }}" placeholder="Post Title"  autocomplete="Off" tabindex="1" minlength="2"  >
                  @if ($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }} @endif
               </div>
               <div class="form-group required">
                  <label class="control-label required" for="Title" >Post Image </label>
                  <input type="file" id="input-file-now" class="dropify" data-height="100" name="image" data-default-file="{{ asset('storage/posts/images/'.$post->image) }}" />
                  @if ($errors->has('image')) <span class="text-danger">{{ $errors->first('image') }} @endif
               </div>
               <div class="form-group ">
                  <label class="control-label ">Post Description </label>
                  <textarea class="form-control wysihtml1" rows="5" name="description">{!! $post->description !!}</textarea>  
                  @if ($errors->has('description')) <span class="text-danger">{{ $errors->first('description') }} @endif
               </div>
               <div class="form-group ">
                  <div class="input-group m-b-30"> 
                     <span class="input-group-addon">Tags</span>
                     <select multiple data-role="tagsinput" class="form-control" name="tags[]" id="txtSkills">
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <button type="sumit" class="btn btn-primary">Save Post</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}">


<script src="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

<script src="{{ asset('plugins/typeahead/dist/typeahead.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/typeahead/dist/bloodhound.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
  $('.dropify').dropify();

</script>
<script type="text/javascript">
// Get the reference to the input field
var elt = $('#txtSkills'); 
var turl = APP_URL + '/admin/call_tags';

var skills = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
       remote: {
            url: turl + '?keyword=%QUERY%',
            wildcard: '%QUERY%',                
      }
});

skills.initialize();

$('#txtSkills').on('beforeItemAdd', function(event) {

   /* if (event.item !== event.item.toLowerCase()) {
        event.cancel = true;
        $(this).tagsinput('add', event.item.toLowerCase());
    }
    */
});


$('#txtSkills').tagsinput({
  /*itemValue : 'id',
  itemText  : 'name',*/
  allowDuplicates : false, 
  maxChars: 20,
  onTagExists: function(item, $tag) {
        $tag.hide().fadeIn();
  },
  typeaheadjs: {
    name: 'citynames',
    displayKey: 'name',
    valueKey: 'name',
    source: skills.ttAdapter(),
    templates: {
                        empty: [
                            '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li class="list-group-item">' + data.name + '</li>'
                        }
                    }
  }
});
/*

$('#txtSkills').tagsinput({
      itemValue : 'id',
      itemText  : 'name',
      maxChars: 10,
      trimValue: true,
      allowDuplicates : false,   
      freeInput: true,
      focusClass: 'form-control',

      tagClass: function(item) {
          if(item.display)
             return 'label label-' + item.display;
          else
              return 'label label-default';
     },
     onTagExists: function(item, $tag) {
          $tag.hide().fadeIn();
    },
      typeaheadjs: [{
                        hint: false,
                        highlight: true
                    },
                    {
                    
                    name: 'skills',
                    itemValue: 'id',
                    displayKey: 'name',
                    source: skills.ttAdapter(),
                    templates: {
                        empty: [
                            '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li class="list-group-item">' + data.name + '</li>'
                        }
                    }
        }]         
});  */   
</script>

@endsection
