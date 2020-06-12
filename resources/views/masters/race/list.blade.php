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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Race</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Race List
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							<a href="{{ route('racenew') }}" class="btn waves-effect waves-light breadcrumbs-btn right" ><i class="material-icons hide-on-med-and-up">settings</i> Add </a>
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
									  <table id="memberprofilelist_datatable" class="table">
										<thead>
											<tr>
												<th>Race Name</th>
												<th style="text-align:center" >Action</th>
											  </tr>
										</thead>
										<tbody>
											@foreach($data['race_view'] as $race)
											<tr>
												<td>
													{{ $race->name }}
												</td>
												<td>
													@php
													$enc_id = Crypt::encrypt($race->id);
                 									$edit = route('editrace',$enc_id);
													@endphp
													<p>
														<a href="{{$edit}}" style="float:left"><i class="material-icons" style="color: #00bcd4!important;">edit</i></a>
														<a style="float:left"></a>
													</p>
													<form style="display:inline-block;" action="{{ route('Racedestroy',$enc_id) }}" method="POST"><a style="float:left">    
														@csrf
                  										@method('DELETE')
														&nbsp;&nbsp;<button type="submit" class="btn-sm " onclick="return ConfirmDeletion()" style="background: none;border: none;"><i style="color:red" class="material-icons">delete</i></button> <p></p></a>
													</form>
												</td>
											</tr>
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

<script>
$(document).ready(function() {
//$("#li_compnay").addClass('active');
	
		$('#memberprofilelist_datatable').DataTable({});
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