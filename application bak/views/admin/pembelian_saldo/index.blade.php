@layout('_layout/admin/index')

@section('title')Data Pembelian Saldo@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pembelian Saldo
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
        <li class="active">Data Pembelian Saldo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="box-header hee_hidden">
                {{$pagination}}    
            </div>
          </div>
        </div>
        <form class="form-inline" action="{{site_url('admin/'.$page.'/search')}}" method="get">
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <div class="box-header with-border">              
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <select class="form-control input-group-btn" name="sort" id="" onchange="this.form.submit();">
                      <option value="">-- Urutkan berdasarkan --</option>
                      <option {{(isset($search_data['sort'])&& $search_data['sort'] == '1')?'selected':''}} value="1">Nama - A-Z</option>
                      <option {{(isset($search_data['sort'])&& $search_data['sort'] == '2')?'selected':''}} value="2">Nama - Z-A</option>
                    </select>
                  </div>
                </div> 
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="box-header with-border pull-right"> 
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <select class="form-control input-group-btn" name="filter" id="" required>
                      <option value="">-- Cari data berdasarkan --</option>
                      <option {{(isset($search_data['filter']) && $search_data['filter'] == 'first_name')?'selected':''}} value="first_name">Nama</option>
                      <option {{(isset($search_data['filter']) && $search_data['filter'] == 'email')?'selected':''}} value="email">Email</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <input value="{{(isset($search_data['keyword']))?$search_data['keyword']:''}}" type="text" class="form-control" name="keyword">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari!</button>
                        </span>
                  </div>
                </div>
            </div>
          </div>
        </div> <!-- row -->
        </form>
        <br>
        <div class="box-body table-responsive">
          <table class="table table-hover table-striped">
                <thead>
                  <th>No.</th>
                  <th>Nama Rekening</th>
                  <th>Nomor Rekening</th>
                  <th>Jumlah Nominal</th>
                  <th>Bukti</th>
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
                      <td>{{$start++}}. </td>
                      <td>{{$row->nama_rek}}</td>
                      <td>{{$row->no_rek}}</td>
                      <td>{{rupiah($row->saldo_user->nominal)}}</td>
                      <td> <a target="_blank" href="{{site_url('uploads/bukti_tf/'.$row->foto)}}" class="btn btn-primary">Lihat</a></td>
                      <td>
                          {{($row->saldo_user->status == '0')?'<span class="label label-primary">Telah Dikonfirmsi</span>':''}}
                          {{($row->saldo_user->status == '1')?'<span class="label label-primary">Telah Dikonfirmsi</span>':''}}
                          {{($row->saldo_user->status == '3')?'<span class=" label label-warning"> Belum Dikonfirmasi</span>':''}}
                          {{($row->saldo_user->status == '4')?'<span class="label label-danger">Ditolak</span>':''}}
                      </td>
                      <td>
                        @if ($row->saldo_user->status == '3')
                          <a href="{{site_url('admin/pembelian_saldo/verifikasi/'.$row->saldo_user->id)}}" class="btn btn-primary" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Konfirmasi</a> 
                          <a href="{{site_url('admin/pembelian_saldo/tolak/'.$row->saldo_user->id)}}" class="btn btn-danger" onclick="return confirm('apakah anda yakin')"><i class="fa fa-ban"></i> Tolak</a> 
                        @else
                          <a href="{{site_url('admin/pembelian_saldo/unverifikasi/'.$row->saldo_user->id)}}" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Batalkan Konfirmasi</a> 
                        @endif
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