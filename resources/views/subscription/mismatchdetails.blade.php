@include('template.header')
<style>
.dataTables_filter
{
	display:none;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/page-users.min.css') }}">

		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Mismatch Report</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Mismatch Report List
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
					  <section class="users-list-wrapper section">
							  <div class="users-list-table">
								<div class="card">
								  <div class="card-content">
									<!-- datatable start -->
									<div class="responsive-table">
									  <table id="mismatchmemberlist_datatable" class="table">
										<thead>
											<tr>
												<th>Company Name</th>
												<th>Member No</th>
												<th>Member Name</th>
												<th>IC No</th>
												<th>Subs</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@php 
												foreach($data['subs_member'] as $row)
												{
											@endphp
											<tr>
												<td>{{ $row->company_name }}</td>
												<td>{{ $row->member_no }}</td>
												<td>{{ $row->member_name }}</td>
												<td>{{ $row->member_ic }}</td>
												<td>{{ $row->subs }}</td>
												@php
												$subcmp_id = $row->subcompany_id;
												$matchid = $row->match_no;
												if($matchid==2){
												//$mem_no = $row->id; 
												@endphp
												<td><button class="btn btn-info"  onclick="ApprovalnewmemberUpdate({{$row->id}});">Approval</button></td>
												@php
												}
												if($matchid==3){
												//$mem_code = $row->member_code; 
												@endphp
												<td><a class="btn btn-info"  onclick="ApprovalMembernameUpdate({{$row->id}});">Approval</button></td>
												@php
												}
												@endphp
											</tr>
											@php
												}
											@endphp
											
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
		<div id="modal_registermember" class="modal">
			<div class="row" style="background: #ff5a92;margin-right:0px;">
				<div class="col m8">
					<h3 style="margin: 18px;color: #fff;font-size: 25px;font-weight: bold;">Register New Member</h3>
				</div>
				<div class="col m4">
					<p style="text-align: right;margin: 15px 0;"><a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">
						<i class="material-icons dp48" style="color: #fff;font-weight: bold;font-size: 25px;">close</i></a>
					</p>
				</div>
			</div>
			<div class="modal-content">
				<div class="row">
				<form class="col s12" action="" method="POST">
				@csrf
				  <div class="row">
					<div class="input-field col s12">
						<input id="resign_date" name="resign_date" type="text" required>
						<label for="resign_date" class="active">Resign Date</label>
					</div>
					<div class="input-field col s12">
						<input id="resign_remark" name="resign_remark" type="text" required>
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
function ApprovalnewmemberUpdate(id)
{
	url = "{{ url('/approvalmismatchdetails') }}" + '/' + id;
	//alert(url);
	window.open(url, '_blank');
	//window.open = ("{{ url('/approvalmismatchdetails') }}" + '/' + id, "_blank");
	
	//alert("dsfvdsg");
	//alert(id);
	//$('#modal_registermember').modal();
	//alert(id);
	//$("#register_id").val(id);
	//return;
	/*swal({
		//title: "Are you sure?", 
		text: "Are you sure that you want to Register?", 
		buttons: {
		  cancel: true,
		  delete: 'Yes'
		},
		icon: "warning",
	}).then((willDelete) => {
				if(willDelete) {
					$.ajax({
						url : "{{ url('/update_newmemregister') }}" + '/' + id,
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
	//});
}
	$(document).ready(function() {
		$('#mismatchmemberlist_datatable').DataTable({
			responsive: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			]
		});
	});
</script>