@layout('_layout/admin/index')

@section('title') Data User@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pelanggan
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/user')}}"><i class="fa fa-list-alt"></i> Data Pelanggan</a></li>
      <li class="active">Edit Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      <a href="{{site_url('admin/user')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
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
        <form class="form-horizontal" action="{{site_url('admin/user/update')}}" method="post">
        {{$csrf}}
        {{form_hidden('id', $data->id);}}
          <div class="form-group">
            <label for="first_name" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="first_name" class="form-control" value="{{$data->first_name}}" id="first_name" placeholder="Nama">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" value="{{$data->email}}" id="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" value="{{$data->password}}" id="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Nomor Telp</label>
            <div class="col-sm-10">
              <input type="tel" name="phone" class="form-control" value="{{$data->phone}}" id="phone" placeholder="Nomor telp">
            </div>
          </div>
          <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea name="alamat" class="form-control" id="alamat">{{$data->alamat}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="active" class="col-sm-2 control-label">Status Akun</label>
            <div class="col-sm-10">
              <select name="active" class="form-control" id="active">
                <option {{($data->active == '0')?'selected':''}} value="0">Non Aktif</option>
                <option {{($data->active == '1')?'selected':''}} value="1">Aktif</option> 
              </select>
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