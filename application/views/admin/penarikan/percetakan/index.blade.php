@layout('_layout/admin/index')

@section('title')Data Penarikan Saldo Percetakan @endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Penarikan Saldo Percetakan
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
        <li class="active">Data Penarikan Saldo Percetakan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="box-header hee_hidden">
                {{$pagination}}    
            </div>
          </div>
        </div>
        <form class="form-inline" action="{{site_url('admin/'.$page.'/search')}}" method="get">
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <div class="box-header with-border">              
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <select class="form-control input-group-btn" name="sort" id="" onchange="this.form.submit();">
                      <option value="">-- Urutkan berdasarkan --</option>
                      <option {{(isset($search_data['sort'])&& $search_data['sort'] == '1')?'selected':''}} value="1">Nama - A-Z</option>
                      <option {{(isset($search_data['sort'])&& $search_data['sort'] == '2')?'selected':''}} value="2">Nama - Z-A</option>
                    </select>
                  </div>
                </div> 
            </div> 
          </div>
        </div> <!-- row -->
        </form>
        <br>
        <div class="box-body table-responsive">
          <table class="table table-hover table-striped">
                <thead>
                  <th>No.</th>
                  <th>Nama Percetakan</th> 
                  <th>Jumlah Nominal</th> 
                  <th>Status</th>
                  <th>Aksi</th>
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
                      <td>{{$start++}}. </td>
                      <td>{{$row->percetakan->nama}}</td> 
                      <td>{{rupiah($row->nominal)}}</td> 
                      <td>
                          {{($row->status == '1')?'<span class="label label-primary">Telah Dikonfirmasi</span>':''}} 
                          {{($row->status == '5')?'<span class=" label label-warning"> Belum Dikonfirmasi</span>':''}} 
                      </td>
                      <td>
                        @if ($row->status == '5')
                          <a href="{{site_url('admin/penarikan/percetakan/konfirmasi/'.$row->id)}}" class="btn btn-primary" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Konfirmasi</a> 
                        @else
                          <a href="{{site_url('admin/penarikan/percetakan/batalkan/'.$row->id)}}" class="btn btn-warning" onclick="return confirm('apakah anda yakin')"><i class="fa fa-check-square-o"></i> Batalkan Konfirmasi</a> 
                        @endif
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