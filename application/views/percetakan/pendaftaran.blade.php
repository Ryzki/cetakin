@layout('_layout/pelanggan/index')

@section('title')Pendaftaran Percetakan@endsection

@section('content')
<div class="text-center opaque-overlay bg-primary">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-12 text-white">
          <h1 style="margin-bottom: -4px" class="text-left display-5">Pendaftaran  <b class="text-white">Percetakan</b></h1>
          <hr class="text-dark border border-white mx-0" style="width: 6%"> 
        </div>
      </div>
    </div>
  </div>
  <div class="py-3">
    <div class="container">
      
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
      <div class="row">
        <div class="col-md-12 mb-2">
          <div class="card bg-light">
            <div class="card-body">
              <form action="{{site_url('percetakan/save')}}" method="post" enctype="multipart/form-data">
                {{$csrf}}

                <h3 class="mb-3">Identitas Percetakan</h3>
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Percetakan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama">
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="email_percetakan" class="col-sm-2 col-form-label">Email Percetakan</label>
                  <div class="col-sm-10">
                    <input type="email" name="email_percetakan" class="form-control" id="email_percetakan">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone_percetakan" class="col-sm-2 col-form-label">Nomor Telepon</label>
                  <div class="col-sm-10">
                    <input type="tel" name="phone_percetakan" class="form-control" id="phone_percetakan">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                  </div>
                </div>  
                <div class="form-group row">
                  <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                  <div class="col-sm-10">
                    <input type="file" name="foto" class="form-control-file" id="foto">
                  </div>
                </div>

                <h3 class="mb-3 mt-4">Untuk masuk ke Dashboard Percetakan</h3>
                <div class="form-group row">
                  <label for="first_name" class="col-sm-2 col-form-label">Nama Petugas</label>
                  <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" id="first_name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                  <div class="col-sm-10">
                    <input type="tel" name="phone" class="form-control" id="phone">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Email petugas ini digunakan untuk Login</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password">
                  </div>
                </div>  
                <div class="form-group row">
                  <label for="reenter_password" class="col-sm-2 col-form-label">Ulangi Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="reenter_password" class="form-control" id="reenter_password">
                  </div>
                </div>  
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>  

      </div>
    </div>
  </div>
@endsection