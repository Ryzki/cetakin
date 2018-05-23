@layout('_layout/pelanggan/index')

@section('title')Beranda@endsection

@section('content')

@include('_layout/pelanggan/user')

<div class="container-fluid py-4">
  <div class="row">
    @include('_layout/pelanggan/sidebar')
    <div class="col-md-9 p-3">
      <div class="row">
        <div class="col-lg-6">
          <h1 style="margin-bottom: -4px" class="text-left display-5">Saldo Anda<b class="text-primary"> <span class="badge badge-primary">{{rupiah($jumlah_saldo)}}</span></b></h1>
          <hr class="text-dark border border-primary mx-0" style="width: 6%">
        </div>
        <div class="col-lg-6">
          <a href="" class="btn btn-secondary border border-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-fw fa-credit-card"></i> Isi Saldo</a>
        </div>
      </div><br>
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>Tanggal / Deskripsi</th>
              <th>Nominal</th>
              <th>Status</th>
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
              <td><i>{{$row->created_at}}</i> - {{$row->keterangan}}</td>
              <td>{{rupiah($row->nominal)}}</td>
              <td>
                {{($row->status == '0')?'<span class="badge badge-primary">Pemasukan</span>':''}}
                {{($row->status == '1')?'<span class="badge badge-warning">Pengeluaran</span>':''}}
                {{($row->status == '2')?'<span class="badge badge-danger">Konfirmasi Transfer</span>':''}}
								{{($row->status == '3')?'<span class="badge badge-info">Menunggu Konfirmasi Transfer</span>':''}}
              </td>
              <td><a href="{{site_url('pelanggan/saldo_user/view/'.$row->id)}}" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i> Lihat Detail</a></td>
            </tr>
          </tbody>
          @endforeach
          <?php endif ?>
        </table>
      </div>
  </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Saldo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{site_url('pelanggan/saldo_user/add')}}" method="post"enctype="multipart/form-data">
          {{$csrf}}
          <div class="form-group">
            <label for="jumlah">Jumlah Nominal</label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Rp.">
          </div>
          <div class="form-group">
            <label for="nama_rek">Nama Rekening</label>
            <input type="text" class="form-control" name="nama_rek" id="nama_rek">
          </div>
          <div class="form-group">
            <label for="no_rek">Nomor Rekening</label>
            <input type="text" class="form-control" name="no_rek" id="no_rek">
          </div>
          <div class="form-group">
            <label for="foto">Bukti</label>
            <input type="file" class="form-control" name="foto" id="foto">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection
