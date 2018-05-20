@layout('_layout/pelanggan/index')

@section('title')Daftar Percetakan@endsection

@section('content')
<div class="text-center opaque-overlay bg-light">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-12 text-dark">
          <h1 style="margin-bottom: -4px" class="text-left display-5">Daftar Percetakan <b class="text-primary">{{($jenis == 'dokumen')?'Dokumen':'Foto'}}</b></h1>
          <hr class="text-dark border border-primary mx-0" style="width: 6%">
        </div>
      </div>
    </div>
  </div>
  <div class="py-3">
    <div class="container">
      <div class="row">

        @foreach ($data as $value)
        <div class="col-md-6 mb-2 card-hover">
          <div class="card" style="display: flex; cursor: pointer;" onclick="window.location.href='{{site_url('percetakan/detail/'.$value->id.'/'.$value->slug)}}'">
            <div class="row no-gutters">
              <div class="col-md-6">
                <img style="max-width: 265px; max-height: 265px;" class="card-img-top img-fluid img-responsive" src="{{base_url('uploads/percetakan/'.$value->foto)}}" width="300" alt="Card image cap">
              </div>
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title"><strong>{{$value->nama}}</strong></h5>
                  <p class="card-text">
                    <span class="badge badge-primary">Buka</span> <br><br>
                    <i class="fa fa-map-marker text-primary"></i> Kabat, Banyuwangi
                  </p>
                  <a href="{{site_url('percetakan/detail/'.$value->id.'/'.$value->slug)}}" class="btn btn-primary btn-block btn-sm">Kunjungi</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
@endsection
