<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cetakin | Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="{{base_url()}}assets/pelanggan/css/theme.css" type="text/css">
  <style>
    body {
      background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          background-image: url({{base_url('assets/image/bg-login.jpg')}});
    }
  </style>
<body>

  <div class="py-5 text-white opaque-overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 bg-primary" style="opacity: 0.8; padding: 12px; border-radius: 25px;">
          <div align="center" class="mb-2 mt-3">
            <a href="{{site_url()}}"><img src="{{base_url('assets/image/logo.png')}}" width="200"  class="d-inline-block align-top" alt=""></a>
            <p align="center" class="pt-2">Silahkan masuk menggunakan akun kamu</p>
          </div>

          <?php if ($message): ?>

          @if ($message[0] == '<')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Peringatan!</strong><br> <?php echo $message; ?>
            </div>
          @else
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <strong>Informasi</strong><br> <?php echo $message[0]; ?>
            </div>
          @endif
          <?php endif ?>
          <form class="" method="post" action="{{site_url('auth/login')}}">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="form-group"> <label>Email</label>
              <?php echo form_input($identity);?>
            </div>
            <div class="form-group"> <label>Password</label>
              <?php echo form_input($password);?>
            </div>
            <button type="submit" class="btn btn-info "><i class="fa fa-paper-plane"></i> Masuk</button>
            <button type="submit" class="btn btn-warning">Lupa Password <i class="fa fa-question"></i></button>
            <br><br>
            <p>Belum memiliki akun? <a class="btn btn-secondary" href="{{site_url('auth/create_user')}}">Daftar Sekarang!</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
