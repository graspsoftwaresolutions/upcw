<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@adminHome')->name('home')->middleware('is_admin');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

//Route::get('admin/memberquery', 'MemberprofileController@index')->name('admin.memberquery')->middleware('is_admin');

Route::resource('memberprofiles', 'MemberprofileController')->middleware('is_admin');
//Route::get('memberprofile', 'MemberprofileController@index')->name('memberprofile')->middleware('is_admin');
Route::post('get_memberprofile_list', 'MemberprofileController@get_memberprofile_list')->middleware('is_admin');
Route::get('findMemberNoExists', 'MemberprofileController@findMemberNoExists')->middleware('is_admin');
Route::post('update_newmemregister', 'SubscriptionController@update_newmemregister')->middleware('is_admin');

//subscription
Route::get('export', 'SubscriptionController@export')->name('export')->middleware('is_admin');
Route::get('importExportView', 'SubscriptionController@importExportView')->name('importExportView')->middleware('is_admin');
Route::get('import_summary', 'SubscriptionController@importSummary')->name('import_summary')->middleware('is_admin');
Route::get('subscriptionList', 'SubscriptionController@subscriptionList')->name('subscriptionList')->middleware('is_admin');
Route::get('subscriptioncompanylist/{id}', 'SubscriptionController@subscriptioncompanylist')->name('subscriptioncompanylist')->middleware('is_admin');
Route::post('subscriptionMemberUpdate', 'SubscriptionController@subscriptionMemberUpdate')->name('subscriptionMemberUpdate')->middleware('is_admin');
Route::delete('subscriptionMemberDelete/{id}','SubscriptionController@subscriptionMemberDelete')->name('subscriptionMemberDelete')->middleware('is_admin');
Route::delete('subscriptionCompanyDelete/{id}','SubscriptionController@subscriptionCompanyDelete')->name('subscriptionCompanyDelete')->middleware('is_admin');
Route::post('mismatch_bseddetails','SubscriptionController@mismatch_bseddetails')->name('mismatch_bseddetails')->middleware('is_admin');
Route::get('approvalmismatchdetails/{id}', 'SubscriptionController@approvalmismatchdetails')->name('approvalmismatchdetails')->middleware('is_admin');
Route::post('update_membercodesub', 'SubscriptionController@update_membercodesub')->middleware('is_admin');

Route::post('import', 'SubscriptionController@import')->name('import')->middleware('is_admin');;
Route::post('get_subdetails', 'SubscriptionController@get_subdetails')->name('get_subdetails')->middleware('is_admin');
Route::post('get_subdetailscmpy', 'SubscriptionController@get_subdetailscmpy')->name('get_subdetailscmpy')->middleware('is_admin');
Route::post('get_subdetailsall', 'SubscriptionController@get_subdetailsall')->name('get_subdetailsall')->middleware('is_admin');
Route::post('get_subs_avilablity_check', 'SubscriptionController@get_subs_avilablity_check')->name('get_subs_avilablity_check')->middleware('is_admin');
Route::post('delete_existingmembersDetails/{id1}/{id2}', 'SubscriptionController@delete_existingmembersDetails')->middleware('is_admin');

Route::get('mismatchdetails/{id1}/{id2}', 'SubscriptionController@mismatchdetails')->name('mismatchdetails')->middleware('is_admin');
//Reports
Route::resource('reports', 'ReportController')->middleware('is_admin');
Route::get('monthlypaidreport', 'ReportController@monthlypaidreport')->name('monthlypaidreport')->middleware('is_admin');
Route::post('get_reportpaid_list', 'ReportController@get_reportpaid_list')->middleware('is_admin');
Route::get('monthwisecompanyreport/{id}', 'ReportController@monthwisecompanyreport')->name('monthwisecompanyreport')->middleware('is_admin');
Route::get('paidunpaidreport', 'ReportController@paidunpaidreport')->name('paidunpaidreport')->middleware('is_admin');
Route::get('statisticsreport', 'ReportController@statisticsreport')->name('statisticsreport')->middleware('is_admin');
Route::get('coststatisticsreport', 'ReportController@coststatisticsreport')->name('coststatisticsreport')->middleware('is_admin');
Route::get('newmemberreport', 'ReportController@newmemberreport')->name('newmemberreport')->middleware('is_admin');
Route::post('get_reportnewmember_list', 'ReportController@get_reportnewmember_list')->middleware('is_admin');
Route::get('resignreport', 'ReportController@resignreport')->name('resignreport')->middleware('is_admin');
Route::post('get_resignreport_list', 'ReportController@get_resignreport_list')->middleware('is_admin');

//Master Company 
Route::get('companylist','MasterController@companylist')->name('companylist')->middleware('is_admin');
Route::post('get_company_list','MasterController@get_company_list')->middleware('is_admin'); 
Route::post('company_nameexists','MasterController@checkCompanyNameExists')->middleware('is_admin'); 
Route::get('companysave','MasterController@companysave')->name('companysave')->middleware('is_admin'); 
Route::post('storeCompany','MasterController@companyStore')->name('storeCompany')->middleware('is_admin'); 
Route::get('edit/{id}','MasterController@editcompanyDetail')->name('editcompany')->middleware('is_admin'); 
Route::delete('companydestroy/{id}','MasterController@companyDestroy')->name('companydestroy')->middleware('is_admin');
Route::post('updatecompany','MasterController@UpdateCompanyDetail')->name('updatecompany')->middleware('is_admin');

Route::get('resignmember', 'ResignmemberController@resignmember')->name('resignmember')->middleware('is_admin');
Route::post('get_resignmember_list', 'ResignmemberController@get_resignmember_list')->middleware('is_admin');
Route::post('update_memberresignstatus', 'ResignmemberController@update_memberresignstatus')->middleware('is_admin');
Route::post('update_memberactivestatus/{id}', 'ResignmemberController@update_memberactivestatus')->middleware('is_admin');
Route::get('resignmember_view/{id}', 'ResignmemberController@resignmember_view')->name('resignmember_view')->middleware('is_admin');

Route::get('subscription_upload', 'SubscriptionBulkController@SubsUploadView')->name('SubsUploadView')->middleware('is_admin');
Route::get('get_tomonth', 'SubscriptionBulkController@GetToMonth')->name('get_tomonth')->middleware('is_admin');

Route::get('member_print/{id}', 'MemberprofileController@PrintMember')->name('memberprofiles.print')->middleware('is_admin');

Route::post('importbulk', 'SubscriptionBulkController@import')->name('importbulk')->middleware('is_admin');
Route::get('importbulk', 'SubscriptionBulkController@SubsUploadView')->middleware('is_admin');

Route::get('relationship','MasterController@relationshiplist')->name('relationship')->middleware('is_admin');
Route::get('editrelationship/{id}','MasterController@editrelationshipDetail')->name('editrelationship')->middleware('is_admin'); 
Route::post('updaterelation','MasterController@UpdateRelationDetail')->name('updaterelation')->middleware('is_admin');
Route::get('relationshipnew','MasterController@relationshipNew')->name('relationshipnew')->middleware('is_admin');
Route::post('storeRelationship','MasterController@relationshipStore')->name('storeRelationship')->middleware('is_admin'); 
Route::delete('Relationshipdestroy/{id}','MasterController@RelationshipDestroy')->name('Relationshipdestroy')->middleware('is_admin');

Route::get('designation','MasterController@designationlist')->name('designation')->middleware('is_admin');
Route::get('editdesignation/{id}','MasterController@editdesignationDetail')->name('editdesignation')->middleware('is_admin'); 
Route::post('updatedesignation','MasterController@UpdateDesignationDetail')->name('updatedesignation')->middleware('is_admin');
Route::get('designationnew','MasterController@designationNew')->name('designationnew')->middleware('is_admin');
Route::post('storedDesignation','MasterController@DesignationStore')->name('storeDesignation')->middleware('is_admin'); 
Route::delete('Designationdestroy/{id}','MasterController@DesignationDestroy')->name('Designationdestroy')->middleware('is_admin');

Route::get('department','MasterController@departmentlist')->name('department')->middleware('is_admin');
Route::get('editdepartment/{id}','MasterController@editdepartmentDetail')->name('editdepartment')->middleware('is_admin'); 
Route::post('updatedepartment','MasterController@UpdateDepartmentDetail')->name('updatedepartment')->middleware('is_admin');
Route::get('departmentnew','MasterController@departmentNew')->name('departmentnew')->middleware('is_admin');
Route::post('storeDepartment','MasterController@DepartmentStore')->name('storeDepartment')->middleware('is_admin'); 
Route::delete('Departmentdestroy/{id}','MasterController@Departmentdestroy')->name('Departmentdestroy')->middleware('is_admin');

Route::get('memberredirect', 'MemberprofileController@ViewEditMember')->name('editmember.locate');
Route::get('historyredirect', 'MemberprofileController@ViewHistoryMember')->name('history.locate');

Route::get('member_history/{id}', 'MemberprofileController@MemberHistory')->name('memberprofiles.history')->middleware('is_admin');

Route::get('race','MasterController@racelist')->name('race')->middleware('is_admin');
Route::get('editrace/{id}','MasterController@editraceDetail')->name('editrace')->middleware('is_admin'); 
Route::post('updaterace','MasterController@UpdateRaceDetail')->name('updaterace')->middleware('is_admin');
Route::get('racenew','MasterController@raceNew')->name('racenew')->middleware('is_admin');
Route::post('storeRace','MasterController@RaceStore')->name('storeRace')->middleware('is_admin'); 
Route::delete('Racedestroy/{id}','MasterController@Racedestroy')->name('Racedestroy')->middleware('is_admin');

Route::get('costcenter','MasterController@costcenterlist')->name('costcenter')->middleware('is_admin');
Route::get('editcostcenter/{id}','MasterController@editcostcenterDetail')->name('editcostcenter')->middleware('is_admin'); 
Route::post('updatecostcenter','MasterController@UpdateCostcenterDetail')->name('updatecostcenter')->middleware('is_admin');
Route::get('costcenternew','MasterController@costcenterNew')->name('costcenternew')->middleware('is_admin');
Route::post('storeCostcenter','MasterController@CostcenterStore')->name('storeCostcenter')->middleware('is_admin'); 
Route::delete('Costcenterdestroy/{id}','MasterController@Costcenterdestroy')->name('Costcenterdestroy')->middleware('is_admin');

Route::post('member_history/{id}','MemberprofileController@ViewMemberHistory')->name('ViewMemberHistory')->middleware('is_admin'); 

Route::get('get-costcenters-list','MasterController@getCostCentersList');