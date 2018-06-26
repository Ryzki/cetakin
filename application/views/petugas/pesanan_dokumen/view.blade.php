@layout('_layout/petugas/index')

@section('title') Data Pesanan Dokumen@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pesanan Dokumen
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('petugas/pesanan_dokumen')}}"><i class="fa fa-list-alt"></i> Data Pesanan Dokumen</a></li>
      <li class="active">Lihat Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <a href="{{site_url('petugas/pesanan_dokumen')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
      <div class="box-body">

        <div class="row">
          <div class="col-md-6">
            <table class="table table-striped">
              <tr>
                <td>Kode Cetak</td>
                <td>{{$data->kode_cetak}}</td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>{{$data->relasiuser->first_name}}</td>
              </tr>
              <tr>
                <td>Jenis Cetak</td>
                <td>{{$jenis_cetak->nama}} {{rupiah($jenis_cetak->harga)}} / {{$jenis_cetak->satuan}}</td>
              </tr>
              <tr>
                <td>Jumlah Sisi</td>
                <td>{{$jumlah_sisi->nama}} {{rupiah($jumlah_sisi->harga)}} / {{$jumlah_sisi->satuan}}</td>
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
                <td>Status</td>
                <td>
                  {{($data->status == '0')?'Belum Diproses':''}}
                  {{($data->status == '1')?'Diproses':''}}
                  {{($data->status == '2')?'Selesai':''}}
                  {{($data->status == '3')?'Ditolak':''}}
                  {{($data->status == '4')?'Dibatalkan':''}}
                </td>
              </tr>
              <tr>
                <td>Saldo Pelanggan</td>
                <td><b>{{(rupiah($saldo_pelanggan))}}</b></td>
              </tr>
              <tr>
                <td></td>
                <td>

                  @if ($data->status == '0')
                    <a href="{{site_url('petugas/pesanan_dokumen/proses/'.$data->id)}}" class="btn btn-primary" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Proses!</a>
                    <a href="{{site_url('petugas/pesanan_dokumen/tolak/'.$data->id)}}" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"><i class="fa fa-ban"></i> Tolak</a>
                  @elseif ($data->status == '1')
                    <a href="{{site_url('petugas/pesanan_dokumen/batalkan/'.$data->id)}}" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"><i class="fa fa-ban"></i> Batalkan Proses</a>
                  @else

                  @endif

                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-5">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">File Cetak</h3>
              </div>
              <div class="box-body" align="center">
                <a href="{{site_url('petugas/pesanan_dokumen/download_file/'.$data->file)}}" class="btn btn-primary text-white">Download File</a>
              </div>
            </div>

            @if ($data->status == '1')
            <div class="box box-success box-solid">
              <div class="box-header with-border">
                <h3 class="box-title" align="center">Konfirmasi Selesai</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <div class="row">
                  <div class="col-sm-6 col-lg-12">
                    <!-- form alert -->
                    @if (!empty(validation_errors()))
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      <h4><strong>Peringatan</strong></h4>
                      <p>{{validation_errors()}}</p>
                    </div>
                    @endif
                  </div>
                  <!-- end form alert -->
                </div>

                <form action="{{site_url('petugas/pesanan_dokumen/selesai')}}" method="post">
                  {{$csrf}}
                  {{form_hidden('id', $data->id)}}
                  {{form_hidden('status', '2')}}

                  <div class="form-group">
                    <label for="biaya_cetak">Biaya Cetak</label>
                    <input value="{{$data->biaya_cetak}}" type="text" name="biaya_cetak" class="form-control" id="biaya_cetak" placeholder="Jumlah Biaya">
                  </div>
                  <div class="form-group">
                    <label for="catatan_percetakan">Catatan</label>
                    <textarea name="catatan_percetakan" class="form-control" id="catatan_percetakan">{{set_value('catatan_percetakan')}}</textarea>
                  </div>
                  <div align="right">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Konfirmasi Selesai</button>
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
              @endif

            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection
