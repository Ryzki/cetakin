@layout('_layout/admin/index')

@section('title') Data Syarat dan Ketentuan@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Syarat dan Ketentuan
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/sdk')}}"><i class="fa fa-bookmark-o"></i> Syarat dan Ketentuan</a></li>
      <li class="active">Lihat Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <a href="{{site_url('admin/sdk')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
      <div class="box-body">
        
        <div class="row">
          <div class="col-md-6">
            <table class="table table-striped">
              <tr>
                <td width="20%">Target</td>
                <td>
                  {{($data->target == '0')?'Pelanggan':''}}
                  {{($data->target == '1')?'Petugas':''}}
                  {{($data->target == '2')?'Percetakan':''}}
                </td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>{{$data->nama}}</td>
              </tr>
              <tr>
                <td>Deskripsi</td>
                <td>{{$data->deskripsi}}</td>
              </tr>
            </table>
          </div>
        </div>     
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection