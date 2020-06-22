<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Log;
use DateTime;

class CommonHelper
{
	public function __construct() {
        
    }
	
    public static function encryption(string $string)
    {
        return strtoupper($string);
    } 
	
	public static function decryption(string $string)
    {
        return strtoupper($string);
    }
	
	public static function random_password($length,$alpha=false)
    {
		$random = str_shuffle('1234567890');
		if($alpha){
			$random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%^&!$%^&');
		}
		
		$password = substr($random, 0, 10);

        return $password;
    }

	public static function ConvertdatetoDBFormat($date){
		if($date!=""){
			$date = str_replace('/', '-', $date );
			$new_date = date("Y-m-d", strtotime($date));
		}else{
			$new_date = '0000-00-00';
		}
		return $new_date;
    }
	
	
	public static function getCostCenterName($centerid){
      return $status_data = DB::table('company_branches')->where('id', $centerid)->pluck('branch_name')->first();
       
	}
	
	public static function getSubsMonthFromCompanyId($companyid){
	return $status_data = DB::table('subcompany as sc')
					->leftjoin('statusmonth as sm', 'sc.statusMonth_id', '=', 'sm.id')
					->where('sc.id', $companyid)
					->pluck('sm.statusMonth')->first();
		
	}
	public static function getCompanyFromSubsCompanyId($companyid){
	return $status_data = DB::table('subcompany as sc')
					->leftjoin('companies as c', 'sc.company_id', '=', 'c.id')
					->where('sc.id', $companyid)
					->pluck('c.company_name')->first();
		
	}
	public static function getNomineeData($memberid){
      return $status_data = DB::table('member_nominees')->where('member_id', $memberid)->get();
       
	}
	public static function getGaurdianData($memberid){
      return $status_data = DB::table('member_guardian')->where('member_id', $memberid)->get();
       
	}
	public static function CostCentersCount(){
      return $status_data = DB::table('company_branches')->where('status', 1)->count();
       
	}
	public static function MembersCount(){
      return $status_data = DB::table('memberprofiles')->count();
       
	}

	public static function getSubsFees($date){
		return $status_data = DB::table('subscription_member as m')
     			    ->select('m.sub_cid', DB::raw('sum(m.subs) as sum'), DB::raw('sum(m.welfare_fee) as sumwelfare'), DB::raw('sum(m.entrance_fee) as sumentrance'), DB::raw('count(*) as total'))
					->leftjoin('subcompany as sc', 'm.subcompany_id', '=', 'sc.id')
					->leftjoin('statusmonth as sm', 'sc.statusMonth_id', '=', 'sm.id')
					->where('sm.statusMonth', $date)
					->first();
	}

	public static function getMemberHistory($memberid,$year){
		return $status_data = DB::table('subscription_member as sm')
			        ->select('sm.subs','sm.welfare_fee','sm.entrance_fee','s.statusMonth','sm.total_subs')  
			        ->leftjoin('subcompany as sc', 'sc.id', '=', 'sm.subcompany_id')
			        ->leftjoin('statusmonth as s', 's.id', '=', 'sc.statusMonth_id')
			        ->where('sm.member_code','=',$memberid)
			        ->where(DB::raw('YEAR(s.statusMonth)'),'=',$year)
			        ->orderBy('s.statusMonth','asc')
			        ->get();
	}
	public static function getMemberDatewiseHistory($memberid,$fromdate,$todate){
		return $status_data = DB::table('subscription_member as sm')
			        ->select('sm.subs','sm.welfare_fee','sm.entrance_fee','s.statusMonth','sm.total_subs')  
			        ->leftjoin('subcompany as sc', 'sc.id', '=', 'sm.subcompany_id')
			        ->leftjoin('statusmonth as s', 's.id', '=', 'sc.statusMonth_id')
			        ->where('sm.member_code','=',$memberid)
			        ->where('s.statusMonth','>=',$fromdate)
                    ->where('s.statusMonth','<=',$todate)
			        ->orderBy('s.statusMonth','asc')
			        ->get();
	}
	public static function getLastPaidDate($memberid){
		return $status_data = DB::table('subscription_member as sm')
			        ->select('s.statusMonth')  
			        ->leftjoin('subcompany as sc', 'sc.id', '=', 'sm.subcompany_id')
			        ->leftjoin('statusmonth as s', 's.id', '=', 'sc.statusMonth_id')
			        ->where('sm.member_code','=',$memberid)
			        ->orderBy('s.statusMonth','desc')
			        ->pluck('s.statusMonth')
			        ->first();
	}

	public static function getCompanyName($companyid){
      return $status_data = DB::table('companies')->where('id', $companyid)->pluck('company_name')->first();
       
	}

	public static function getCostCount($scid){
		$mdata = DB::table('subscription_member as m')
       ->select(DB::raw('count(m.sub_cid) as sum'))
       ->where('m.subcompany_id','=',$scid)
       ->groupBy('m.sub_cid')
       //->dump()
       ->get();
       return count($mdata);
	}
}