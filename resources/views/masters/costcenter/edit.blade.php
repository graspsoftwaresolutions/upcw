@include('template.header')

		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Cost Center Name</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Cost Center add
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							<a href="{{ route('costcenter') }}" class="btn waves-effect waves-light breadcrumbs-btn right" ><i class="material-icons hide-on-med-and-up">settings</i> List </a>
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
                                @php $row = $data['cost_view']; @endphp
								<form class="formValidate" id="formValidate" method="POST" action="{{ route('updatecostcenter') }}">
									
									@csrf
                                    <input type="hidden" name="autoid" value="{{$row->id}}">
									<div class="row">
										<div class="col m4 s12">
                                            <label for="company_name">Company*</label>
                                            <select class=" browser-default" id="company_name" required='true' name="company_name" data-error=".errorTxt6" >
											  <option value="">Choose company name</option>
											  
											  @foreach($data['company_view'] as $row_res)
											  <option @if($row->company_id==$row_res->id) selected @endif value="{{ $row_res->id}}" >{{ $row_res->company_name }}</option>
											  @endforeach
											 
											</select>
											<div class="input-field">
	                                            <div class="errorTxt6"></div>
	                                        </div>
                                        </div>
										<div class="input-field col m6 s6">
										  <label for="cost_center">Cost Center Name</label>
										  <input id="cost_center" value="{{$row->branch_name}}" name="cost_center" type="text" data-error=".errorTxt1">
										  <small class="errorTxt1"></small>
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

<script>


  $("#formValidate").validate({
    rules: {
	  company_name:{
        required: true,
      },
	 
      },
      //For custom messages
      messages: {
		company_name:{
				required: "Select Company name"
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