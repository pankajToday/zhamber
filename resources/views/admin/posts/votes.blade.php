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
		
     

    <div class="row">
   <div class="col-md-12">
      <div class="panel">
         <div class="panel-heading">
            <div class="row">
               <div class="col-sm-6">
                  All  votes for this post ({{ _pfix($post->id) }})
               </div>
               <div class="col-sm-6 text-right">
                  <!-- <a href="{{ route('admin.posts.create') }}" class="btn  btn-info btn-sm" data-toggle="tooltip" data-original-title="Add New  Facility"><i class="fa fa-plus" aria-hidden="true"></i> Add New  Post </a> -->
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
                  
                  </tr>
               </thead>
               <tbody>
                @foreach ($votes as $key => $list)
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
                    
                     
                  </tr>
                @endforeach  
               </tbody>
            </table>
            </div>
         </div>
      </div>
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

@endsection
