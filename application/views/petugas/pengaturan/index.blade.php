@layout('_layout/petugas/index')

@section('title')Data Percetakan@endsection

@section('content')
  <section class="content-header">
    <h1>
      Pengaturan
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box"> 
      <div class="box-body">
        <form class="form-horizontal" action="" method="post">
           
          <div class="form-group">
            <label for="iduser" class="col-sm-2 control-label">Status Dokumen</label>
            <div class="col-sm-10">
              <select name="kategori" class="form-control" id="iduser">
                <option value="0">Tersedia</option>
                <option value="1">Tidak Tersedia</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="iduser" class="col-sm-2 control-label">Status Foto</label>
            <div class="col-sm-10">
              <select name="kategori" class="form-control" id="iduser">
                <option value="0">Tersedia</option>
                <option value="1">Tidak Tersedia</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="iduser" class="col-sm-2 control-label">Status Percetakan</label>
            <div class="col-sm-10">
              <select name="kategori" class="form-control" id="iduser">
                <option value="0">Buka</option>
                <option value="1">Tutup</option>
              </select>
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