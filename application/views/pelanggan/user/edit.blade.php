@layout('_layout/pelanggan/index')

@section('title')Beranda@endsection

@section('content')

@include('_layout/pelanggan/user')

<div class="container-fluid py-4">
  <div class="row">
    @include('_layout/pelanggan/sidebar')
    <div class="col-md-9 p-3">
        <h1 style="margin-bottom: -4px" class="text-left display-5">Profil <b class="text-primary">Saya</b></h1>
        <hr class="text-dark border border-primary mx-0" style="width: 6%">
        <div class="row">
        	<div class="col-md-8">
        		<form action="{{site_url('pelanggan/homepage/update_profile')}}" method="post">
              {{$csrf}}
              {{form_hidden('id', $data->id)}}

    				  <div class="form-group row">
    				    <label for="first_name" class="col-lg-3 col-form-label">Nama</label>
    				    <div class="col-lg-9">
    				      <input name="first_name" type="text" class="form-control" id="first_name" placeholder=" Masukkan Nama" value="{{$data->first_name}}">
    				    </div>
    				  </div>
    				  <div class="form-group row">
    				    <label for="Phone" class="col-lg-3 col-form-label">Nomor Telepon</label>
    				    <div class="col-lg-9">
    				      <input name="phone" type="number" class="form-control" id="Phone" placeholder=" Masukkan Nomor Telepon" value="{{$data->phone}}">
    				    </div>
    				  </div>
    				  <div class="form-group row">
    				    <label for="alamat" class="col-lg-3 col-form-label">Alamat</label>
    				    <div class="col-lg-9">
    				      <textarea name="alamat" id="alamat" class="form-control" rows="5">{{$data->alamat}}</textarea>
    				    </div>
    				  </div>
    				  <div class="form-group row">
    				    <label for="alamat" class="col-lg-3 col-form-label"></label>
    				    <div class="col-lg-9">
    				      <button class="btn btn-primary" type="submit">Ubah Data</button>
    				    </div>
    				  </div>
    				</form>
        	</div>
        </div>
      </div>
  </div>
</div>
@endsection
