@include('template.header')
@include('flash-message')

<style>

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
									$count = count($data['memberhistory']);
									$lastmonth = '';
									if(!empty($data['memberhistory']) && $count!=0)
									{
										
										$lastmonth = $data['memberhistory'][count($data['memberhistory'])-1]->statusMonth;
									}
								@endphp
								<tr>
									<td width="25%">Date of joing</td>
									<td width="25%" style="color:#1120a6">: {{ date('d/M/Y',strtotime($memberdetails->doj)) }}</td>
									
									<td width="25%">Last paid Date</td>
									<td width="25%" style="color:#1120a6">: @if($lastmonth!='') {{ date('M/ Y',strtotime($lastmonth)) }} @endif
									</td>
								</tr>
							</tbody>
						</table>
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
									  <table id="memberprofilelist_datatable" class="table">
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
											@php
												$slno = 1;
												$totalsubs = 0;
											@endphp
											@foreach($data['memberhistory'] as $history)
											@php
												$totalsubs += $history->subs;
											@endphp
											<tr>
												<td> {{ $slno }} </td>
												<td> {{ date('M/ Y',strtotime($history->statusMonth)) }} </td>
												<td> {{ $history->subs }} </td>
												<td> {{ $history->welfare_fee }} </td>
												<td> {{ $totalsubs }} </td>
											</tr>
											@php
												$slno++;
											@endphp
											@endforeach
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
</script>