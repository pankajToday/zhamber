
<div id="event-detail">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title"> REJECT POST - #{{ _pfix($post->id) }}</h4>
   </div>
   <div class="modal-body">
    <div id="errmessage"></div>
      <form method="post" action="#"  name="postRejectForm" id="postRejectForm">
      <input type="hidden" name="id_post" value="{{ $post->id }}">
        @csrf
        <div class="form-body">
           
             <div class="form-group">
                     <label for="comment">Rejection Reason</label>
                     <textarea class="form-control summernote" rows="3" id="rejected_reason" name="rejected_reason"></textarea>
                     <span id="rejected_reason_msg" class="text-danger"></span>
                  </div>

                     <div class="form-group">
                      <button type="submit"  class="btn btn-primary">
                    Reject Post 
                    </button>
                    <button type="submit" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                    </div>




         </div>
      </form>
   </div>
  
</div>

