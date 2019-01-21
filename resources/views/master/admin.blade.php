<?php
use App\Auth;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>9jabusiness Admin -  
  @yield('title')
</title>
  
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ url('img/favicon.png') }}">
  <link rel="icon" href="{{ url('img/favicon.png') }}" type="image/x-icon">
   @yield('othercss')

    <!-- Bootstrap Dropify CSS -->
    <link href="{{ url('admin/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
  
  <!-- Data table CSS -->
  <link href="{{ url('admin/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>


    <!-- bootstrap-select CSS -->
    <link href="{{ url('admin/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
  

    <!-- switchery CSS -->
    <link href="{{ url('admin/vendors/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" type="text/css"/>
  
  <!-- Toast CSS -->
  <link href="{{ url('admin/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">

  <!-- bootstrap-touchspin CSS -->
    <link href="{{ url('admin/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Bootstrap Switches CSS -->
    <link href="{{ url('admin/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    
  <!-- Custom CSS -->
  <link href="{{ url('admin/dist/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
  <!-- Preloader -->
  <div class="preloader-it">
    <div class="la-anim-1"></div>
  </div>

  <!-- /Preloader -->
    <div class="wrapper  theme-5-active pimary-color-green">
    <!-- Top Menu Items -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
          <div class="logo-wrap">
            <a href="/dashboard">
              <img class="brand-img" src="{{ url('images/logo.png') }}" alt="brand" height="35" />
            </a>
          </div>
        </div>  
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>

        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>

        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>

        <form id="search_form" role="search" action="{{ url('admin/list/search/listing') }}" class="top-nav-search collapse pull-left">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search">
            <span class="input-group-btn">
            <button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
            </span>
          </div>
        </form>


      </div>
      <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
          
          
          
          <li class="dropdown auth-drp">
            <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"> 
              <img src="{{ url(image_url_encode(Auth::info('photo'))) }}" alt="user_auth" class="user-auth-img img-circle"/> <span> {{ Auth::info('name') }} </span> </a>
            <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
              <li>
                <a href="{{ url('admin/form/edit/profile') }}"><i class="zmdi zmdi-account"></i><span>Edit Profile</span></a>
              </li>

              <li>
                <a href="{{ url('admin/form/edit/password') }}"><i class="zmdi zmdi-lock-outline"></i><span>Change Password</span></a>
              </li>

              <li class="divider"></li>
              <li>
                <a href="{{ url('admin/form/logout') }}"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
              </li>
            </ul>
          </li>
        </ul>
      </div>  
    </nav>
    <!-- /Top Menu Items -->
    
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
      <ul class="nav navbar-nav side-nav nicescroll-bar">
         <li><a  href="/" target="_blank"><i class="zmdi zmdi-home mr-20"></i>9jabusiness Home</a></li>
       
       
        <li class="navigation-header">
          <span>Add New</span> 
          <i class="zmdi zmdi-more"></i>
        </li>
          <li ><a{!! set_active_url('admin/form/add/listing','active-page') !!} href="{{ url('admin/form/add/listing') }}"><i class="zmdi zmdi-videocam mr-20"></i>Add Listing</a></li>

          <li><a {!! set_active_url('admin/form/add/city','active-page') !!} href="{{ url('admin/form/add/city') }}"><i class="zmdi zmdi-book-image mr-20"></i>Add City</a></li>
           @if(Auth::level() < 3)

        <li><a  {!! set_active_url('admin/form/add/category','active-page') !!} href="{{ url('admin/form/add/category') }}"><i class="zmdi zmdi-book mr-20"></i> Add Category</a></li>

        <li  ><a {!! set_active_url('admin/form/add/admin','active-page') !!} href="{{ url('admin/form/add/admin') }}"><i class="zmdi zmdi-reader mr-20"></i>Add Admin</a></li>
        @endif

        <li class="navigation-header">
          <span>Listings</span> 
          <i class="zmdi zmdi-more"></i>
        </li>

         <li><a {!! set_active_url('admin/list/recent/listing','active-page') !!} href="{{ url('admin/list/recent/listing') }}"><i class="zmdi zmdi-book-image mr-20"></i>Recent Listing</a></li>
         @if(Auth::level() < 3)
        <li><a  {!! set_active_url('admin/list/unapproved/listing','active-page') !!} href="{{ url('admin/list/unapproved/listing') }}"><i class="zmdi zmdi-bookmark-outline mr-20"></i>Unapproved Listings</a></li>

        

         <li><a {!! set_active_url('admin/list/expired/listing','active-page') !!} href="{{ url('admin/list/expired/listing') }}"><i class="zmdi zmdi-book-image mr-20"></i>Expired Listing</a></li>

          <li><a {!! set_active_url('admin/list/trash/listing','active-page') !!} href="{{ url('admin/list/trash/listing') }}"><i class="zmdi zmdi-book-image mr-20"></i>Trash Listing</a></li>
          @endif

        

        
        <li class="navigation-header">
          <span>Browse list</span> 
          <i class="zmdi zmdi-more"></i>
        </li>
        @if(Auth::level() < 3)
        <li><a  {!! set_active_url('admin/list/categories','active-page') !!} href="{{ url('admin/list/categories') }}"><i class="zmdi zmdi-bookmark-outline mr-20"></i>Categories</a></li>
        @endif

        <li><a {!! set_active_url('admin/list/cities','active-page') !!} href="{{ url('admin/list/cities') }}"><i class="zmdi zmdi-accounts-list mr-20"></i>Cities</a></li>

        <li><a  {!! set_active_url('admin/list/admins','active-page') !!} href="{{ url('admin/list/admins') }}"><i class="zmdi zmdi-accounts-list mr-20"></i>Admins</a></li>

        <li class="navigation-header">
          <span>My Profile </span> 
          <i class="zmdi zmdi-more"></i>
        </li>
        <li><a  {!! set_active_url('admin/form/edit/profile','active-page') !!} href="{{ url('admin/form/edit/profile') }}"><i class="zmdi zmdi-account mr-20"></i> Edit Profile</a> </li>

        <li><a  {!! set_active_url('admin/form/edit/password','active-page') !!} href="{{ url('admin/form/edit/password') }}"><i class="zmdi zmdi-lock-outline mr-20"></i> Change Password</a></li>

        <li><a  {!! set_active_url('admin/form/logout','active-page') !!} href="{{ url('admin/form/logout') }}"><i class="zmdi zmdi-power mr-20"></i> Log Out</a></li>


        
        
        
        
        
        
      
      
        
        
      
        
      </ul>
    </div>
    <!-- /Left Sidebar Menu -->
    

    

        <!-- Main Content -->
    <div class="page-wrapper">

