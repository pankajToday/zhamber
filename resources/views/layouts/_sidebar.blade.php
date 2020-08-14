<!-- Sidebar  -->
<nav id="sidebar">
    <div id="dismiss">
        <i class="fa fa-arrow-left"></i>
    </div>

    <div class="sidebar-header">
        <img src="{{ asset('web/images/logo.png') }}" alt="">
    </div>
  
    <div class="sidebar-body">
     @foreach(_topTags() as $key => $row)

     <a class="btn btn-primary btn-round-sm btn-sm m-1  mr-1" href="{{ asset('tag/'.$row->name) }}">#{{ $row->name }}<!-- <small> ({{ $row->no_sum_post }})</small> --> </a>

      @endforeach
  </div>
   
    <ul class="list-unstyled CTAs">
       
        <li>
            <a href="{{ asset('contact-us') }}">Contact Us</a>
        </li>
        <li>
             <a href="{{ asset('privacy-policy') }}">Privacy Policy </a>
        </li>
        <li>
            <a href="{{ asset('terms-of-service') }}">Terms of service </a>
        </li>
         <li>
            <a href="{{ asset('rules') }}">Site Rules </a>
        </li>
        <li>
            <a href="{{ asset('zpp') }}" class="btn btn-sm btn-info">Earn with Zhamber</a>
        </li>
    </ul>
  <div class="menu-social">
     <a href="https://www.facebook.com/zhamberofficial" target="_new" class="facebook"><i class="ti-facebook"></i></a> 
  <a href="https://www.twitter.com/zhamberofficial" target="_new" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="https://www.instagram.com/zhamberofficial" target="_new" class="instagram"><i class="fa fa-instagram"></i></a>
  
    </div>  
</nav>
