<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>ChiliDogtags Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css') }}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ url('admin/images/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  @include('admin.layout.header')

  @include('admin.layout.sidebar')

  @yield('content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <a href="{{ url('admin/logout')}}" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </aside>
  <!-- /.control-sidebar -->

  @include('admin.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('admin/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ url('admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ url('admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ url('admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ url('admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('admin/plugins/chart.js/Chart.min.js') }}"></script>



<!-- Custom JS -->
<script src="{{ url('admin/js/custom.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js') }}"></script>

</body>
</html>
