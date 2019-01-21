
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
            <a href="{{ url('/') }}">
              <img class="brand-img" src="{{ url('images/logo.png') }}" alt="brand" height="35" />
            </a>
          </div>
        </div>  
   

        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>

     
      </div>
      <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
          <li class="dropdown auth-drp">
            <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">  <span> <i class="fa fa-list"></i> </span> </a>
            <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
              <li>
                <a href="{{ url('/') }}"><i class="zmdi zmdi-account"></i><span>Home</span></a>
              </li>

              <li>
                <a href="{{ url('contact') }}"><i class="zmdi zmdi-lock-outline"></i><span>Contact</span></a>
              </li>

            </ul>
          </li>
        </ul>
      </div>  
    </nav>
    <!-- /Top Menu Items -->
    

    

    

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
  <script src="{{ url('admin/dist/js/init.js') }}"></script>
  <script src="{{ url('admin/dist/js/dashboard-data.js') }}"></script>
</body>

</html>
