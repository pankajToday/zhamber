<div class="widget">
	<h4 class="widget-title">My Account</h4>
	<ul class="naves">
		<li>
			<i class="ti-user"></i>
			<a title="" href="{{ asset('profile') }}">My Profile</a>
		</li>

		<li>
			<i class="ti-pencil-alt"></i>
			<a title="" href="{{ asset('profile/edit') }}">Edit Profile</a>
		</li>
		<!-- <li>
			<i class="ti-settings"></i>
			<a title="" href="#">Account Setting</a>
		</li> -->
		<li>
			<i class="ti-lock"></i>
			<a title="" href="{{ asset('profile/change-password') }}">change password</a>
		</li>

		 <li> <i class="ti-power-off"></i> <a href="{{ url('/logout') }}" title="Logout"onclick="event.preventDefault(); document.getElementById('wid_logout_form').submit();"> log out</a> <form id="wid_logout_form" action="{{ url('/logout') }}" method="POST" style="display: none;"> @csrf </form> </li> 
	</ul>
</div>