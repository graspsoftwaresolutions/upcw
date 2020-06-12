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
}