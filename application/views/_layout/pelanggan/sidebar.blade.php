<?php $page = $this->uri->segment(2); ?>

<div class="col-md-3 p-2">
  <ul class="list-group border border-primary">
    <a href="{{site_url('pelanggan/pesanan')}}" class="list-group-item list-group-item-action {{($page == 'pesanan')?'active':''}}"><i class="fa fa-fw fa-list-alt"></i> Daftar Pesanan</a>
    <a href="{{site_url('pelanggan/saldo_user')}}" class="list-group-item list-group-item-action {{($page == 'saldo_user')?'active':''}}"><i class="fa fa-fw fa-money"></i> Lihat Saldo</a>
    <a href="{{site_url('pelanggan')}}" class="list-group-item list-group-item-action {{($page == '')?'active':''}}"><i class="fa fa-fw fa-user-circle-o"></i> Profil Saya</a>
    <a href="{{site_url('pelanggan/change_password')}}" class="list-group-item list-group-item-action {{($page == 'change_password')?'active':''}}"><i class="fa fa-fw fa-lock"></i> Ubah Password</a>
    <a href="{{site_url('pelanggan/change_email')}}" class="list-group-item list-group-item-action {{($page == 'change_email')?'active':''}}"><i class="fa fa-inbox"></i> Ubah Email</a>
    <a href="{{site_url('auth/logout')}}" class="list-group-item list-group-item-action"><i class="fa fa-fw fa-sign-out"></i> Keluar</a>
  </ul>
</div>
