<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="manifest.json">

    <title>Cetakin | @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{base_url()}}assets/pelanggan/css/theme.css" type="text/css">
    @yield('style')
  </head>
  <style>
      .hover:focus, .hover:hover {
       box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
      }
      .row.no-gutters {
        margin-right: 0;
        margin-left: 0;

        & > [class^="col-"],
        & > [class*=" col-"] {
          padding-right: 0;
          padding-left: 0;
        }
      }

      .image-hover:hover{
        transform: scale(1.5);
        cursor: pointer;
        transition: transform .4s;
      }

      .card-hover:hover{
        transition: transform .2s;
        transform: scale(1.04);
        cursor: pointer;
      }
  </style>

  <body>
    @include('_layout/pelanggan/navbar')

    @yield('content')

    @yield('modal')

    @include('_layout/pelanggan/footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Sweet Alert-->
    <script src="{{base_url()}}assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <script>
      @if($this->session->userdata('message'))
        <?php $message = $this->session->userdata('message');?>
        function sweet(){
          swal("Informasi", "{{ $message[0] }}", "{{ $message[1] }}");
        }
        window.onload = sweet;
      @endif
    </script>

    @yield('script')

  </body>

</html>
