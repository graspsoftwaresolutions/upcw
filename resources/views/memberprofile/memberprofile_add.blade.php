@include('template.header')
@section('headSection')
<link rel="stylesheet" type="text/css" href="ss{{ asset('public/assets/vendors/flag-icon/css/flag-icon.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/datepicker.css') }}">

@endsection
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Member Query</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Member add
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							<a href="{{ route('memberprofiles.index') }}" class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" ><i class="material-icons hide-on-med-and-up">settings</i> List </a>
					  </div>
					</div>
				  </div>
				</div>
			<div class="col s12">
				<div class="container">
					  <div class="row">
						<div class="col s12">
							@if (count($errors) > 0)
							  @foreach ($errors->all() as $error)
								<div class="card-alert card gradient-45deg-red-pink">
									<div class="card-content white-text">
									  <p>
										<i class="material-icons">check</i> {{ __('Error') }} : {{ __($error) }}</p>
									</div>
									<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
									  <span aria-hidden="true">×</span>
									</button>
								 </div>
							  @endforeach
							@endif
						  <div id="validations" class="card card-tabs">
							<div class="card-content">
							  <div class="card-title">
								<div class="row">
								  <div class="col s12 m6 l10">
									<h4 class="card-title">Add Member</h4>
								  </div>
								</div>
							  </div>

								<form class="formValidate" id="formValidate" method="POST" action="{{ route('memberprofiles.store') }}">

									<input type="hidden" name="id" id="updateid">
									@csrf
									<div class="row">
						              <div class="input-field col m6 s12">
						                  <label for="member_name">Member Name</label>
										  <input id="member_name" placeholder="Member Name" name="member_name" type="text" data-error=".errorTxt1">
										  <small class="errorTxt1"></small>
						              </div>
						              <div class="input-field col m6 s12">
						                <input id="pf_number" placeholder="P.F No" name="pf_no" type="text" data-error=".errorTxt111">
						                <label for="pf_number">  P.F No</label>
						              </div>
						            </div>
									
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="ic_no_new">IC No(New)</label>
										  <input id="ic_no_new" placeholder="Ic" type="text" name="ic_no_new" data-error=".errorTxt2">
										  <small class="errorTxt2"></small>
										</div>
										<div class="col m6 s12">
										  
										  	<label for="race">Race</label>
											<select class="error browser-default" id="race" name="race" data-error=".errorTxt3" required="true">
												<option value="">Choose race</option>
												@php 
													foreach($data['race_list'] as $row)
													{
												@endphp	
												<option value="{{ $row->id }}">{{ $row->name }}</option>
												@php
													}
												@endphp 
											</select>
											<small class="errorTxt3"></small>
										  
										</div>
										
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="member_no">Member No</label>
										  <input id="member_no" placeholder="Member No" type="text" name="member_no" data-error=".errorTxt11">
										  <small class="errorTxt11"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="employee_no">Employee No</label>
										  <input id="employee_no" placeholder="Employee No" type="text" name="employee_no" data-error=".errorTxt12">
										  <small class="errorTxt12"></small>
										</div>
									</div>
									<div class="row">
						              <div class="col m6 s12">
										  <label for="sex">Sex</label>
										  <div class="">
											<select class="error browser-default" id="sex" name="sex" data-error=".errorTxt41" required="">
											  <option value="">Choose sex</option>
											  <option value="male">Male</option>
											  <option value="female">Female</option>
											</select>
											<small class="errorTxt41"></small>
										  </div>
										</div>
										 <div class="col m6 s12">
										  <label for="sex">Marital status</label>
										  <div class="">
											<select class="error browser-default" id="mstatus" name="mstatus" data-error=".errorTxt42" required="">
											  <option value="">Choose status</option>
											  <option value="Single">Single</option>
											  <option value="Married">Married</option>
											  <option value="Others">Others</option>
											</select>
											<small class="errorTxt42"></small>
										  </div>
										</div>
						              
						            </div>
									
									<div class="row">
										<br>
										<div class="input-field col m6 s12">
											<input type="text" placeholder="DOB" class="datepicker1" name="dob" id="dob" data-error=".errorTxt5" required="" autocomplete="off">
											<small class="errorTxt5"></small>
											<label for="dob" class="active">Date of Birth</label>
										</div>
										<div class="input-field col m6 s12">
											<label for="doj" class="">Date of Join</label>
											<input type="text" placeholder="DOJ" class="datepicker1" name="doj" id="doj" data-error=".errorTxt6" required="" autocomplete="off">
											<small class="errorTxt6"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m12 s12">
										  <textarea id="address" name="address" placeholder="Address" class="materialize-textarea validate" data-error=".errorTxt7"></textarea>
										  <label for="address">Address</label>
										  <small class="errorTxt7"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="postal_code">Postal Code</label>
										  <input id="postal_code" type="text" placeholder="Postal Code" name="postal_code" data-error=".errorTxt8">
										  <small class="errorTxt8"></small>
										</div>
										<div class="input-field col m6 s12">
											<label for="promoteddate" class="">Date Promoted to Scope of AMCO</label>
											<input type="text" placeholder="Date Promoted to Scope of AMCO" class="datepickerone" name="promoted_date" id="promoteddate" data-error=".errorTxt61" autocomplete="off">
											<small class="errorTxt61"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m12 s12">
										  <textarea id="offaddress" name="office_address" placeholder="Address" class="materialize-textarea validate" data-error=".errorTxt7"></textarea>
										  <label for="offaddress">Office Address</label>
										  <small class="errorTxt7"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="email_id">Personal E-Mail </label>
										  <input id="email_id" placeholder="Personal Email" type="email" name="email_id" data-error=".errorTxt16">
										  <small class="errorTxt16"></small>
										</div>
										<div class="input-field col m6 s12">
											<label for="off_email_id">Office E-Mail </label>
										  <input id="off_email_id" placeholder="Office Email" type="email" name="office_email" data-error=".errorTxt16">
										  <small class="errorTxt16"></small>
										</div>
									</div>
									<div class="row">
										<div class="col m6 s12">
											<label for="memberofunion">Have you been a member of this union before? </label>

											<p style="margin-top: 10px;">
											    <label>
											      <input class="with-gap" name="memberofunion" type="radio" value="0"  />
											      <span>Yes</span>
											    </label>
											    &nbsp;&nbsp;&nbsp;
											    <label>
											      <input class="with-gap" name="memberofunion" type="radio" value="1" checked />
											      <span>No</span>
											    </label>
											</p>
										    <p>
											    
										    </p>
										    <br>
										</div>
									</div>
									<div class="row">
										<div class="col m12 s12">
										  <label for="sex">Company name</label>
										  <div class="">
											<select class="error" id="company_name" name="company_name" data-error=".errorTxt9" required="">
												<option value="">Choose company name
												@php 
													foreach($data['company_list'] as $row)
													{
												@endphp
												<option selected="" value="{{ $row->id }}">{{ $row->company_name }}
												@php
													}
												@endphp
											</select>
											<small class="errorTxt9"></small>
										  </div>
										</div>
									</div>
									<div class="row">
								        <div class="col s12">
								          Proposed by  : Name &nbsp;&nbsp;&nbsp;
								          <div class="input-field inline" style="margin: 3px !important;">
								            <input id="proposedname" name="proposed_name" style="width:450px;" type="text" class="validate">
								          </div>
								          PF No / Membership No &nbsp;&nbsp;&nbsp;
								          <div class="input-field inline" style="margin: 3px !important;">
								            <input id="proposedname" name="proposed_number" style="width:350px;" type="text" class="validate">
								          </div>
								        </div>
								    </div>
								    <div class="row">
								        <div class="col s12">
								          Seconded by  : Name &nbsp;&nbsp;&nbsp;
								          <div class="input-field inline" style="margin: 3px !important;">
								            <input id="secondedname" name="seconded_name" style="width:450px;" type="text" class="validate">
								          </div>
								          PF No / Membership No &nbsp;&nbsp;&nbsp;
								          <div class="input-field inline" style="margin: 3px !important;">
								            <input id="secondedname" name="seconded_number" style="width:350px;" type="text" class="validate">
								          </div>
								        </div>
								    </div>
								    <div class="row">
										<div class="input-field col m6 s12">
										  <label for="meet_on">Decision on this application made at EXCO Meeting held on </label>
										  <input id="meet_on" placeholder="Meet on" type="text" class="datepickerone" name="meet_date" data-error=".errorTxt16">
										  <small class="errorTxt16"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="date_approved"> Date Approved  </label>
										  <input id="date_approved" placeholder="Date" type="text" class="datepickerone" name="approved_date" data-error=".errorTxt16">
										  <small class="errorTxt16"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="position">Position</label>
										  <input id="position" type="text" placeholder="Position" name="position" data-error=".errorTxt10">
										  <small class="errorTxt10"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="approvedrejected">Approved / Rejected</label>
										  <input id="approvedrejected" type="text" placeholder="Approved / Rejected" name="approved_status" data-error=".errorTxt10">
										  <small class="errorTxt10"></small>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="telephone_no">No.Tel(R)</label>
										  <input id="telephone_no" type="text" placeholder="No.Tel(R)" name="telephone_no" data-error=".errorTxt13">
										  <small class="errorTxt13"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="telephone_no_office">No.Tel(O)</label>
										  <input id="telephone_no_office" type="text" placeholder="No.Tel(O)" name="telephone_no_office" data-error=".errorTxt14">
										  <small class="errorTxt14"></small>
										</div>
										
									</div>
									
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="telephone_no_hp">No.H/P</label>
										  <input id="telephone_no_hp" type="text" name="telephone_no_hp" placeholder="No.H/P" data-error=".errorTxt15">
										  <small class="errorTxt15"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="entrance_fee">Entrance Fee</label>
										  <input id="entrance_fee" type="text" name="entrance_fee" value="10" data-error=".errorTxt17">
										  <small class="errorTxt17"></small>
										</div>
										
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="monthly_fee">Monthly Fee</label>
										  <input id="monthly_fee" type="text" name="monthly_fee" value="15" data-error=".errorTxt18">
										  <small class="errorTxt18"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="welfare_fund">Welfare Fund</label>
										  <input id="welfare_fund" type="text" name="welfare_fund" value="1" data-error=".errorTxt18">
										  <small class="errorTxt18"></small>
										</div>
										
										
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="recommended_by">Recommended By</label>
										  <input id="recommended_by" type="text" placeholder="Recommended By" name="recommended_by" data-error=".errorTxt19">
										  <small class="errorTxt19"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="supported_by">Supported By</label>
										  <input id="supported_by" type="text" placeholder="Supported By" name="supported_by" data-error=".errorTxt20">
										  <small class="errorTxt20"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="designation">Designation and Department/Branch</label>
										  <input id="designation" type="text" placeholder="Designation and Department/Branch" name="designation_branch" data-error=".errorTxt20">
										  <small class="errorTxt20"></small>
										</div>
										<div class="col s6">
										  <label for="member_status">Member Status *</label>
										  <div class="">
											<select class="error" id="member_status" name="member_status" data-error=".errorTxt21" required="">
											  <option value="1">Active
											  <option value="2">Deactive
											</select>
											<small class="errorTxt21"></small>
										  </div>
										</div>
									</div>
									<div class="row">
										
										<div class="col s12 m12">
											Nominee Details
											<input type="button" class="btn btn-sm purple" name="addnominee" id="addnominee" value="Add Nominee" />
											 <input type="text" name="nomineecount" class="hide" readonly id="nomineecount" value="0" />
											 <table>
											 	<thead>
											 		<tr>
											 			<th width="20%">Name</th>
											 			<th width="40%">Home Address</th>
											 			<th width="5%">Age</th>
											 			<th width="15%">Relationship</th>
											 			<th width="10%">NRIC No</th>
											 			<th>Action</th>
											 		</tr>
											 	</thead>
											 	<tbody id="nomineearea">
											 		
											 	</tbody>
											 	
											 </table>
										</div>
										<div class="col s12 m12">
											<br>
											<br>
											Guardian Details
											<table>
											 	<thead>
											 		<tr>
											 			<th width="20%">Name</th>
											 			<th width="40%">Home Address</th>
											 			<th width="5%">Age</th>
											 			<th width="15%">Relationship</th>
											 			<th width="10%">NRIC No</th>
											 		</tr>
											 	</thead>
											 	<tbody id="gaurdarea">
											 		
											 	<tr><td><input id="gaurdname" name="gaurdname[]" type="text"></td><td><input id="gaurd_address" name="gaurd_address" type="text"></td><td><input id="gaurd_age" name="gaurd_age" type="text"></td><td><input id="nominee_relationship" name="nominee_relationship" type="text"></td><td><input id="nominee_nric" name="nominee_nric" type="text"></td></tr></tbody>
											 	
											 </table>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
										  <button class="btn waves-effect waves-light right submit" type="submit" name="action">Submit
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
				<!--div class="content-overlay"></div-->
			</div>
		</div>


