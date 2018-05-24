@layout('_layout/petugas/index')

@section('title')Data Percetakan@endsection

@section('content')
  <section class="content-header">
    <h1>
      Informasi Percetakan
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box"> 
      <div class="box-body">
        <form class="form-horizontal" action="" method="post">
          <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" value="lorem" id="nama" placeholder="Nama">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" value="lorem" id="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="no_telp" class="col-sm-2 control-label">Nomor Telp</label>
            <div class="col-sm-10">
              <input type="tel" name="no_telp" class="form-control" value="lorem" id="no_telp" placeholder="Nomor telp">
            </div>
          </div>
          <div class="form-group">
            <label for="foto" class="col-sm-2 control-label">foto</label>
            <div class="col-sm-10">
              <input type="tel" name="foto" class="form-control" value="lorem" id="no_telp" placeholder="Foto">
            </div>
          </div>
          <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea name="alamat" class="form-control" id="alamat">lorem</textarea>
            </div>
          </div> 
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Simpan</button>
              <a href="{{site_url('petugas/percetakan')}}" class="btn btn-primary">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection