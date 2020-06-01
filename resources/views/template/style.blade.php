<link rel="apple-touch-icon" href="{{ asset('public/app-assets/images/favicon/favicon.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/app-assets/images/favicon/favicon.png') }}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- BEGIN: VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/animate-css/animate.css') }}">

<!--link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/sweetalert/sweetalert.css') }}"-->

<!-- END: VENDOR CSS-->
<!-- BEGIN: Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/themes/vertical-modern-menu-template/materialize.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/themes/vertical-modern-menu-template/style.min.css') }}">
<style>
.users-list-wrapper .users-list-table .dataTable tbody td {
    padding: 7px 0px!important;
	font-size: 13px;
}
</style>
<style type="text/css">
	label {
	    font-size: .8rem;
	    color: #000 !important;
	}
</style>
@include('template.script')

<script>
 $("#collapsible_expen").mouseover(function(){
	 alert("testt");
                //$("#projectStatusDrp").show();
				$(".sidenav-main").addClass("nav-expanded");
				$(".sidenav-main").removeClass("nav-collapsed");
 });

      $("#collapsible_expen").blur(function() {
            $(".sidenav-main").addClass("nav-expanded");
			$(".sidenav-main").removeClass("nav-collapsed");
        });
</script>