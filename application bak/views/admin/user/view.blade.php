@layout('_layout/admin/index')

@section('title') Data Pelanggan@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pelanggan
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/user')}}"><i class="fa fa-list-alt"></i> Data Pelanggan</a></li>
      <li class="active">Lihat Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <a href="{{site_url('admin/user')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
      <div class="box-body">
        
        <div class="row">
          <div class="col-md-5">
            <table class="table table-striped">
              <tr>
                <td>Nama</td>
                <td>{{$data->first_name}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{$data->email}}</td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td>{{$data->phone}}</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>{{$data->alamat}}</td>
              </tr>
              <tr>
                <td>Status Akun</td>
                <td>{{($data->active == '0')?'Tidak Aktif':'Aktif'}}</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <a href="" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"> Non Aktifkan</a>
                </td>
              </tr>
            </table>
          </div>
        </div>     
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection