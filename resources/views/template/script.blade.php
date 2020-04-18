<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('public/app-assets/js/vendors.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('public/app-assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<!-- BEGIN THEME  JS-->
<script src="{{ asset('public/app-assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/search.min.js') }}"></script>
<script src="{{ asset('public/app-assets/js/custom/custom-script.min.js') }}"></script> <!--pending-->
<script src="{{ asset('public/app-assets/js/scripts/customizer.min.js') }}"></script>

<!-- BEGIN PAGE LEVEL JS-->
<!--script src="{{ asset('public/app-assets/js/scripts/extra-components-sweetalert.min.js') }}"></script-->
	
<script src="{{ asset('public/app-assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<!-- END PAGE LEVEL JS-->
<style>
.card-alert {
	position: fixed;
    top: 0px;
    right: 5px;
    padding: 10px 10px;
    z-index: 9999;
    margin: 10px 5px;
} 
</style>
<script>
$(document).ready(function(){
	$(".card-alert").delay(2000).slideUp(300);
});
</script>
<script>
$(window).resize(function(){
	if ($(window).width() >= 1024){	
		$(".sidenav-main").removeClass("nav-lock"); 
		$(".sidenav-main").removeClass("nav-expanded"); 
		$(".sidenav-main").addClass("nav-collapsed");
	}	
});
</script>