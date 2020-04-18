<!--

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
       
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="statusdate" class="form-control date-picker">
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>-->
           <!-- </form>
        </div>
    </div>
</div>-->
<style>
.swal-text {
	text-align: center;
    font-size: 19px;
    line-height: 30px;
}
.swal-footer {
	text-align: center;
}
</style>
<meta name="csrf-token" content="{!! csrf_token() !!}">
@include('template.header')
@php
use App\Model\Company;
use App\Model\Subcompany;
use App\Model\SubMatchmaster;
@endphp

		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Subscription</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Subscription Upload
						  </li>
						</ol>
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
									<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
											@csrf
                                            <div class="col s12 m6 l3">
											<input type="month" name="statusdate" id="statusdate" class="form-control">
                                            </div>
											<div class="col s12 m6 l5">
											<select class="error" id="company_name" name="company_name" data-error=".errorTxt9" required="">
											  <option value="">Choose company name</option>
											  
											  @foreach($data['company'] as $row_res)
											  <option value="{{ $row_res->id}}" >{{ $row_res->company_name }}</option>
											  @endforeach
											 <!-- <option value="1">company 1
											  <option value="2">company 2-->
											</select>
                                            </div>
											<div id="file_upload_show" style="display:none">
                                            <div class="col s12 m6 l4" >
											<input type="file" name="file" class="form-control" >
                                            </div>
											<br><br><br>
											<button class="btn btn-success">Submit</button>
                                            <br><br><br>
											</div>
										  <!--  <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>-->
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
					  <div class="row">
						<div class="col s12">
						
								
								<!--end sub-->
								<div class="col s12 m6 l6 card">
								<span class="col l12" style="padding:1%;font-weight:bold;color:black;width:100%;text-align:center;"><u>Summary for the Current Month</u></span>
								
								
								<table style="width:100%;">
								<tr style="background: -webkit-linear-gradient(45deg, #37459e, #7e27a2);color:#fff;">
								<td>SlNo</td>
								<td>Company Name</td>
								<td>Member Count</td>
								<td>Total Amount</td>
								</tr>
								@php
								$tot=0;
								$sum=0;
								@endphp
								@foreach($data['report'] as $k=>$cmpcunt)
								@php
								//var_dump($cmpcunt->company_id);
								//exit;
								
								$cmpy_name= Company::where([
									['id','=',$cmpcunt->company_id]
								])->value('company_name');
								//var_dump($cmpy_name);
								//exit;
								@endphp
								<tr class="hideonchg">
								<td>{{ $k+1 }}</td>
								<td>{{ $cmpy_name  }}</td>
								<td>@php $tot += $cmpcunt->total; @endphp {{ $cmpcunt->total }}</td>
								<td>@php $sum += $cmpcunt->sum; @endphp {{ $cmpcunt->sum }}</td>
								</tr>
								@endforeach
								<tr style="font-weight:bold;color:black"  class="hideonchg">
								<td style="font-weight:bold" colspan='2'>Total</td>
								<td style="font-weight:bold">@php echo $tot; @endphp</td>
								<td style="font-weight:bold">@php echo $sum; @endphp</td>
								</tr>
								<tbody id="tbdycmpy1">
								</tbody>
								<tr style="color:black;" id="tbdycmpy2">
								</tr>
								</table>
								<br><br><br>
								</div>
								<div class="col s12 m6 l6 card">
								<span class="col l12" style="padding:1%;font-weight:bold;color:black;width:100%;text-align:center;"><u>Approval Members</u></span>
								<table style="width:100%;">
								<tr style="background: -webkit-linear-gradient(45deg, #37459e, #7e27a2);color:#fff;">
								<td>SlNo</td>
								<td>Description</td>
								<td>Count</td>								
								</tr>
								@php
								$totm=0;
								$summ=0;
								@endphp
								@foreach($data['match'] as $key=>$cmpcunt)
								@php
								//var_dump($cmpcunt->company_id);
								//exit;
								/*$mtch_name= SubMatchmaster::where([
									['id','=',$cmpcunt->match_no]
								])->value('match_name');
								*/
								@endphp
								<tr class="hideonchg">
								<td>{{$key+1}}</td>
								<td><a href="{{ url('mismatchdetails/'.$cmpcunt->subcompany_id.'/'.$cmpcunt->id) }}" >{{ $cmpcunt->match_name }} </a> </td>
								<td>@php $totm += $cmpcunt->total; @endphp {{ $cmpcunt->total }}</td>
								
								</tr>
								@endforeach
								<tr style="font-weight:bold;color:black" class="hideonchg">
								<td style="font-weight:bold" colspan="2">Total</td>
								<td style="font-weight:bold">@php echo $tot; @endphp</td>								
								</tr>
								<tbody id="tbdy1">
								</tbody>
								<tr style="color:black;" id="tbdy2">
								</tr>
								</table>
								<br><br><br>
								</div>
						</div>
					  </div>
				</div>
				<!--div class="content-overlay"></div-->
			</div>
			
		</div>
												
												
