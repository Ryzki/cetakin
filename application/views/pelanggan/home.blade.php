@layout('_layout/pelanggan/index')

@section('title')Beranda@endsection

@section('content')

@include('_layout/pelanggan/user') 

<div class="container-fluid py-4">
  <div class="row">
    @include('_layout/pelanggan/sidebar') 
    <div class="col-md-9 p-3">
        <h1 style="margin-bottom: -4px" class="text-left display-5">Daftar <b class="text-primary">Pesanan</b></h1>
        <hr class="text-dark border border-primary mx-0" style="width: 6%"> 
        <table class="table table-hover table-striped table-bordered">
          <thead class="thead-inverse">
            <tr>
              <th>No.</th>
              <th>Nama Percetakan</th>
              <th>Kode Pengambilan</th>
              <th>Status Pesanan</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <?php if(empty($tampildata)): ?>
              <tr>
                  <td colspan="6" align="center">Tidak ada Data</td>
              </tr>
          <?php else: ?>
          @foreach($tampildata as $row)
          <tbody>
            <tr>
              <th>1</th>
              <td>{{$row->kode_pengambilan}}</td>
              <td>{{$row->kode_pengambilan}}</td>
              <td>{{$row->status}}</td>
              <td><a href="{{site_url('pelanggan/pesanan/view/'.$row->id)}}" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i></a></td>
            </tr>
          </tbody>
          @endforeach
          <?php endif ?> 
        </table>
      </div>
  </div>
</div>
@endsection