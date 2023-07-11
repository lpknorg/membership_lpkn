<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>Gentelella Alela!</title>

  <!-- Bootstrap -->
  <link href="{{asset('template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('template/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{asset('template/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="{{asset('template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{asset('template/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="{{asset('template/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{asset('template/build/css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      @include('layouts.sidebar')

      <!-- top navigation -->
      @include('layouts.navbar')
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <!-- top tiles -->
        @yield('breadcumb')
        
        @yield('content')
        <br />
      </div>
      <!-- /page content -->

      <!-- footer content -->
      @include('layouts.footer')
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{asset('template/vendors/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('template/vendors/fastclick/lib/fastclick.js')}}"></script>
  <!-- NProgress -->
  <script src="{{asset('template/vendors/nprogress/nprogress.js')}}"></script>
  <!-- Chart.js -->
  <script src="{{asset('template/vendors/Chart.js/dist/Chart.min.js')}}"></script>
  <!-- gauge.js -->
  <script src="{{asset('template/vendors/gauge.js/dist/gauge.min.js')}}"></script>
  <!-- bootstrap-progressbar -->
  <script src="{{asset('template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
  <!-- iCheck -->
  <script src="{{asset('template/vendors/iCheck/icheck.min.js')}}"></script>
  <!-- Skycons -->
  <script src="{{asset('template/vendors/skycons/skycons.js')}}"></script>
  <!-- Flot -->
  <script src="{{asset('template/vendors/Flot/jquery.flot.js')}}"></script>
  <script src="{{asset('template/vendors/Flot/jquery.flot.pie.js')}}"></script>
  <script src="{{asset('template/vendors/Flot/jquery.flot.time.js')}}"></script>
  <script src="{{asset('template/vendors/Flot/jquery.flot.stack.js')}}"></script>
  <script src="{{asset('template/vendors/Flot/jquery.flot.resize.js')}}"></script>
  <!-- Flot plugins -->
  <script src="{{asset('template/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
  <script src="{{asset('template/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
  <script src="{{asset('template/vendors/flot.curvedlines/curvedLines.js')}}"></script>
  <!-- DateJS -->
  <script src="{{asset('template/vendors/DateJS/build/date.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{asset('template/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
  <script src="{{asset('template/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="{{asset('template/vendors/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('template/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{asset('template/build/js/custom.min.js')}}"></script>

</body>
</html>
