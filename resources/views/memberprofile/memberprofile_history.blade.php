@include('template.header')
@include('flash-message')

<style>

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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Member</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Member history
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							
					  </div>
					</div>
				  </div>
				</div>
				<div class="col s12">
					<div class="card">
						<div class="card-content">
							<h4 class="card-title">Member Details  </h4> 
							@php
								$memberdetails = $data['memberinfo'];
							@endphp
							<table width="100%" class="memberinfotable" style="font-weight: bold; font-size: 16px">
								<tbody><tr>
									<td width="25%">Member Name </td>
									<td width="25%" style="color:#1120a6">: {{ $memberdetails->member_name }} </td>
									<td width="25%">Member Number</td>
									<td width="25%" style="color:#1120a6">: {{ $memberdetails->member_no }}</td>
								</tr>
								<tr>
									<td width="25%">NRIC-NEW</td>
									<td width="25%" style="color:#1120a6">: {{ $memberdetails->ic_no_new }}</td>
									<td width="25%">Cost Center</td>
									<td width="25%" style="color:#1120a6">: {{ CommonHelper::getCostCenterName($memberdetails->cost_centerid) }} </td>
									
								</tr>
								<tr class="hide">
									<td width="25%">Type</td>
									<td width="25%" style="color:#1120a6">: Emplo</td>
									
									<td width="25%">Status</td>
									<td width="25%" style="color:#1120a6">: DEFAULTER</td>
								</tr>
								@php
									$lastpaiddate = CommonHelper::getLastPaidDate($memberdetails->id);
								@endphp
								<tr>
									<td width="25%">Date of joing</td>
									<td width="25%" style="color:#1120a6">: {{ date('d/M/Y',strtotime($memberdetails->doj)) }}</td>
									
									<td width="25%">Last paid Date</td>
									<td width="25%" style="color:#1120a6">: @if($lastpaiddate!='') {{ date('M/ Y',strtotime($lastpaiddate)) }} @endif
									</td>
								</tr>
							</tbody>
						</table>
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
							    <form method="post" id="filtersubmit" action="">
								@csrf  
									<div class="row">
										<div class="input-field col m3 s12">
											<input id="from_month" type="text" class="validate datepicker-custom" required="" value="{{ $data['from_date']=='' ? '' : date('M/Y',strtotime($data['from_date'])) }}" autocomplete="off" name="from_month">
											<label for="from_month" class="">From Month</label>
										</div>
										<div class="input-field col m3 s12">
											<input id="to_month" type="text" autocomplete="off" class="validate datepicker-custom" required="" value="{{ $data['to_date']=='' ? '' : date('M/Y',strtotime($data['to_date'])) }}" name="to_month">
											<label for="to_month" class="">To Month</label>
										</div>
										
										<div class="input-field col m2 s12">
											<button class="btn waves-effect waves-light right" id="filter_by_monthyear_newmember" type="submit" name="action">Search
												<i class="material-icons right">send</i>
											</button>
										</div>
									</div>
								</form>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div>
			<div class="col s12">
				<div class="container">
					@if($data['from_date']=='')
					@if(isset($data['member_years']))
					<ul class="collapsible collapsible-accordion">
						@foreach($data['member_years'] as $year)
						@php
			            	$memberhistory = CommonHelper::getMemberHistory($memberdetails->id,$year->years);
			            	$slno=1;
			            @endphp
			            @if($year->years==date('Y'))
					    <li class="active">
			               <div class="collapsible-header" tabindex="0"><i class="material-icons">perm_contact_calendar</i> {{$year->years}}</div>
			               <div class="collapsible-body" style="display: block;">
			               	<a href="#" class="export-button btn btn-sm right" style="background:#ccc;" onclick="return PrintTable({{ $year->years }})">Print</a>
			                  <table border="1" cellpadding="4" style="border-collapse: collapse;" id="page-current-history{{$year->years}}" class="display ">
									<thead>
										<tr>
											<th>S.No</th>
											<th>History Date</th>
											<th>Subscription Paid</th>
											<th>Welfare Paid</th>
											<th>Tot.Subs.Paid</th>
									    </tr>
									</thead>
									<tbody>
										
										@foreach($memberhistory as $history)
										
										<tr>
											<td> {{ $slno }} </td>
											<td> {{ date('M/ Y',strtotime($history->statusMonth)) }} </td>
											<td> {{ $history->subs }} </td>
											<td> {{ $history->welfare_fee }} </td>
											<td> {{ $history->total_subs }} </td>
										</tr>
										@php
											$slno++;
										@endphp
										@endforeach
									</tbody>
								</table>
			               </div>
			            </li>
			            @else
			            <li>
			                <div class="collapsible-header"><i class="material-icons">perm_contact_calendar</i> {{$year->years}}</div>
					        <div class="collapsible-body">
					        	<a href="#" class="export-button btn btn-sm right" style="background:#ccc;" onclick="return PrintTable({{ $year->years }})">Print</a>
			                  <table border="1" cellpadding="4" style="border-collapse: collapse;" id="page-current-history{{$year->years}}" class="display ">
									<thead>
										<tr>
											<th>S.No</th>
											<th>History Date</th>
											<th>Subscription Paid</th>
											<th>Welfare Paid</th>
											<th>Tot.Subs.Paid</th>
									    </tr>
									</thead>
									<tbody>
										
										@foreach($memberhistory as $history)
										
										<tr>
											<td> {{ $slno }} </td>
											<td> {{ date('M/ Y',strtotime($history->statusMonth)) }} </td>
											<td> {{ $history->subs }} </td>
											<td> {{ $history->welfare_fee }} </td>
											<td> {{ $history->total_subs }} </td>
										</tr>
										@php
											$slno++;
										@endphp
										@endforeach
									</tbody>
								</table>
			               </div>
			            </li>
			            @endif
					    @endforeach
					</ul>
					@endif
					@else
					<ul class="collapsible collapsible-accordion">
						
						@php
			            	$memberhistory = CommonHelper::getMemberDatewiseHistory($memberdetails->id,$data['from_date'],$data['to_date']);
			            	$slno=1;
			            @endphp
			            
					    <li class="active">
			               <div class="collapsible-header" tabindex="0"><i class="material-icons">perm_contact_calendar</i> {{ date('M/Y',strtotime($data['from_date'])) }} - {{ date('M/Y',strtotime($data['to_date'])) }}</div>
			               <div class="collapsible-body" style="display: block;">
			               		<a href="#" class="export-button btn btn-sm right" style="background:#ccc;" onclick="return PrintTable(0)">Print</a>
			                  <table border="1" cellpadding="4" style="border-collapse: collapse;"  id="page-current-history0" class="display ">
									<thead>
										<tr>
											<th>S.No</th>
											<th>History Date</th>
											<th>Subscription Paid</th>
											<th>Welfare Paid</th>
											<th>Tot.Subs.Paid</th>
									    </tr>
									</thead>
									<tbody>
										
										@foreach($memberhistory as $history)
										
										<tr>
											<td> {{ $slno }} </td>
											<td> {{ date('M/ Y',strtotime($history->statusMonth)) }} </td>
											<td> {{ $history->subs }} </td>
											<td> {{ $history->welfare_fee }} </td>
											<td> {{ $history->total_subs }} </td>
										</tr>
										@php
											$slno++;
										@endphp
										@endforeach
									</tbody>
								</table>
			               </div>
			            </li>
			        </ul>
					@endif
					
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
//$("#li_compnay").addClass('active');
	
		$('#memberprofilelist_datatable').DataTable({
			responsive: true,
			lengthMenu: [[25, 100, -1], [25, 100, "All"]],
			dom: 'lBfrtip',
			buttons: [
				{
					extend: 'excelHtml5',
					text: 'Excel',
					title: 'Member History',
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
					title: 'Member History',
					exportOptions: {
						modifier: {
							page: 'all',
						}
					}
				}
			],
		});
});
function showaddForm() {
// $('.edit_hide').show();
	$('.add_hide').show();
	$('.edit_hide_btn').hide();
	//$('#rate_name').val("");
	//$('#category_id').val("");
	//$('#self_share').val("");
	$('.modal').modal();
}
function ConfirmDeletion() {
    if (confirm("{{ __('Are you sure you want to delete?') }}")) {
        return true;
    } else {
        return false;
    }
}
 $(function() {
    $('.datepicker-custom').MonthPicker({ 
		Button: false, 
		MonthFormat: 'M/yy',
		OnAfterChooseMonth: function() { 
			//getDataStatus();
		} 
	 });
  });
 function PrintTable(year){
 	var divToPrint=document.getElementById("page-current-history"+year);
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
 }
</script>