@include('template.footer')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>


  $("#formValidate").validate({
    rules: {
      member_name: {
        required: true,
      },
      ic_no_new: {
        required: true,
      },
	  race: {
        required: true,
      },
	  sex: {
        required: true,
      },
	  /* dob: {
        required: true,
		date:true
      }, */
	  doj: {
        required: true
      },
	  /* address: {
        required: true,
      }, */
	  /* postal_code: {
		required: true,  
	  }, */
	  company_name:{
        required: true,
      },
	  /* position:{
        required: true,
      }, */
	  "member_no":{
        required: true,
		remote: {
			url: "{{ url('/findMemberNoExists')}}",
			data: {
				mp_id: function() {
					return $("#updateid").val();
				},
				_token: "{{csrf_token()}}",
				member_no: $(this).data('member_no')
			},
			type: "GET",
		},
      },
	  employee_no:{
        required: true,
      },
	  /* telephone_no:{
        required: true,
      },
	  telephone_no_office:{
        required: true,
      },
	  telephone_no_hp:{
        required: true,
      },
	  email_id:{
        required: true,
		email:true,
      },
	  entrance_fee: {
		required: true,
	  },
	  monthly_fee: {
		required: true,
	  },
	  recommended_by: {
		required: true,
	  },
	  supported_by: {
		required: true,
	  },
	  member_status: {
		required: true,
	  }, */
      /* password: {
        required: true,
        minlength: 5
      },
      cpassword: {
        required: true,
        minlength: 5,
        equalTo: "#password"
      },
      curl: {
        required: true,
        url:true
      }, */
      
      /* cgender:"required",
      cagree:"required", */
      },
      //For custom messages
      messages: {
			member_name:{
				required: "Enter a member name"
				//minlength: "Enter at least 5 characters"
			},
			member_no: {
				required: "member no required",
				remote: "Already member no exist"
			},
      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }
  });
  

	  
