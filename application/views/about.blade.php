@layout('_layout/pelanggan/index')

@section('title')Tantang Kami @endsection

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
<div class="">
  <div class="opaque-overlay"> 
      <div class="row ">
        <div class="col-md-5 text-white bg">
          <div class="bg-primary " style="padding-top: 150px; padding-bottom: 70%; opacity: 0.9; margin-right: -15px; padding-left: 40px">
              <h1 style="margin-bottom: -4px" class="text-left display-5">Tentang <b class="text-white">Cetakin</b></h1>
              <hr class="text-dark border border-white mx-0" style="width: 6%"> 
          </div>  
        </div>
        <div class="col-md-7 bg-white py-5">
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio inventore consequuntur ab officiis, facilis, vel culpa omnis dolore, ex voluptatem officia cupiditate quod incidunt corporis vero laborum corrupti. Laudantium, reprehenderit.</p>
          <p>Untuk meningkatkan kualitas aplikasi cetakin, silahkan berikan kritik dan saran kamu!  </p>
        </div>
      </div> 
  </div>
</div>
 
@endsection  
