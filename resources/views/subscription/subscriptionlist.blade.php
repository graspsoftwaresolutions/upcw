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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Subscription List</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Subscription List
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
									  <table id="subscriptionmemberlist_datatable" class="table">
									  <h5 style="text-align:left;float:left;width:50%;">Search:<input type="text" id="myInput" name="myInput" style="float:left;width:30%;" class="form-control"/> </h5>
										<thead>
											<tr>
												<th>Year / Month</th>
												<th>Company Name</th>
												<th style="text-align:center">Member Count</th>
												<th style="text-align:center">Action</th>
											</tr>
										</thead>
										<tbody>
											@php 
												foreach($data['subscriptionlist'] as $row)
												{
											@endphp
											<tr>
												<td style='text-transform: uppercase;'>
													@php
														$monthyear = DB::table('statusmonth')->where('id' ,$row->statusMonth_id)->value('statusMonth');
														echo date('Y-M', strtotime($monthyear));
													@endphp
												</td>
												<td>
													@php
														$cmp_detail = url("/subscriptioncompanylist/{$row->sub_cid}");
														$company_name = DB::table('companies')->where('id' ,$row->company_id)->value('company_name');
														echo '<a target="_blank" href="'.$cmp_detail.'">'.$company_name.'</a>';
													@endphp
												</td>
												<td style="text-align:center">{{ $row->total }}</td>
												<td style="text-align:center">
													<form method="POST" action="{{ route('subscriptionCompanyDelete',$row->sub_cid) }}">
														{{ csrf_field() }}
														{{ method_field('DELETE') }}

														<div class="form-group">
															<input type="submit" class="btn btn-danger delete-user" value="Delete">
														</div>
													</form>
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

<script>
	$(document).ready(function() {
	var table =	$('#subscriptionmemberlist_datatable').DataTable({
			responsive: true,
			//bFilter: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			]
		});
		$('#myInput').on( 'keyup', function () {
			table.search( this.value ).draw();
		} );


	});
</script>

<script>
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>