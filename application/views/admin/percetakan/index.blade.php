@layout('_layout/admin/index')

@section('title')Data Percetakan@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Percetakan
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
        <li class="active">Data Percetakan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
              <a href="{{site_url('admin/percetakan/add')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
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
                      <option {{(isset($search_data['filter']) && $search_data['filter'] == 'nama')?'selected':''}} value="nama">Nama</option>
                      <option {{(isset($search_data['filter']) && $search_data['filter'] == 'email_percetakan')?'selected':''}} value="email_percetakan">Email</option>
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
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Nomor Telp</th>
                  <th>Status Verifikasi</th>
                  <th>Aksi</th>
                </thead>

                <?php if(empty($tampildata)): ?>
                    <tr>
                        <td colspan="6" align="center">Tidak ada Data</td>
                    </tr>
                <?php else: ?>
                    <?php $start+= 1 ?>
                @foreach($tampildata as $row)
                <tr>
                  <td>{{$start++}}</td>
                  <td>{{$row->nama}}</td>
                  <td>{{$row->email_percetakan}}</td>
                  <td>{{$row->phone_percetakan}}</td>
                  <td>
                    {{($row->status_verifikasi == '0')?'<span class="label label-warning">Belum Diverifikasi</span>':''}}
                    {{($row->status_verifikasi == '1')?'<span class="label label-primary">Diverifikasi</span>':''}}
                    {{($row->status_verifikasi == '2')?'<span class="label label-danger">Ditolak</span>':''}}
                  </td>
                  <td>
                        <a href="{{site_url('admin/percetakan/view/'.$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                        <a href="{{site_url('admin/percetakan/edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <a href="{{site_url('admin/percetakan/delete/'.$row->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                      </td>
                </tr>
                @endforeach
                <?php endif ?> 
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