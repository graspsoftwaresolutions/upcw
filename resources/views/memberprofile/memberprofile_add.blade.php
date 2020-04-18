@include('template.header')
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
						  <div id="validations" class="card card-tabs">
							<div class="card-content">
							  <div class="card-title">
								<div class="row">
								  <div class="col s12 m6 l10">
									<h4 class="card-title"></h4>
								  </div>
								</div>
							  </div>

								<form class="formValidate" id="formValidate" method="POST" action="{{ route('memberprofiles.store') }}">
									<input type="hidden" name="id" id="updateid">
									@csrf
									<div class="row">
										<div class="input-field col m12 s12">
										  <label for="member_name">Member Name</label>
										  <input id="member_name" name="member_name" type="text" data-error=".errorTxt1">
										  <small class="errorTxt1"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m4 s12">
										  <label for="ic_no_new">IC No(New)</label>
										  <input id="ic_no_new" type="text" name="ic_no_new" data-error=".errorTxt2">
										  <small class="errorTxt2"></small>
										</div>
										<div class="col m4 s12">
										  <div class="input-field">
											<select class="error" id="race" name="race" data-error=".errorTxt3" required="">
												<option value="">Choose race
												@php 
													foreach($data['race_list'] as $row)
													{
												@endphp	
												<option value="{{ $row->id }}">{{ $row->name }}
												@php
													}
												@endphp 
											</select>
											<small class="errorTxt3"></small>
										  </div>
										</div>
										<div class="col m4 s12">
										  <!--label for="sex">Sex</label-->
										  <div class="input-field">
											<select class="error" id="sex" name="sex" data-error=".errorTxt4" required="">
											  <option value="">Choose sex
											  <option value="male">Male
											  <option value="female">Female
											</select>
											<small class="errorTxt4"></small>
										  </div>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
											<input type="text" class="datepicker1" name="dob" id="dob" data-error=".errorTxt5" required="" autocomplete="off">
											<label for="dob" class="">Date of Birth</label>
											<small class="errorTxt5"></small>
										</div>
										<div class="input-field col m6 s12">
											<input type="text" class="datepicker1" name="doj" id="doj" data-error=".errorTxt6" required="" autocomplete="off">
											<label for="doj" class="">Date of Join</label>
											<small class="errorTxt6"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m12 s12">
										  <textarea id="address" name="address" class="materialize-textarea validate" data-error=".errorTxt7"></textarea>
										  <label for="address">Address</label>
										  <small class="errorTxt7"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m12 s12">
										  <label for="postal_code">Postal Code</label>
										  <input id="postal_code" type="text" name="postal_code" data-error=".errorTxt8">
										  <small class="errorTxt8"></small>
										</div>
									</div>
									<div class="row">
										<div class="col m12 s12">
										  <!--label for="sex">Sex</label-->
										  <div class="input-field">
											<select class="error" id="company_name" name="company_name" data-error=".errorTxt9" required="">
												<option value="">Choose company name
												@php 
													foreach($data['company_list'] as $row)
													{
												@endphp
												<option value="{{ $row->id }}">{{ $row->company_name }}
												@php
													}
												@endphp
											</select>
											<small class="errorTxt9"></small>
										  </div>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m12 s12">
										  <label for="position">Position</label>
										  <input id="position" type="text" name="position" data-error=".errorTxt10">
										  <small class="errorTxt10"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="member_no">Member No</label>
										  <input id="member_no" type="text" name="member_no" data-error=".errorTxt11">
										  <small class="errorTxt11"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="employee_no">Employee No</label>
										  <input id="employee_no" type="text" name="employee_no" data-error=".errorTxt12">
										  <small class="errorTxt12"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m4 s12">
										  <label for="telephone_no">No.Tel(R)</label>
										  <input id="telephone_no" type="text" name="telephone_no" data-error=".errorTxt13">
										  <small class="errorTxt13"></small>
										</div>
										<div class="input-field col m4 s12">
										  <label for="telephone_no_office">No.Tel(O)</label>
										  <input id="telephone_no_office" type="text" name="telephone_no_office" data-error=".errorTxt14">
										  <small class="errorTxt14"></small>
										</div>
										<div class="input-field col m4 s12">
										  <label for="telephone_no_hp">No.H/P</label>
										  <input id="telephone_no_hp" type="text" name="telephone_no_hp" data-error=".errorTxt15">
										  <small class="errorTxt15"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m12 s12">
										  <label for="email_id">E-Mail *</label>
										  <input id="email_id" type="email" name="email_id" data-error=".errorTxt16">
										  <small class="errorTxt16"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="entrance_fee">Entrance Fee</label>
										  <input id="entrance_fee" type="text" name="entrance_fee" data-error=".errorTxt17">
										  <small class="errorTxt17"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="monthly_fee">Monthly Fee</label>
										  <input id="monthly_fee" type="text" name="monthly_fee" data-error=".errorTxt18">
										  <small class="errorTxt18"></small>
										</div>
									</div>
									<div class="row">
										<div class="input-field col m6 s12">
										  <label for="recommended_by">Recommended By</label>
										  <input id="recommended_by" type="text" name="recommended_by" data-error=".errorTxt19">
										  <small class="errorTxt19"></small>
										</div>
										<div class="input-field col m6 s12">
										  <label for="supported_by">Supported By</label>
										  <input id="supported_by" type="text" name="supported_by" data-error=".errorTxt20">
										  <small class="errorTxt20"></small>
										</div>
	`								</div>
									<div class="row">
										<div class="col s12">
										  <label for="member_status">Member Status *</label>
										  <div class="input-field">
											<select class="error" id="member_status" name="member_status" data-error=".errorTxt21" required="">
											  <option value="1">Active
											  <option value="2">Deactive
											</select>
											<small class="errorTxt21"></small>
										  </div>
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
  });
</script>