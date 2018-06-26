@layout('_layout/petugas/index')

@section('title')Data Info Harga Cetak Dokumen@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Info Harga Cetak Dokumen
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Info Harga</li>
        <li class="active">Cetak Dokumen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
              <a href="{{site_url('petugas/info_harga/dokumen_add')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="box-header hee_hidden">
                {{$pagination}}    
            </div>
          </div>
        </div>
        <form class="form-inline" action="{{site_url('petugas/'.$page.'/dokumen_search')}}" method="get">
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
                  <th>Klasifikasi</th>
                  <th style="width: 25%">Nama</th>
                  <th>Harga</th>
                  <th>Satuan</th>
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
                      <td>{{$row->klasifikasi->nama}}</td>
                      <td>{{$row->nama}}</td>
                      <td>{{rupiah($row->harga)}}</td>
                      <td>{{$row->satuan}}</td>
                      <td> 
                        <a href="{{site_url('petugas/info_harga/dokumen_edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <a href="{{site_url('petugas/info_harga/dokumen_delete/'.$row->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
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