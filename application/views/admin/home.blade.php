@layout('_layout/admin/index')

@section('title')Dashboard@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <?php $user = $this->ion_auth->user()->row(); ?> 

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-body"> 
          <div class="row"> 
            <div class="col-md-12">
              <h1>
                Selamat Datang {{$user->first_name}}
              </h1>
              <p>Anda Login sebagai <b>Administrator</b></p>
            </div>
          </div>
        </div>
         
      </div>
      <!-- /.box -->

    </section>
@endsection