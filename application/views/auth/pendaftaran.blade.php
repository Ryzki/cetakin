@layout('_layout/pelanggan/index')

@section('title')Pendaftaran@endsection

@section('style')
<style>
.bg {
    background-image: url(<?php echo site_url('assets/image/bg-regis.jpg');?>);

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
</style> 
@endsection

@section('content')
<div class="bg">
  <div class="text-center opaque-overlay bg-primary" style="opacity: 0.9;">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-12 text-white" align="center">
          <h1 style="margin-bottom: -4px" class="text-center text-left display-5">Pendaftaran  <b class="text-white">Pelanggan Cetakin</b></h1>
          <hr class="text-dark border border-white mx-0" style="width: 6%">
        </div>
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
        <div class="col-md-6 col-lg-6 offset-3 mb-2">
          <div class="card bg-light" style="opacity: 1">
            <div class="card-body">
              <form action="{{site_url('auth/create_user')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />

                <div class="form-group row">
                  <label for="first_name" class="col-lg-4 col-form-label">Nama</label>
                  <div class="col-lg-8">
                    <?php echo form_input($first_name);?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone" class="col-lg-4 col-form-label">Nomor Telepon</label>
                  <div class="col-lg-8">
                    <?php echo form_input($phone);?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-lg-4 col-form-label">Email</label>
                  <div class="col-lg-8">
                    <?php echo form_input($email);?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-lg-4 col-form-label">Password</label>
                  <div class="col-lg-8">
                    <?php echo form_input($password);?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="reenter_password" class="col-lg-4 col-form-label">Ulangi Password</label>
                  <div class="col-lg-8">
                    <?php echo form_input($password_confirm);?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="reenter_password" class="col-lg-4 col-form-label"> </label>
                  <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Daftar</button>
                  </div>
                  <div class="col-lg-12">
                  <br>
                  Sudah punya akun? silahkan
                  <a href="{{site_url('percetakan/pendaftaran')}}">Masuk</a>
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
