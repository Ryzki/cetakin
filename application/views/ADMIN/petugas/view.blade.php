@layout('_layout/admin/index')

@section('title') Data Petugas@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Petugas
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/petugas')}}"><i class="fa fa-list-alt"></i> Data Petugas</a></li>
      <li class="active">Lihat Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <a href="{{site_url('admin/petugas')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
      <div class="box-body">
        
        <div class="row">
          <div class="col-lg-4 col-xs-12">
            <table class="table table-striped">
              <h4 class="text-center">Data Petugas</h4>
              <tr>
                <td>Nama</td>
                <td>{{$data->relasiuser->first_name}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{$data->relasiuser->email}}</td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td>{{$data->relasiuser->phone}}</td>
              </tr>
              <tr>
                <td>Status Akun</td>
                <td>{{($data->relasiuser->active == '0')?'Belum Aktif':'Aktif'}}</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <a href="" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"> Non Aktifkan</a>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-lg-4 col-xs-12">
            <table class="table table-striped">
              <h4 class="text-center">Data Percetakan</h4>
              <tr>
                <td>Nama Percetakan</td>
                <td>{{$data->relasipercetakan->nama}}</td>
              </tr>
              <tr>
                <td>Status Verifikasi</td>
                <td>
                  {{($data->relasipercetakan->status_verifikasi == '0')?'Belum Diverifikasi':''}}
                  {{($data->relasipercetakan->status_verifikasi == '1')?'Diverifikasi':''}}
                  {{($data->relasipercetakan->status_verifikasi == '2')?'Ditolak':''}}
                </td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <a href="" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"> Hapus Verifikasi</a>
                </td>
              </tr>
            </table>
          </div>
          <h4 class="text-center">Foto Percetakan</h4>
          <div class="col-lg-4 col-xs-12">
            <img class="img-responsive" src="{{site_url('uploads/percetakan/'.$data->relasipercetakan->foto)}}">
          </div>
        </div>     
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection