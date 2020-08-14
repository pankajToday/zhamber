<div class="responsive-header stick zindex-99">
<div class="mh-head first">
	<span class="mh-btns-left" >
		<a class="" href="javascript::" id="sidebarCollapse"><i class="fa fa-align-justify" style="font-style: 33px;" ></i></a>
	</span>
	<span class="mh-text" >
		<a href="{{ asset('') }}" title=""><img src="{{ asset('web/images/logo.png') }}" alt=""></a>
	</span>
	<span class="mh-btns-right">

	
	<a href="javascript::" class="sflip s-bradious">
        <i class="ti-search"></i> 
       </a> 

       <a href="javascript::" data-toggle="modal" data-target="#langModal" class="l-bradious">
      		<i class="fa-en"></i>
  		 </a> 
 

		@if(isset(Auth::guard('web')->user()->id)) <a href="{{ asset('post/new') }}" class="p-bradious" > <i class="ti-plus ml--2"></i> </a> @else <a href="javascript::" class="p-bradious "  data-toggle="modal" data-target="#AllSignInUp"> <i class="ti-plus ml--2"></i> </a> @endif

		@if(isset(Auth::guard('web')->user()->id)) 
			<a href="javascript::" class="brad-img" data-toggle="modal" data-target="#aModelLink" > 
					
					@if(isset(Auth::guard('web')->user()->avatar)) 
					<img src="{{ asset('storage/avatar/'.Auth::guard('web')->user()->avatar) }}" class="bradious"  width="25px;">
					@else
					      <img src="{{ asset('img/av_73x73.jpg') }}" alt="" width="30px;">  
					@endif
			</a> 
		@else <a href="javascript::" class="u-bradious" data-toggle="modal" data-target="#AllSignInUp"> <i class="ti-user ml--2"></i> </a> 
		@endif

	</span>
</div>
<div class="mh-head second" style="display: none;">
	<form class="mh-form multiple-datasets" >
		  <input class="typeahead" type="text" placeholder="Search tags, users">
		<a href="#/" class="fa fa-search"></a>
	</form>
</div>
</div>	

<style type="text/css">
.ml--2{
	margin-left: -2px!important;
}
</style>