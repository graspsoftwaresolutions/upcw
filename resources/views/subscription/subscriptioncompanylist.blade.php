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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Subscription Company</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Subscription Company List
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
						  <div class="card-title">
							<h4 class="card-title">Company Name: {{ CommonHelper::getCompanyFromSubsCompanyId($data['subs_id']) }}</h4>
							<h4 class="card-title">Subscription Month: {{ date('M / Y',strtotime(CommonHelper::getSubsMonthFromCompanyId($data['subs_id']))) }}</h4>
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
													<th style="text-align:center">Cost Center</th>
													<th style="text-align:center">Member No</th>
													<th style="text-align:center">Member Name</th>
													<th style="text-align:center">Subs</th>
													<th style="text-align:center">Action</th>
												  </tr>
											</thead>
											<tbody>
												@php 
													$i = 1;
													foreach($data['overall_company_member'] as $row)
													{
												@endphp
												<tr>
													<td style="text-align:center">{{ $i }}</td>
													<td style="text-align:center">{{ CommonHelper::getCostCenterName($row->sub_cid) }}</td>
													<td style="text-align:center">{{ $row->member_no }}</td>
													<td style="text-align:center">{{ $row->member_name }}</td>
													<td style="text-align:center">{{ $row->subs }}</td>
													<td style="text-align:center; width: 300px!important;">
														
															<button data-target="modal{{ $row->id }}" class="btn modal-trigger" id="test_modal" data-id="{{ $row->id }}" style="float: left;margin: 0 10px;">Edit</button>
														
															<form method="POST" action="{{ route('subscriptionMemberDelete',$row->id) }}" style="float: left;">
															{{ csrf_field() }}
															{{ method_field('DELETE') }}

																
																	<input type="submit" class="btn btn-danger delete-user" value="Delete">
																
															</form>
														
														
														
													</td>
												</tr>
												<div id="modal{{ $row->id }}" class="modal">
													<div class="row" style="background: #ff5a92;margin-right:0px;">
														<div class="col m10">
															<h3 style="margin: 18px;color: #fff;font-size: 25px;font-weight: bold;text-transform:uppercase">{{$row->member_name}} [{{$row->member_no}}]</h3>
														<h5>{{$row->member_name}}</h5>
														</div>
														<div class="col m1">
															<p style="text-align: right;margin: 15px 0;"><a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">
																<i class="material-icons dp48" style="color: #fff;font-weight: bold;font-size: 25px;">close</i></a>
															</p>
														</div>
													</div>
													<div class="modal-content">
														<div class="row">
														<form class="col s12" action="{{ route('subscriptionMemberUpdate') }}" method="POST">
														@csrf
														  <div class="row">
															<div class="input-field col s12">
														
																<input type="hidden" name="company_id" id="company_id" value="@php echo $id2 = \Request::segment(2); @endphp">
																<input type="hidden" name="subs_id" id="subs_id" value="{{ $row->id }}">
																<input id="subsc_company_subs" name="subsc_company_subs" type="number" value="{{ $row->subs }}" min="0">
																<label for="subsc_company_subs" class="active">Subs</label>
															</div>
															<div class="input-field col s12">
																<input id="subsc_company_insur" name="subsc_company_insur" type="number" min="0" value="{{ $row->insur }}">
																<label for="subsc_company_insur" class="active">Insur</label>
															</div>
															<div class="input-field col s12">
															  <button class="btn waves-effect waves-light right" type="submit" name="action">Submit
																<i class="material-icons right">send</i>
															  </button>
															</div>
														  </div>
														</form>
														</div>
													</div>
												</div>
												<script>
													  $(document).ready(function(){
															$('#modal{{ $row->id }}').modal();
													  });
												</script>
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

<script>
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>