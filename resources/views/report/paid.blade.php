@include('template.header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/page-users.min.css') }}">
<link href="{{ asset('public/app-assets/css/jquery-ui-month.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/MonthPicker.min.css') }}" rel="stylesheet" type="text/css" />
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
		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Paid Report</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Paid List
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
										<input id="monthlyyear_paid" type="text" class="validate datepicker-custom" value="{{date('M/Y')}}" name="monthlyyear_paid">
										<label for="monthlyyear_paid" class="">Date</label>
										<!--	<input type="text" class="datepicker1" name="monthlyyear_paid" id="monthlyyear_paid" autocomplete="off">
											<label for="monthlyyear_paid" class="">Year</label>-->
										</div>
										<div class="input-field col m4 s12">
											<select class="error" id="company_name" name="company_name">
												<option value="">Choose company name</option>
												@foreach($data['company'] as $row_res)
												<option value="{{ $row_res->id}}" >{{ $row_res->company_name }}</option>
												@endforeach
											</select>
										</div>
										<div class="input-field col m3 s12">
											<button type="button" name="submit" class="btn" id="submit">Submit</button>
										</div>
									<!--<div class="input-field col m3 s12">
										<input id="monthlyyear_paid" type="text" class="validate datepicker-custom" value="{{date('M/Y')}}" name="monthlyyear_paid">
										<label for="monthlyyear_paid" class="">Date</label>
									</div>-->
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
										  <table id="paidlist_datatable" class="table">
											<thead>
												<tr>
													<th>Company Name</th>
													<th style="text-align:center">Member Count</th>
													<th style="text-align:center">Total Amount</th>
												  </tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<th></th>
													<th id="member_total_count" style="text-align:center"></th>
													<th id="member_total_amount" style="text-align:center"></th>
												</tr>
											</tfoot>
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
		var dataTable = $('#paidlist_datatable').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_reportpaid_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					mypaid: function() {
						return $('#monthlyyear_paid').val();
					},
					cmp_id: function() {
						return $('#company_name').val();
					},
					_token: "{{csrf_token()}}",
					
					//d.mypaid = $('#monthlyyear_paid').val();
				}
			},
			drawCallback:function(settings)
			{
				$('#member_total_count').html(settings.json.count);
				$('#member_total_amount').html(settings.json.total);
			},
			columns: [
				{
					"data": "company_name"
				},
				{
					"data": "member_count"
				},
				{
					"data": "total_amount"
				}
			]
		});
		$('#submit').click(function(){
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