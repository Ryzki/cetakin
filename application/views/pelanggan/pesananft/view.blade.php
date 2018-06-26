@layout('_layout/pelanggan/index')

@section('title') Detail Pesanan@endsection

@section('content')

@include('_layout/pelanggan/user')

<div class="container-fluid py-2">
	<div class="row">
		@include('_layout/pelanggan/sidebar')

		<div class="col-md-9 p-3">
			<a href="{{site_url('pelanggan/pesananft')}}" class="btn btn-warning mb-2"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
			<h1 style="margin-bottom: -4px" class="text-left display-5">Detail <b class="text-primary">Pesanan</b></h1>
			<hr class="text-dark border border-primary mx-0" style="width: 6%">
			<div class="row">
				<div class="col-md-6">
					<table class="table table-striped">
						<tr>
							<td style="width: 40%">Nama Percetakan</td>
							<td>??</td>
						</tr>
						<tr>
							<td>Kode Pengambilan</td>
							<td>{{$data->kode_pengambilan}}</td>
						</tr>  
						<tr>
							<td>Ukuran</td>
							<td>{{$data->ukuran}}</td>
						</tr>
						<tr>
							<td>Catatan</td>
							<td>{{$data->catatan}}</td>
						</tr>
						<tr>
							<td>Status Pesanan</td>
							<td>
								{{($data->status == '0')?'Belum Diproses':''}}
								{{($data->status == '1')?'Diproses':''}}
								{{($data->status == '2')?'Selesai':''}}
								{{($data->status == '3')?'Diambil':''}}
								{{($data->status == '4')?'Ditolak':''}}
							</td>
						</tr>
						<tr>
							<td></td>
							<td><a href="" class="btn btn-warning"><i class="fa fa-fw fa-close"></i> Batalkan</a></td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<div class="card text-center bg-light border border-primary">
					  <div class="card-header">
					    File
					  </div>
					  <div class="card-body">
					    <a class="btn btn-primary text-white">{{$data->file}}</a>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
