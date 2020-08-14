@extends('layouts.app')
@section('content')

<section>
			<div class="gap  ">
				<div class="container">
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<div class="contct-info" id="contact-form">
								
								<div class="contact-form" >
									<div class="cnt-title">
										<span>Send us a message</span>
										
									</div>
									<p id="form_err_msg"></p>

									 <form id="send_contact_form" name="send_contact_form" method="post" novalidate="novalidate" autocomplete="off">
									 	@csrf
										<div class="form-group">	
										  <input type="text" id="cname" name="name" autocomplete="off" required="required"/>
										  <label class="control-label" for="input">First & Last Name</label><i class="mtrl-select"></i>
										</div>
										<div class="form-group">	
										  <input type="text" name="email" id="cemail" autocomplete="off" required="required"/>
										  <label class="control-label" for="input">Email Address</label><i class="mtrl-select"></i>
										</div>

										<div class="form-group">	
										  <input type="text" name="mobile" id="cmobile" autocomplete="off" required="required"/>
										  <label class="control-label" for="input">Phone No.</label><i class="mtrl-select"></i>
										</div>
										
										<div class="form-group">	
										  <textarea rows="4" id="cmessage" name="message" required="required"></textarea>
										  <label class="control-label" for="textarea">Message</label><i class="mtrl-select"></i>
										</div>
										<div class="submit-btns">
											<button class="btn btn-info" id="submit" name="submit" type="submit">Send Message</button>





										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- contact info -->

<script type="text/javascript">

jQuery(document).on("submit", "#send_contact_form", function(e) {

		e.preventDefault();




		loadBox("contact-form");

      	  jQuery.ajax({
            type: "POST",
            url: APP_URL + '/sendContactEnquiry',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function(a) {
                jQuery(".loaderbox").remove();
             
                if ("R" == a.status) {
                	jQuery("#form_err_msg").html('<div class="alert alert-danger w-100">' + a.msg + "</div>");
                }
                
                if ("S" == a.status) {

             	  $("#form_err_msg").html('');
               		jQuery("#contact-form").html('<div class="uk-confirm-green text-center"  >  </div> <div class="text-center smsgbox myp "> <h2 class="text-success">Thank You !! </h2><h4 class="text-success"> Your request has been sent successfully. We shall be contacting you soon.! </h4></div>'); 
            	}

            },
            error: function(a) {
                jQuery(".loaderbox").remove();
                var b = a.responseJSON;
                alert('Something went wrong! Please try again.!');
            }
        });
  
   
});


</script>
@endsection
