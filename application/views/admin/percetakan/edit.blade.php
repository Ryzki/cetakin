@layout('_layout/admin/index')

@section('title') Data Percetakan@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pelanggan
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/percetakan')}}"><i class="fa fa-list-alt"></i> Data Percetakan</a></li>
      <li class="active">Edit Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      <a href="{{site_url('admin/percetakan')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-lg-6 col-lg-12">
            <!-- form alert -->
            @if (!empty(validation_errors()))
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dilgiss="alert" aria-hidden="true">x</button>
              <h4><strong>Peringatan</strong></h4>
              <p>{{validation_errors()}}</p>
            </div>
            @endif
          </div>
          <!-- end form alert -->
        </div>
        <form class="form-horizontal" action="{{site_url('admin/percetakan/update')}}" method="post" enctype="multipart/form-data">
        {{$csrf}}
        {{form_hidden('id', $data->id);}}
          <div class="form-group">
            <label for="nama" class="col-lg-2 control-label">Nama Percetakan</label>
            <div class="col-lg-10">
              <input type="text" name="nama" class="form-control" value="{{$data->nama}}" id="nama" placeholder="Nama Percetakan">
            </div>
          </div>
          <div class="form-group">
            <label for="email_percetakan" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
              <input type="email" name="email_percetakan" class="form-control" value="{{$data->email_percetakan}}" id="email_percetakan" placeholder="Email Percetakan">
            </div>
          </div>
          <div class="form-group">
            <label for="phone_percetakan" class="col-lg-2 control-label">Telp. Percetakan</label>
            <div class="col-lg-10">
              <input type="tel" name="phone_percetakan" class="form-control" value="{{$data->phone_percetakan}}" id="phone_percetakan" placeholder="Nomor telepon">
            </div>
          </div>
          <div class="form-group">
            <label for="foto" class="col-lg-2 control-label">foto</label>
            <div class="col-lg-10">
              <img src="{{base_url('uploads/percetakan/'.$data->foto)}}" alt="" class="img-responsive img-fluid" width="10%">
              <input type="file" name="foto" id="foto" placeholder="Foto">
            </div>
          </div>
          <div class="form-group">
            <label for="alamat" class="col-lg-2 control-label">Alamat</label>
            <div class="col-lg-10">
              <textarea name="alamat" class="form-control" id="alamat">{{$data->alamat}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="status_verifikasi" class="col-lg-2 control-label">Status Verifikasi</label>
            <div class="col-lg-10">
              <select name="status_verifikasi" class="form-control" id="status_verifikasi">
                <option {{($data->status_verifikasi == '0')?'selected':''}} value="0">Belum Verifikasi</option>
                <option {{($data->status_verifikasi == '1')?'selected':''}} value="1">Verifikasi</option> 
                <option {{($data->status_verifikasi == '2')?'selected':''}} value="2">Tolak</option> 
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
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