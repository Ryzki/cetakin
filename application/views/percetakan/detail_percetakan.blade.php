@layout('_layout/pelanggan/index')

@section('title')Detail Percetakan@endsection

@section('content')
<div class="text-left opaque-overlay bg-light">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-12 text-dark">
          <h1 style="margin-bottom: 5px" class="text-left display-5"><span class="badge badge-primary">BUKA</span> {{$data->nama}}</h1>
          <i class="fa fa-map-marker text-primary"></i> Kabat, Banyuwangi
        </div>
      </div>
    </div>
  </div>

  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <img class="card-img-top" src="{{base_url('uploads/percetakan/'.$data->foto)}}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><strong>Melayani :</strong></h5>
              <table class="table table-sm" style="font-size: 15px">
                <?php if(empty($info_harga)): ?>
                    <tr>
                        <td colspan="6" align="center">Tidak ada Data</td>
                    </tr>
                <?php else: ?>
                    @foreach($info_harga as $harga)
                <tr>
                  <td>{{$harga->nama}}</td><td><b>{{rupiah($harga->harga)}} /{{$harga->satuan}}</b></td>
                </tr>
                 @endforeach
                <?php endif ?>
              </table>
            </div>
          </div>
        </div>

        @if($this->ion_auth->logged_in())
          <div class="col-md-5">
            <div class="card">
              <div class="card-header bg-primary">
                <i class="fa fa-bullhorn"></i> Ayo Mulai Cetak Dokumen di {{$data->nama}}!
              </div>
              <div class="card-body">
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
                <form action="{{site_url('percetakan/cetak')}}" method="post" enctype="multipart/form-data">
                  {{$csrf}}
                  {{form_hidden('url', $data->id.'/'.$data->slug);}}
                  {{form_hidden('idpercetakan', $data->id);}}

                  <div class="form-group">
                    <label for="jenis_cetak">Jenis Cetak</label>
                    <select name="jenis_cetak" id="jenis_cetak" class="form-control">
                      <option value="">-Jenis Cetak-</option>
                      <option {{(set_value('jenis_cetak')=='0')?'selected':''}} value="0">Normal (Berwarna dan Hitam Putih)</option>
                      <option {{(set_value('jenis_cetak')=='1')?'selected':''}} value="1">Hitam Putih</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jumlah_sisi">Jumlah Sisi</label>
                    <select name="jumlah_sisi" id="jumlah_sisi" class="form-control">
                      <option value="">-Jumlah Sisi-</option>
                      <option {{(set_value('jumlah_sisi')=='0')?'selected':''}} value="0">1 Sisi</option>
                      <option {{(set_value('jumlah_sisi')=='0')?'selected':''}} value="1">2 Sisi (bolak-balik)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jumlah_copy">Jumlah Copy</label>
                    <input name="jumlah_copy" type="number" class="form-control" id="jumlah_copy" value="{{set_value('jumlah_copy')}}">
                  </div>
                  <div class="form-group">
                    <label for="file">File Cetak (.pdf atau .doc)</label>
                    <input type="file" name="file" class="form-control-file" id="file">
                  </div>
                  <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="7" cols="90" placeholder="Masukan Detail mengenai cetakan kamu. Contoh : Halaman yang di cetak, Penjilidan, tebal kertas, dll.">{{set_value('catatan')}}</textarea>
                  </div>
                  <div align="right">
                    <button type="submit" class="btn btn-secondary"><i class="fa fa-print"></i> Cetak Sekarang!</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        @else
          <div class="col-md-5" id="login">
            <div class="card">
              <div class="card-header bg-primary">
                <i class="fa fa-bullhorn"></i> <b>Ayo Mulai Cetak Dokumen di {{$data->nama}}!</b>
              </div>
              <div class="card-body">
                <div class="alert alert-danger" role="alert">
                  Kamu harus Login terlebih dahulu!
                </div>

                <?php $message = $this->session->flashdata('message');
                if (isset($message)): ?>
                  <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
                    <h4 class="alert-heading"><i class="icon fa fa-ban"></i> Peringatan!</h4>
                    <?php echo $message; ?>
                  </div>
                <?php endif ?>
                <form method="post" action="{{site_url('auth/login_pelanggan')}}">
                  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                  {{form_hidden('url', $data->id.'/'.$data->slug);}}

                  <div class="form-group">
                    <label for="kode_pengambilan">Email</label>
                    <input type="email" class="form-control" name="identity" id="email" placeholder="Isikan Email">
                  </div>
                  <div class="form-group">
                    <label for="kode_pengambilan">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Isikan Password">
                  </div>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Masuk</button>
                  <br><br>
                  Belum memiliki akun? <a href="{{site_url('pendaftaran')}}" class="btn btn-secondary"><i class="fa fa-pencil-square-o"></i> Daftar Sekarang!</a>
                </form>
              </div>
            </div>
          </div>
        @endif

        <div class="col-md-4">
          <h4 class="mb-3"><b>Percetakan <span class="text-primary">Lainnya</span></b></h4>
          @foreach ($percetakan_lainnya as $row)
          <div class="card mb-2 card-hover"  onclick="window.location.href='{{site_url('percetakan/detail/'.$row->id.'/'.$row->slug)}}'">
            <div class="row no-gutters hover">
              <div class="col-md-4">
                <img class="card-img-top" src="{{base_url('uploads/percetakan/'.$row->foto)}}" width="100" alt="Card image cap">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 16px; margin-bottom: 4px"><strong>{{$row->nama}}</strong></h5>
                  <p class="card-text" style="font-size: 13px">
                    <i class="fa fa-map-marker text-primary"></i> Kabat, Banyuwangi
                  </p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>
@endsection
