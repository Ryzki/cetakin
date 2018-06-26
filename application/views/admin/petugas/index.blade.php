@layout('_layout/admin/index')

@section('title')Data Petugas@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Petugas
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
        <li class="active">Data Petugas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
              <a href="{{site_url('admin/petugas/add')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="box-header hee_hidden">
                {{$pagination}}    
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
        <div class="box-body table-responsive">
          <table class="table table-hover table-striped">
                <thead>
                  <th>No.</th>
                  <th>Nama Petugas</th>
                  <th>Status Akun</th>
                  <th>Nama Percetakan</th>
                  <th>Status Verifikasi</th>
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
                      <td>{{($row->relasiuser->active == '0')?'Belum Aktif':'Aktif'}}</td>
                      <td>{{$row->relasipercetakan->nama}}</td>
                      <td>
                        {{($row->relasipercetakan->status_verifikasi == '0')?'Belum Diverifikasi':''}}
                        {{($row->relasipercetakan->status_verifikasi == '1')?'Diverifikasi':''}}
                        {{($row->relasipercetakan->status_verifikasi == '2')?'Ditolak':''}}
                      </td>
                      <td>
                        <a href="{{site_url('admin/petugas/view/'.$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                        <a href="{{site_url('admin/petugas/edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <a href="{{site_url('admin/petugas/delete/'.$row->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
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