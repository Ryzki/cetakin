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
          <p>{{$user->first_name}}</p>
          <a href=""><i class="fa fa-circle text-success"></i> Admin Cetakin</a>
        </div>
      </div>
      <br><br>

      <?php $page = $this->uri->segment(2); ?>
      <?php $subPage = $this->uri->segment(3); ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li {{($page=='' || $page=='homepage')?'class="active"':''}} ><a href="{{site_url('admin/homepage')}}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li> 
        <li {{($page=='pembelian_saldo')?'class="active"':''}} ><a href="{{site_url('admin/pembelian_saldo')}}"><i class="fa fa-credit-card-alt"></i> <span>Konfirmasi Pembelian Saldo</span></a></li>
        <li class="treeview {{($page=='penarikan')?'active':''}} ">
          <a href="">
            <i class="fa fa-money"></i> <span>Penarikan Saldo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{($subPage=='pelanggan')?'class="active"':''}}><a href="{{site_url('admin/penarikan_saldo/pelanggan')}}"><i class="fa fa-list-alt"></i> Pelanggan</a></li>
            <li {{($subPage=='percetakan')?'class="active"':''}}><a href="{{site_url('admin/penarikan_saldo/percetakan')}}"><i class="fa fa-list-alt"></i> Percetakan</a></li> 
          </ul>
        </li>
        <li class="treeview {{($page=='user' || $page=='percetakan')?'active':''}} ">
          <a href="">
            <i class="fa fa-book"></i> <span>Kelola Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{($page=='user')?'class="active"':''}}><a href="{{site_url('admin/user')}}"><i class="fa fa-list-alt"></i> Data Pelanggan</a></li>
            <li {{($page=='percetakan')?'class="active"':''}}><a href="{{site_url('admin/percetakan')}}"><i class="fa fa-list-alt"></i> Data Percetakan</a></li>
            <li><a href="{{site_url('admin/sdk')}}"><i class="fa fa-bookmark"></i> Syarat dan Ketentuan</a></li>
          </ul>
        </li> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
