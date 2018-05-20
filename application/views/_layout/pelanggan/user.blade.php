<?php $user = $this->ion_auth->user()->row(); ?>

<div class="text-center opaque-overlay bg-light">
	<div class="pl-3 py-4">
	  <div class="row">
	    <div class="col-md-12 text-dark">
	      <h1 style="margin-bottom: -5px" class="text-left display-5"><i class="fa fa-fw fa-user-circle-o" style="color: grey; font-size: 60px"></i> {{$user->first_name}}</h1>
	    </div>
	  </div>
	</div>
</div>
