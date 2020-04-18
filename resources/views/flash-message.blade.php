@if ($message = Session::get('success'))
<div class="card-alert card gradient-45deg-green-teal">
	<div class="card-content white-text">
	  <p>
		<i class="material-icons">check</i> SUCCESS : {{ $message }}</p>
	</div>
	<!--button type="button" class="close white-text" data-dismiss="alert" aria-label="Close" style="top: 0px;right: 5px;">
	  <span aria-hidden="true" style="font-size: 21px;">×</span>
	</button-->
</div>	  
@endif


@if ($message = Session::get('warning'))
	<div class="card-alert card gradient-45deg-amber-amber">
		<div class="card-content white-text">
		  <p>
			<i class="material-icons">warning</i> UPDATE : {{ $message }}</p>
		</div>
		<!--button type="button" class="close white-text" data-dismiss="alert" aria-label="Close" style="top: 0px;right: 5px;">
		  <span aria-hidden="true" style="font-size: 21px;">×</span>
		</button-->
	</div>
@endif


<!--
@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	Please check the form below for errors
</div>
@endif
-->