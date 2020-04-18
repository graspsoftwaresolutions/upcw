@include('template.header')
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
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>Member Query</span></h5>
						<ol class="breadcrumbs mb-0">
						  <li class="breadcrumb-item"><a href="#">Dashboard</a>
						  </li>
						  <li class="breadcrumb-item active">Member View
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
					<div class="section users-view">
  <!-- users view media object start -->
  <div class="card-panel">
    <div class="row">
      <div class="col s12 m7">
        <div class="display-flex media">
          <!--a href="#" class="avatar">
            <img src="../../../app-assets/images/avatar/avatar-15.png" alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
          </a-->
          <div class="media-body">
            <h6 class="media-heading">
				<span style="font-size: 19px;font-weight: bold;">{{ $memberprofile->member_name }} </span><br>
				<span>
					@php 
						$rname = DB::table('races')->where("id", "=", $memberprofile->race)->first();
						if(isset($rname))
						{
							echo "( ".$rname->name." )";
						}
					@endphp
				</span>
            </h6>
          </div>
        </div>
      </div>
      <!--div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
        <a href="app-email.html" class="btn-small btn-light-indigo"><i class="material-icons">mail_outline</i></a>
        <a href="user-profile-page.html" class="btn-small btn-light-indigo">Profile</a>
        <a href="page-users-edit.html" class="btn-small indigo">Edit</a>
      </div-->
    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s12 m4">
          <table class="striped">
            <tbody>
              <tr>
                <td> MEMBER NO </td>
                <td>{{ $memberprofile->member_no }}</td>
              </tr>
              <tr>
                <td> EMPLOYEE NO</td>
                <td>{{ $memberprofile->employee_no }}</td>
              </tr>
			  <tr>
                <td>IC NO:</td>
                <td>{{ $memberprofile->ic_no_new }}</td>
              </tr>
              <tr>
                <td>DATE OF JOIN:</td>
                <td>{{ $memberprofile->doj }}</td>
              </tr>
			  <tr>
                <td>DATE OF BIRTH:</td>
                <td>{{ $memberprofile->dob }}</td>
              </tr>
              <tr>
                <td>STATUS</td>
                <td>
					@php 
						$member_status = "";
						if($memberprofile->member_status == "1")
						{
							echo '<span class="chip green lighten-5"><span class="green-text">Active</span></span>';
						}
						if($memberprofile->member_status == "2")
						{
							echo '<span class="chip red lighten-5"><span class="red-text">RESIGNED</span></span>';
						}
					@endphp
				</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col s12 m8">
          <table class="responsive-table">
            <tbody>
			<tr>
                <td>COMPANY NAME</td>
                <td>
					@php 
						$cname = DB::table('companies')->where("id", "=", $memberprofile->company_name)->first();
					@endphp
				{{ $cname->company_name }}</td>
              </tr>
			<tr>
				<th>POSITION</th>
                <td>{{ $memberprofile->position }}</td>
              </tr>
              <tr>
				<th>ENTRANCE FEE</th>
                <td>{{ $memberprofile->entrance_fee }}</td>
              </tr>
              <tr>
                <th>MONTHLY FEE</th>
                <td>{{ $memberprofile->monthly_fee }}</td>
              </tr>
              <tr>
                <th>RECOMMENDED BY</th>
                <td>{{ $memberprofile->recommended_by }}</td>
              </tr>
			  <tr>
                <th>SUPPORTED BY</th>
                <td>{{ $memberprofile->supported_by }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
  <!-- users view card details start -->
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s12">
          <h6 class="mb-2 mt-2" style="font-size: 19px;font-weight: bold;text-transform: uppercase;margin-top:0%!important;"><i class="material-icons">error_outline</i> Personal Info</h6>
          <table class="striped">
            <tbody>
              <tr>
                <td>ADDRESS:</td>
                <td>{{ $memberprofile->address }}</td>
              </tr>
			  <tr>
                <td>EMAIL ID</td>
                <td>{{ $memberprofile->email_id }}</td>
              </tr>
              <tr>
                <td>TELEPHONE NO:</td>
                <td>{{ $memberprofile->telephone_no }}</td>
              </tr>
              <tr>
                <td>TELEPHONE NO OFFICE:</td>
                <td>{{ $memberprofile->telephone_no_office }}</td>
              </tr>
			  <tr>
                <td>TELEPHONE NO HP:</td>
                <td>{{ $memberprofile->telephone_no_hp }}</td>
              </tr>
              <tr>
                <td>POSTAL CODE</td>
                <td>{{ $memberprofile->postal_code }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <!-- users view card details ends -->

</div>
				</div>
				<!--div class="content-overlay"></div-->
			</div>
		</div>

	
@include('template.footer')

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/page-users.min.js') }}"></script>