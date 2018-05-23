@layout('_layout/pelanggan/index')

@section('title') Detail Saldo @endsection

@section('content')

@include('_layout/pelanggan/user')

<div class="container-fluid py-2">
	<div class="row">
		@include('_layout/pelanggan/sidebar')

		<div class="col-md-9 p-3">
			<a href="{{site_url('pelanggan/saldo_user')}}" class="btn btn-warning mb-2"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
			<h1 style="margin-bottom: -4px" class="text-left display-5">Detail <b class="text-primary">Saldo</b></h1>
			<hr class="text-dark border border-primary mx-0" style="width: 6%">
			<div class="row">
				<div class="col-md-6">
					<table class="table table-striped">
						<tr>
							<td style="width: 40%">Nominal</td>
							<td>{{rupiah($data->nominal)}}</td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>{{$data->keterangan}}</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>
								{{($data->status == '0')?'<span class="badge badge-primary">Pemasukan</span>':''}}
								{{($data->status == '1')?'<span class="badge badge-warning">Pengeluaran</span>':''}}
								{{($data->status == '2')?'<span class="badge badge-danger">Konfirmasi Transfer</span>':''}}
								{{($data->status == '3')?'<span class="badge badge-info">Menunggu Konfirmasi Transfer</span>':''}}
							</td>
						</tr>
					</table>

				</div>

				@if($data->status == '2')
				<div class="col-md-6">
					<div class="card text-center bg-primary border border-primary">
					  <div class="card-header">
					    <strong>Segera Lakukan Pembayaran!</strong>
					  </div>
					  <div class="card-body">
							<p>
								<strong>Bank Mandiri</strong> <br>
								A/n Cetakin Solusi Print <br>
								1292131237123 <br><br>

								<strong>Bank BRI</strong> <br>
								A/n Cetakin Solusi Print <br>
								1292131237123 <br>
							</p>
							<a href="{{site_url('pelanggan/saldo_user/konfirmasi/'.$data->id)}}" class="btn btn-secondary" data-toggle="modal" data-target="#konfirmasiTf"><i class="fa fa-fw fa-check"></i> Konfirmasi Transfer</a>
					  </div>
					</div>
				</div>
				@endif

			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="konfirmasiTf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Konfirmasi Transfer Pengisian Saldo</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{site_url('pelanggan/saldo_user/konfirmasi')}}" method="post" enctype="multipart/form-data">
          {{$csrf}}
					{{form_hidden('id_saldo', $data->id)}}

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
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection
