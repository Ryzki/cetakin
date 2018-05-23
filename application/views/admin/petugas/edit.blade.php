@layout('_layout/admin/index')

@section('title') Data Petugas@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Petugas
    </h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-book"></i> &nbsp Kelola Data</li>
      <li><a href="{{site_url('admin/petugas')}}"><i class="fa fa-list-alt"></i> Data Petugas</a></li>
      <li class="active">Edit Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <a href="{{site_url('admin/petugas')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
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
        <form class="form-horizontal" action="{{site_url('admin/petugas/update')}}" method="post">
          {{$csrf}}
          {{form_hidden('id', $data->id);}}
            <div class="form-group">
              <label for="idusers" class="col-sm-2 control-label">Nama Petugas</label>
              <div class="col-sm-10">
                <select name="idusers" class="form-control" id="idusers">
                  <option value=""></option>
                  @foreach($tampiluser as $datauser)
                  <option {{($data->idusers == $datauser->id)?'selected':' '}} value="{{$datauser->id}}">{{$datauser->first_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="idpercetakan" class="col-sm-2 control-label">Nama Percetakan</label>
              <div class="col-sm-10">
                <select name="idpercetakan" class="form-control" id="idpercetakan">
                  <option value=""></option>
                  @foreach($tampilpercetakan as $datapercetakan)
                  <option {{($data->idpercetakan == $datapercetakan->id)?'selected':' '}} value="{{$datapercetakan->id}}">{{$datapercetakan->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <a href="" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection