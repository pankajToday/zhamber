
<style type="text/css">
 .no-radius{
    border-radius: 0px;
  }
</style>
<div class="row " style="background: #333;margin:0px;padding:15px 10px 0px 10px;">
   <div class="col-2 col-md-2 mb-3">
       @if(_chkVoted($post->id,'up') == 'Y')
            <div class="udbox-green" id="up_box_{{ $post->id }}">
               @else
            <div class="udbox" id="up_box_{{ $post->id }}">
               @endif    
               @if(isset(Auth::guard('web')->user()->id)) 
               <a href="javascript::" class="upordown" id="up" data-id="{{ $post->id }}" data-toggle="tooltip" title="Upvotes" >
               @else
               <a href="javascript::" data-toggle="modal" data-target="#AllSignInUp" >
               @endif 
               <img src="{{ asset('web/images/up.png') }}" width="21px;">
               <span id="up_c">{{ $post->n_like }}</span>
               </a>
            </div>

   </div>
   <div class="col-2 col-md-2">
@if(_chkVoted($post->id,'down') == 'Y')
            <div class="udbox-red" id="down_box_{{ $post->id }}">
               @else
            <div class="udbox" id="down_box_{{ $post->id }}">
               @endif 
               @if(isset(Auth::guard('web')->user()->id)) 
               <a href="javascript::" class="upordown" id="down" data-id="{{ $post->id }}" data-toggle="tooltip" title="Downvotes">
               @else
               <a href="javascript::" data-toggle="modal" data-target="#AllSignInUp">
               @endif 
               <img src="{{ asset('web/images/down.png') }}" width="21px;">
               <span id="down_c">{{ $post->n_dlike }}</span>
               </a>
            </div>
   </div>
   <div class="col-3 col-md-2">
     {!! Share::page(\Request::fullUrl(),$post->title, ['class' => 'btn btn-fb btn-block','title' => 'Share with facebook'], '<span class="list-unstyled">', '</span> ')->facebook() !!}
   </div>
   <div class="col-3 col-md-2">
    {!! Share::page(\Request::fullUrl(),$post->title, ['class' => 'btn btn-block btn-tw','title' => 'Share with Twitter'], '<span class="list-unstyled">', '</span> ')->twitter() !!}
   </div>
   <div class="col-3 col-md-2">
    {!! Share::page(\Request::fullUrl(),$post->title, ['class' => 'btn btn-block btn-whatsapp','title' => 'Share with whatsapp'], '<span class="list-unstyled">', '</span> ')->whatsapp() !!}
   </div>
   <div class="col-3 col-md-2">
    <button type="button" class="btn btn-outline-warning no-radius btn-block" id="cbox" >
     <a  id="cplink" style=""  data-toggle="tooltip" data-placement="top" title="Copy Link"  onclick="copyToClipboard('#copylink')"><i class="fa fa-link pr-1"></i> </a>
      <input type="hidden" id="copylink" value="{{ \Request::fullUrl() }}">
  </button>
   </div>

</div>  

