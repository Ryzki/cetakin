@layout('_layout/petugas/index')

@section('title')Riwayat Penarikan Saldo @endsection

@section('content') 
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
              <h1>Riwayat Penarikan Saldo<b class="text-primary"></b></h1> 

              <div class="row" style="padding-top: 14px">
                <div class="col-md-12"> 
                  <a href="{{site_url('petugas/saldo_percetakan')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a> 
                </div>
              </div>
            </div>
          </div>
        </div>   
        <div class="box-body">
          <table class="table table-hover table-striped">
            <thead>
              <th>No.</th>
              <th>Tanggal / Deskripsi</th>
              <th>Nominal</th>
              <th>Status</th> 
            </thead>
            <!-- cek isi data -->
            <?php if(empty($tampildata)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada Data</td>
                </tr>
            <?php else: ?>
                <?php $start+= 1 ?>
                @foreach($tampildata as $row)
                <tr>
                  <td>{{$start++}}.</td>
                  <td>{{dateFormat(3, $row->created_at)}} <br> {{$row->keterangan}}</td>
                  <td>{{rupiah($row->nominal)}}</td>
                  <td>
                    {{($row->status == '0')?'<span class="label label-success">Pemasukan</span>':''}}
                    {{($row->status == '1')?'<span class="label label-warning">Pengeluaran</span>':''}}
                    {{($row->status == '5')?'<span class="label label-warning">Menunggu Konfirmasi</span>':''}}
                  </td> 
                </tr>
                @endforeach
            <?php endif ?> <!-- end cek -->
          </table>
        </div>
        <div class="box-footer clearfix">
            {{$pagination}}
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modalTarikDana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Masukkan Jumlah Penarikan</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="{{site_url('petugas/saldo_percetakan/tarik')}}">
        {{$csrf}}

          <div class="form-group">
            <label for="nominal">Nominal</label>
            <input name="nominal" type="text" class="form-control" id="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
            <small class="form-text text-muted">Jumlah Saldo yang dapat di tarik <br><b>{{money(($total_saldo == NULL)?'0':$total_saldo)}}</b></small>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tarik</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{base_url('assets/')}}js/money.js"></script>
<script>
$(document).ready(function(){
    $("form").submit(function(e){
        var nominal = $('#nominal').val();
        var jumlah_tarik = nominal.replace(/\./g,'');
        var tarik = parseInt(jumlah_tarik);
        var saldo_ambil = parseInt('<?php echo $total_saldo; ?>');
        console.log(tarik);
        if (tarik >= saldo_ambil) {
            e.preventDefault();
            alert('Maaf, jumlah yang anda tarik kurang dari saldo yang bisa diambil!');
        } else {
          if (confirm("Apakah anda yakin Akan menarik dana sebesar Rp. "+tarik) == true) {
            return true;
          } else {
            e.preventDefault();
          }
        }

    });
});
</script>
@endsection