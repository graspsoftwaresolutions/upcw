<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/jquery-ui-month.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/MonthPicker.min.css') }}">
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
					  <div class="col s2 m6 l6">
					  	<a class="btn waves-effect waves-light cyan breadcrumbs-btn right " href="{{ asset('storage/app/subscription/subscription.xlsx') }}">Download Sample</a>
					  </div>
					</div>
				  </div>
				</div>
				<div class="col s12">
            <div class="container">
                 
                					                    <div class="card">
                        <div class="card-title">
                                                    </div>

                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 m12">

                                    <div class="row">
                                       <form action="{{ route('importbulk') }}" method="POST" enctype="multipart/form-data">
											@csrf                                            <div class="row">
												
                                                <div class="col m2 s12">
                                                    <label for="doe" class="active">From Month*</label>
                                                    <input type="text" name="frommonth" id="frommonth" readonly="" value="{{ date('M/Y') }}" class="datepicker-custom month-year-input">
                                                   <!--  <input type="text" name="entry_date" id="entry_date" value="Apr/2020" class="datepicker-custom month-year-input" readonly="readonly"> -->
                                                </div>
                                                <div class="col m2 s12">
                                                    <label for="type">Type*</label>
                                                    <select class="error browser-default" id="type" name="type" data-error=".errorTxt9" required="">
													  <option value="">Choose Type</option>
													  <option selected="" value="1" >Single Bank</option>
													  <option value="2" >Multiple Bank</option>
													 
													</select>
                                                    <div class="errorTxt9"></div>
                                                </div>
                                              
                                                <div id="divcompanyname" class="col m4 s12">
                                                    <label for="company_name">Bank*</label>
                                                    <select class="error browser-default" id="company_name" name="company_name" data-error=".errorTxt6" >
													  <option value="">Choose bank name</option>
													  
													  @foreach($data['company'] as $row_res)
													  <option value="{{ $row_res->id}}" >{{ $row_res->company_name }}</option>
													  @endforeach
													 <!-- <option value="1">company 1
													  <option value="2">company 2-->
													</select>
                                                    <div class="errorTxt6"></div>
                                                </div>
                                                
                                                <div id="file-upload-div" class="input-field  file-field col m2 s12">
                                                    <div class="btn ">
                                                        <span>File</span>
                                                        <input type="file" name="file" class="form-control btn" accept=".xls,.xlsx">
                                                    </div>
                                                    <div class="file-path-wrapper ">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>
                                                <div class="col m1 s12 " style="padding-top:5px;">
                                                    <br>
                                                    <button id="submit-upload" class="mb-6 btn waves-effect waves-light purple lightrn-1 form-download-btn" type="submit">Submit</button>

                                                </div>

                                            </div>
                                            <div class="row hide">
                                                <div class="col s7">

                                                </div>
                                                <div class="col s4 ">

                                                    <button id="submit-download" class="waves-effect waves-light cyan btn btn-primary form-download-btn hide" type="button">Download Sample</button>

                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
					                </div>
            </div>

				
				
			
			
		</div>
												
												
@include('template.footer')
<script src="{{ asset('public/app-assets/js/jquery-ui-month.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/MonthPicker.min.js') }}"></script>
<script>
	 $(document).ready(function() {
        $('.datepicker-custom').MonthPicker({
            Button: false,
            changeYear: true,
            MonthFormat: 'M/yy',
            OnAfterChooseMonth: function() {
                //getToDate();
            }
        });
        $('.ui-button').removeClass("ui-state-disabled");
        //$('.datepicker-custom').MonthPicker({ Button: false,dateFormat: 'M/yy' });

    });
	function getToDate(){
		var frommonth = $("#frommonth").val();
		var noofmonths = $("#noofmonths").val();

		if(frommonth!='' && noofmonths!=""){
			additional_cond = 'frommonth='+frommonth+'&noofmonths='+noofmonths;
	        $.ajax({
	            type: "GET",
	            dataType: "json",
	            url : "{{ URL::to('/get_tomonth') }}?"+additional_cond,
	            success:function(res){
	                if(res)
	                {
	                    $("#tomonth").val(res);
	                }else{
	                    $("#tomonth").val('');
	                }
	            }
	        });
		}else{
			$("#tomonth").val('');
		}
		
	}
	$(document.body).on('change', '#type' ,function(){
       var type = $("#type").val();
       if(type!=""){
       		if(type==1){
       			$("#divcompanyname").removeClass('hide');
       			$("#company_name").attr('required',true);
       		}else{
       			$("#divcompanyname").addClass('hide');
       			$("#company_name").attr('required',false);
       		}
       }else{
       		$("#divcompanyname").addClass('hide');
       		$("#company_name").attr('required',false);
       }
    });
</script>