@yield('content')

    
  
      <!-- Footer -->
      <footer class="footer container-fluid pl-30 pr-30">
        <div class="row">
          <div class="col-sm-12">
            <p>2018 &copy; 9jabusiness</p>
          </div>
        </div>
      </footer>
      <!-- /Footer -->
      
    </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
  
  <!-- JavaScript -->
  
  <!-- jQuery -->
  <script src="{{ url('admin/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

  <!-- Bootstrap Daterangepicker JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
  
  <!-- Form Flie Upload Data JavaScript -->
  <script src="{{ url('admin/dist/js/form-file-upload-data.js') }}"></script>
  
  <!-- Data table JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
  
  <!-- Slimscroll JavaScript -->
  <script src="{{ url('admin/dist/js/jquery.slimscroll.js') }}"></script>

  <!-- Progressbar Animation JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
  <script src="{{ url('admin/vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>
  
  <!-- Fancy Dropdown JS -->
  <script src="{{ url('admin/dist/js/dropdown-bootstrap-extended.js') }}"></script>
  
  <!-- Sparkline JavaScript -->
  <script src="{{ url('admin/vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>
  
  <!-- Owl JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
  
  <!-- Switchery JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
  
  <!-- Toast JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

  
  <!-- Multiselect JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>

  <!-- Bootstrap Switch JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>


  <!-- Select2 JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

  <!-- Bootstrap Select JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

  <!-- Bootstrap Touchspin JavaScript -->
  <script src="{{ url('admin/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
  

    
  <!-- Form Advance Init JavaScript -->
  <script src="{{ url('admin/dist/js/form-advance-data.js') }}"></script>
  <!-- Init JavaScript -->
  <script src="{{ url('admin/dist/js/init.js') }}"></script><!-- 
  <script src="{{ url('admin/dist/js/dashboard-data.js') }}"></script> -->
</body>

</html>
