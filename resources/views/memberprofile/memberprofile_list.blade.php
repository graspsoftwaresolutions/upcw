@include('template.header')
@include('flash-message')
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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Member Query</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Member List
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							<a href="{{ route('memberprofiles.create') }}" class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" ><i class="material-icons hide-on-med-and-up">settings</i> Add </a>
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
									<div class="row hide">								
										<div class="input-field col m12 s12">
										<h3>Filter</h3>
										</div>
										<div class="input-field col m4 s12">
										
											<select class="error" id="company_name" name="company_name">
											<option value="">Choose company name</option>
												@foreach($data['company'] as $row_res)
												<option value="{{ $row_res->id}}" >{{ $row_res->company_name }}</option>
												@endforeach
											</select>
											<label for="company_name" class="">Company Name</label>
										</div>
										<div class="input-field col m3 s12">
											<button type="button" class="btn btn-success" name="submit" id="submit">Submit</button>
										</div>
									<!--<div class="input-field col m3 s12">
										<input id="monthlyyear_paid" type="text" class="validate datepicker-custom" value="{{date('M/Y')}}" name="monthlyyear_paid">
										<label for="monthlyyear_paid" class="">Date</label>
									</div>-->
								</div>
									<div class="responsive-table">
									  <table id="memberprofilelist_datatable" class="table">
										<thead>
											<tr>
												<th>Member No</th>
												<th>Company Name</th>
												<th>Member Name</th>
												<th>IC No(New)</th>
												<th>Race</th>
												<th>Sex</th>
												<th>DOB</th>
												<th>DOJ</th>
												<th>Status</th>
												<th>Action</th>
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
<!-- <script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script> -->

<script>
$(document).ready(function() {
	
	var dataTable = $('#memberprofilelist_datatable').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_memberprofile_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					cmp_id: function() {
						return $('#company_name').val();
					},
					_token: "{{csrf_token()}}"
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
					"data": "member_name"
				},
				{
					"data": "ic_no_new"
				},
				{
					"data": "race"
				},
				{
					"data": "sex"
				},
				{
					"data": "dob"
				},
				{
					"data": "doj"
				},
				{
					"data": "member_status"
				},
				{
					"data": "options"
				}
			]
		});
		$('#submit').click(function(){
			dataTable.draw();
			//alert("sdfdxfg");
		});
});
</script>