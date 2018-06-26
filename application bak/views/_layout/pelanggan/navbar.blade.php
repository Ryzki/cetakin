<?php $page = $this->uri->segment(1); ?>

  <nav class="navbar fixed-top navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="{{site_url('homepage')}}">
        <img src="{{base_url('assets/image/logo.png')}}" width="150"  class="d-inline-block align-top" alt=""> 
      </a>

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>

      <div class="collapse navbar-collapse text-center" id="navbar2SupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item {{($page == '' || $page == 'homepage')?'border border-white':''}}">
            <a class="nav-link text-white bg-primary" href="{{site_url('homepage')}}"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Beranda</a>
          </li>
          <li class="nav-item {{($page == 'percetakan')?'border border-white':''}}">
            <a class="nav-link text-white bg-primary" href="{{site_url('percetakan')}}"><i class="fa d-inline fa-lg fa-list-alt"></i> Daftar Percetakan</a>
          </li>
          <li class="nav-item {{($page == 'snk')?'border border-white':''}}">
            <a class="nav-link text-white bg-primary" href="snk"><i class="fa d-inline fa-lg fa-clone"></i> Syarat dan Ketentuan</a>
          </li>
          <li class="nav-item {{($page == 'about_us')?'border border-white':''}}">
            <a class="nav-link text-white bg-primary" href="#"><i class="fa d-inline fa-lg fa-info"></i> Tentang Kami</a>
          </li>
          <a class="btn navbar-btn ml-2 text-white btn-secondary d-block d-sm-none"><i class="fa d-inline fa-lg fa-user-circle-o"></i> Daftar</a>
        </ul>
      </div>

      @if (!$this->ion_auth->logged_in())
        <div class="text-right justify-content-between d-none d-sm-block" >
          <a href="{{site_url('auth/create_user')}}" class="btn btn-outline-white text-primary bg-white navbar-btn ml-2 text-white"> Daftar Sekarang!</a>
        </div>
        <div class="text-right justify-content-between d-none d-sm-block" >
          <a href="{{site_url('auth/login')}}" class="btn btn-primary border-white navbar-btn ml-2"> Masuk</a>
        </div>
      @else
        <?php $user = $this->ion_auth->user()->row(); ?>

        <div class="btn-group text-right justify-content-between d-none d-sm-block">
          <a class="btn btn-primary border-white navbar-btn ml-2 dropdown-toggle hee_maxw200" data-toggle="dropdown"><i class="fa d-inline fa-lg fa-user-circle-o"></i> {{$user->first_name}}</a>
          <div class="dropdown-menu ">
            <a class="dropdown-item" href="{{site_url('pelanggan/pesanan')}}"><i class="fa d-inline fa-lg fa-list-alt"></i> Daftar Pesanan</a>
            <a class="dropdown-item" href="{{site_url('pelanggan/saldo_user')}}"><i class="fa d-inline fa-lg fa-money"></i> Lihat Saldo</a>
            <a class="dropdown-item" href="{{site_url('pelanggan')}}"><i class="fa d-inline fa-lg fa-user-circle-o"></i> Ubah Akun</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{site_url('auth/logout')}}"><i class="fa d-inline fa-lg fa-sign-out"></i> Logout</a>
          </div>
        </div>
      @endif

  </nav>  <br><br>
  <div class="mb-3"></div>
