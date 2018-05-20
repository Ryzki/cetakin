@layout('_layout/petugas/index')

@section('title')Data Pesanan Foto@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pesanan Foto
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
      <div class="box-header with-border">
        <a href="" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
      </div>
        <div class="box-body">
          <table class="table table-hover table-striped">
                <thead>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Kode Pengambilan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </thead>
                
                <tr>
                  <td>1</td>
                  <td>lorem</td>
                  <td>lorem</td>
                  <td>belum diproses</td>
                  <td>
                    <a href="" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                    <a href="" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                  </td>
                </tr>
                
              </table>
        </div>
        <div class="box-footer clearfix">
           
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection