@layout('_layout/pelanggan/index')

@section('title')Detail Percetakan @endsection

@section('content')
<div class="text-left opaque-overlay bg-light">
    <div class="py-4 px-3">
      <div class="row">
        <div class="col-md-12 text-dark">
          <h1 style="margin-bottom: 5px" class="text-left display-5"><span class="badge badge-primary">BUKA</span> {{$data->nama}}</h1>
          <i class="fa fa-map-marker text-primary"></i> Kabat, Banyuwangi
        </div>
      </div>
    </div>
  </div>

  <div class="py-3">
    <div class="px-3">
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
                  {{form_hidden('url', $data->id.'/'.$this->uri->segment(3).'/'.$data->slug);}}
                  {{form_hidden('idpercetakan', $data->id);}}

                  <div class="form-group">
                    <label for="idjeniscetak">Ukuran Kertas / Jenis Cetak</label>
                    <select name="idjeniscetak" id="idjeniscetak" class="form-control" required>
                      <option value="">-Ukuran Kertas / Jenis Cetak-</option>
                      
                      @foreach ($jenis_cetak as $value) 
                        <option {{(set_value('idjeniscetak')==$value->id)?'selected':''}} value="{{$value->id}}">{{$value->nama}}</option>
                      @endforeach 
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="idjumlahsisi">Jumlah Sisi</label>
                    <select name="idjumlahsisi" id="idjumlahsisi" class="form-control" required>
                      <option value="">-Jumlah Sisi-</option>
                      
                      @foreach ($jumlah_sisi as $value) 
                        <option {{(set_value('idjumlahsisi')==$value->id)?'selected':''}} value="{{$value->id}}">{{$value->nama}}</option>
                      @endforeach 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label for="idstatusjilid">Status Jilid</label>
                    <select name="idstatusjilid" id="idstatusjilid" class="form-control" required>
                      <option value="">-Status Jilid-</option>
                      
                      @foreach ($status_jilid as $value) 
                        <option {{(set_value('idstatusjilid')==$value->id)?'selected':''}} value="{{$value->id}}">{{$value->nama}}</option>
                      @endforeach 
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jumlah_lembar">Jumlah Lembar</label>
                    <input name="jumlah_lembar" type="number" class="form-control" id="jumlah_lembar" value="{{set_value('jumlah_lembar')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="jumlah_copy">Jumlah Copy</label>
                    <input name="jumlah_copy" type="number" class="form-control" id="jumlah_copy" value="{{set_value('jumlah_copy')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="file">File Cetak (.pdf atau .doc)</label>
                    <input type="file" name="file" class="form-control-file" id="file" required>
                  </div>
                  <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="7" cols="90" placeholder="Masukan Detail mengenai cetakan kamu. Contoh : Halaman yang di cetak, Penjilidan, tebal kertas, dll." required>{{set_value('catatan')}}</textarea>
                  </div>
                  <div align="center">
                    <a class="btn btn-secondary text-white" id="btn-kalkulasi"><i class="fa fa-print"></i> Kalkulasi Biaya</a>
                  </div> 
                  

                  <div class="alert alert-danger" id="tab-peringatan-form" style="display:none;">
                    <p><span id="field"></span> Tidak Boleh Kosong</p>
                  </div>

                  <div class="alert alert-primary text-center mt-3" id="tab-perkiraan">
                    <h5>Perkiraan Biaya Cetak</h5>
                    <p style="font-size:27px" id="biaya"> - </p>
                  </div>

                  <div id="tab-cetak" style="display:none;">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Cetak Sekarang!</button>
                  </div>

                  <div class="alert alert-danger" id="tab-danger" style="display:none;">
                    <p>Saldo kamu tidak mencukupi</p>
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
                <form method="post" action="{{site_url('auth/login_pelanggan')}}" name="login">
                  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                  {{form_hidden('url', $data->id.'/'.$this->uri->segment(4).'/'.$data->slug);}}

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

@section('script') 
<script type="text/javascript">
  $(document).ready(function(){
      // this bit needs to be loaded on every page where an ajax POST may happen
      $.ajaxSetup({
          data: {
              csrf_test_name: $.cookie('csrf_cookie_name')
          }
      });
      
      // $('#perkiraan-biaya').load("<?php echo site_url('product/load_cart');?>");

      //Simpan Obat
      $('#btn-kalkulasi').on('click',function(){ 
          var idjeniscetak      = $('#idjeniscetak').val();
          var idjumlahsisi      = $('#idjumlahsisi').val();
          var idstatusjilid     = $('#idstatusjilid').val(); 
          var jumlah_lembar     = $('#jumlah_lembar').val(); 
          var jumlah_copy       = $('#jumlah_copy').val();    
          var saldo_pelanggan   = parseInt(<?php echo $saldo_pelanggan; ?>);  
          console.log(idjeniscetak);
          
          if (idjeniscetak == '') { 
              window.alert('Jenis cetak tidak boleh kosong');
              $("#biaya").text(); 
          } else if (idjumlahsisi == '') { 
              window.alert('Jumlah Sisi tidak boleh kosong');
              $("#biaya").text(); 
          } else if (idstatusjilid == '') { 
              window.alert('Status Jilid tidak boleh kosong');
              $("#biaya").text(); 
          } else if (jumlah_lembar == '') { 
              window.alert('Jumlah Lembar tidak boleh kosong');
              $("#biaya").text(); 
          } else if (jumlah_copy == '') { 
              window.alert('Jumlah Copy tidak boleh kosong');
              $("#biaya").text(); 
          }

          $.ajax({
              type : "POST",
              url  : "<?php echo base_url('percetakan/kalkulasi_biaya')?>",
              dataType : "JSON",
              data : {idjeniscetak:idjeniscetak , idjumlahsisi:idjumlahsisi, idstatusjilid:idstatusjilid, jumlah_lembar:jumlah_lembar,  jumlah_copy:jumlah_copy},
              success: function(data){    
                console.log(data); 
                
                $("#biaya").text(toRp(data)); 
                
                if (data >= saldo_pelanggan) {
                    document.getElementById('tab-danger').style.display = "block";
                    document.getElementById('tab-cetak').style.display = "none";
                } else {
                    document.getElementById('tab-cetak').style.display = "block";
                    document.getElementById('tab-danger').style.display = "none";
                }
 
              }, 
          });
          return false;
      }); 

  });
 
  function toRp(a,b,c,d,e){e=function(f){return f.split('').reverse().join('')};b=e(parseInt(a,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return'Rp.\t'+e(d)}
</script> 
@endsection