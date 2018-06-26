@layout('_layout/pelanggan/index')

@section('title') Detail Pesanan@endsection

@section('content')

@include('_layout/pelanggan/user')

<div class="container-fluid py-2">
	<div class="row">
		@include('_layout/pelanggan/sidebar')

		<div class="col-md-9 p-3">
			<a href="{{site_url('pelanggan/pesanan')}}" class="btn btn-warning mb-2"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
			<h1 style="margin-bottom: -4px" class="text-left display-5">Detail <b class="text-primary">Pesanan</b></h1>
			<hr class="text-dark border border-primary mx-0" style="width: 6%">
			<div class="row">
				<div class="col-md-6">
					<table class="table table-striped">
						<tr>
							<td style="width: 40%">Nama Percetakan</td>
							<td>{{$percetakan->nama}} {{$percetakan->kecamatan->name}}, {{$percetakan->kabupaten->name}} </td>
						</tr>
						<tr>
							<td>Kode Pengambilan</td>
							<td>{{$data->kode_cetak}}</td>
						</tr>
						<tr>
							<td>Jenis Cetak</td>
							<td>
								{{$jenis_cetak->nama}} {{rupiah($jenis_cetak->harga)}} / {{$jenis_cetak->satuan}}
							</td>
						</tr>
						<tr>
							<td>Jumlah Sisi</td>
							<td>
								{{$jumlah_sisi->nama}} {{rupiah($jumlah_sisi->harga)}} / {{$jumlah_sisi->satuan}}
							</td>
						</tr>
						<tr>
							<td>Status Jilid</td>
							<td>
								{{$jumlah_status_jilid->nama}} {{rupiah($jumlah_status_jilid->harga)}} / {{$jumlah_status_jilid->satuan}}
							</td>
						</tr> 
						<tr>
							<td>Jumlah Lembar</td>
							<td>{{$data->jumlah_lembar}} Lembar</td>
						</tr>
						<tr>
							<td>Jumlah Copy</td>
							<td>{{$data->jumlah_copy}}</td>
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
								{{($data->status == '3')?'Ditolak':''}}
								{{($data->status == '4')?'Dibatalkan':''}}
							</td>
						</tr>
						<?php if($data->status == '0'){ ?>
						<tr>
							<td></td>
							<td><a href="{{site_url('pelanggan/pesanan/batalkan/'.$data->id)}}" class="btn btn-warning"><i class="fa fa-fw fa-close" onclick="return confirm('apakah anda yakin')"></i> Batalkan</a></td>
						</tr>
						<?php } else { ?>
						<tr>
							<td></td>
							<td><a href="" class="btn btn-warning disabled"><i class="fa fa-fw fa-close" onclick="return confirm('apakah anda yakin')"></i> Batalkan</a></td>
						</tr>
						<?php } ?>
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
