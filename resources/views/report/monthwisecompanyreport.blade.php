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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Monthlywise Company Report</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Monthlywise Company List
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
									<h4 class="card-title" style="font-size: 25px;">Subscription for the month <b style="color: #da0225;font-weight: bold;font-size: 25px;text-transform: uppercase;"> @php echo date("F Y", strtotime($data['overall_company'][0]->statusMonth)); @endphp </b></h4>
								  </div>
								</div>
								<div class="row">&nbsp;</div>
								<div class="row">
									<div class="col s6 m2">
										Company Name
									</div>
									<div class="col s6 m4">
										<b style="color: #000;">{{ $data['overall_company'][0]->company_name }}</b>
									</div>
									<div class="col s6 m2">
										Total Member
									</div>
									<div class="col s6 m1">
										<b style="color: #000;">{{ $data['overall_company_count'][0]->total }}</b>
									</div>
									<div class="col s6 m2">
										Total Amount
									</div>
									<div class="col s6 m1">
										<b style="color: #000;">{{ $data['overall_company_count'][0]->sum }}</b>
									</div>
								</div>
								<div class="row">&nbsp;</div>
							  </div>
								<div class="row">
									<div class="input-field col m3 s12">
										<input type="text" class="datepicker1" name="monthlyyear_newmember" id="monthlyyear_newmember" autocomplete="off">
										<label for="monthlyyear_newmember" class="">Member No</label>
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
										  <table id="monthwisecompanylist_datatable" class="table">
											<thead>
												<tr>
													<th style="text-align:center">S No</th>
													<th style="text-align:center">Member No</th>
													<th style="text-align:center">Member Name</th>
													<th style="text-align:center">Subs</th>
													<th style="text-align:center">Insur</th>
												  </tr>
											</thead>
											<tbody>
												@php 
													$i = 1;
													foreach($data['overall_company'] as $row)
													{
												@endphp
												<tr>
													<td style="text-align:center">{{ $i }}</td>
													<td style="text-align:center">{{ $row->member_no }}</td>
													<td style="text-align:center">{{ $row->member_name }}</td>
													<td style="text-align:center">{{ $row->subs }}</td>
													<td style="text-align:center">{{ $row->insur }}</td>
												</tr>
												@php
													$i++;
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
<script>
$(document).ready(function() {
	$('#monthwisecompanylist_datatable').DataTable({
		responsive: true,
		lengthMenu: [
			[10, 25, 50, 100],
			[10, 25, 50, 100]
		]
	});
});
</script>