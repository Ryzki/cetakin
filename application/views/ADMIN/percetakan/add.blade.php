@layout('_layout/admin/index')

@section('title') Data percetakan@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data percetakan
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
      <div class="box-header with-border">
      <h3>Tambah Data</h3>
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
          <form class="form-horizontal" action="{{site_url('admin/percetakan/save')}}" method="post">
          {{$csrf}}
          {{form_hidden('group_id', '2');}}
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" value="{{set_value('nama')}}" id="nama" placeholder="Nama">
              </div>
            </div>
            <div class="form-group">
              <label for="email_percetakan" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="email_percetakan" class="form-control" value="{{set_value('email_percetakan')}}" id="email_percetakan" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="foto" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input type="text" name="foto" class="form-control" value="{{set_value('foto')}}" id="foto" placeholder="foto">
              </div>
            </div>
            <div class="form-group">
              <label for="phone_percetakan" class="col-sm-2 control-label">Nomor Telp</label>
              <div class="col-sm-10">
                <input type="tel" name="phone_percetakan" class="form-control" value="{{set_value('phone_percetakan')}}" id="phone_percetakan" placeholder="Nomor telp">
              </div>
            </div>
              <div class="form-group">
              <label for="alamat" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea name="alamat" class="form-control" id="alamat">{{set_value('alamat')}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection