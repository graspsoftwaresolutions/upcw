<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubsheetImport;
use App\Model\StatusMonth;
use App\Model\Company;
use App\Model\Race;
use App\Model\Subcompany;
use App\Model\Memberprofile;
use App\Model\SubscriptionMember;
use DB;

class SubscriptionBulkController extends Controller
{
    public function SubsUploadView()
    {
       $year = date('Y');
       $month = date('m');        
       $data['company'] =Company::where('status','=','1')->get();
       $data['report']= DB::table('statusmonth')
       ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
       ->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
       ->select('company_id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
       ->whereYear('statusmonth.statusMonth','=',$year)
       ->whereMonth('statusmonth.statusMonth', '=', $month)
       ->groupBy('subcompany.company_id')
       ->get();

       return view('subscription.import_subscription')->with('data',$data);
    }

    public function GetToMonth(Request $request)
    {
    	$frommonth = $request->input('frommonth');
    	$noofmonths = $request->input('noofmonths');

    	$datearr = explode("/",$frommonth);  
        $monthname = $datearr[0];
        $year = $datearr[1];
        $form_date = date('Y-m-d',strtotime('01-'.$monthname.'-'.$year));
        $to_date = date("M/Y",strtotime("+".($noofmonths-1)." month",strtotime($form_date)));
        echo json_encode($to_date);
    }
}
