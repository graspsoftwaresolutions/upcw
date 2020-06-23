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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Statistics Report</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Statistics List
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							
					  </div>
					</div>
				  </div>
				</div>
				<!--div class="col s12">
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
											<input type="text" class="datepicker1" name="year_paid_unpaid" id="year_paid_unpaid" autocomplete="off">
											<label for="year_paid_unpaid" class="">Year</label>
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
											<button type="submit" name="submit" id="submit">Submit</button>
										</div>
									</form>
								</div>

							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div-->
				<div class="col s12">
					<div class="container">
						  <section class="users-list-wrapper section">
								  <div class="users-list-table">
									<div class="card">
									  <div class="card-content">
										<!-- datatable start -->
										<div class="responsive-table">
										  <table id="statistics_datatable" class="table">
											<thead>
												<tr>												
													<th >Company Name</th>
													@php 
														//dd($data['subscriptionlist']);
														$query_fetch = DB::table('races');
														$racelist = $query_fetch->get();
														foreach($racelist as $row)
														{
													@endphp
														<th style="text-align:center">@php echo "M".substr($row->name, 0, 1); @endphp</th>
													@php
														}
													@endphp
													
													<th style="text-align:center">Subtotal (Male)</th>
													@php 
														foreach($racelist as $row)
														{
													@endphp
														<th style="text-align:center">@php echo "F".substr($row->name, 0, 1); @endphp</th>
													@php
														}
													@endphp
													<th style="text-align:center">Subtotal (Female)</th>
													<th style="text-align:right">Overall Total</th>
												</tr>
											</thead>
											<tbody>
												@php
												//$data['subscriptionlist']= DB::table('companies')->get();
												foreach($data['companies'] as $res)
												{
												@endphp
													<tr>
														<td> <a href="{{ route('coststatisticsreport') }}">{{ $res->company_name }} </a> </td>
														@php 
														$data_subtotal=0;
														$data_subtotal_female=0;
														$data_overall_total=0;
														foreach($racelist as $row)
														{
															$data_toto_count = DB::table('memberprofiles')->where('race', $row->id)->where('member_status', 1)->where('company_name', $res->id)->whereRaw('LOWER(`sex`) LIKE ? ',[trim(strtolower("Male")).'%'])->get()->count();
															$data_subtotal +=$data_toto_count;
														@endphp
														<td style="text-align:center">{{ $data_toto_count }}</td>
														@php
														}
														@endphp
														<td style="text-align:center">{{ $data_subtotal }}</td>
														@php 
														foreach($racelist as $row)
														{
															$data_totol_count_female = DB::table('memberprofiles')->where('race', $row->id)->where('member_status', 1)->where('company_name', $res->id)->where('sex','=',"female")->get()->count();
															$data_subtotal_female +=$data_totol_count_female;
														@endphp
														<td style="text-align:center">{{ $data_totol_count_female }}</td>
														@php
														}
														@endphp
														<td style="text-align:center">{{ $data_subtotal_female }}</td>
														<td style="text-align:right">
															@php 
																$data_overall_total = $data_subtotal + $data_subtotal_female;
															@endphp
														{{ $data_overall_total }}
														</td>
														
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
@include('template.footer')
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js" type="text/javascript"></script>

<script src="{{ asset('public/app-assets/js/jquery-ui-month.min.js')}}"></script>
<script src="{{ asset('public/js/MonthPicker.min.js')}}"></script>
<script>
$(document).ready(function() {
	$('#statistics_datatable').DataTable({
		responsive: true,
		dom: 'lBfrtip',
		buttons: [
			{
				extend: 'excelHtml5',
				text: 'Excel',
				title: 'Statistics',
				selectAll: "Select all items",
				exportOptions: {
					modifier: {
						search: 'none',
						///order: 'applied'
						page:   'all',
					}
				}
			},
			{
				extend: 'pdfHtml5',
				text: 'PDF',
				title: 'Statistics',
				exportOptions: {
					modifier: {
						page: 'all',
					}
				}
			}
		],
		lengthMenu: [
			[10, 25, 50, '-1'],
			[10, 25, 50, 'All']
		],
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