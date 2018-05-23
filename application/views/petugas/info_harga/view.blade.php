@layout('_layout/petugas/index')

@section('title') Data Info Harga Cetak Dokumen@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Info Harga Cetak Dokumen
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Info Harga</li>
      <li><a href="{{site_url('petugas/info_harga/dokumen')}}"><i class="fa fa-list-alt"></i> Cetak Dokumen</a></li>
      <li class="active">Lihat Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <a href="{{site_url('petugas/info_harga/dokumen')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
      <div class="box-body">
        
        <div class="row">
          <div class="col-md-5">
            <table class="table table-striped">
              <tr>
                <td>Nama</td>
                <td>{{$data->nama}}</td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>{{$data->harga}}</td>
              </tr>
              <tr>
                <td>Satuan</td>
                <td>{{$data->satuan}}</td>
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