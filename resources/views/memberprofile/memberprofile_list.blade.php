@include('template.header')
@include('flash-message')
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/page-users.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/datepicker.css') }}">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Member Query</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Member List
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							<a href="{{ route('memberprofiles.create') }}" class="btn waves-effect waves-light breadcrumbs-btn right" ><i class="material-icons hide-on-med-and-up">settings</i> Add </a>
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
									<h4 class="card-title">Filter</h4>
								  </div>
								</div>
							  </div>
								<div class="row">
									<div class="input-field col m1 s12">
										<input id="from_doj" placeholder="FROM DOJ" type="text" class="validate datepicker-custom" autocomplete="off" value="" name="from_doj">
										<label for="from_doj" class="">FROM DOJ</label>
									</div>
									<div class="input-field col m1 s12">
										<input id="to_doj" placeholder="TO DOJ" type="text" class="validate datepicker-custom" autocomplete="off" value="" name="to_doj">
										<label for="to_doj" class="">TO DOJ</label>
									</div>
									<div class="col m3 s12">
										<label for="company_name" class="">Company Name</label>
										<select class="error browser-default" id="company_name" name="company_name">
											<option value="">Choose company name</option>
											@foreach($data['company'] as $row_res)
											<option value="{{ $row_res->id}}" >{{ $row_res->company_name }}</option>
											@endforeach
										</select>
										
									</div>
									<div class="col m3 s12">
										<label for="cost_center" class="">Cost center</label>
										
										<select class="error browser-default" id="cost_center" name="cost_center">
										<option value="">Choose cost center</option>
											@foreach($data['costcenters'] as $cost)
											<option value="{{ $cost->id}}" >{{ $cost->branch_name }}</option>
											@endforeach
										</select>
									</div>
									<div class="col m2 s12">
										  
										  	<label for="race">Race</label>
											<select class="error browser-default" id="race" name="race" data-error=".errorTxt3" required="true">
												<option value="">Choose race</option>
												@php 
													foreach($data['race_list'] as $row)
													{
												@endphp	
												<option value="{{ $row->id }}">{{ $row->name }}</option>
												@php
													}
												@endphp 
											</select>
											<div class="input-field">
												<small class="errorTxt3"></small>
											</div>
										  
										</div>
										<div class="col m1 s12">
										  <label for="sex">Sex</label>
										  <div class="">
											<select class="error browser-default" id="sex" name="sex" data-error=".errorTxt41">
											  <option value="">Choose sex</option>
											  <option value="male">Male</option>
											  <option value="female">Female</option>
											</select>
											<div class="input-field">
												<small class="errorTxt41"></small>
											</div>
										  </div>
										</div>

									<div class="input-field col m1 s12">
										<br>
										<button id="submit" class="btn waves-effect waves-light right" id="filter_by_monthyear_newmember" type="submit" name="action">Search
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
									
									<div class="responsive-table">
									  <table id="memberprofilelist_datatable" class="table">
										<thead>
											<tr>
												<th>Member No</th>
												<th>Member Name</th>
												<th>Company Name</th>
												<th>Cost Center</th>
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
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function() {
	
	var dataTable = $('#memberprofilelist_datatable').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			"order": [[ 0, "asc" ]],
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
					from_doj: function() {
						return $('#from_doj').val();
					},
					to_doj: function() {
						return $('#to_doj').val();
					},
					cost_center: function() {
						return $('#cost_center').val();
					},
					race: function() {
						return $('#race').val();
					},
					sex: function() {
						return $('#sex').val();
					},
					_token: "{{csrf_token()}}"
				}
			},
			columns: [
				{
					"data": "member_no"
				},
				
				{
					"data": "member_name"
				},
				{
					"data": "company_name"
				},
				{
					"data": "cost_center"
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
<script>
  $(function() {
  //   $('.datepicker-custom').MonthPicker({ 
		// Button: false, 
		// MonthFormat: 'M/yy',
		// OnAfterChooseMonth: function() { 
		// 	//getDataStatus();
		// } 
	 // });
	 $('.datepicker,.datepicker-custom').datepicker({
		    dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});

  });
  $('#company_name').change(function() {
    var companyID = $(this).val();

    if (companyID != '' && companyID != 'undefined') {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ URL::to('/get-costcenters-list') }}?company_id=" + companyID,
            success: function(res) {
                if (res) {
                    $('#cost_center').empty();
                    $("#cost_center").append($('<option></option>').attr('value', '').text(
                        "Select"));
                    $.each(res, function(key, entry) {
                        $('#cost_center').append($('<option></option>').attr(
                            'value', entry.branchid).text(entry.branch_name));

                    });
                } else {
                    $('#cost_center').empty();
                }
            }
        });
    } else {
        $('#cost_center').empty();
    }
});
</script>