@include('template.footer')
<script>
function mismatch_bseddetails(mat_id){	
	//console.log(match_id);		
	//alert(mat_id);	
	//var url = "{{ url(app()->getLocale().'/mismatch_bseddetails') }}"	
	var statusmonth = $("#statusdate").val();	
	var url = "{{url('/mismatch_bseddetails')}}";	
	//console.log(statusmonth);	
	//console.log(url);	
	//return;	
	$.ajax({	
			   type:"POST",	
			   url:url,	
			   //data: dataString,	
			   data: {"_token": "{{ csrf_token() }}","mat_id": mat_id,"statusmonth":statusmonth},	
				success:function(response) {	
					//console.log(response);	
				//window.location.href = response;	
				//window.location.href = response.redirect;	
				var w = window.open("{{url('/mismatch_bseddetails')}}");	
				w.document.open();	
				w.document.write(response);	
				w.document.close();	
				}	
	});	
}
$(document).ready(function(){
	$('#tbdy1').empty();
	$('#tbdy2').empty();
	//$('#hideonchg1').hide();
	
  $("#statusdate").change(function(){
    //alert("The text has been changed.");
	$('#company_name').prop('selectedIndex',0);
	var statusmonth = $(this).val();
	$('#tbdy1').empty();
	$('#tbdy2').empty();
	$('#tbdycmpy2').empty();
	$('#tbdycmpy1').empty();
	//var dataString = "&_token"+ "{{csrf_token()}}"+'&statusmonth=' + statusmonth ;
	$.ajax({
			   type:"POST",
			   url:"{{url('/get_subdetails')}}",
			   //data: dataString,
			   data: {"_token": "{{ csrf_token() }}","statusmonth": statusmonth},
				success:function(response) {
					$('.hideonchg').hide();
					//console.log($.parseJSON(response).size());
					var totcnt = 0;
					$.each($.parseJSON(response), function(idx, obj) {
						totcnt += parseInt(obj.total);
					<!--	$('#tbdy1').append('<tr><td>'+(idx+1)+'</td><td>'+obj.match_name+'</td><td>'+obj.total+'</td></tr>');-->
					});
					$('#tbdy1').append('<tr><td>'+(idx+1)+'</td><td><a onclick="mismatch_bseddetails('+obj.id+');">'+obj.match_name+'</a></td><td>'+obj.total+'</td></tr>');
					$('#tbdy2').append('<td colspan="2">Total</td><td>'+totcnt+'</td>');
				}
	});
	$.ajax({
			   type:"POST",
			   url:"{{url('/get_subdetailscmpy')}}",
			   //data: dataString,
			   data: {"_token": "{{ csrf_token() }}","statusmonth": statusmonth},
				success:function(response) {
					$('.hideonchg').hide();
					//console.log($.parseJSON(response).size());
					var totcnt = 0;
					var sumcnt = 0;
					$.each($.parseJSON(response), function(idx, obj) {
						totcnt += parseInt(obj.total);
						sumcnt += parseInt(obj.sum);
						$('#tbdycmpy1').append('<tr><td>'+(idx+1)+'</td><td>'+obj.company_name+'</td><td>'+obj.total+'</td><td>'+obj.sum+'</td></tr>');
					});
					$('#tbdycmpy2').append('<td colspan="2">Total</td><td>'+totcnt+'</td><td>'+sumcnt+'</td>');
				}
	});

  });
  
});

$(document).ready(function(){
	$("#company_name").change(function(){
		var company_id = $(this).val();
		var statusmonth = $("#statusdate").val();
		//alert(statusmonth);
		$.ajax({
		type:"POST",
		url:"{{url('/get_subs_avilablity_check')}}",
		//data: dataString,
		data: {"_token": "{{ csrf_token() }}","statusmonth": statusmonth,"company_id": company_id},
			success:function(response) {
				if(response == 0)
				{
					$("#file_upload_show").css("display","block");
				}
				else
				{
					$("#file_upload_show").css("display","none");
					resignMemberStatusUpdate(company_id, statusmonth);
				}
				
			}
		});
	
	});
});
function resignMemberStatusUpdate(company_id, statusmonth)
{
	//alert(company_id);
	//return;
	swal({
		//title: "Are you sure?", 
		text: "Already datas are uploaded for this company month / year, If you want reupload the file mean click on yes?", 
		buttons: {
		  cancel: true,
		  delete: 'Yes'
		},
		icon: "warning",
	}).then((willDelete) => {
				if(willDelete) {
					$.ajax({
						url : "{{ url('/delete_existingmembersDetails') }}" + '/' + company_id + '/' + statusmonth,
						type : "POST",
						data : {_token: "{{csrf_token()}}"},
						success: function(){
							$(".swal-overlay--show-modal").css("display","none");
							$("#file_upload_show").css("display","block");
							$('#tbdy1').css("display","none");
							$('#tbdycmpy1').css("display","none");
							$('#tbdy2').css("display","none");
							$('#tbdycmpy2').css("display","none");
							
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
	});
}
</script>