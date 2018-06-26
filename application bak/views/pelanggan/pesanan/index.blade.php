@layout('_layout/pelanggan/index')

@section('title')Beranda@endsection

@section('content')

@include('_layout/pelanggan/user')

<div class="container-fluid py-4">
  <div class="row">

    @include('_layout/pelanggan/sidebar')

    <div class="col-md-9 p-3">
        <h1 style="margin-bottom: -4px" class="text-left display-5">Daftar <b class="text-primary">Cetak Dokumen</b></h1>
        <hr class="text-dark border border-primary mx-0" style="width: 6%">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Percetakan</th>
              <th>Kode Cetak</th>
              <th>Waktu Pemesanan</th>
              <th>Status Pesanan</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <?php if(empty($tampildata)): ?>
              <tr>
                  <td colspan="6" align="center">Tidak ada Data</td>
              </tr>
          <?php else: $start=1;?>
          @foreach($tampildata as $row)
          <tbody>
            <tr>
              <th>{{$start++}}</th>
              <td>{{$row->relasipercetakan->nama}}</td>
              <td>{{$row->kode_pengambilan}}</td>
              <td>{{dateFormat(3, $row->created_at)}}</td>
              <td>
                {{($row->status == '0')?'<span class="badge badge-warning">Belum di Proses</span>':''}}
                {{($row->status == '1')?'<span class="badge badge-primary">Sedang Diproses</span>':''}}
                {{($row->status == '2')?'<span class="badge badge-success">Selesai</span>':''}}
                {{($row->status == '4')?'<span class="badge badge-info">Diambil</span>':''}}
                {{($row->status == '3')?'<span class="badge badge-danger">Ditolak</span>':''}}
              </td>
              <td><a href="{{site_url('pelanggan/pesanan/view/'.$row->id)}}" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i></a></td>
            </tr>
          </tbody>
          @endforeach
          <?php endif ?>
        </table>
      </div>
  </div>
  {{$pagination}}
</div>
@endsection
