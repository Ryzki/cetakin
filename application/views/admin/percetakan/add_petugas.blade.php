@layout('_layout/admin/index')

@section('title')Data Petugas@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data Petugas
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
        <li><a href="{{site_url('admin/percetakan')}}"><i class="fa fa-list-alt"></i> Data Percetakan</a></li>
        <li><a href=""><i class="fa fa-list-alt"></i> Lihat Data</a></li>
        <li class="active">Tambah Data Petugas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
      <div class="box-header with-border">
      <a href="{{site_url('admin/percetakan')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> kembali</a>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6 col-lg-12">
              <!-- form alert -->
              @if (!empty(validation_errors()))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><strong>Peringatan</strong></h4>
                <p>{{validation_errors()}}</p>
              </div>
              @endif
            </div>
            <!-- end form alert -->
          </div>
          <form class="form-horizontal" action="{{site_url('admin/percetakan/save_petugas')}}" method="post">
          {{$csrf}}
          {{form_hidden('group_id', '2');}}
          {{form_hidden('percetakan_id', $this->uri->segment(4));}}
          
            <div class="form-group">
              <label for="first_name" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" name="first_name" class="form-control" value="{{set_value('first_name')}}" id="first_name" placeholder="Nama">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" value="{{set_value('email')}}" id="email" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="phone" class="col-sm-2 control-label">Nomor Telp</label>
              <div class="col-sm-10">
                <input type="tel" name="phone" class="form-control" value="{{set_value('phone')}}" id="phone" placeholder="Nomor telp">
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" value="{{set_value('password')}}" id="password" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label for="reenter_password" class="col-sm-2 control-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" name="reenter_password" class="form-control" value="{{set_value('reenter_password')}}" id="reenter_password" placeholder="Konfirmasi Password">
              </div>
            </div>
              <div class="col-sm-offset-2 col-sm-10">
                <a href="" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
              </div>
          </form>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection