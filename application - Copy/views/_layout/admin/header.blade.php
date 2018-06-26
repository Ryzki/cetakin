  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><span class="fa d-inline fa-lg fa-print"></span></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa d-inline fa-lg fa-print"></i> Admin Cetak<b>in</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <?php $user = $this->ion_auth->user()->row(); ?>

          <li>
            <a href="{{site_url('auth/logout')}}"><i class="fa fa-sign-out"></i> Keluar</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
