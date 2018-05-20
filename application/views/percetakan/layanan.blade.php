@layout('_layout/pelanggan/index')

@section('title')Pilih Layanan@endsection

@section('content')
  <div class="py-5">
    <div class="container">
      <h1 class="text-center"><b>Mau Cetak Apa Hari ini?</b></h1>
      <hr align="center" style="width: 20%">
      <div class="row text-center mt-4">
        <div class="col-md-6">
            <div class="center" onclick="window.location.href='{{site_url('percetakan/daftar/dokumen')}}'">
              <img class="img-fluid image-hover" width="200" src="{{site_url('assets/image/dokumen.png')}}" alt="Card image cap">
            </div>
            <div class="card-body">
              <h5 class="card-title">Dokumen</h5>
              <a href="{{site_url('percetakan/daftar/dokumen')}}" class="btn btn-primary">Lihat Daftar Percetakan Dokumen</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="center" onclick="window.location.href='{{site_url('percetakan/daftar/foto')}}'">
              <img class="img-fluid image-hover" width="200" src="{{site_url('assets/image/foto.png')}}" alt="Card image cap">
            </div>
            <div class="card-body">
              <h5 class="card-title">Foto</h5>
              <a href="{{site_url('percetakan/daftar/foto')}}" class="btn btn-primary">Lihat Daftar Percetakan Foto</a>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
