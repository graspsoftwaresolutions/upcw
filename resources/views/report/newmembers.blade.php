@include('template.header')
<style>

	.monthly-sub-status:hover{
		background-color: #eeeeee !important;
		cursor:pointer;
	}
	.btn, .btn-sm-one {
		line-height: 36px;
		display: inline-block;
		height: 35px;
		padding: 0 7px;
		vertical-align: middle;
		text-transform: uppercase;
		border: none;
		border-radius: 4px;
		-webkit-tap-highlight-color: transparent;
	}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/page-users.min.css') }}">
<link href="{{ asset('public/app-assets/css/jquery-ui-month.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/MonthPicker.min.css') }}" rel="stylesheet" type="text/css" />
		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>New Members Report</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">New Members List
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
										<input id="monthlyyear_newmember" type="text" class="validate datepicker-custom" value="{{date('M/Y')}}" name="monthlyyear_newmember">
										<label for="monthlyyear_newmember" class="">DATE DOJ</label>
									</div>
									<div class="input-field col m3 s12">
										
										<select class="error" id="company_name" name="company_name">
										<option value="">Choose company name</option>
											@foreach($data['company'] as $row_res)
											<option value="{{ $row_res->id}}" selected="" >{{ $row_res->company_name }}</option>
											@endforeach
										</select>
										<label for="company_name" class="">Company Name</label>
									</div>
									<div class="input-field col m3 s12">
										
										<select class="error" id="cost_center" name="cost_center">
										<option value="">Choose cost center</option>
											@foreach($data['costcenters'] as $cost)
											<option value="{{ $cost->id}}" >{{ $cost->branch_name }}</option>
											@endforeach
										</select>
										<label for="cost_center" class="">Cost center</label>
									</div>
									<div class="input-field col m2 s12">
										<button class="btn waves-effect waves-light right" id="filter_by_monthyear_newmember" type="submit" name="action">Search
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
										  <table id="newmemberslist_datatable" class="table">
											<thead>
												<tr>
													<th style="text-align:center">Member No</th>
													<th style="text-align:center">Company Name</th>
													<th style="text-align:center">Cost Center</th>
													<th style="text-align:center">Member Name</th>
													<th style="text-align:center">DOJ</th>
													<th style="text-align:center">Status</th>
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
@include('template.footer')
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/jquery-ui-month.min.js')}}"></script>
<script src="{{ asset('public/js/MonthPicker.min.js')}}"></script>
<script>
$(document).ready(function() {
		var dataTable = $('#newmemberslist_datatable').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_reportnewmember_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					mypaid: function() {
						return $('#monthlyyear_newmember').val();
					},
					cmp_id: function() {
						return $('#company_name').val();
					},
					costcenter_id: function() {
						return $('#cost_center').val();
					},
					_token: "{{csrf_token()}}",
				}
			},
			columns: [
				{
					"data": "member_no"
				},
				{
					"data": "company_name"
				},
				{
					"data": "cost_center"
				},
				{
					"data": "member_name"
				},
				{
					"data": "doj"
				},
				{
					"data": "action"
				}
			]
		});
		$('#filter_by_monthyear_newmember').on('click', function(){
			dataTable.draw();
		});
});
</script>

<script>
  $(function() {
    $('.datepicker-custom').MonthPicker({ 
		Button: false, 
		MonthFormat: 'M/yy',
		OnAfterChooseMonth: function() { 
			//getDataStatus();
		} 
	 });
  });
</script>