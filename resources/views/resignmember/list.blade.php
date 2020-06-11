@include('template.header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/page-users.min.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
.swal-text {
    font-size: 19px;
}
.swal-footer {
    text-align: center;
}
</style>
<style>
.ui-datepicker-month
{
	display: block;
    height: 30px;
	float: left;
}
.ui-datepicker-year
{
	display: block;
    height: 30px;
	float: right;
}
</style>
		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Resign Members</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Resign Members List
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							
					  </div>
					</div>
				  </div>
				</div>
				<div class="col s12">
					<div class="container">
						<div class="row">
						<div class="col s12">
						  <div id="validations" class="card card-tabs">
							<div class="card-content">
							  <div class="card-title">
								<div class="row">
								  <div class="col s12 m6 l10">
									<h4 class="card-title"></h4>
								  </div>
								</div>
							  </div>
								<div class="row">
									<div class="input-field col m3 s12">
										<input type="text" name="resign_memberno" id="resign_memberno" autocomplete="off">
										<label for="resign_memberno" class="">Member No</label>
									</div>
									<div class="input-field col m2 s12">
										<button class="btn waves-effect waves-light right" id="filter_by_resign_memberno" type="submit" name="action">Search
											<i class="material-icons right">send</i>
										</button>
									</div>
								</div>

							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="col s12">
					<div class="container">
						  <section class="users-list-wrapper section">
								  <div class="users-list-table">
									<div class="card">
									  <div class="card-content">
										<!-- datatable start -->
										<div class="responsive-table">
										  <table id="resignmemberlist_datatable" class="table">
											<thead>
												<tr>
													<th style="text-align:left">Member Name</th>
													<th style="text-align:center">Member No</th>
													<th style="text-align:center">IC No</th>
													<th style="text-align:center">Status</th>
													<th style="text-align:center">Action</th>
												  </tr>
											</thead>
											<tbody>
												
											</tbody>
										  </table>
										</div>
										<!-- datatable ends -->
									  </div>
									</div>
								  </div>
							</section>
	  
					</div>
					<!--div class="content-overlay"></div-->
				</div>
		</div>
		<div id="modal_resignmember" class="modal">
			<div class="row" style="background: #ff5a92;margin-right:0px;">
				<div class="col m8">
					<h3 style="margin: 18px;color: #fff;font-size: 25px;font-weight: bold;">Resign Member</h3>
				</div>
				<div class="col m4">
					<p style="text-align: right;margin: 15px 0;"><a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">
						<i class="material-icons dp48" style="color: #fff;font-weight: bold;font-size: 25px;">close</i></a>
					</p>
				</div>
			</div>
			<div class="modal-content">
				<div class="row">
				<form class="col s12" action="{{ url('/update_memberresignstatus') }}" method="POST">
				@csrf
				  <div class="row">
					<div class="input-field col s12">
						<input type="hidden" name="resign_id" id="resign_id" value="">
						<input id="resign_date" name="resign_date" placeholder="resign date" type="text" required>
						<label for="resign_date" class="active">Resign Date</label>
					</div>
					<div class="input-field col s12">
						<input id="resign_remark" name="resign_remark" type="text">
						<label for="resign_remark" class="active">Resign Remark</label>
					</div>
					<div class="input-field col s12">
					  <button class="btn waves-effect waves-light right" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					  </button>
					</div>
				  </div>
				</form>
				</div>
			</div>
		</div>
@include('template.footer')
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
function resignMemberStatusUpdate(id)
{
	$('#modal_resignmember').modal();
	//alert(id);
	$("#resign_id").val(id);
	return;
	swal({
		//title: "Are you sure?", 
		text: "Are you sure that you want to resign?", 
		buttons: {
		  cancel: true,
		  delete: 'Yes'
		},
		icon: "warning",
	}).then((willDelete) => {
				if(willDelete) {
					$.ajax({
						url : "{{ url('/update_memberresignstatus') }}" + '/' + id,
						type : "POST",
						data : {_token: "{{csrf_token()}}"},
						success: function(){
							//window.location.href = "{{ url('/resignmember') }}";
							location.reload();
						},
						error : function(){
							swal({
								title: 'Opps...',
								text : data.message,
								type : 'error',
								timer : '1500'
							})
						}
					})
				} 
		/* else {
		swal("Your imaginary file is safe!");
		} */
	});
}

/* function activeMemberStatusUpdate(id)
{
	//alert(id);
	swal({
		//title: "Are you sure?", 
		text: "Are you sure that you want to active?", 
		buttons: {
		  cancel: true,
		  delete: 'Yes'
		},
		icon: "warning",
	}).then((willDelete) => {
				if(willDelete) {
					$.ajax({
						url : "{{ url('/update_memberactivestatus') }}" + '/' + id,
						type : "POST",
						data : {_token: "{{csrf_token()}}"},
						success: function(){
							//window.location.href = "{{ url('/resignmember') }}";
							location.reload();
						},
						error : function(){
							swal({
								title: 'Opps...',
								text : data.message,
								type : 'error',
								timer : '1500'
							})
						}
					})
				} 
		else {
		swal("Your imaginary file is safe!");
		} 
	});
} */

$(document).ready(function() {
		var dataTable = $('#resignmemberlist_datatable').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_resignmember_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					resign_memberno: function() {
						return $('#resign_memberno').val();
					},
					_token: "{{csrf_token()}}",
				}
			},
			columns: [
				{
					"data": "member_name"
				},
				{
					"data": "member_no"
				},
				{
					"data": "ic_no_new"
				},
				{
					"data": "member_status"
				},
				{
					"data": "options"
				}
			]
		});
		$('#filter_by_resign_memberno').on('click', function(){
			dataTable.draw();
		});
});
</script>

<script>
  $(function() {
    $("#resign_date").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});
  });
</script>