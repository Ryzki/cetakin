  <?php $user = $this->ion_auth->user()->row(); ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{base_url()}}assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><b>{{$user->first_name}}</b></p>
          <span>Admin Percetakan</span>
        </div>
      </div>
      <br><br>

      <?php $page = $this->uri->segment(2); ?>
      <?php $sub_page = $this->uri->segment(3); ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li {{($page=='homepage')?'class="active"':''}}><a href="{{site_url('petugas/homepage')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="treeview {{($page=='pesanan_dokumen' || $page=='pesanan_foto')?'active':''}}">
          <a href="">
            <i class="fa fa-shopping-bag"></i> <span>Kelola Pesanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{($page=='pesanan_dokumen')?'class="active"':''}}><a href="{{site_url('petugas/pesanan_dokumen')}}"><i class="fa fa-file"></i> Dokumen</a></li>
            <li {{($page=='pesanan_foto')?'class="active"':''}}><a href="{{site_url('petugas/pesanan_foto')}}"><i class="fa fa-file-image-o"></i> Foto</a></li>
          </ul>
        </li>
        <li class="treeview {{($page=='info_harga' || $page=='foto')?'active':''}}">
          <a href="">
            <i class="fa fa-info-circle"></i> <span>Kelola Info Harga</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{($sub_page=='dokumen')?'class="active"':''}}><a href="{{site_url('petugas/info_harga/dokumen')}}"><i class="fa fa-file"></i> Cetak Dokumen</a></li>
            <li {{($sub_page=='foto')?'class="active"':''}}><a href="{{site_url('petugas/info_harga/foto')}}"><i class="fa fa-file-image-o"></i> Cetak Foto</a></li>
          </ul>
        </li>
        <li><a href=""><i class="fa fa-home"></i> <span>Kelola Data Percetakan</span></a></li>
        <li><a href=""><i class="fa fa-credit-card-alt"></i> <span>Lihat Saldo</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
