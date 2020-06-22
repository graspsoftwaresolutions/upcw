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
use App\Helpers\CommonHelper;
use DB;

class SubscriptionController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function get_subdetails(){	
        $monthyear = $_POST['statusmonth'];	
        $monyr = explode("-",$monthyear);	
        //var_dump($monyr);	
        $year = $monyr[0];	
        $month = $monyr[1];	
        $data['match']= DB::table('sub_match_master')	
        ->join('subscription_member', 'subscription_member.match_no', '=', 'sub_match_master.id')	
        ->join('subcompany', 'subcompany.id', '=', 'subscription_member.subcompany_id')     	
        ->join('statusmonth', 'statusmonth.id', '=', 'subcompany.statusMonth_id')     	
        ->select('sub_match_master.id','sub_match_master.match_name', DB::raw('count(*) as total'))	
       // whereYear('created_at', '=', $year)	
       //->whereMonth('created_at', '=', $month)	
        ->whereYear('statusmonth.statusMonth','=',$year)	
        ->whereMonth('statusmonth.statusMonth', '=', $month)	
        ->groupBy('sub_match_master.id')	
        ->get();	
       // dd($data['match']);	
        return json_encode($data['match']);	
    }
    public function get_subdetailscmpy(){
        $monthyear = $_POST['statusmonth'];
        $company_name = $_POST['company_name'];
        //return $company_name;
        $monyr = explode("-",$monthyear);
        //var_dump($monyr);
        $year = $monyr[0];
        $month = $monyr[1];
        $data['report']= DB::table('subscription_member as m')
        ->select('cb.branch_name','m.sub_cid', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'), DB::raw('sum(m.welfare_fee) as sumwelfare'), DB::raw('sum(m.entrance_fee) as sumentrance'))
        ->leftjoin('subcompany as sc', 'm.subcompany_id', '=', 'sc.id')
        ->leftjoin('statusmonth as sm', 'sc.statusMonth_id', '=', 'sm.id')
        ->leftjoin('company_branches as cb', 'cb.id', '=', 'm.sub_cid')
        ->whereYear('sm.statusMonth','=',$year)
        ->whereMonth('sm.statusMonth', '=', $month)
        ->where('sc.company_id', '=', $company_name)
        ->groupBy('m.sub_cid')
        //->dump()
        ->get();

    //     $data['report']= DB::table('statusmonth')
    //     ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
    //     ->join('companies', 'companies.id', '=', 'subcompany.company_id')
    //     ->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
    //     ->select('companies.company_name', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
    //    // whereYear('created_at', '=', $year)
    //    //->whereMonth('created_at', '=', $month)
    //     ->whereYear('statusmonth.statusMonth','=',$year)
    //     ->whereMonth('statusmonth.statusMonth', '=', $month)
    //     ->groupBy('subscription_member.s')
    //     ->get();
        return json_encode($data['report']);
    }
	public function get_subs_avilablity_check()
	{
		$monthyear = $_POST['statusmonth'];
		$monyr = explode("-",$monthyear);
		$year = $monyr[0];
        $month = $monyr[1];
		
		$company_id = $_POST['company_id'];
		
		$data['report']= DB::table('statusmonth')
        ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
		->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
		->where('subcompany.company_id','=',$company_id)
		->whereYear('statusmonth.statusMonth','=',$year)
        ->whereMonth('statusmonth.statusMonth', '=', $month)
		->count();
		
		return json_encode($data['report']);
		//exit;
		
	}
	public function delete_existingmembersDetails($c_id, $sm_id)
	{
		$monthyear = $sm_id;
		$monyr = explode("-",$monthyear);
		$year = $monyr[0];
        $month = $monyr[1];
		
		$company_id = $c_id;
		$data['existingmember'] = DB::table('statusmonth')
			->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
			//->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
			->select('subcompany.id as subcom')
			->where('subcompany.company_id','=',$company_id)
			->whereYear('statusmonth.statusMonth','=',$year)
			->whereMonth('statusmonth.statusMonth', '=', $month)
			->first();
			
			//dd($data['existingmember']->subcom);			
			DB::table('subscription_member')->where("subcompany_id","=",$data['existingmember']->subcom)->delete();
			//exit;
	}
	
    public function importExportView(Request $request)
    {
          
        $companyid = $request->input('company');    
        $subsdate = $request->input('subsdate');    
        if($companyid==''){
            if($subsdate!=''){
              $year = date('Y',strtotime($subsdate));
              $month = date('m',strtotime($subsdate)); 
              $date = $subsdate;
            }else{
              $year = date('Y');
              $month = date('m'); 
              $date = date('Y-m-01');
            }
            $dircompanyid = '';
           
        }else{
            $date = DB::table('subcompany as sc')
                    ->leftjoin('statusmonth as sm', 'sm.id', '=', 'sc.statusMonth_id')
                    ->where('sc.id','=',$companyid)
                    ->pluck('sm.statusMonth')
                    ->first();
            $year = date('Y',strtotime($date));
            $month = date('m',strtotime($date));
            $dircompanyid = DB::table('subcompany as sc')
                    ->leftjoin('statusmonth as sm', 'sm.id', '=', 'sc.statusMonth_id')
                    ->where('sc.id','=',$companyid)
                    ->pluck('sc.company_id')
                    ->first();
        }
        //return $companyid;
       $data['company'] =Company::where('status','=','1')->get();
       $report = DB::table('subscription_member as m')
       ->select('sc.company_id','m.sub_cid', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'),'sc.company_id','sc.id as scid')
       ->leftjoin('subcompany as sc', 'm.subcompany_id', '=', 'sc.id')
       ->leftjoin('statusmonth as sm', 'sc.statusMonth_id', '=', 'sm.id')
       ->whereYear('sm.statusMonth','=',$year)
       ->whereMonth('sm.statusMonth', '=', $month);

      if($companyid!=''){
        $report = $report->where('m.subcompany_id','=',$companyid);
      }

       $data['report'] = $report->groupBy('m.subcompany_id')
       //->dump()
       ->get();

       $data['subsdate'] = $date;
       $data['companyid'] = $dircompanyid;
      // dd($data['report']);

     /* $data['match']= DB::table('sub_match_master')
      ->join('subscription_member', 'subscription_member.match_no', '=', 'sub_match_master.id')
      ->join('subcompany', 'subcompany.id', '=', 'subscription_member.subcompany_id')     
      ->join('statusmonth', 'statusmonth.id', '=', 'subcompany.statusMonth_id')     
      ->select('subscription_member.match_name', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
     // whereYear('created_at', '=', $year)
     //->whereMonth('created_at', '=', $month)
      ->whereYear('statusmonth.statusMonth','=',$year)
      ->whereMonth('statusmonth.statusMonth', '=', $month)
      ->groupBy('subscription_member.match_name')
      ->get();*/
    //   $data['match']= DB::table('sub_match_master')
    //   ->join('subscription_member', 'subscription_member.match_no', '=', 'sub_match_master.id')
    //   ->join('subcompany', 'subcompany.id', '=', 'subscription_member.subcompany_id')     
    //   ->join('statusmonth', 'statusmonth.id', '=', 'subcompany.statusMonth_id')     
    //   ->select('sub_match_master.match_name','sub_match_master.id','subscription_member.subcompany_id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
    //  // whereYear('created_at', '=', $year)
    //  //->whereMonth('created_at', '=', $month)
    //   ->whereYear('statusmonth.statusMonth','=',$year)
    //   ->whereMonth('statusmonth.statusMonth', '=', $month)
    //   ->groupBy('sub_match_master.match_name')
    //   ->groupBy('sub_match_master.id')
    //   ->groupBy('subscription_member.subcompany_id')
    //   ->get();

       //dd($data['match']);
       return view('subscription.import')->with('data',$data);
    }
	public function subscriptionList()
	{
        $data['subscriptionlist']= DB::table('statusmonth')
        ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
        ->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
        ->select('statusMonth_id','subcompany.id as sub_cid','subcompany.company_id as company_id', DB::raw('count(*) as total'))
        ->groupBy('subcompany.company_id')
       // ->groupBy('subcompany.id')
        ->groupBy('subcompany.statusMonth_id')
        ->get();
		return view('subscription.subscriptionlist')->with('data',$data);
	}
	public function subscriptionMemberUpdate(Request $request)
	{
		//dd($request->all());
		$subsc_company_subs = $request->input('subsc_company_subs');
		$subsc_company_insur = $request->input('subsc_company_insur');
		$company_id = $request->input('company_id');
		$subs_id = $request->input('subs_id');
		DB::table('subscription_member')
                ->where('id', $subs_id)
                ->update(['subs' => $subsc_company_subs],['insur' => $subsc_company_insur]);
		return  redirect('subscriptioncompanylist/'.$company_id);
	}
	public function subscriptionMemberDelete($id)
	{
		DB::table('subscription_member')->where('id','=',$id)->delete();
        return  redirect('subscriptionList');
	}
	public function subscriptioncompanylist($id)
	{
		//dd($id);
        $data['overall_company_member'] = DB::table('subscription_member')->where('subcompany_id', '=', $id)->get();
        $data['subs_id'] = $id;
		return view('subscription.subscriptioncompanylist')->with('data',$data);
	}
	public function subscriptionCompanyDelete($id)
	{
		DB::table('subscription_member')->where('subcompany_id','=',$id)->delete();
        return  redirect('subscriptionList');
	}
	public function mismatchdetails(Request $request)
	{
		$id1 = \Request::segment(2);
		$id2 = \Request::segment(3);
		$data['subs_member']= DB::table('subscription_member')
		->where('subcompany_id','=',$id1)
		->where('match_no', '=', $id2)
		->get();
		return view('subscription.mismatchdetails')->with('data',$data);
	}
	public function update_newmemregister(){
        $id = $_POST['s_id']; 
        $mem_no = $_POST['mem_no'];    
        $mem_name = $_POST['mem_name'];    
        $mem_ic = $_POST['mem_ic'];    
        $doj = $_POST['doj'];    
        $empno = isset($_POST['empno'])?$_POST['empno']:'';    
        $mem_sub = $_POST['mem_sub'];    
        $cmp_id = $_POST['cmp_id'];    
        $mempro['member_no'] = $mem_no;
        $mempro['member_name'] = $mem_name;
        $mempro['doj'] = $doj;
        $mempro['ic_no_new'] = $mem_ic; 
        $mempro['company_name'] = $cmp_id; 
        $mempro['company_names']= DB::table('companies')->where('id',$cmp_id)->first()->company_name;
        $mempro['employee_no'] = $empno;         
       // var_dump($mempro);
       // exit;
        $data_exists = Memberprofile::where([
            ['member_no','=',$mem_no],
            //['status','=','1']
            ])->count();
        if($data_exists > 0)
        {
          $m_id= Memberprofile::where('member_no','=',$mem_no)->first()->id;
        }
        else{
        $savememprof = Memberprofile::create($mempro);  
        //echo True;
        $m_id = $savememprof->id;
        }
        DB::table('subscription_member')
        ->where('id', $id)
        ->update(array('member_code' =>$m_id,'match_no' => "1"));   
        echo True; 
    }
    public function update_membercodesub(){
        $id = $_POST['s_id'];   
       
        $mem_no= DB::table('subscription_member')
		->where('id','=',$id)
        ->first()->member_no;
       // var_dump($mem_no);
       // exit;
       if(!empty($mem_no))
        { 
        $data_exists = Memberprofile::where([
                  ['member_no','=',$mem_no],
                  //['status','=','1']
                  ])->count();
        if($data_exists > 0)
        {
            $m_id = Memberprofile::where([
                ['member_no','=',$mem_no],
                 ])->first()->id;
           // var_dump($m_id);
            DB::table('subscription_member')
            ->where('id', $id)
            //->update(['member_code' => $m_id],['match_no' => "1"]);      
            ->update(array('member_code' =>$m_id,'match_no' => "1"));   
            echo True; 
        }
        else{
            echo False;
        }          
    }       
        
    }
    public function mismatch_bseddetails()
	{
        $id1 = $_POST['mat_id'];       
        $id2 = $_POST['statusmonth'];  
        $staMon = explode("-",$id2);    		
        $data['subs_member']= DB::table('statusmonth')
        ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
        ->join('companies', 'companies.id', '=', 'subcompany.company_id')
        ->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
       // ->select('companies.company_name', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
        ->where('subscription_member.match_no', '=', $id1)
        ->whereMonth('statusmonth.statusMonth', '=', $staMon[1])
        ->whereYear('statusmonth.statusMonth', '=', $staMon[0])
        ->get();
        return view('subscription.mismatchdetails')->with('data',$data);
        //return view('subscription.mismatchdetails')->with('data',$data);
        //dd($data);
		//return view('subscription.mismatchdetails')->with('data',$data);
    }

    public function approvalmismatchdetails($id){
        $data['id'] = $id;
        $data['race_list'] = Race::where('status','=','1')->get();
       // dd();
		$data['company_list'] = Company::where('status','=','1')->get();
        return view('subscription.approvalmismatchdetails')->with('data',$data);  
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
      ini_set('memory_limit', -1);
      ini_set('max_execution_time', 10000);
        //dd($request->all());
        $statusMon =  $request->input('statusdate')."-01";
        $cmpy_id =  $request->input('company_name');
        $company_name = Company::where([
            ['id','=',$cmpy_id]
           ])->get()->toArray();
        //dd($statusMonth);
        $data = [];
        $this->validate($request, array(
            'file'      => 'required'
        ));	  
        if($request->hasFile('file')){
         $file = $request->file('file');
         $extension = $file->getClientOriginalExtension();
           //dd($extension);
           // $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
               $files = $request->file('file');  
              //$name = $request->file->getClientOriginalName();
                $destinationPath = 'uploads';
                $resume_name = time().'.'.$files->getClientOriginalExtension();
                $files->move('public/uploads/',$resume_name);
                $data = (new SubsheetImport)->toArray('public/uploads/'.$resume_name);
                //dd($data[0]);
                //status month
                $statmon_exists = StatusMonth::where([
                    ['statusMonth','=',$statusMon]
                   ])->get()->toArray();
                   //dd($statmon_exists);
                   if(!empty($statmon_exists[0]['id'])){
                    $stamonth_id = $statmon_exists[0]['id'];
                   }
                   else{
                    $data_Month['statusMonth'] = $statusMon;       
                    $saveStatusMont = StatusMonth::create($data_Month);  
                    $stamonth_id = $saveStatusMont->id;
                   }
                //sub company creation
                 $Sub_cmpy_exists = Subcompany::where([
                    ['statusMonth_id','=',$stamonth_id],
                    ['company_id','=',$cmpy_id],
                   ])->get()->toArray();

                   if(!empty($Sub_cmpy_exists[0]['id'])){
                   $cmpystat_id = $Sub_cmpy_exists[0]['id'];
                   }
                   else{
                    $subcmpstat['statusMonth_id'] = $stamonth_id;
                    $subcmpstat['company_id'] = $cmpy_id; 
                    $savecompanystat = Subcompany::create($subcmpstat);  
                    $cmpystat_id = $savecompanystat->id;
                   }           
                //subscription creation
                //dd($data);
                $arrfirst = count($data[0]);
                //dd($arrfirst-1);
                $details = $data[0];
               // dd($details);
                for($fi=1; $fi<$arrfirst; $fi++){
                    $comp_name=$company_name[0]['company_name'];
                    //$company_name = $comp_name;
                    $member_no = $details[$fi][1]; 
                    $member_name = $details[$fi][2]; 
                    $member_ic = $details[$fi][3]; 
                    $member_empno = $details[$fi][4]; 
                    $mem_subs = $details[$fi][5];  
                    if(isset($details[$fi][6])){
                    $mem_ins = $details[$fi][6];     
                    }
                    else{
                         $mem_ins = 0;
                    } 
                    $member_exists = Memberprofile::where([
                         ['member_no','=',$member_no]
                        ])->get()->toArray();
                     if(!empty($member_exists[0]['id'])){
                        $member_id = $member_exists[0]['id'];                       
                        $memname_exists = Memberprofile::where([
                            ['id','=',$member_id],
                            ['member_name','=',$member_name]
                           ])->count();;
                           if($memname_exists > 0)
                            {
                            $matched = 3;  
                           }   
                           else{
                            $matched = 1;    
                           }                  
                     }
                     else{
                        //$member_id = Null;
                       // $matched = 2;
                       $matched = 1;
                       $mem_no = $member_no;    
                       $mem_name = $member_name;    
                       $mem_ic = $member_ic;    
                       $doj = $statusMon;    
                       $empno = isset($member_empno)?$member_empno:'';    
                       $mem_sub = $mem_subs;    
                       $cmp_id = $comp_name;    
                       $mempro['member_no'] = $mem_no;
                       $mempro['member_name'] = $mem_name;
                       $mempro['doj'] = $doj;
                       $mempro['ic_no_new'] = $mem_ic; 
                       $mempro['company_name'] =  $cmpy_id; 
                       $mempro['company_names'] = DB::table('companies')->where('id', $cmpy_id)->first()->company_name;
                       $mempro['employee_no'] = $empno;   
                       $mempro['member_status'] = 1;   
                       $mempro['monthly_fee'] =  $mem_sub;   
                       $savememprof = Memberprofile::create($mempro);  
                       //echo True;
                      // dd($mempro['company_names']);
                       $member_id  = $savememprof->id;    

                     }                    
                     $data_subdetails['subcompany_id'] = $cmpystat_id;
                     $data_subdetails['member_code'] = $member_id;
                     $data_subdetails['company_name'] = $comp_name;
                     $data_subdetails['member_name'] = $member_name;                  
                     $data_subdetails['member_no'] = $member_no;                  
                     $data_subdetails['member_ic'] = $member_ic;                  
                     $data_subdetails['emp_no'] = $member_empno;                  
                     $data_subdetails['subs'] = $mem_subs;                  
                     $data_subdetails['insur'] = $mem_ins;  
                     $data_subdetails['match_no'] =  $matched;
                     
					 if(isset($mem_subs) || $mem_subs !=Null ||$mem_subs !=null || $mem_subs !=""){
                       $datacn = SubscriptionMember::where(array('subcompany_id'=>$cmpystat_id,'member_code'=>$member_id))->count(); 
                      //var_dump($datacn);
                        if($datacn > 0){                         
                        }
                        else{
                        $saveMember_Data = SubscriptionMember::create($data_subdetails); 
                        }                           
                      }                                          
                    // echo "updated successfully";                
                }
            }
        }
        //exit;
        return  redirect('/importExportView')->with('success', 'Subscription Uploaded successfully!');
        /*
       $data = [];
	   $this->validate($request, array(
		   'file'      => 'required'
	   ));	  
	   if($request->hasFile('file')){
		$file = $request->file('file');
		$extension = $file->getClientOriginalExtension();
		  //dd($extension);
		  // $extension = File::extension($request->file->getClientOriginalName());
		   if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
			  $files = $request->file('file');  
			 //$name = $request->file->getClientOriginalName();
			   $destinationPath = 'uploads';
			   $resume_name = time().'.'.$files->getClientOriginalExtension();
           	   $files->move('public/uploads/',$resume_name);
               $data = (new SubsheetImport)->toArray('public/uploads/'.$resume_name);
              // dd($data[0]);
              $statusMon = $data[0][1][1]."-".$data[0][0][1]."-01";                   
              //exists cheack and take the id              
              $statmon_exists = StatusMonth::where([
                ['statusMonth','=',$statusMon]
               ])->get()->toArray();
               if(!empty($statmon_exists[0]['id'])){
                $stamonth_id = $statmon_exists[0]['id'];
               }
               else{
                $data_Month['statusMonth'] = $statusMon;       
                $saveStatusMont = StatusMonth::create($data_Month);  
                $stamonth_id = $saveStatusMont->id;
               }
              //dd($statmon_exists[0]['id']);  
            foreach($data[0] as $key=>$data1[0]){
                if(in_array("Company",$data1[0]))
                {   
                    $cmpval[] = $key;
                    $cmpyname[]=$data1[0];                
                }  
            }
            for($k=0; $k<count($cmpval); $k++){
                $firstval = $cmpval[$k];    
                if($k < (count($cmpval)-1)){
                $secval = $cmpval[$k+1];   
                for($i=$firstval; $i<$secval; $i++){
                    $d[$cmpyname[$k][2]][] = $data[0][$i];
                 }              
                }
                else{
                 $secval = count($data[0]);  
                 for($i=$firstval; $i<$secval-1; $i++){
                    $d[$cmpyname[$k][2]][] = $data[0][$i];
                 } 
                }                
            }
            //dd($d);
            foreach($d as $key=>$details){                
                //company name new insert check with the db
                $comp_name = $key;  
                //db insert company id                  
                $cmpy_exists = Company::where([
                    ['company_name','=',$comp_name]
                   ])->get()->toArray();
                   if(!empty($cmpy_exists[0]['id'])){
                    $cmpy_id = $cmpy_exists[0]['id'];
                   }
                   else{
                    $data_cmpy['company_name'] = $comp_name;     
                    $savecompany = Company::create($data_cmpy);  
                    $cmpy_id = $savecompany->id;
                   }

                   $Sub_cmpy_exists = Subcompany::where([
                    ['statusMonth_id','=',$stamonth_id],
                    ['company_id','=',$cmpy_id],
                   ])->get()->toArray();

                   if(!empty($Sub_cmpy_exists[0]['id'])){
                    //$cmpy_id = $Sub_cmpy_exists[0]['id'];
                    //already exists
                   // exit;
                   $cmpystat_id = $Sub_cmpy_exists[0]['id'];
                   }
                   else{
                    $subcmpstat['statusMonth_id'] = $stamonth_id;
                    $subcmpstat['company_id'] = $cmpy_id; 
                    $savecompanystat = Subcompany::create($subcmpstat);  
                    $cmpystat_id = $savecompanystat->id;
                   }               
                //var_dump(count($details));
                $arrfirst = count($details);
                for($fi=3; $fi<$arrfirst-2; $fi++){
                   $company_name = $comp_name;
                   $member_no = $details[$fi][1]; 
                   $member_name = $details[$fi][2]; 
                   $member_ic = $details[$fi][3]; 
                   $member_empno = $details[$fi][4]; 
                   $mem_subs = $details[$fi][5];  
                   $mem_ins = $details[$fi][6];                     

                    $member_exists = Memberprofile::where([
                        ['ic_no_new','=',$member_ic]
                       ])->get()->toArray();
                    if(!empty($member_exists[0]['id'])){
                     $memeber_id = $member_exists[0]['id'];
                    }
                    else{
                        $data_Mem['member_name'] = $member_name;
                        $data_Mem['ic_no_new'] = $member_ic;
                        $data_Mem['member_no'] = $member_no;
                        $data_Mem['employee_no'] = $member_empno;
                        $data_Mem['employee_no'] = $member_empno;
                        $data_Mem['company_name'] = $cmpy_id;
                        $saveMember_Data = Memberprofile::create($data_Mem);
                        $memeber_id = $saveMember_Data->id;
                    }

                    $data_subdetails['subcompany_id'] = $cmpystat_id;
                    $data_subdetails['member_code'] = $memeber_id;
                    $data_subdetails['company_name'] = $comp_name;
                    $data_subdetails['member_name'] = $member_name;                  
                    $data_subdetails['member_ic'] = $member_ic;                  
                    $data_subdetails['subs'] = $mem_subs;                  
                    $data_subdetails['insur'] = $mem_ins;  
                    $saveMember_Data = SubscriptionMember::create($data_subdetails);                         
                   // echo "updated successfully";                  
                   
                }
                
            }     
           
                return  redirect('/importExportView')->with('success', 'Subscription Uploaded successfully!');
           
                            
           }
        }*/
    }

    public function importSummary(Request $request)
    {
          
        $companyid = $request->input('company');    
        if($companyid==''){
            $year = date('Y');
            $month = date('m'); 
            $date = date('Y-m-01');
            $dircompanyid = '';
        }else{
            $date = DB::table('subcompany as sc')
                    ->leftjoin('statusmonth as sm', 'sm.id', '=', 'sc.statusMonth_id')
                    ->where('sc.id','=',$companyid)
                    ->pluck('sm.statusMonth')
                    ->first();
            $year = date('Y',strtotime($date));
            $month = date('m',strtotime($date));
            $dircompanyid = DB::table('subcompany as sc')
            ->leftjoin('statusmonth as sm', 'sm.id', '=', 'sc.statusMonth_id')
            ->where('sc.id','=',$companyid)
            ->pluck('sc.company_id')
            ->first();
        }
        //return $companyid;
       $data['company'] =Company::where('status','=','1')->get();
       $report = DB::table('subscription_member as m')
       ->select('company_id','m.sub_cid', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
       ->leftjoin('subcompany as sc', 'm.subcompany_id', '=', 'sc.id')
       ->leftjoin('statusmonth as sm', 'sc.statusMonth_id', '=', 'sm.id')
       ->whereYear('sm.statusMonth','=',$year);

       if($companyid!=''){
         $report = $report->where('m.subcompany_id','=',$companyid);
       }

       $data['report'] = $report->whereMonth('sm.statusMonth', '=', $month)
       ->groupBy('m.sub_cid')
       //->dump()
       ->get();

       $data['subsdate'] = $date;
       $data['companyid'] = $dircompanyid;
      // dd($data['report']);

       //dd($data['match']);
       return view('subscription.import_summary')->with('data',$data);
    }
    public function get_subdetailsall(){
        $monthyear = $_POST['statusmonth'];
        $company_name = $_POST['company_name'];
        //return $company_name;
        $monyr = explode("-",$monthyear);
        //var_dump($monyr);
        $year = $monyr[0];
        $month = $monyr[1];

        // $data['report']= DB::table('subscription_member as m')
        // ->select('cb.branch_name','m.sub_cid', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'), DB::raw('sum(m.welfare_fee) as sumwelfare'), DB::raw('sum(m.entrance_fee) as sumentrance'))
        // ->leftjoin('subcompany as sc', 'm.subcompany_id', '=', 'sc.id')
        // ->leftjoin('statusmonth as sm', 'sc.statusMonth_id', '=', 'sm.id')
        // ->leftjoin('company_branches as cb', 'cb.id', '=', 'm.sub_cid')
        // ->whereYear('sm.statusMonth','=',$year)
        // ->whereMonth('sm.statusMonth', '=', $month)
        // ->where('sc.company_id', '=', $company_name)
        // ->groupBy('m.sub_cid')
        // //->dump()
        // ->get();

        $report = DB::table('subscription_member as m')
       ->select('sc.company_id','m.sub_cid', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'),'c.company_name','sc.id as scid')
       ->leftjoin('subcompany as sc', 'm.subcompany_id', '=', 'sc.id')
       ->leftjoin('statusmonth as sm', 'sc.statusMonth_id', '=', 'sm.id')
       ->leftjoin('companies as c', 'c.id', '=', 'sc.company_id')
       ->whereYear('sm.statusMonth','=',$year)
       ->whereMonth('sm.statusMonth', '=', $month);

       if($company_name!=''){
          $report = $report->where('sc.company_id','=',$company_name);
       }

       $report = $report->groupBy('m.subcompany_id')
       //->dump()
       ->get();

       $info = [];

       foreach ($report as $key => $value) {
           //dd(gettype($value));
            $value->costcount = CommonHelper::getCostCount($value->scid);
            $info[] = $value ;
       }

       $data['report'] = $info;


    //     $data['report']= DB::table('statusmonth')
    //     ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
    //     ->join('companies', 'companies.id', '=', 'subcompany.company_id')
    //     ->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
    //     ->select('companies.company_name', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
    //    // whereYear('created_at', '=', $year)
    //    //->whereMonth('created_at', '=', $month)
    //     ->whereYear('statusmonth.statusMonth','=',$year)
    //     ->whereMonth('statusmonth.statusMonth', '=', $month)
    //     ->groupBy('subscription_member.s')
    //     ->get();
        return json_encode($data['report']);
    }

    public function update_submembermemcode(){

    }
}