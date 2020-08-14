
<style type="text/css">
 .no-radius{
    border-radius: 0px;
  }
  .svg-inline--fa {
    display: inline-block;
    font-size: inherit;
    height: 1em;
    overflow: visible;
    vertical-align: -0.125em;
}
</style>
<div class="row" style="text-align: center;">
   <div class="col-4 col-md-4 mb-3">
      
       @if(isset(Auth::guard('web')->user()->id)) 
             <button type="button" class="{{  (_chkVoted($post->id,'up') == 'Y')?'btn-success':'btn-outline-light' }} btn btn-block no-radius upordown  udbox"  id="up" data-id="{{ $post->id }}" data-toggle="tooltip" title="Upvotes">
        @else
       <button type="button"  href="javascript::" class="btn-outline-light btn btn-block no-radius udbox" data-toggle="modal" data-target="#AllSignInUp" >
        @endif

         <svg aria-hidden="true" focusable="false" data-prefix="fa" data-icon="arrow-alt-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-alt-up "><path fill="currentColor" d="M272 480h-96c-13.3 0-24-10.7-24-24V256H48.2c-21.4 0-32.1-25.8-17-41L207 39c9.4-9.4 24.6-9.4 34 0l175.8 176c15.1 15.1 4.4 41-17 41H296v200c0 13.3-10.7 24-24 24z" class=""></path></svg>
               <span id="up_c">{{ $post->n_like }} </span>

    </button>

   </div>
   <div class="col-4 col-md-4">


     @if(isset(Auth::guard('web')->user()->id)) 
             <button type="button" class="{{  (_chkVoted($post->id,'down') == 'Y')?'btn-danger':'btn-outline-light' }} btn btn-block no-radius upordown udbox"  id="down" data-id="{{ $post->id }}" data-toggle="tooltip" title="Downvotes">
        @else
       <button type="button"  href="javascript::" class="btn-outline-light btn btn-block no-radius udbox" data-toggle="modal" data-target="#AllSignInUp" >
        @endif

         <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-alt-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-alt-down fa-w-14"><path fill="currentColor" d="M176 32h96c13.3 0 24 10.7 24 24v200h103.8c21.4 0 32.1 25.8 17 41L241 473c-9.4 9.4-24.6 9.4-34 0L31.3 297c-15.1-15.1-4.4-41 17-41H152V56c0-13.3 10.7-24 24-24z" class=""></path></svg>
               <span id="down_c">{{ $post->n_dlike }} </span>

    </button>


   </div>
  
    <div class="col-4 col-md-4">
    <button type="button" class="btn btn-outline-light no-radius btn-block p-2" data-toggle="collapse" href="#shareLink" role="button" aria-expanded="false" aria-controls="shareLink">
     <i class="ti-share pr-1"></i> 
  </button>
   </div>






</div> 

   
<div class="collapse multi-collapse" id="shareLink" style="background: #333;margin:0px;padding:15px 10px 10px 10px;text-align: center;">
     <div class="row">
       <div class="col-3 col-md-3">
     {!! Share::page(\Request::fullUrl(),$post->title, ['class' => 'btn btn-fb btn-block','title' => 'Share with facebook'], '<span class="list-unstyled">', '</span> ')->facebook() !!}
   </div>
   <div class="col-3 col-md-3">
    {!! Share::page(\Request::fullUrl(),$post->title, ['class' => 'btn btn-block btn-tw','title' => 'Share with Twitter'], '<span class="list-unstyled">', '</span> ')->twitter() !!}
   </div>
   <div class="col-3 col-md-3">
    {!! Share::page(\Request::fullUrl(),$post->title, ['class' => 'btn btn-block btn-whatsapp','title' => 'Share with whatsapp'], '<span class="list-unstyled">', '</span> ')->whatsapp() !!}
   </div>

   <div class="col-3 col-md-3">
  <button type="button" class="btn btn-outline-warning no-radius btn-block" id="cbox">
     <a  id="cplink" style=""  data-toggle="tooltip" data-placement="top" title="Copy Link"  onclick="copyToClipboard('#copylink')"><i class="fa fa-link pr-1"></i> </a>
      <input type="hidden" id="copylink" value="{{ \Request::fullUrl() }}">
  </button>
   </div>

     </div>
</div> 



