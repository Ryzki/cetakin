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
        <form class="form-horizontal" action="{{site_url('petugas/pengaturan/update')}}" method="post">
        {{$csrf}}
        {{form_hidden('id', $data->id)}}
           
          <div class="form-group">
            <label for="status_dokumen" class="col-sm-2 control-label">Status Dokumen</label>
            <div class="col-sm-10">
              <select name="status_dokumen" class="form-control" id="status_dokumen">
                <option {{($data->status_dokumen == '1')?'selected':''}} value="1">Tersedia</option>
                <option {{($data->status_dokumen == '0')?'selected':''}} value="0">Tidak Tersedia</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="status_foto" class="col-sm-2 control-label">Status Foto</label>
            <div class="col-sm-10">
              <select name="status_foto" class="form-control" id="status_foto">
                <option {{($data->status_foto == '1')?'selected':''}} value="1">Tersedia</option>
                <option {{($data->status_foto == '0')?'selected':''}} value="0">Tidak Tersedia</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="status_percetakan" class="col-sm-2 control-label">Status Percetakan</label>
            <div class="col-sm-10">
              <select name="status_percetakan" class="form-control" id="status_percetakan">
                <option {{($data->status_percetakan == '1')?'selected':''}} value="1">Buka</option>
                <option {{($data->status_percetakan == '0')?'selected':''}} value="0">Tutup</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Ubah</button> 
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection