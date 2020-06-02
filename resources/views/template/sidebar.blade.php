<style>
.brand-sidebar .brand-logo {
    margin: 1px 7px;
}
</style>  
  <!-- BEGIN: SideNav-->
    <!--aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square"-->
    <aside id="collapsible_expen" class="sidenav-main nav-collapsible sidenav-light nav-collapsed">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper" style="text-align: center;"><a class="brand-logo darken-1" href="#" style="padding: 5px 12px 22px 0px;position:unset;"><img class="hide-on-med-and-down" src="{{ asset('public/img/logo.png') }}" alt="logo" style="height:50px"><img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('public/img/logo.png') }}" alt="logo" style="height:43px"><!--span class="logo-text hide-on-med-and-down">Nuteaiw</span--></a><!--a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a--></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold"><a class="{{ Request::is('admin/home') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('admin.home') }}"><i class="material-icons">home</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><!--span class="badge badge pill orange float-right mr-10">3</span--></a>
        </li>
        <li class="bold {{ Request::is('companylist') ? 'active' : '' }}"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)" tabindex="0"><i class="material-icons">settings_brightness</i><span class="menu-title" data-i18n="Advanced UI">Master</span></a>
          <div class="collapsible-body" style="">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a href="{{ route('companylist') }}" class="{{ Request::is('companylist') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Company">Company</span></a>
              </li>
              <li><a href="{{ route('relationship') }}" class="{{ Request::is('relationship') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Company">Relationship</span></a>
              </li>
            </ul>
          </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Member Details</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        
		<li class="bold"><a class="{{ Request::is('memberprofiles*') ? 'active' : '' }}  waves-effect waves-cyan " 
        href="{{ route('memberprofiles.index') }}"><i class="material-icons">note</i>
        <span class="menu-title" data-i18n="Member Query">Member Query</span>
        <!--span class="badge new badge pill pink accent-2 float-right mr-2">5</span--></a>
        </li>
		
        <li class="bold {{ Request::is('importExportView','subscriptionList') ? 'active' : '' }}"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)" tabindex="0"><i class="material-icons">note</i><span class="menu-title" data-i18n="Advanced UI">Subscription</span></a>
          <div class="collapsible-body" style="">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a href="{{ route('SubsUploadView') }}" class="{{ Request::is('importExportView') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="New Members">Subscription Upload</span></a>
              </li>	
            <!--    <li><a href="{{ route('importExportView') }}" class="{{ Request::is('importExportView') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="New Members">Subscription Upload</span></a>
              </li>  -->
			<li><a href="{{ route('subscriptionList') }}" class="{{ Request::is('subscriptionList') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="New Members">Subscription List</span></a>
              </li>	
            </ul>
          </div>
        </li>
		<li class="bold {{ Request::is('monthlypaidreport','newmemberreport','resignreport','paidunpaidreport') ? 'active' : '' }}"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)" tabindex="0"><i class="material-icons">settings_brightness</i><span class="menu-title" data-i18n="Advanced UI">Report</span></a>
          <div class="collapsible-body" style="">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li><a href="{{ route('newmemberreport') }}" class="{{ Request::is('newmemberreport') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="New Members">New Members</span></a>
              </li>		  
              <li><a href="{{ route('resignreport') }}" class="{{ Request::is('resignreport') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Resign Members">Resign Members</span></a>
              </li>
			  <li><a href="{{ route('monthlypaidreport') }}" class="{{ Request::is('monthlypaidreport') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Monthly Paid">Monthly Paid</span></a>
              </li>
			  <li><a href="{{ route('paidunpaidreport') }}" class="{{ Request::is('paidunpaidreport') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Paid Unpaid">Paid / Unpaid</span></a>
              </li>
			  <li><a href="{{ route('statisticsreport') }}" class="{{ Request::is('statisticsreport') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Paid Unpaid">Statistics</span></a>
              </li>
            </ul>
          </div>
        </li>
		<li class="bold"><a class="{{ Request::is('resignmember') ? 'active' : '' }}  waves-effect waves-cyan " href="{{ route('resignmember') }}"><i class="material-icons">note</i><span class="menu-title" data-i18n="Mail">Resign Members</span><!--span class="badge new badge pill pink accent-2 float-right mr-2">5</span--></a>
        </li>
		
		
      </ul>
      <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->
	
	<div id="main" class="main-full">