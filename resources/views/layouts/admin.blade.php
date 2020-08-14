<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title> Zhamber</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables/dataTable.boostrap.css') }}">

<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/colors/blue.css') }}" id="theme"  rel="stylesheet">
<link href="{{ asset('plugins/themify-icons/themify-icons.css') }}" rel="stylesheet">

<script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!} 
var FTOKEN = {!! json_encode(csrf_token()) !!}
</script>
<!--[if lt IE 9]>
<script src="{{ asset('js/html5shiv.js') }}"></script>
<script src="{{ asset('js/respond.min.js') }}"></script>
<![endif]-->

</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
   <!--  <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div> -->
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="javascript::">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="{{ asset('img/admin-logo.png') }}" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="{{ asset('img/admin-logo.png') }}" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="{{ asset('img/admin-text.png') }}" alt="home" class="dark-logo" /><!--This is light logo text--><img src="{{ asset('img/admin-text.png') }}" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    

                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                  <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                   
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{ asset('img/avatar-sm.png') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"> {{ strtoupper(Auth::guard('admin')->user()->name) }}   </b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                   
                                    <div class="u-text">
                                        <h4>{{ strtoupper(Auth::guard('admin')->user()->name) }}</h4>
                                        <p class="text-muted">{{ strtoupper(Auth::guard('admin')->user()->email) }}</p></div>
                                </div>
                            </li>
                            
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ asset('admin/change-password') }}"><i class="ti-settings"></i> Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
            <a  
               href="{{ route('admin.logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"
               class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
         </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li class="user-pro">
                        <a href="javascript::" class="waves-effect"><img src="{{ asset('img/avatar-sm.png') }}" alt="user-img" class="img-circle"> <span class="hide-menu">  {{ strtoupper(Auth::guard('admin')->user()->name) }}</span>
                        </a>
                      
                    </li>
                    <li> <a href="{{ asset('admin/dashboard') }}" class="waves-effect"><i class="mdi mdi-view-dashboard fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span></a></li>

                        <li> <a href="{{ asset('admin/posts') }}" class="waves-effect">
                        <i class="mdi mdi-image-filter fa-fw" data-icon="v"></i> <span class="hide-menu">   Posts  </span></a>
                       
                    </li>

                     <li> <a href="{{ asset('admin/users') }}" class="waves-effect">
                        <i class="mdi mdi-account-multiple" data-icon="v"></i> <span class="hide-menu"> Users  </span></a>
                       
                    </li>


                     <li> <a href="{{ asset('admin/contact-enquiry') }}" class="waves-effect">
                        <i class="mdi mdi-message-bulleted" data-icon="v"></i> <span class="hide-menu"> Contact Enquiries  </span></a>
                       
                    </li>

                    

                      <li class="devider"></li>
                      <li>
            <a  
               href="{{ route('admin.logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"
               class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
         </li>

            
                
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
                
             <div class="container-fluid">
          @yield('content')
            <div>

                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-admin"> 2017 &copy; Tinku </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
   <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>

<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('plugins/html5-editor/wysihtml5-0.3.0.js') }}"></script>
<script src="{{ asset('plugins/html5-editor/bootstrap-wysihtml5.js') }}"></script>

<link href="{{ asset('plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
<script src="{{ asset('plugins/toast-master/js/jquery.toast.js') }} "></script>
<script src="{{ asset('plugins/blockUI/jquery.blockUI.js') }}"></script>
<script src="{{ asset('js/helpers.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/blockui.css') }}">

</body>

</html>
