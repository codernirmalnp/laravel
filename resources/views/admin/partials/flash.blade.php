@if ($message = Session::get('success'))

<div class="row mb-3">
<div class="alert alert-success alert-block  col-md-12">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>
</div>

@endif


@if ($message = Session::get('error'))

<div class="row mb-2">
<div class="alert alert-danger alert-block col-md-10">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>
</div>

@endif


@if ($message = Session::get('warning'))
<div class="row mb-2">
<div class="alert alert-warning alert-block col-md-10">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	<strong>{{ $message }}</strong>

</div>
</div>


@endif


@if ($message = Session::get('info'))
<div class="row mb-2">
<div class="alert alert-info alert-block col-md-10">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	<strong>{{ $message }}</strong>

</div>
</div>

@endif


@if ($errors->any())
<div class="row mb-2">
<div class="alert alert-danger col-md-10">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	Please check the form below for errors

</div>
</div>

@endif