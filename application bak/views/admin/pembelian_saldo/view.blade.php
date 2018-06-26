@layout('_layout/admin/index')

@section('title') Data Pembelian Saldo@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pembelian Saldo
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/pembelian_saldo')}}"><i class="fa fa-list-alt"></i> Data Pembelian Saldo</a></li>
      <li class="active">Lihat Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <a href="{{site_url('admin/pembelian_saldo')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
      <div class="box-body">
        
        <div class="row">
          <div class="col-md-5">
            <table class="table table-striped">
              <tr>
                <td>Nama</td>
                <td>{{$data->idusers}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{$data->nama_rekening}}</td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td>{{$data->jumlah_transfer}}</td>
              </tr>
              <tr>
                <td>Status</td>
                <td>{{$data->status}}</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <a href="" class="btn btn-success" onclick="return confirm('apakah anda yakin')"> Konfirmasi</a>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-5">
            <div class="box-header with-border">
              <h3 class="text-center">Bukti Transfer</h3>
            </div>
          </div>
        </div>     
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection