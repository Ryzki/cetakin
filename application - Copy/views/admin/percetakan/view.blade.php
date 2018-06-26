@layout('_layout/admin/index')

@section('title') Data Percetakan@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Percetakan
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/percetakan')}}"><i class="fa fa-list-alt"></i> Data Percetakan</a></li>
      <li class="active">Lihat Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      <a href="{{site_url('admin/percetakan')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
      </div>
      
      <div class="row">
        <div class="col-md-4">
            <img class="img-responsive" src="{{site_url('uploads/percetakan/'.$data->foto)}}">
            <table class="table table-striped">
              <tr>
                <td>Nama</td>
                <td>{{$data->nama}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{$data->email_percetakan}}</td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td>{{$data->phone_percetakan}}</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>{{$data->alamat}}</td>
              </tr>
              <tr>
                <td>Status Verifikasi</td>
                <td>
                  {{($data->status_verifikasi == '0')?'<span class="label label-warning">Belum Diverifikasi</span>':''}}
                  {{($data->status_verifikasi == '1')?'<span class="label label-success">Diverifikasi</span>':''}}
                  {{($data->status_verifikasi == '2')?'<span class="label label-danger">Ditolak</span>':''}}
                </td>
              </tr>
              <tr>
                <td></td>
                <td>
                  @if ($data->status_verifikasi == '0')
                    <a href="{{site_url('admin/percetakan/verifikasi/'.$data->id)}}" class="btn btn-primary" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Verifikasi</a> 
                    <a href="{{site_url('admin/percetakan/tolak/'.$data->id)}}" class="btn btn-danger" onclick="return confirm('apakah anda yakin')"><i class="fa fa-ban"></i> Tolak</a> 
                  @elseif ($data->status_verifikasi == '1')
                    <a href="{{site_url('admin/percetakan/unverifikasi/'.$data->id)}}" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"><i class="fa fa-trash"></i> Hapus Verifikasi</a> 
                  @else
                    <a href="{{site_url('admin/percetakan/verifikasi/'.$data->id)}}" class="btn btn-primary" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Verifikasi</a> 
                  @endif
                </td>
              </tr>
            </table>
        </div>
        <div class="col-md-8">
            <div class="box-header with-border">
              <h3 class="text-center">Data Petugas</h3>
            </div>
              <a href="{{site_url('admin/percetakan/add_petugas/'.$data->id)}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            <div class="box-body table-responsive">
              <table class="table table-hover table-striped">
                    <thead>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Nomor Telp</th>
                      <th>Aksi</th>
                    </thead>

                    <?php if(empty($petugas)): ?>
                        <tr>
                            <td colspan="6" align="center">Tidak ada Data</td>
                        </tr>
                    <?php else: $no=1;?>
                    @foreach($petugas as $row)
                    <tr>
                      <td>{{$no++}}.</td>
                      <td>{{$row->relasiuser->first_name}}</td>
                      <td>{{$row->relasiuser->email}}</td>
                      <td>{{$row->relasiuser->phone}}</td>
                      <td>
                        <a href="{{site_url('admin/percetakan/edit_petugas/'.$row->relasiuser->id.'/'.$data->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <a href="{{site_url('admin/percetakan/delete_petugas/'.$row->relasiuser->id.'/'.$data->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                    @endforeach
                    <?php endif ?> 
                  </table>
            </div>
        </div>
      </div> 


    </div><!-- /.box -->

  </section>
  <!-- /.content -->
@endsection