</script>

<style>
.ui-datepicker-month
{
	display: block;
    height: 30px;
	float: left;
}
.ui-datepicker-year
{
	display: block;
    height: 30px;
	float: right;
}
</style>
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
	$(".datepickerone").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});
  });
  $(document.body).on('click', '.delete_nominee' ,function(){
		if(confirm('Are you sure you want to delete?')){
			var attach_id = $(this).data('id');
			var parrent = $(this).parents("tr");
			parrent.remove(); 
		}else{
			return false;
		}
		
	});
  $('#addnominee').click(function(){
    	var nomineecount = $("#nomineecount").val();
    	//alert(nomineecount);
	    var attachrow = '<tr><td><input type="text" name="serialnumber[]" id="serialnumber" class="hide" readonly value="'+nomineecount+'" /><input id="nomineename_'+nomineecount+'" name="nomineename[]" type="text" /></td>';

	    attachrow += '<td><input id="nominee_address_'+nomineecount+'" name="nominee_address[]" type="text" /></td>';
	    attachrow += '<td><input id="nominee_age_'+nomineecount+'" name="nominee_age[]" type="text" /></td>';
	    attachrow += '<td><input id="nominee_relationship_'+nomineecount+'" name="nominee_relationship[]" type="text" /></td>';
	    attachrow += '<td><input id="nominee_nric_'+nomineecount+'" name="nominee_nric[]" type="text" /></td>';
		
		attachrow += '<td><button type="button" data-id="'+nomineecount+'" class="delete_nominee waves-light btn">Delete</button></td></tr>';
		$('#nomineearea').append(attachrow);
		nomineecount = parseInt(1)+parseInt(nomineecount);
		$("#nomineecount").val(nomineecount);
	});
</script>