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
			<h5 class="breadcrumbs-title mt-0 mb-0"><span>Company</span></h5>
			<ol class="breadcrumbs mb-0">
			  <li class="breadcrumb-item"><a href="#">Dashboard</a>
			  </li>
			  <li class="breadcrumb-item active">Member List
			  </li>
			</ol>
		  </div>
		  <div class="col s2 m6 l6">
		  		<a href="{{ route('companysave') }}" class="btn waves-effect waves-light breadcrumbs-btn right" ><i class="material-icons hide-on-med-and-up">settings</i> Add </a>
		  </div>
		</div>
	  </div>
	</div>
	<div class="col s12">
		<div class="container">
			<div class="users-list-table">
				<div class="card">
				  <div class="card-content">
					<!-- datatable start -->
					<div class="responsive-table">
					  <table id="memberprofilelist_datatable" class="table">
						<thead>
							<tr>
								<th>Company Name</th>
								<th style="text-align:center" >Action</th>
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
		</div>
	</div>
</div>
		

	
@include('template.footer')

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>

<script>
$(document).ready(function() {
//$("#li_compnay").addClass('active');
	
		$('#memberprofilelist_datatable').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],
			ajax: {
				"url": "{{ url('/get_company_list') }}",
				"dataType": "json",
				"type": "POST",
				"data": {
					_token: "{{csrf_token()}}"
				},
			},
			columns: [
				{
					"data": "company_name"
				},
				{
					"data": "options"
				}
			]
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