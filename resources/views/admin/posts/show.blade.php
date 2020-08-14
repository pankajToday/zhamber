@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"># {{ _pfix($post->id )}}</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li  class="active"><a href="{{ asset('admin/posts') }}"> Posts</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-4">
         <div class="panel panel-default">
         <div class="panel-heading">{{ $post->title }} </div>
            <div class="panel-body b-b">
               <a href="{{ asset('storage/posts/images/'.$post->image) }}" data-toggle="lightbox" data-gallery="multiimages" data-title="{{ $post->title }}">
  <img src="{{ asset('storage/posts/images/'.$post->image) }}" alt="gallery" class="img-responsive" /> 
</a>
            </div>

            <div class="panel-body b-b">
               <strong> Description:</strong><br><br>

              {!! $post->description !!}
            </div>
            <div class="panel-body b-b">
               <strong> Tags:</strong> <br><br>

               @foreach($post->PostTag as $key => $tag)
                     <span  class="label label-warning">#{{$tag->name }}</span>
                     @endforeach
            </div>

         </div> 
	</div>
	<div class="col-md-8">
		
      <div class="panel panel-default">
      <div class="panel-heading">Post Statistics 

      </div>
            <div class="panel-body b-b">
                 <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong> 
                             UP Votes (<i class="fa fa-arrow-up"></i>)</strong>
                            <hr>
                            <p class="text-muted">{{ $post->n_like }} votes</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>DOWN Vote (<i class="fa fa-arrow-down"></i>)</strong>
                          <hr>
                            <p class="text-muted">{{ $post->n_dlike }} votes</p>
                        </div>
                        <div class="col-md-3 col-xs-6"> <strong>No ov Views (<i class="fa fa-eye"></i>)</strong>
                            <hr>
                            <p class="text-muted">{{ $post->n_views }} Views</p>
                        </div>
                        
                    </div> 
            </div>
      </div>
      <!-- /panel --> 



     <div class="panel panel-default">
   <div class="panel-heading">Update Statistics</div>
   <div class="panel-body b-b">
    <div id="errmessage"></div>
<form  method="post" name="update_p_stat" id="update_p_stat" novalidate="novalidate"  autocomplete="off">
  @csrf
      <div class="row">
         <div class="col-md-3 col-xs-6">
            <div class="form-group">
               <label class="control-label">Up Vote</label>
               <div class="input-group"> <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="text" name="n_like" placeholder="Up Votes" class="form-control" value="{{ $post->n_like }}"> 
               </div>
            </div>
         </div>
         <div class="col-md-3 col-xs-6">
            <div class="form-group">
               <label class="control-label">Down Vote</label>
               <div class="input-group"> <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="text" name="n_dlike" placeholder="Down Votes" class="form-control" value="{{ $post->n_dlike }}"> 
               </div>
            </div>
         </div>
         <div class="col-md-3 col-xs-6">
            <div class="form-group">
               <label class="control-label">Views</label>
               <div class="input-group"> <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                  <input type="text" name="n_views" placeholder="Views" class="form-control" value="{{ $post->n_views }}"> 
               </div>
            </div>
         </div>
         <div class="col-md-3 col-xs-6">
            <div class="form-group m-t-10">
               <label class="control-label"><br><br></label>
               <button type="submit" class="btn btn-info">Submit</button>
               <input type="hidden" name="id_post" value="{{ $post->id }}">
            </div>
         </div>
      </div>
      <!-- orw -->
</form>
   </div>
</div>



<div class="panel panel-default">
   <div class="panel-heading">
      Last 10  votes for this post
      <div class="pull-right"><a href="{{ asset('admin/post/votes/'.$post->id) }}" class="btn btn-sm btn-info">View All Votes</a></div>
   </div>
   <div class="panel-body b-b">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th>Username</th>
               <th>Vote Type</th>
               <th>Date Time</th>
            <tr>
         </thead>
         <tbody>
            @foreach($last_10_votes as $key => $list)
            <tr>
               <td>
                  <a href="{{ asset('admin/users/'.$list->id_user) }}" class="btn btn-sm btn-outline btn-info"> 
                  {{ $list->User->username }}
                  </a>
               </td>
               <td>{{ $list->v_type }}</td>
               <td>
                  {{ date('d M Y',strtotime($list->created_at)) }}
                  <span class="text-muted">{{ date('h:i A',strtotime($list->created_at)) }}</span>
               </td>
            <tr>
               @endforeach
         </tbody>
      </table>
   </div>
</div>
<!-- /panel -->



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


<script type="text/javascript">
  
$("form[name=update_p_stat]").on("submit", function(a) {
       a.preventDefault();
       var b = $(this);
        $.ajax({
            url: APP_URL + "/admin/update_p_stat",
            data: b.serialize(),
            type: "POST",
            dataType: "json",
            success: function(r) {
              if("R" == r.status){
                 $("#errmessage").html('<div class="alert alert-danger p-10">' + r.msg + "</div>");
              }

              if("S" == r.status){
                 $("#errmessage").html('<div class="alert alert-success p-10">' + r.msg + "</div>");
              }

            },
            error: function(a) {
                 $("#loaderbox").remove();
                var b = a.responseJSON;
                console.log(b);
                $("#errmessage").html('<div class="alert alert-danger p-10">' + b.message + "</div>");
            }
        });

  
});

</script>
@endsection
