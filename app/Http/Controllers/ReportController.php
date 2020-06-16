<?php

namespace App\Http\Controllers;

use App\Report;
use App\Model\Company;
use App\Model\Memberprofile;
use Illuminate\Http\Request;
use DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('report.paid');
    }
	public function monthlypaidreport()
	{
		$data['company'] =Company::where('status','=','1')->get();
		/*$year = date('Y');
        $month = date('m');        
       $data['company'] =Company::where('status','=','1')->get();
       $data['report']= DB::table('statusmonth')
       ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
       ->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
       ->select('company_id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
       //whereYear('created_at', '=', $year)
     // ->whereMonth('created_at', '=', $month)
       ->whereYear('statusmonth.statusMonth','=',$year)
       ->whereMonth('statusmonth.statusMonth', '=', $month)
       ->groupBy('subcompany.company_id')
       ->get();*/
		return view('report.paid')->with('data',$data);
	}
	public function paidunpaidreport(Request $request)
	{
		$data = $request->all();
		//$year = date("Y");
		
			if(isset($data['year_paid_unpaid']))
			{
				
				$year = $data['year_paid_unpaid'];
			}
			else{
				$year = date("Y");
			}

			if(isset($data['company_name']))
			{
				
				$companyid = $data['company_name'];
			}
			else{
				$companyid = '';
			}

		
		//dd($year);
		$query_pt = DB::table('statusmonth');
		$query_pt->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
		$query_pt->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
		$query_pt->join('memberprofiles', 'memberprofiles.id', '=', 'subscription_member.member_code');
		$query_pt->whereYear('statusmonth.statusMonth',$year);
		
		//dd($data["paidunpaidlist"]);
		//$dt_paid = $data["paidunpaidlist"];
		$dt_paid = $query_pt->get()->toArray();
		//dd($dt_paid);
		$dt_paidunp = array();
		$i = 0; 
		foreach($dt_paid as $dt_paidun){
			//dd($dt_paidun->company_id);
			//$dt_paidunp[$dt_paidun->company_id][]= $dt_paidun->company_id;
			//$dt_paidunp[$dt_paidun->company_id][$dt_paidun->member_no][$i][]= $dt_paidun->member_name;
			//$dt_paidunp[$dt_paidun->company_id][$i][$dt_paidun->member_no][]= $dt_paidun->member_no;
			$dt_paidunp[$dt_paidun->company_id][$dt_paidun->member_no][date("m", strtotime($dt_paidun->statusMonth))]= $dt_paidun->subs;
			//$dt_paidunp[$dt_paidun->company_id][$i][]= $dt_paidun->subs;
			$i++;
		}
		//dd($dt_paidunp);
		//exit;
		$data['year'] = $year;
		$data["paidunpaidlist"] = $dt_paidunp;
		$data['company'] =Company::where('status','=','1')->get();
		
		return view('report.paidunpaid')->with('data',$data);
	}
	public function statisticsreport(Request $request)
	{
		$data['company'] =Company::where('status','=','1')->get();
		return view('report.statistics')->with('data',$data);
	}
	public function coststatisticsreport(Request $request)
	{
		$data['costcenters'] = DB::table('memberprofiles as m')->select('cb.*')
								->leftjoin('company_branches as cb', 'cb.id', '=', 'm.cost_centerid')
								->where('m.cost_centerid','!=',Null)->where('m.race','!=',Null)->where('m.sex','!=',Null)->groupBy('m.cost_centerid')->get();
		//dd($data['costcenters']);
		return view('report.coststatistics')->with('data',$data);
	}
	public function get_reportpaid_list(Request $request)
	{
		//	var_dump($_POST['cmp_id']);
		//exit;
		$monthlyyear_paid = $_POST['mypaid'];
		$cmp_id = $_POST['cmp_id'];
		$member_total_count=0;
        $member_total_amount=0;
		if($monthlyyear_paid==""){
            $year = date("Y");
            $month = date("m");
        }
        else{
			$fmmm_date = explode("/",$monthlyyear_paid);
			$month = date('m',strtotime('01-'.$fmmm_date[0].'-'.$fmmm_date[1]));
			$year = date('Y',strtotime('01-'.$fmmm_date[0].'-'.$fmmm_date[1]));
		}
		
		
		$columns = array( 
            0 => 'company_name',
			1 => 'member_count',
            2 => 'total_amount'
        );
		//dd();
		$query_pt = DB::table('statusmonth');
		$query_pt->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
		$query_pt->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
		$query_pt->select('subcompany.id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'));
		//if($monthlyyear_paid != "")
		//{
			if($cmp_id !=''){
				$cmp_id = $cmp_id;			
			$query_pt->where('subcompany.company_id', '=', $cmp_id);
			}
			$query_pt->whereYear('statusMonth', '=', $year);
			$query_pt->whereMonth('statusMonth', '=', $month);
			//$query_pt->where(DB::raw("DATE_FORMAT(statusMonth, '%Y-%m') = $year"));
		//}
		$query_pt->groupBy('subcompany.id');
		$totalData = $query_pt->get()->count();
        $totalFiltered = $totalData;
		
		$limit = $request->input('length');
        $start = $request->input('start');
        //$order = $columns[$request->input('order.0.column')];
        $order = "subcompany.id";
        $dir = $request->input('order.0.dir');
        
		if(empty($request->input('search.value')))
        {  
            if( $limit == -1){
                
				$query_fetch = DB::table('statusmonth');
				$query_fetch->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
				$query_fetch->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
				$query_fetch->select('subcompany.id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'));
				//if($monthlyyear_paid != "")
				//{
					if($cmp_id !=''){
					$cmp_id = $cmp_id;
					$query_fetch->where('subcompany.company_id', '=', $cmp_id);
					}
					$query_fetch->whereYear('statusMonth', '=', $year);
					$query_fetch->whereMonth('statusMonth', '=', $month);
				//}
				$query_fetch->groupBy('subcompany.id');
				$query_fetch->orderBy($order,$dir);
				$paidlist = $query_fetch->get()->toArray();
				      
           
                
            }else{
                 //dd($dir);
				$query_fetch = DB::table('statusmonth');
				$query_fetch->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
				$query_fetch->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
				$query_fetch->select('subcompany.id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'));
				//if($monthlyyear_paid != "")
				//{
					if($cmp_id !=''){
						$cmp_id = $cmp_id;
					$query_fetch->where('subcompany.company_id', '=', $cmp_id);
					}
					$query_fetch->whereYear('statusMonth', '=', $year);
					$query_fetch->whereMonth('statusMonth', '=', $month);
				//}
				$query_fetch->groupBy('subcompany.id');
				$query_fetch->offset($start);
				$query_fetch->limit($limit);
				$query_fetch->orderBy($order,$dir);
				$paidlist = $query_fetch->get()->toArray();
            }
            // dd($paidlist);
        }
       
		else {
			$search = $request->input('search.value'); 
			if( $limit == -1){
					$query_fetch = DB::table('statusmonth');
					$query_fetch->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
					$query_fetch->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
					$query_fetch->select('subcompany.id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'));
					//if($monthlyyear_paid != "")
					//{
						if($cmp_id !=''){
							$cmp_id = $cmp_id;
						$query_fetch->where('subcompany.company_id', '=', $cmp_id);
						}
						$query_fetch->whereYear('statusMonth', '=', $year);
						$query_fetch->whereMonth('statusMonth', '=', $month);
					//}
					$query_fetch->groupBy('subcompany.id');
					$query_fetch->orWhere('company_name', 'LIKE',"%{$search}%");
					$query_fetch->orderBy($order,$dir);
					$paidlist = $query_fetch->get()->toArray();
			}else{
					$query_fetch = DB::table('statusmonth');
					$query_fetch->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
					$query_fetch->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
					$query_fetch->select('subcompany.id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'));
					//if($monthlyyear_paid != "")
					//{
						if($cmp_id !=''){
							$cmp_id = $cmp_id;
						$query_fetch->where('subcompany.company_id', '=', $cmp_id);
						}
						$query_fetch->whereYear('statusMonth', '=', $year);
						$query_fetch->whereMonth('statusMonth', '=', $month);
					//}
					$query_fetch->groupBy('subcompany.id');
					$query_fetch->orWhere('company_name', 'LIKE',"%{$search}%");
					$query_fetch->offset($start);
					$query_fetch->limit($limit);
					$query_fetch->orderBy($order,$dir);
					$paidlist = $query_fetch->get()->toArray();
			}
			
			$query_pt = DB::table('statusmonth');
			$query_pt->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
			$query_pt->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
			$query_pt->select('subcompany.id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'));
			//if($monthlyyear_paid != "")
			//{
				if($cmp_id !=''){
					$cmp_id = $cmp_id;
				$query_pt->where('subcompany.company_id', '=', $cmp_id);
				}
				$query_pt->whereYear('statusMonth', '=', $year);
				$query_pt->whereMonth('statusMonth', '=', $month);
			//}
			$query_pt->groupBy('subcompany.id');
			$query_pt->orWhere('company_name', 'LIKE',"%{$search}%");
			$totalFiltered = $query_pt->get()->count();
        }

		//dd($paidlist);
		//exit;
		$data = array();
        if(!empty($paidlist))
        {
			$member_total_count = 0;
			$member_total_amount = 0;
			
            foreach ($paidlist as $paid)
            {
				$company_name1 = DB::table('subcompany')->where('id' ,$paid->id)->value('company_id');	
				$company_name = DB::table('companies')->where('id' ,$company_name1)->value('company_name');				
				//dd($company_name);
				$link =  url("/monthwisecompanyreport/{$paid->id}");
                $nestedData['company_name'] = "<a href=".$link.">".$company_name."</a>";
				$nestedData['member_count'] = '<p style="text-align:center">'.$paid->total.'</p>';
                $nestedData['total_amount'] = '<p style="text-align:center">'.$paid->sum.'</p>';
				$member_total_count = $member_total_count + floatval($paid->total);
				$member_total_amount = $member_total_amount + floatval($paid->sum);
                $data[] = $nestedData;

            }
        }
        //dd($data);
		$json_data = array(

            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data,
			'count'    => $member_total_count,
			'total'    => " RM ".number_format($member_total_amount, 2)
            );
        echo json_encode($json_data);
	}
	public function monthwisecompanyreport($id)
	{
		//dd($id);
		$query_fetch = DB::table('statusmonth');
		$query_fetch->select('*');
		$query_fetch->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
		$query_fetch->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
		$query_fetch->where('subcompany_id', '=', $id);
		$data['overall_company'] = $query_fetch->get();
		
		$query_pt = DB::table('statusmonth');
		$query_pt->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id');
		$query_pt->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id');
		$query_pt->select(DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'));
		$query_pt->where('subcompany_id', '=', $id);
		$data['overall_company_count'] = $query_pt->get();
		
		return view('report.monthwisecompanyreport')->with('data',$data);
	}
	public function newmemberreport()
	{
		$data['company'] = Company::where('status','=','1')->get();
		$data['costcenters'] = DB::table('company_branches')->where('status','=','1')->get();
		return view('report.newmembers')->with('data',$data);
	}
	public function get_reportnewmember_list(Request $request)
	{
		$monthlyyear_paid = $_POST['mypaid'];
		$cmp_id = $_POST['cmp_id'];
		$costcenter_id = $_POST['costcenter_id'];
        if($monthlyyear_paid!=""){
          $fmmm_date = explode("/",$monthlyyear_paid);
          $month = date('m',strtotime('01-'.$fmmm_date[0].'-'.$fmmm_date[1]));
          $year = date('Y',strtotime('01-'.$fmmm_date[0].'-'.$fmmm_date[1]));
		}
		$slno = 0;
	
		//dd($year);
		$columns = array( 
			$slno++ => 'member_no',
			$slno++ => 'company_name',
			$slno++ => 'member_name',
            $slno++ => 'doj',
			$slno++ => 'id' ,
			$slno++ => 'id' ,
        );
		
		$query_pt = DB::table('memberprofiles');
		$query_pt->select('memberprofiles.*');
		if($monthlyyear_paid != "")
		{
			$query_pt->whereYear('doj', '=', $year);
			$query_pt->whereMonth('doj', '=', $month);
		}
		else
		{
			$query_pt->whereYear('doj', '=', date("Y"));
			$query_pt->whereMonth('doj', '=', date("m"));
		}
		if($cmp_id !=''){
			$cmp_id = $cmp_id;
			$query_pt->where('company_name', '=', $cmp_id);
		}
		if($costcenter_id !=''){
			$query_pt->where('cost_centerid', '=', $costcenter_id);
		}
		$totalData = $query_pt->get()->count();
        $totalFiltered = $totalData;
		
		$limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
				$query_fetch = DB::table('memberprofiles');
				$query_fetch->select('memberprofiles.*');
				if($monthlyyear_paid != "")
				{
					$query_fetch->whereYear('doj', '=', $year);
					$query_fetch->whereMonth('doj', '=', $month);
				}
				else
				{
					$query_fetch->whereYear('doj', '=', date("Y"));
					$query_fetch->whereMonth('doj', '=', date("m"));
				}
				if($cmp_id !=''){
					$cmp_id = $cmp_id;
					$query_fetch->where('company_name', '=', $cmp_id);
				}
				if($costcenter_id !=''){
					$query_fetch->where('cost_centerid', '=', $costcenter_id);
				}
				$query_fetch->orderBy($order,$dir);
				$newmemberlist = $query_fetch->get()->toArray();
                
            }else{
				$query_fetch = DB::table('memberprofiles');
				$query_fetch->select('memberprofiles.*');
				if($monthlyyear_paid != "")
				{
					$query_fetch->whereYear('doj', '=', $year);
					$query_fetch->whereMonth('doj', '=', $month);
				}
				else
				{
					$query_fetch->whereYear('doj', '=', date("Y"));
					$query_fetch->whereMonth('doj', '=', date("m"));
				}
				if($cmp_id !=''){
					$cmp_id = $cmp_id;
					$query_fetch->where('company_name', '=', $cmp_id);
				}
				if($costcenter_id !=''){
					$query_fetch->where('cost_centerid', '=', $costcenter_id);
				}
				$query_fetch->offset($start);
				$query_fetch->limit($limit);
				$query_fetch->orderBy($order,$dir);
				$newmemberlist = $query_fetch->get()->toArray();
            }
        }
		else {
			$search = $request->input('search.value'); 
			if( $limit == -1){
					$query_fetch = DB::table('memberprofiles');
					$query_fetch->select('memberprofiles.*');
					if($monthlyyear_paid != "")
					{
						$query_fetch->whereYear('doj', '=', $year);
						$query_fetch->whereMonth('doj', '=', $month);
					}
					else
					{
						$query_fetch->whereYear('doj', '=', date("Y"));
						$query_fetch->whereMonth('doj', '=', date("m"));
					}
					if($cmp_id !=''){
						$cmp_id = $cmp_id;
						$query_fetch->where('company_name', '=', $cmp_id);
					}
					if($costcenter_id !=''){
						$query_fetch->where('cost_centerid', '=', $costcenter_id);
					}
					$query_fetch->Where('member_no', '=',$search);
					$query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('doj', 'LIKE',"%{$search}%");
					$query_fetch->orderBy($order,$dir);
					$newmemberlist = $query_fetch->get()->toArray();
			}else{
					$query_fetch = DB::table('memberprofiles');
					$query_fetch->select('memberprofiles.*');
					if($monthlyyear_paid != "")
					{
						$query_fetch->whereYear('doj', '=', $year);
						$query_fetch->whereMonth('doj', '=', $month);
					}
					else
					{
						$query_fetch->whereYear('doj', '=', date("Y"));
						$query_fetch->whereMonth('doj', '=', date("m"));
					}
					if($cmp_id !=''){
						$cmp_id = $cmp_id;
						$query_fetch->where('company_name', '=', $cmp_id);
					}
					if($costcenter_id !=''){
						$query_fetch->where('cost_centerid', '=', $costcenter_id);
					}
					$query_fetch->Where('member_no', '=',$search);
					$query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('doj', 'LIKE',"%{$search}%");
					$query_fetch->offset($start);
					$query_fetch->limit($limit);
					$query_fetch->orderBy($order,$dir);
					$newmemberlist = $query_fetch->get()->toArray();
			}
			
			$query_pt = DB::table('memberprofiles');
			$query_pt->select('memberprofiles.*');
			if($monthlyyear_paid != "")
			{
				$query_pt->whereYear('doj', '=', $year);
				$query_pt->whereMonth('doj', '=', $month);
			}
			else
			{
				$query_pt->whereYear('doj', '=', date("Y"));
				$query_pt->whereMonth('doj', '=', date("m"));
			}
			if($cmp_id !=''){
				$cmp_id = $cmp_id;
				$query_pt->where('company_name', '=', $cmp_id);
			}
			if($costcenter_id !=''){
				$query_pt->where('cost_centerid', '=', $costcenter_id);
			}
			$query_pt->Where('member_no', '=',$search);
			$query_pt->orWhere('member_name', 'LIKE',"%{$search}%");
			$query_pt->orWhere('doj', 'LIKE',"%{$search}%");
			$totalFiltered = $query_pt->get()->count();
		 
        }
		
	
		//dd($paidlist);
		//exit;
		$data = array();
        if(!empty($newmemberlist))
        {
            foreach ($newmemberlist as $newmember)
            {
                $nestedData['member_no'] = '<p style="text-align:center">'.$newmember->member_no.'</p>';
				//$nestedData['company_name'] = '<p style="text-align:center">'.$newmember->company_name.'</p>';
				$nestedData['company_name'] = DB::table('companies')->where('id' ,$newmember->company_name)->value('company_name');
				$nestedData['member_name'] = '<p style="text-align:center">'.$newmember->member_name.'</p>';
				$nestedData['doj'] = '<p style="text-align:center">'.date("d/m/Y", strtotime($newmember->doj)).'</p>';
				$nestedData['cost_center'] = DB::table('company_branches')->where('id' ,$newmember->cost_centerid)->pluck('branch_name')->first();
                $nestedData['action'] = '<p style="text-align:center"> N </p>';
                $data[] = $nestedData;

            }
        }
		$json_data = array(

            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data
            );
        echo json_encode($json_data);
	}
	public function resignreport()
	{
		$data['company'] = Company::where('status','=','1')->get();
		$data['costcenters'] = DB::table('company_branches')->where('status','=','1')->get();
		return view('report.resign')->with('data',$data);
	}
	public function get_resignreport_list(Request $request)
	{		
		$monthlyyear_resigndate = $_POST['monthlyyear_resignmember'];
		$cmp_id = $_POST['cmp_id'];
		$costcenter_id = $_POST['costcenter_id'];
        if($monthlyyear_resigndate!=""){
          $fmmm_date = explode("/",$monthlyyear_resigndate);
          $month = date('m',strtotime('01-'.$fmmm_date[0].'-'.$fmmm_date[1]));
          $year = date('Y',strtotime('01-'.$fmmm_date[0].'-'.$fmmm_date[1]));
        }
		else
		{
			$month = date("m");
			$year = date("Y");
		}
		if($cmp_id !=''){
			$cmp_id = $cmp_id;
		}
		else{
			$cmp_id = '';
		}

		$slno = 0;

		$columns = array( 
            $slno++ => 'member_no',
			$slno++ => 'company_name',
			$slno++ => 'cost_centerid',
            $slno++ => 'member_name', 
            $slno++ => 'ic_no_new', 
            $slno++ => 'race', 
            $slno++ => 'dob', 
            $slno++ => 'doj',
            $slno++ => 'resign_date'
		);
		$query_pt = DB::table('memberprofiles');
		$query_pt->select('memberprofiles.*');
		if($monthlyyear_resigndate != "")
		{
			$query_pt->whereYear('resign_date', '=', $year);
			$query_pt->whereMonth('resign_date', '=', $month);
		}
		else
		{
			$query_pt->whereYear('resign_date', '=', date("Y"));
			$query_pt->whereMonth('resign_date', '=', date("m"));
		}
		if($cmp_id !=''){
			$cmp_id = $cmp_id;
			$query_pt->where('company_name', '=', $cmp_id);
		}
		if($costcenter_id !=''){
			$query_pt->where('cost_centerid', '=', $costcenter_id);
		}
		$totalData = $query_pt->get()->count();
        $totalFiltered = $totalData;
		
		$limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
				$query_fetch = DB::table('memberprofiles');
				$query_fetch->select('memberprofiles.*');
				if($monthlyyear_resigndate != "")
				{
					$query_fetch->whereYear('resign_date', '=', $year);
					$query_fetch->whereMonth('resign_date', '=', $month);
				}
				else
				{
					$query_fetch->whereYear('resign_date', '=', date("Y"));
					$query_fetch->whereMonth('resign_date', '=', date("m"));
				}
				if($cmp_id !=''){
					$cmp_id = $cmp_id;
					$query_fetch->where('company_name', '=', $cmp_id);
				}
				if($costcenter_id !=''){
					$query_fetch->where('cost_centerid', '=', $costcenter_id);
				}
				$query_fetch->where('member_status', '=', 2);
				$query_fetch->orderBy($order,$dir);
				$resignlist = $query_fetch->get()->toArray();
                
            }else{
				$query_fetch = DB::table('memberprofiles');
				$query_fetch->select('memberprofiles.*');
				if($monthlyyear_resigndate != "")
				{
					$query_fetch->whereYear('resign_date', '=', $year);
					$query_fetch->whereMonth('resign_date', '=', $month);
				}
				else
				{
					$query_fetch->whereYear('resign_date', '=', date("Y"));
					$query_fetch->whereMonth('resign_date', '=', date("m"));
				}
				if($cmp_id !=''){
					$cmp_id = $cmp_id;
					$query_fetch->where('company_name', '=', $cmp_id);
				}
				if($costcenter_id !=''){
					$query_fetch->where('cost_centerid', '=', $costcenter_id);
				}
				$query_fetch->where('member_status', '=', 2);
				$query_fetch->offset($start);
				$query_fetch->limit($limit);
				$query_fetch->orderBy($order,$dir);
				$resignlist = $query_fetch->get()->toArray();
            }
        }
		else {
			$search = $request->input('search.value'); 
			if( $limit == -1){
					$query_fetch = DB::table('memberprofiles');
					$query_fetch->select('memberprofiles.*');
					if($monthlyyear_resigndate != "")
					{
						$query_fetch->whereYear('resign_date', '=', $year);
						$query_fetch->whereMonth('resign_date', '=', $month);
					}
					else
					{
						$query_fetch->whereYear('resign_date', '=', date("Y"));
						$query_fetch->whereMonth('resign_date', '=', date("m"));
					}
					if($cmp_id !=''){
						$cmp_id = $cmp_id;
						$query_fetch->where('company_name', '=', $cmp_id);
					}
					if($costcenter_id !=''){
						$query_fetch->where('cost_centerid', '=', $costcenter_id);
					}
					$query_fetch->where('member_status', '=', 2);
					$query_fetch->Where('member_no', '=',$search);
					$query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('resign_date', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('doj', 'LIKE',"%{$search}%");
					$query_fetch->orderBy($order,$dir);
					$resignlist = $query_fetch->get()->toArray();
			}else{
					$query_fetch = DB::table('memberprofiles');
					$query_fetch->select('memberprofiles.*');
					if($monthlyyear_resigndate != "")
					{
						$query_fetch->whereYear('resign_date', '=', $year);
						$query_fetch->whereMonth('resign_date', '=', $month);
					}
					else
					{
						$query_fetch->whereYear('resign_date', '=', date("Y"));
						$query_fetch->whereMonth('resign_date', '=', date("m"));
					}
					if($cmp_id !=''){
						$cmp_id = $cmp_id;
						$query_fetch->where('company_name', '=', $cmp_id);
					}
					if($costcenter_id !=''){
						$query_fetch->where('cost_centerid', '=', $costcenter_id);
					}
					$query_fetch->where('member_status', '=', 2);
					$query_fetch->Where('member_no', '=',$search);
					$query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('resign_date', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('doj', 'LIKE',"%{$search}%");
					$query_fetch->offset($start);
					$query_fetch->limit($limit);
					$query_fetch->orderBy($order,$dir);
					$resignlist = $query_fetch->get()->toArray();
			}
			
			$query_pt = DB::table('memberprofiles');
			$query_pt->select('memberprofiles.*');
			if($monthlyyear_resigndate != "")
			{
				$query_pt->whereYear('resign_date', '=', $year);
				$query_pt->whereMonth('resign_date', '=', $month);
			}
			else
			{
				$query_pt->whereYear('resign_date', '=', date("Y"));
				$query_pt->whereMonth('resign_date', '=', date("m"));
			}
			if($cmp_id !=''){
				$cmp_id = $cmp_id;
				$query_pt->where('company_name', '=', $cmp_id);
			}
			if($costcenter_id !=''){
				$query_pt->where('cost_centerid', '=', $costcenter_id);
			}
			$query_pt->where('member_status', '=', 2);
			$query_pt->Where('member_no', '=',$search);
			$query_pt->orWhere('member_name', 'LIKE',"%{$search}%");
			$query_pt->orWhere('resign_date', 'LIKE',"%{$search}%");
			$query_pt->orWhere('doj', 'LIKE',"%{$search}%");
			$totalFiltered = $query_pt->get()->count();
		 
        }


		$data = array();
        if(!empty($resignlist))
        {
            foreach ($resignlist as $resign)
            {
                //$nestedData['mp_id'] = $resign['id'];
                $nestedData['member_no'] = $resign->member_no;
				$nestedData['company_name'] = trim(DB::table('companies')->where('id' ,$resign->company_name)->value('company_name'));
                $nestedData['member_name'] = $resign->member_name;
				$nestedData['ic_no_new'] = $resign->ic_no_new;
				$nestedData['cost_center'] = DB::table('company_branches')->where('id' ,$resign->cost_centerid)->pluck('branch_name')->first();
                $nestedData['race'] = $resign->race;
                $nestedData['dob'] = $resign->dob;
                $nestedData['doj'] = $resign->doj;
                $nestedData['resign_date'] = $resign->resign_date;
                $data[] = $nestedData;

            }
        }
		$json_data = array(

            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
        echo json_encode($json_data);
		
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
