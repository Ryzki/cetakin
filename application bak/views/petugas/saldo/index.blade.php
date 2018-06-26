@layout('_layout/petugas/index')

@section('title')Data Saldo Percetakan@endsection

@section('content') 
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
              <h1>Saldo Percetakan<b class="text-primary"></b></h1>
            <p style="font-size: 18px">Jumlah Saldo <span class="label label-success">{{rupiah($total_saldo)}}</span></p>
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
              <th>Tanggal / Deskripsi</th>
              <th>Nominal</th>
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
                  <td>{{dateFormat(3, $row->created_at)}} <br> {{$row->keterangan}}</td>
                  <td>{{rupiah($row->nominal)}}</td>
                  <td>
                    {{($row->status == '0')?'<span class="label label-primary">Pemasukan</span>':''}}
                    {{($row->status == '1')?'<span class="label label-warning">Pengeluaran</span>':''}}
                  </td>
                  <td>
                    <a href="{{site_url('petugas/pesanan_dokumen/view/'.$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Detail</a>
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
