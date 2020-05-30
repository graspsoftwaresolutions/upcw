@include('template.header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/page-users.min.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Paid/Unpaid Report</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Paid/Unpaid List
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
									<form action="{{route('paidunpaidreport')}}" method="GET" id="fmsubmit">
										@csrf
										<div class="input-field col m3 s12">
											<input type="text" placeholder="year" class="datepicker1" value="{{ $data['year'] }}" name="year_paid_unpaid" id="year_paid_unpaid" autocomplete="off">
											<label for="year_paid_unpaid" class="">Year</label>
										</div>
										<div class="input-field col m4 s12">
											<select class="error" id="company_name" name="company_name">
												<option value="">Choose company name</option>
												@foreach($data['company'] as $row_res)
												<option selected="" value="{{ $row_res->id}}" >{{ $row_res->company_name }}</option>
												@endforeach
											</select>
										</div>
										<div class="input-field col m3 s12">
											<button type="submit" class="btn" name="submit" id="submit">Submit</button>
										</div>
									</form>
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
												@php	
												$months1 = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
												$curmn = date('m');
												$curmyr = date('Y');
												$year = $data['year'];
												if($year == $curmyr)
												{
													foreach($months1 as $key=>$monsin)
													{
														if($key<=$curmn){
															$months[$key] = $monsin;
													}
												}													
												}
												else{
													$months = $months1;
												}
												
												$mm = count($months);
												//var_dump($mm);
												@endphp											
													<th >Company Name</th>
													<th style="text-align:center">Member Name</th>
													<th style="text-align:center">Member Number</th>
													<!--<th style="text-align:center">Sub</th>-->
													@foreach($months as $key=>$monsin)														
														<th style="text-align:center">{{$monsin}}</th>														
													@endforeach
												  </tr>
											</thead>
											<tbody style="xboder:2px solid red;">
												
												@php													
													
												foreach($data["paidunpaidlist"] as $key => $row)
												{
												@endphp
													
														@foreach($row as $key1=>$rowmem) 
														<tr>
															<td > 
															@php 
																$company_name = DB::table('companies')->where('id' ,$key)->value('company_name'); 
																echo $company_name;
															@endphp
															</td>
															<td style="text-align:left">
															@php
																$member_name = DB::table('memberprofiles')->where('member_no' ,$key1)->value('member_name'); 
																echo $member_name;
															@endphp
															</td>
															<td style="text-align:center">{{$key1}}</td>
															@php
															for($m=1; $m<=$mm; $m++){
															@endphp
															<td style="text-align:center" class="valsett">
															@php
															foreach($rowmem as $kk=>$rw){
																if($m == $kk){
																	echo $rw;
																}																
															}
															@endphp
															</td>
															@php
															}
															@endphp
														</tr>
														@endforeach
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
@include('template.footer')
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function() {
	$('#paidlist_datatable').DataTable({
		responsive: true,
		"columnDefs": [{
		  "visible": false,
		  "targets": 0
		}],
		"order": [
		  [0, 'asc']
		],
		lengthMenu: [
			[10, 25, 50, 100],
			[10, 25, 50, 100]
		],
		 "drawCallback": function (settings) {
		  var api = this.api();
		  var rows = api.rows({
			page: 'current'
		  }).nodes();
		  var last = null;

		  api.column(0, {
			page: 'current'
		  }).data().each(function (group, i) {
			if (last !== group) {
			  $(rows).eq(i).before(
				'<tr style="background:grey;padding:2px !important;color:white;" class="group"><td colspan="4">' + "<label style='text-transform:uppercase;color:#000;font-weight:bold;font-size:18px;'>"+group + '</label></td></tr>'
			  );

			  last = group;
			}
		  });
		}
	});
});
</script>
<style>
.ui-datepicker-year
{
	display: block;
    height: 30px;
	float: none;
}
.ui-datepicker-prev
{
	display:none;
}
.ui-datepicker-next
{
	display:none;
}
.ui-datepicker-calendar { display: none; }
.ui-datepicker select.ui-datepicker-year
{
	width:100%;
}
.ui-datepicker .ui-datepicker-title {
    line-height: 0px;
}
</style>
<script>
$(function() {
    $('#year_paid_unpaid').datepicker({
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        onClose: function(dateText, inst) { 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
        }
    });
	$("#year_paid_unpaid").focus(function () {
        $(".ui-datepicker-month").hide();
    });
$('#submit').click(function(){
	$('#fmsubmit').submit();
});	
	
});
  
</script>