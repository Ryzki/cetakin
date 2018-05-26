@layout('_layout/petugas/index')

@section('title')Data Percetakan@endsection

@section('style')
  <!-- Select2 -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/css/select2.min.css">
@endsection

@section('content')
  <section class="content-header">
    <h1>
      Informasi Percetakan
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box"> 
      <div class="box-body">
        <form class="form-horizontal" action="{{site_url('petugas/percetakan/update')}}" method="post" enctype="multipart/form-data">
          {{$csrf}}
          {{form_hidden('id', $percetakan->id)}}

          <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" value="{{$percetakan->nama}}" id="nama" placeholder="Nama">
            </div>
          </div>
          <div class="form-group">
            <label for="email_percetakan" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email_percetakan" name="email_percetakan" class="form-control" value="{{$percetakan->email_percetakan}}" id="email_percetakan" placeholder="email_percetakan">
            </div>
          </div>
          <div class="form-group">
            <label for="phone_percetakan" class="col-sm-2 control-label">Nomor Telp</label>
            <div class="col-sm-10">
              <input type="tel" name="phone_percetakan" class="form-control" value="{{$percetakan->phone_percetakan}}" id="phone_percetakan" placeholder="Nomor telp">
            </div>
          </div>
          <div class="form-group">
            <label for="foto" class="col-sm-2 control-label">foto</label>
            <div class="col-sm-10">
              <input type="file" name="foto" class="form-control" id="foto">
              <?php $img = isset($percetakan->foto) ? $percetakan->foto : 'default.png';?>
              <img style="margin-top: 10px" width="300" height="1000" src="{{base_url('uploads/percetakan/'.$img)}}" class="image-preview img-responsive" alt="">
            </div>
          </div>
          <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea name="alamat" class="form-control" id="alamat">{{$percetakan->alamat}}</textarea>
            </div>
          </div> 
          <div class="form-group">
            <label for="id_provinsi" class="col-sm-2 control-label">Provinsi</label>
            <div class="col-sm-6">
              <select name="id_provinsi" id="id_provinsi" class="form-control select2" style="width: 100%;">
                <option selected="selected">== Pilih Provinsi ==</option>
  
                @foreach ($provinsi as $value)
                  <option {{($id_provinsi == $value->id)?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>                   
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="id_kabupaten" class="col-sm-2 control-label">Kabupaten</label>
            <div class="col-sm-6">
              <select name="id_kabupaten" id="id_kabupaten" class="form-control select2" style="width: 100%;"> 
   
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="id_kecamatan" class="col-sm-2 control-label">Kecamatan</label>
            <div class="col-sm-6">
              <select name="id_kecamatan" id="id_kecamatan" class="form-control select2" style="width: 100%;"> 
   
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Ubah</button> 
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection

@section('script')
<script src="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Page script -->
<script>
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2() 
})
</script>

<script src="https://d19m59y37dris4.cloudfront.net/hub/1-3-0/vendor/jquery.cookie/jquery.cookie.js">
</script>

<script>
var photo = (function(){
    // bind events
    $("[type='file']").on('change', eventPreviewGambar);

    init();

    // Events
    function eventPreviewGambar(event){
        readURL(event.target);
    }

    function readURL(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

})();
</script>

<script> 
$(document).ready(function(){

  $.ajaxSetup({
      data: {
          csrf_test_name: $.cookie('csrf_cookie_name')
      }
  });

  var prov = <?php echo $id_provinsi; ?>;
  var kab = <?php echo $id_kabupaten; ?>;
  var kec = <?php echo $percetakan->id_kecamatan; ?>;

  $.ajax({
      type : 'GET',
      url : '<?php echo base_url('petugas/percetakan/show_edit/getKabupaten'); ?>',
      data :  {'kab_id' : kab, 'prov_id' : prov}, 
      success: function (data) {
      $.LoadingOverlay("hide");
      //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
      $("#id_kabupaten").html(data);
    }
  });
  
  $.ajax({
      type : 'GET',
      url : '<?php echo base_url('petugas/percetakan/show_edit/getKecamatan'); ?>',
      data :  {'kab_id' : kab, 'kec_id' : kec}, 
      success: function (data) {
      $.LoadingOverlay("hide");
      //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
      $("#id_kecamatan").html(data);
    }
  });

  $('#id_provinsi').change(function(){
    //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
    var prov = $('#id_provinsi').val();
    $.LoadingOverlay("show");
    console.log(prov); 
     
    $.ajax({
        type : 'GET',
        url : '<?php echo base_url('petugas/percetakan/show_edit/getKabupaten'); ?>',
        data :  'prov_id=' + prov,
        success: function (data) {
        $.LoadingOverlay("hide");
        //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
        $("#id_kabupaten").html(data);
      }
    });
  });

  $('#id_kabupaten').change(function(){
    //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
    var kab = $('#id_kabupaten').val();
    $.LoadingOverlay("show");  
    $.ajax({
        type : 'GET',
        url : '<?php echo base_url('petugas/percetakan/show/getKecamatan'); ?>',
        data :  'kab_id=' + kab,
        success: function (data) {
        $.LoadingOverlay("hide");
        //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
        $("#id_kecamatan").html(data);
      }
    });
  });
});
</script>
@endsection