@include('template.header')

		<div class="row">
			<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
				  <!-- Search for small screen-->
				  <div class="container">
					<div class="row">
					  <div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Company Name</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Company add
						  </li>
						</ol>
					  </div>
					  <div class="col s2 m6 l6">
							<a href="{{ route('companylist') }}" class="btn waves-effect waves-light breadcrumbs-btn right" ><i class="material-icons hide-on-med-and-up">settings</i> List </a>
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
                                @php $row = $data['relation_view']; @endphp
								<form class="formValidate" id="formValidate" method="POST" action="{{ route('updaterelation') }}">
									
									@csrf
                                    <input type="hidden" name="autoid" value="{{$row->id}}">
									<div class="row">
										<div class="input-field col m6 s6">
										  <label for="relation_name">Relationship Name</label>
										  <input id="relation_name" value="{{$row->relation_name}}" name="relation_name" type="text" data-error=".errorTxt1">
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
$('select[required]').css({
    position: 'absolute',
    display: 'inline',
    height: 0,
    padding: 0,
    border: '1px solid rgba(255,255,255,0)',
    width: 0
  }); 

  $("#formValidate").validate({
    rules: {
	  company_name:{
        required: true,
      },
	 
      },
      //For custom messages
      messages: {
		company_name:{
				required: "Enter a Company name"
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