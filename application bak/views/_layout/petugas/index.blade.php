<?php
if (!$this->ion_auth->logged_in())
{
  // redirect them to the login page
  redirect('auth/login', 'refresh');
}

$user = $this->ion_auth->user()->row();

if ($user->group_id == 1){
    redirect('auth/logout', 'refresh');
} else if ($user->group_id == 3){
    redirect('auth/logout', 'refresh');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cetakin | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  @yield('style')

</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<!-- ini header admin-->
@include('_layout/petugas/header')
<!-- end header admin -->

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
<!-- ini sidebar -->
@include('_layout/petugas/sidebar')
<!-- end sidebar -->

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
@yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>&nbsp
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{base_url()}}assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{base_url()}}assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{base_url()}}assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{base_url()}}assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{base_url()}}assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{base_url()}}assets/admin/dist/js/demo.js"></script>
<!-- Sweet Alert-->
<script src="{{base_url()}}assets/vendor/sweetalert/sweetalert.min.js"></script>

<script src="{{base_url('assets/vendor/jquery-loading/')}}dist/loadingoverlay.min.js"></script>

@yield('script')

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  @if($this->session->userdata('message'))
    <?php $message = $this->session->userdata('message');?>
    function sweet(){
      swal("Informasi", "{{ $message[0] }}", "{{ $message[1] }}");
    }
    window.onload = sweet;
  @endif
</script>
</body>
</html>
