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
    //    $data['report']= DB::table('statusmonth')
    //    ->join('subcompany', 'subcompany.statusMonth_id', '=', 'statusmonth.id')
    //    ->join('subscription_member', 'subscription_member.subcompany_id', '=', 'subcompany.id')
    //    ->select('company_id', DB::raw('sum(subs) as sum'), DB::raw('count(*) as total'))
    //    ->whereYear('statusmonth.statusMonth','=',$year)
    //    ->whereMonth('statusmonth.statusMonth', '=', $month)
    //    ->groupBy('subcompany.company_id')
    //    ->get();

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

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        $this->validate($request, array(
            'file'      => 'required'
        ));	  

        //dd($request->all());
        $frommonth =  $request->input('frommonth');
        
        $statusMon = '';
        if($frommonth!=''){
            $datearr = explode("/",$frommonth);  
            $monthname = $datearr[0];
            $year = $datearr[1];
            $statusMon = date('Y-m-d',strtotime('01-'.$monthname.'-'.$year));
        }

        $type =  $request->input('type');
        

        if($type==1){
            $cmpy_id =  $request->input('company_name');
            $company_name = Company::where([
                ['id','=',$cmpy_id]
               ])->pluck('company_name')->first();
            
            $data = [];
        
            if($request->hasFile('file')){
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                 
                if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
                    $files = $request->file('file');  
                    
                    $destinationPath = 'uploads';
                    $resume_name = time().'.'.$files->getClientOriginalExtension();
                    $file = $request->file('file')->storeAs('subscription', $resume_name  ,'local');
                    //$files->move('public/uploads/',$resume_name);
                    $data = (new SubsheetImport)->toArray('storage/app/subscription/'.$resume_name);
                   //  dd($data);
                     
       
                    $arrfirst = count($data[0]);
                    // dd($data[0]);
                    $details = $data[0];

                        $statmon_exists = StatusMonth::where([
                            ['statusMonth','=',$statusMon]
                            ])->get()->toArray();
                            //dd($statmon_exists);
                        if(!empty($statmon_exists)){
                            $stamonth_id = $statmon_exists[0]['id'];
                        }
                        else{
                            $data_Month['statusMonth'] = $statusMon;      
                            //$data_Month['ToMonth'] = $statusMon;   
                            $saveStatusMont = StatusMonth::create($data_Month);  
                            $stamonth_id = $saveStatusMont->id;
                        }
                        //sub company creation
                        $Sub_cmpy_exists = Subcompany::where([
                            ['statusMonth_id','=',$stamonth_id],
                            ['company_id','=',$cmpy_id],
                            ])->get()->toArray();
        
                        if(!empty($Sub_cmpy_exists)){
                            $cmpystat_id = $Sub_cmpy_exists[0]['id'];
                        }
                        else{
                            $subcmpstat['statusMonth_id'] = $stamonth_id;
                            $subcmpstat['company_id'] = $cmpy_id; 
                            $savecompanystat = Subcompany::create($subcmpstat);  
                            $cmpystat_id = $savecompanystat->id;
                        }
                        
                        for($fi=1; $fi<$arrfirst; $fi++){
                            $comp_name=$company_name;
                            //$company_name = $comp_name;
                           // dd($details[2]);
                            $sl_no = $details[$fi][0]; 
                            $member_employeeno = $details[$fi][1]; 
                            $member_name = $details[$fi][2]; 
                            //dd($member_name);
                            $member_no = $details[$fi][3]; 
                            $member_costcenter = $details[$fi][4]; 
                            $member_ic = $details[$fi][5]; 
                            $mem_subs = $details[$fi][6]; 
                            $member_paid = $details[$fi][7]; 

                            if($member_no!='' && $member_no!=null && $member_no!="Member Id"){
                                //dd($details[$fi][5]);
                               
                                if($member_costcenter!=''){
                                    $costcenterid = DB::table('company_branches')->where([
                                        ['company_id','=',$cmpy_id],
                                        ['branch_name','=',$member_costcenter]
                                    ])->pluck('id')->first();
                                    if($costcenterid==''){
                                        $costcenterid = DB::table('company_branches')->insertGetId(
                                            ['company_id' => $cmpy_id, 'branch_name' => $member_costcenter, 'status' =>1 ]
                                        );
                                    }
                                    //dd($costcenterid);
                                }
            
                                $member_exists = Memberprofile::where([
                                    ['member_no','=',$member_no]
                                    ])->get()->toArray();
                                
                                if(!empty($member_exists[0]['id'])){
                                    $member_id = $member_exists[0]['id'];                       
                                    $memname_exists = Memberprofile::where([
                                        ['id','=',$member_id],
                                        ['member_name','=',$member_name]
                                    ])->count();
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
                                //  $empno = isset($member_empno)?$member_empno:'';    
                                $mem_sub = $mem_subs;    
                                $cmp_id = $comp_name;    
                                $mempro['member_no'] = $mem_no;
                                $mempro['member_name'] = $mem_name;
                                $mempro['doj'] = $doj;
                                $mempro['ic_no_new'] = $mem_ic; 
                                $mempro['company_name'] =  $cmpy_id; 
                                $mempro['cost_centerid'] =  $costcenterid; 
                                $mempro['company_names'] = DB::table('companies')->where('id', $cmpy_id)->first()->company_name;
                                // $mempro['employee_no'] = $empno;   

                                $emailid = $mem_no.'@amco.com';
                                $mempro['email_id'] =  $emailid;

                                $mempro['member_status'] = 1;   
                                $mempro['monthly_fee'] =  $mem_subs;   
                                $mempro['entrance_fee'] = 0; 
                                $savememprof = Memberprofile::create($mempro);  
                                //echo True;
                                // dd($mempro['company_names']);
                                $member_id  = $savememprof->id;    

                                
                                //dd($emailid);
                                $password = bcrypt($mem_ic);

                                $userid = DB::table('users')->insertGetId(
                                    ['name' => $mem_name, 'email' => $emailid, 'is_admin' =>0, 'password' => $password ]
                                );
            
                                }    

                                
                                
            
                                $data_subdetails['subcompany_id'] = $cmpystat_id;
                                $data_subdetails['member_code'] = $member_id;
                                $data_subdetails['sub_cid'] = $costcenterid;
                                //dd($costcenterid);
                                $data_subdetails['member_name'] = $member_name;                  
                                $data_subdetails['member_no'] = $member_no;                  
                                $data_subdetails['member_ic'] = $member_ic;                  
                            // $data_subdetails['emp_no'] = $member_empno;                  
                                $data_subdetails['subs'] = $member_paid;                  
                                $data_subdetails['welfare_fee'] = 0;  
                                $data_subdetails['entrance_fee'] = 0;  
                                $data_subdetails['match_no'] =  $matched;
                                
                                if( $mem_subs !=""){
                                    $datacn = SubscriptionMember::where(array('subcompany_id'=>$cmpystat_id,'member_code'=>$member_id,'sub_cid'=>$costcenterid))->count(); 
                                //dd($datacn);
                                    if($datacn == 0){
                                        $saveMember_Data = SubscriptionMember::create($data_subdetails);            
                                        //dd( $saveMember_Data);              
                                    }
                                    else{
                                        SubscriptionMember::where(array('subcompany_id'=>$cmpystat_id,'member_code'=>$member_id,'sub_cid'=>$costcenterid))->update($data_subdetails);

                                        // dd($data_subdetails);
                                    
                                    }                           
                                }      
                            }
                            
                        }


                
                    
                }
            }
            
        }
        else{
            // $cmpy_id =  $request->input('company_name');
            // $company_name = Company::where([
            //     ['id','=',$cmpy_id]
            //    ])->pluck('company_name')->first();
            
            $data = [];
        
            if($request->hasFile('file')){
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                 
                if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
                    $files = $request->file('file');  
                    
                    $destinationPath = 'uploads';
                    $resume_name = time().'.'.$files->getClientOriginalExtension();
                    $file = $request->file('file')->storeAs('subscription', $resume_name  ,'local');
                    //$files->move('public/uploads/',$resume_name);
                    $data = (new SubsheetImport)->toArray('storage/app/subscription/'.$resume_name);
                   //  dd($data);
                     
       
                    $arrfirst = count($data[0]);
                    // dd($data[0]);
                    $details = $data[0];

                        $statmon_exists = StatusMonth::where([
                            ['statusMonth','=',$statusMon]
                            ])->get()->toArray();
                            //dd($statmon_exists);
                        if(!empty($statmon_exists)){
                            $stamonth_id = $statmon_exists[0]['id'];
                        }
                        else{
                            $data_Month['statusMonth'] = $statusMon;      
                            //$data_Month['ToMonth'] = $statusMon;   
                            $saveStatusMont = StatusMonth::create($data_Month);  
                            $stamonth_id = $saveStatusMont->id;
                        }
                        //sub company creation
                        // $Sub_cmpy_exists = Subcompany::where([
                        //     ['statusMonth_id','=',$stamonth_id],
                        //     ['company_id','=',$cmpy_id],
                        //     ])->get()->toArray();
        
                        // if(!empty($Sub_cmpy_exists)){
                        //     $cmpystat_id = $Sub_cmpy_exists[0]['id'];
                        // }
                        // else{
                        //     $subcmpstat['statusMonth_id'] = $stamonth_id;
                        //     $subcmpstat['company_id'] = $cmpy_id; 
                        //     $savecompanystat = Subcompany::create($subcmpstat);  
                        //     $cmpystat_id = $savecompanystat->id;
                        // }
                        
                        for($fi=0; $fi<$arrfirst; $fi++){
                            dd($details[$fi]);
                            $comp_name=$company_name;
                            //$company_name = $comp_name;
                            
                            $sl_no = $details[$fi][0]; 
                            $member_employeeno = $details[$fi][1]; 
                            $member_name = $details[$fi][2]; 
                            //dd($member_name);
                            $member_no = $details[$fi][3]; 
                            $member_costcenter = $details[$fi][4]; 
                            $member_ic = $details[$fi][5]; 
                            $mem_subs = $details[$fi][6]; 
                            $member_paid = $details[$fi][7]; 

                            if($member_no!='' && $member_no!=null && $member_no!="Member Id"){
                                //dd($details[$fi][5]);
                               
                                if($member_costcenter!=''){
                                    $costcenterid = DB::table('company_branches')->where([
                                        ['company_id','=',$cmpy_id],
                                        ['branch_name','=',$member_costcenter]
                                    ])->pluck('id')->first();
                                    if($costcenterid==''){
                                        $costcenterid = DB::table('company_branches')->insertGetId(
                                            ['company_id' => $cmpy_id, 'branch_name' => $member_costcenter, 'status' =>1 ]
                                        );
                                    }
                                    //dd($costcenterid);
                                }
            
                                $member_exists = Memberprofile::where([
                                    ['member_no','=',$member_no]
                                    ])->get()->toArray();
                                
                                if(!empty($member_exists[0]['id'])){
                                    $member_id = $member_exists[0]['id'];                       
                                    $memname_exists = Memberprofile::where([
                                        ['id','=',$member_id],
                                        ['member_name','=',$member_name]
                                    ])->count();
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
                                //  $empno = isset($member_empno)?$member_empno:'';    
                                $mem_sub = $mem_subs;    
                                $cmp_id = $comp_name;    
                                $mempro['member_no'] = $mem_no;
                                $mempro['member_name'] = $mem_name;
                                $mempro['doj'] = $doj;
                                $mempro['ic_no_new'] = $mem_ic; 
                                $mempro['company_name'] =  $cmpy_id; 
                                $mempro['cost_centerid'] =  $costcenterid; 
                                $mempro['company_names'] = DB::table('companies')->where('id', $cmpy_id)->first()->company_name;
                                // $mempro['employee_no'] = $empno;   

                                $emailid = $mem_no.'@amco.com';
                                $mempro['email_id'] =  $emailid;

                                $mempro['member_status'] = 1;   
                                $mempro['monthly_fee'] =  $mem_subs;   
                                $mempro['entrance_fee'] = 0; 
                                $savememprof = Memberprofile::create($mempro);  
                                //echo True;
                                // dd($mempro['company_names']);
                                $member_id  = $savememprof->id;    

                                
                                //dd($emailid);
                                $password = bcrypt($mem_ic);

                                $userid = DB::table('users')->insertGetId(
                                    ['name' => $mem_name, 'email' => $emailid, 'is_admin' =>0, 'password' => $password ]
                                );
            
                                }    

                                
                                
            
                                $data_subdetails['subcompany_id'] = $cmpystat_id;
                                $data_subdetails['member_code'] = $member_id;
                                $data_subdetails['sub_cid'] = $costcenterid;
                                //dd($costcenterid);
                                $data_subdetails['member_name'] = $member_name;                  
                                $data_subdetails['member_no'] = $member_no;                  
                                $data_subdetails['member_ic'] = $member_ic;                  
                            // $data_subdetails['emp_no'] = $member_empno;                  
                                $data_subdetails['subs'] = $member_paid;                  
                                $data_subdetails['welfare_fee'] = 0;  
                                $data_subdetails['entrance_fee'] = 0;  
                                $data_subdetails['match_no'] =  $matched;
                                
                                if( $mem_subs !=""){
                                    $datacn = SubscriptionMember::where(array('subcompany_id'=>$cmpystat_id,'member_code'=>$member_id,'sub_cid'=>$costcenterid))->count(); 
                                //dd($datacn);
                                    if($datacn == 0){
                                        $saveMember_Data = SubscriptionMember::create($data_subdetails);            
                                        //dd( $saveMember_Data);              
                                    }
                                    else{
                                        SubscriptionMember::where(array('subcompany_id'=>$cmpystat_id,'member_code'=>$member_id,'sub_cid'=>$costcenterid))->update($data_subdetails);

                                        // dd($data_subdetails);
                                    
                                    }                           
                                }      
                            }
                            
                        }


                
                    
                }
            }
        }

       

        //dd($statusMonth);
       // $data = [];
        
        // if($request->hasFile('file')){
        //  $file = $request->file('file');
        //  $extension = $file->getClientOriginalExtension();
        //    //dd($extension);
        //    // $extension = File::extension($request->file->getClientOriginalName());
        //     if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
        //        $files = $request->file('file');  
        //       //$name = $request->file->getClientOriginalName();
        //         $destinationPath = 'uploads';
        //         $resume_name = time().'.'.$files->getClientOriginalExtension();
        //         $file = $request->file('file')->storeAs('subscription', $resume_name  ,'local');
        //         //$files->move('public/uploads/',$resume_name);
        //         $data = (new SubsheetImport)->toArray('storage/app/subscription/'.$resume_name);
        //         dd($data);
        //         //status month
        //         if($noofmonths>=1){

        //             $arrfirst = count($data[0]);
        //             // dd($data[0]);
        //             $details = $data[0];

        //             for($i=1;$i<=$noofmonths;$i++){
        //                 $statusMonths = $i==1 ? $statusMon : date('Y-m-01', strtotime('+'.($i-1).' months',strtotime($statusMon)));
        //                 $statmon_exists = StatusMonth::where([
        //                     ['statusMonth','=',$statusMonths]
        //                    ])->get()->toArray();
        //                    //dd($statmon_exists);
        //                 if(!empty($statmon_exists)){
        //                     $stamonth_id = $statmon_exists[0]['id'];
        //                 }
        //                 else{
        //                     $data_Month['statusMonth'] = $statusMonths;      
        //                     //$data_Month['ToMonth'] = $statusMon;   
        //                     $saveStatusMont = StatusMonth::create($data_Month);  
        //                     $stamonth_id = $saveStatusMont->id;
        //                 }
        //                 //sub company creation
        //                 $Sub_cmpy_exists = Subcompany::where([
        //                     ['statusMonth_id','=',$stamonth_id],
        //                     ['company_id','=',$cmpy_id],
        //                    ])->get()->toArray();
        
        //                 if(!empty($Sub_cmpy_exists)){
        //                     $cmpystat_id = $Sub_cmpy_exists[0]['id'];
        //                 }
        //                 else{
        //                     $subcmpstat['statusMonth_id'] = $stamonth_id;
        //                     $subcmpstat['company_id'] = $cmpy_id; 
        //                     $savecompanystat = Subcompany::create($subcmpstat);  
        //                     $cmpystat_id = $savecompanystat->id;
        //                 }
                        
        //                 for($fi=1; $fi<$arrfirst; $fi++){
        //                     $comp_name=$company_name;
        //                     //$company_name = $comp_name;
        //                     $pf_no = $details[$fi][0]; 
        //                     $member_ic = $details[$fi][1]; 
        //                     $member_name = $details[$fi][2]; 
        //                     //dd($member_name);
        //                     $member_costcenter = $details[$fi][3]; 
        //                     $member_accountno = $details[$fi][4]; 
        //                     $member_no = $details[$fi][5]; 

        //                     if($member_no!='' && $member_no!=null && $member_no!="Member No"){
        //                         //dd($details[$fi][5]);
        //                         $mem_subs = $details[$fi][6];  
        //                         $subs_month = 15;
        //                         $totsubs_month = 15;

        //                         $entrance_fee = $mem_subs - $subs_month;

        //                         if($noofmonths>1){
        //                             $subs_month = 15;
        //                             $totsubs_month = $subs_month*$noofmonths;
        //                             $entrance_fee = $mem_subs - $totsubs_month;

        //                         }
            
        //                         if(isset($details[$fi][8])){
        //                             $mem_welfare = $details[$fi][7];     
        //                         }
        //                         else{
        //                             $mem_welfare = 0;
        //                         } 

        //                         if($member_costcenter!=''){
        //                             $costcenterid = DB::table('company_branches')->where([
        //                                 ['company_id','=',$cmpy_id],
        //                                 ['branch_name','=',$member_costcenter]
        //                             ])->pluck('id')->first();
        //                             if($costcenterid==''){
        //                                 $costcenterid = DB::table('company_branches')->insertGetId(
        //                                     ['company_id' => $cmpy_id, 'branch_name' => $member_costcenter, 'status' =>1 ]
        //                                 );
        //                             }
        //                             //dd($costcenterid);
        //                         }
            
        //                         $member_exists = Memberprofile::where([
        //                             ['member_no','=',$member_no]
        //                             ])->get()->toArray();
                                
        //                         if(!empty($member_exists[0]['id'])){
        //                             $member_id = $member_exists[0]['id'];                       
        //                             $memname_exists = Memberprofile::where([
        //                                 ['id','=',$member_id],
        //                                 ['member_name','=',$member_name]
        //                             ])->count();
        //                             if($memname_exists > 0)
        //                             {
        //                                 $matched = 3;  
        //                             }   
        //                             else{
        //                                 $matched = 1;    
        //                             }                  
        //                         }
        //                         else{
        //                             //$member_id = Null;
        //                         // $matched = 2;
        //                         $matched = 1;
        //                         $mem_no = $member_no;    
        //                         $mem_name = $member_name;    
        //                         $mem_ic = $member_ic;    
        //                         $doj = $statusMon;    
        //                         //  $empno = isset($member_empno)?$member_empno:'';    
        //                         $mem_sub = $mem_subs;    
        //                         $cmp_id = $comp_name;    
        //                         $mempro['member_no'] = $mem_no;
        //                         $mempro['member_name'] = $mem_name;
        //                         $mempro['doj'] = $doj;
        //                         $mempro['ic_no_new'] = $mem_ic; 
        //                         $mempro['company_name'] =  $cmpy_id; 
        //                         $mempro['cost_centerid'] =  $costcenterid; 
        //                         $mempro['company_names'] = DB::table('companies')->where('id', $cmpy_id)->first()->company_name;
        //                         // $mempro['employee_no'] = $empno;   

        //                         $emailid = $mem_no.'@amco.com';
        //                         $mempro['email_id'] =  $emailid;

        //                         $mempro['member_status'] = 1;   
        //                         $mempro['monthly_fee'] =  $subs_month;   
        //                         $mempro['entrance_fee'] = $entrance_fee; 
        //                         $savememprof = Memberprofile::create($mempro);  
        //                         //echo True;
        //                         // dd($mempro['company_names']);
        //                         $member_id  = $savememprof->id;    

                               
        //                         //dd($emailid);
        //                         $password = bcrypt($mem_ic);

        //                         $userid = DB::table('users')->insertGetId(
        //                             ['name' => $mem_name, 'email' => $emailid, 'is_admin' =>0, 'password' => $password ]
        //                         );
            
        //                         }    

                               
                                
            
        //                         $data_subdetails['subcompany_id'] = $cmpystat_id;
        //                         $data_subdetails['member_code'] = $member_id;
        //                         $data_subdetails['sub_cid'] = $costcenterid;
        //                         //dd($costcenterid);
        //                         $data_subdetails['member_name'] = $member_name;                  
        //                         $data_subdetails['member_no'] = $member_no;                  
        //                         $data_subdetails['member_ic'] = $member_ic;                  
        //                     // $data_subdetails['emp_no'] = $member_empno;                  
        //                         $data_subdetails['subs'] = $subs_month;                  
        //                         $data_subdetails['welfare_fee'] = 1;  
        //                         $data_subdetails['entrance_fee'] = $entrance_fee;  
        //                         $data_subdetails['match_no'] =  $matched;
                                
        //                         if( $mem_subs !=""){
        //                             $datacn = SubscriptionMember::where(array('subcompany_id'=>$cmpystat_id,'member_code'=>$member_id,'sub_cid'=>$costcenterid))->count(); 
        //                         //dd($datacn);
        //                             if($datacn == 0){
        //                                 $saveMember_Data = SubscriptionMember::create($data_subdetails);            
        //                                 //dd( $saveMember_Data);              
        //                             }
        //                             else{
        //                                 SubscriptionMember::where(array('subcompany_id'=>$cmpystat_id,'member_code'=>$member_id,'sub_cid'=>$costcenterid))->update($data_subdetails);

        //                                // dd($data_subdetails);
                                    
        //                             }                           
        //                         }      
        //                     }
                            
                                                                
        //                     // echo "updated successfully";                
        //                 }


        //             }
        //         }else{

        //         }
        //       //  dd(30);  
        //         //subscription creation
        //         //dd($data);
               
        //        // dd($details);
               
        //     }
        // }
       
        return  redirect('/importExportView')->with('success', 'Subscription Uploaded successfully!');
       
     
    }
}
