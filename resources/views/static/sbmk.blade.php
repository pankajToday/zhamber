@extends('layouts.app')
@section('content')

<section>
	<div class="gap2 card-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="top-banner">
						
						<h1>Sabse Bada MEMER Kaun</h1>
					</div>
					<nav class="breadcrumb">
					  <a class="breadcrumb-item text-white" href="{{ asset('/') }}">Home</a>
					  <span class="breadcrumb-item active">Sabse Bada MEMER Kaun</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	
		<div class="container">
			 <a href="{{ asset('sabse-bada-memer-kaun') }}">
 <img src="{{ asset('web/images/sabse-bada-memer-kaun.jpg') }}" >
</a> 
		</div>
	
</section>



<section style="margin-bottom: 100px;margin-top: 0px;">
	<div class="gap no-bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
						
						<div class="central-meta">
									<div class="about">
										
										<div class="personal text-center">
											<h5>Do you think you make good Memes?</h5>
											<br>
											<h6>Awesome! Upload your memes and get a chance to win prizes worth</h6>
											<h3>Rs. 75,000/-</h3>
											<br>

											<h5>1st Prize Rs. 25,000/-</h5>
											<h5>2nd Prize Rs. 15,000/-</h5>
											<h5>3rd Prize Rs. 10,000/-</h5>
											<h5>4th Prize Rs. 5000/-</h5>
											<h5>5th Prize Rs. 2500/-</h5>
											<h5>6th Rs. 2000/-</h5>
											<h5>7th Rs. 1500/-</h5>
											<h5>8th Rs. 1000/-</h5>
											<h5>9th Rs. 1000/-</h5>
											<h5>10th Rs. 1000/-</h5>
											<h5>11th to 30th Rs. 500/- Each</h5>


											


											
										</div>

										<div class="personal">
											<br>
											<h5 class="f-title">Contest Rules: </h5>
										
												<ol style="color:#ccc">
													<li>Meme should have a watermark of your username on Zhamber</li>
													<li>Memes you upload should follow the <a href="{{ asset('rules') }}" style="color: #007bff" target="_new">Site Rules</a> </li>
													<li>Duplicate memes uploaded from same/different accounts will be rejected</li>
													<li>You can upload as many memes as you want!</li>
													<li>You can upload meme at any time during contest period</li>
													<li>By submitting your memes, you agree to our <a href="{{ asset('privacy-policy') }}"  style="color: #007bff"target="_new">Terms of Service</a> and <a href="{{ asset('privacy-policy') }}" style="color: #007bff" target="_new"> Privacy Policy </a></li>
												</ol>
											
										</div>


										<div class="personal">
											<br>
											<h5 class="f-title">How you win?</h5>
										
												<ol style="color:#ccc">
													<li>Memes will be ranked on the scoring criteria based on no. of votes + no. of views </li>
													<li>Top 30 highest scoring memes will be declared as winners on 1
st August 2020</li>
													<li>In case of TIE for any position the prize money will be equally divided between the respective
contestants</li>
													<li>You can upload as many memes as you want!</li>
													<li>You can upload meme at any time during contest period</li>
													<li>Prize money will be transferred to the winner’s account through Paytm, Phone Pe or Google Pay</li>
												</ol>
											
										</div>


										<div class="personal">
											<br>
											<h5 class="f-title">Important Note</h5>
											<p>The copyright issues relating to the use of memes is murky. However, it is very clear that the
rights of a copyright holder apply to memes. Because we publish content on the web, we
must balance the desire to have captivating and inspiring content with the responsibility to
properly manage copyright.</p>
												
											
										</div>

										<div class="personal">
										<br>
										<h4>Contest Starts on 24th June 2020 and Ends on 31st July 2020 midnight</h4>
										<br>
										<h5>In case of any queries please send an email to contact@zhamber.com or <a href="{{ asset('contact-us') }}" style="color: #007bff" target="_new">Contact Us</a>.</h5>
										<br>
										<h3>Start uploading your memes on Zhamber</h3>
										</div>

										
									

									</div>
						</div>	

						
				</div>
			</div>
		</div>
	</div>
</section>


@endsection
