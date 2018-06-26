@layout('_layout/petugas/index')

@section('title')Data Pesanan Dokumen@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pesanan Dokumen
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-shopping-bag"></i> &nbsp Kelola Pesanan</li>
        <li class="active">Pesanan Dokumen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box container">
               <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
              <a href="{{site_url('petugas/pesanan_dokumen/add')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="box-header hee_hidden">
                <!--{{$pagination}}-->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <div class="box-header with-border">
              <form class="form-inline">
                <div class="form-group">
                  <div class="input-group input-group-sm">
                          <select class="form-control input-group-btn" name="" id="">
                            <option>-- Urutkan berdasarkan --</option>
                            <option value="">Nama</option>
                            <option value="">Email</option>
                          </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="box-header with-border">
              <form class="form-inline pull-right">
                <div class="form-group">
                  <div class="input-group input-group-sm">
                          <select class="form-control input-group-btn" name="" id="">
                            <option>-- Cari data berdasarkan --</option>
                            <option value="">Nama</option>
                            <option value="">Email</option>
                          </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari!</button>
                        </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div> <!-- row -->
        <br>
        <div class="box-body">
          <table class="table table-hover table-striped">
                <thead>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Kode Cetak</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </thead>
                <!-- cek isi data -->
                <?php if(empty($tampildata)): ?>
                    <tr>
                        <td colspan="6" align="center">Tidak ada Data</td>
                    </tr>
                <?php else: ?>
                    <?php $start+= 1 ?>
                    @foreach($tampildata as $row)
                    <tr>
                      <td>{{$start++}}</td>
                      <td>{{$row->relasiuser->first_name}}</td>
                      <td>{{$row->kode_cetak}}</td>
                      <td>{{dateFormat(3, $row->created_at)}}</td>
                      <td>
                        {{($row->status == '0')?'<span class="label label-warning">Belum di Proses</span>':''}}
                        {{($row->status == '1')?'<span class="label label-primary">Sedang Diproses</span>':''}}
                        {{($row->status == '2')?'<span class="label label-success">Selesai</span>':''}}
                        {{($row->status == '3')?'<span class="label label-danger">Ditolak</span>':''}}
                        {{($row->status == '4')?'<span class="label label-info">Dibatalkan</span>':''}}
                      </td>
                      <td>
                        <a href="{{site_url('petugas/pesanan_dokumen/view/'.$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                      </td>
                    </tr>
                    @endforeach
                <?php endif ?> <!-- end cek -->
              </table>
        </div>
        <div class="box-footer clearfix">
           {{$pagination}}
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
