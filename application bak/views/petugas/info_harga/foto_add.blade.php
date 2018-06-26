@layout('_layout/petugas/index')

@section('title') Data Info Harga@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Info Harga</li>
        <li><a href="{{site_url('petugas/info_harga/foto')}}"><i class="fa fa-list-alt"></i> Cetak Foto</a></li>
        <li class="active">Tambah Data</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
      <div class="box-header with-border">
      <a href="{{site_url('petugas/info_harga/foto')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> kembali</a>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6 col-lg-12">
              <!-- form alert -->
              @if (!empty(validation_errors()))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><strong>Peringatan</strong></h4>
                <p>{{validation_errors()}}</p>
              </div>
              @endif
            </div>
            <!-- end form alert -->
          </div>
          <form class="form-horizontal" action="{{site_url('petugas/info_harga/foto_save')}}" method="post">
          {{$csrf}}

          {{form_hidden('idusers', '$data');}}
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" value="{{set_value('nama')}}" id="nama" placeholder="Nama">
              </div>
            </div>
            <div class="form-group">
              <label for="harga" class="col-sm-2 control-label">Harga</label>
              <div class="col-sm-10">
                <input type="number" name="harga" class="form-control" value="{{set_value('harga')}}" id="harga" placeholder="Harga">
              </div>
            </div>
            <div class="form-group">
              <label for="satuan" class="col-sm-2 control-label">Satuan</label>
              <div class="col-sm-10">
                <input type="text" name="satuan" class="form-control" value="{{set_value('satuan')}}" id="nama" placeholder="Satuan">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <a href="" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection