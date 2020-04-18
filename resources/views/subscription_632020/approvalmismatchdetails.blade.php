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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Approval Report</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">New Register Approval
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
					  </div>
					</div>
				  </div>
				</div>
			@php	
			$dt_sub = DB::table('subscription_member')->where('id',$data['id'])->get();
			$memb_name =$dt_sub[0]->member_name;
			$cm_nm =$dt_sub[0]->company_name;
			$cmpyid =DB::table('subcompany')->where('id',$dt_sub[0]->subcompany_id)->value('company_id');
			$mem_no = $dt_sub[0]->member_no;
			$mem_ic = $dt_sub[0]->member_ic;
			if(isset($dt_sub[0]->emp_no)){
				$empno = $dt_sub[0]->emp_no;
			}
			else{
				$empno ="";
			}
			
			$mem_sub = $dt_sub[0]->subs;
			$statMon = DB::table('subcompany')->where('id',$dt_sub[0]->subcompany_id)->value('statusMonth_id');
			$statMondj = DB::table('statusmonth')->where('id',$statMon)->value('statusMonth');
			
			$doj = date('Y-m-d',strtotime($statMondj));
			$dt_subdet = DB::table('memberprofiles')->where('member_no',$mem_no)->first();
			
			//var_dump($dt_subdet);
			//exit;
			if(isset($dt_subdet)){
				$memcode = $dt_subdet->id;
				@endphp
				<div class="col s12">
				<div class="container">
				<section class="users-list-wrapper section">
				<div class="users-list-table">
				<div class="card  col s12 m12">
					<div class="card-content">
					<table class="striped" style="padding:2%;border:2px solid grey;width:100%;">
						<tr style="margin:20% !important">
								<td style="padding:1%;font-weight:bold !important;color:black;"> COMPANY NAME </td>
								<td>{{ isset($cm_nm)?$cm_nm:'' }}</td>
							</tr>
							<tr style="margin:20% !important">
								<td style="padding:1%;font-weight:bold !important;color:black;"> MEMBER NO </td>
								<td>{{ isset($mem_no)?$mem_no:'' }}</td>
							</tr>
							<tr>
								<td style="padding:1%;font-weight:bold !important;color:black;"> MEMBER NAME</td>
								<td>{{ isset($memb_name)?$memb_name:'' }}</td>
							</tr>
							<tr>
								<td style="padding:1%;font-weight:bold !important;color:black;">IC NO:</td>
								<td>{{ isset($mem_ic)?$mem_ic:'' }}</td>
							</tr>
							<tr>
								<td style="padding:1%;font-weight:bold !important;color:black;">EMPLOYEE NO:</td>
								<td>{{ isset($empno)?$empno:'' }}</td>
							</tr>
							<tr>
								<td style="padding:1%;font-weight:bold !important;color:black;">DATE OF JOIN:</td>
								<td>{{ isset($doj)?$doj:'' }}</td>
							</tr>
							<tr>
								<td style="padding:1%;font-weight:bold !important;color:black;text-transform:uppercase;">MONTHLY SUB:</td>
								<td>{{ isset($mem_sub)?$mem_sub:'' }}</td>
							</tr>
							<tr><td colspan=2>
							<button style="background:green !important;color:white;"  onclick="approveexistmem({{$data['id']}});" class="btn btn-success">Approved</button>
							<button style="background:red !important;color:white;"  onclick="approveexistmemrej({{$data['id']}});" class="btn btn-danger">Rejected</button>
							
							</td></tr>
							</table>

								</div>	</div>	
								</div>	</section></div>	</div>							
				@php
			}
			else{
				//echo "new";
			
			@endphp
			<div class="col s12">
				<div class="container">
					  <section class="users-list-wrapper section">
							  <div class="users-list-table">
								<div class="card  col s12 m12">
								  <div class="card-content">
								  	
										<table class="striped" style="padding:2%;border:2px solid grey;width:100%;">
										<tr style="margin:20% !important">
												<td style="padding:1%;font-weight:bold !important;color:black;"> COMPANY NAME </td>
												<td>{{ isset($cm_nm)?$cm_nm:'' }}</td>
											</tr>
											<tr style="margin:20% !important">
												<td style="padding:1%;font-weight:bold !important;color:black;"> MEMBER NO </td>
												<td>{{ isset($mem_no)?$mem_no:'' }}</td>
											</tr>
											<tr>
												<td style="padding:1%;font-weight:bold !important;color:black;"> MEMBER NAME</td>
												<td>{{ isset($memb_name)?$memb_name:'' }}</td>
											</tr>
											<tr>
												<td style="padding:1%;font-weight:bold !important;color:black;">IC NO:</td>
												<td>{{ isset($mem_ic)?$mem_ic:'' }}</td>
											</tr>
											<tr>
												<td style="padding:1%;font-weight:bold !important;color:black;">DATE OF JOIN:</td>
												<td>{{ isset($doj)?$doj:'' }}</td>
											</tr>
											<tr>
												<td style="padding:1%;font-weight:bold !important;color:black;text-transform:uppercase;">Monthly Subscription:</td>
												<td>{{ isset($mem_sub)?$mem_sub:'' }}</td>
											</tr>
											<tr>
												<td style="padding:1%;font-weight:bold !important;color:black;text-transform:uppercase;" colspan="2">
												<button style="background:green !important;color:white;"  onclick="approvenewmem({{$data['id']}});" class="btn btn-success">Approved</button>
												<button style="background:red !important;color:white;"  onclick="approvenewmemrej({{$data['id']}});" class="btn btn-danger">Rejected</button>
												</td>
											</tr>
											</table>
			  							
								  </div>
								</div>
							  </div>
						</section>
  
				</div>
				<!--div class="content-overlay"></div-->
			</div>
			@php } @endphp
		</div>
		
@include('template.footer')

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

function approveexistmem(s_id){
	//alert(s_id);
	$.ajax({
			url : "{{ url('/update_membercodesub') }}",
			type : "POST",
			data : {_token: "{{csrf_token()}}",s_id: s_id},
			success: function(response){
				
				//window.location.href = "{{ url('/resignmember') }}";
				//location.reload();
				//console.log(response);
				if(response==1){
				//alert("Approved");
				window.location.href = "{{ url('/importExportView') }}";	
				}
				else{
					alert("Not Approved");
				}
			}
	});
}
function approvenewmem(s_id){
	var mem_no = "{{ isset($mem_no)?$mem_no:'' }}";
	var mem_name = "{{ isset($memb_name)?$memb_name:'' }}";
	var mem_ic = "{{ isset($mem_ic)?$mem_ic:'' }}";
	var mem_ic = "{{ isset($mem_ic)?$mem_ic:'' }}";
	var doj = "{{ isset($doj)?$doj:'' }}";
	var mem_sub = "{{ isset($mem_sub)?$mem_sub:'' }}";
	var cmp_id = "{{ isset($cmpyid)?$cmpyid:'' }}";
	var empno = "{{ isset($empno)?$empno:'' }}";
	//alert(cmp_id);
	$.ajax({
			url : "{{ url('/update_newmemregister') }}",
			type : "POST",
	data : {_token: "{{csrf_token()}}",s_id:s_id,empno:empno,mem_no:mem_no,mem_name:mem_name,mem_ic:mem_ic,doj:doj,mem_sub:mem_sub,cmp_id:cmp_id},
			success: function(response){
				//window.location.href = "{{ url('/resignmember') }}";
				//location.reload();
				if(response==1){
					alert("Member Profile Created and Approved");

				}
				else{
					alert("Not Approved");
				}
			}
	});
}
function ApprovalnewmemberUpdate(id)
{
	/*$.ajax({
			url : "{{ url('/update_newmemregister') }}" + '/' + id,
			type : "POST",
			data : {_token: "{{csrf_token()}}"},
			success: function(){
				//window.location.href = "{{ url('/resignmember') }}";
				location.reload();
			}
	});
	window.location.href = "{{ url('/update_newmemregister') }}" + '/' + id;*/
	//alert("dsfvdsg");
	//alert(id);
	//$('#modal_registermember').modal('show');
	//alert(id);
	//$("#register_id").val(id);
	//return;
	/*swal({
		//title: "Are you sure?", 
		text: "Are you sure that you want to Register?", 
		buttons: {
		  cancel: true,
		  delete: 'Yes'
		},
		icon: "warning",
	}).then((willDelete) => {
				if(willDelete) {
					$.ajax({
						url : "{{ url('/update_newmemregister') }}" + '/' + id,
						type : "POST",
						data : {_token: "{{csrf_token()}}"},
						success: function(){
							//window.location.href = "{{ url('/resignmember') }}";
							location.reload();
						},
						error : function(){
							swal({
								title: 'Opps...',
								text : data.message,
								type : 'error',
								timer : '1500'
							})
						}
					})
				} 
		/* else {
		swal("Your imaginary file is safe!");
		} */
	//});
}
	$(document).ready(function() {
		$('#mismatchmemberlist_datatable').DataTable({
			responsive: true,
			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			]
		});
	});
</script>
<script>
  $(function() {
    $("#dob").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});
	$("#doj").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});
  });
</script>