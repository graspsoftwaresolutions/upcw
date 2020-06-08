<?php

namespace App\Http\Controllers;

use App\Model\Memberprofile;
use App\Model\Race;
use App\Model\Company;
use Illuminate\Http\Request;
use DB;
class MemberprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct() {
		
        $this->Memberprofile = new Memberprofile;
        $this->middleware('auth');
       
    }
    public function index()
    {
        $data['company'] =Company::where('status','=','1')->get();
        return view('memberprofile.memberprofile_list')->with('data',$data);
    }
	public function memberprofile()
    {
        //return view('memberprofile.memberprofile_list');

    }
	
    
    public function get_memberprofile_list(Request $request)
	{
		
       // $cmp_id = $_POST['cmp_id'];
       $cmp_id = $_POST['cmp_id'];
      //var_dump($cmp_id);
		$columns = array( 
            0 => 'member_no',
			1 => 'employee_no',
            2 => 'member_name', 
            3 => 'ic_no_new', 
            4 => 'race', 
            5 => 'sex', 
            6 => 'dob', 
            7 => 'doj', 
            8 => 'member_status', 
            9 => 'options'
        );
		$query_pt = DB::table('memberprofiles');
		$query_pt->select('id','member_no','member_name','company_name','company_names','employee_no','ic_no_new','race','sex','dob','doj','member_status');
		//if($monthlyyear_paid != "")
		//{
			if($cmp_id !=''){
			$cmp_id = $cmp_id;			
			$query_pt->where('company_name', '=', $cmp_id);
			}
			
		$totalData = $query_pt->get()->count();
        $totalFiltered = $totalData;
		
		$limit = $request->input('length');
        $start = $request->input('start');
        //$order = $columns[$request->input('order.0.column')];
        $order = "id";
        $dir = $request->input('order.0.dir');
        
		if(empty($request->input('search.value')))
        {  
            if( $limit == -1){
                
				$query_fetch = DB::table('memberprofiles');
				$query_fetch->select('id','member_no','member_name','company_name','company_names','employee_no','ic_no_new','race','sex','dob','doj','member_status');
				//if($monthlyyear_paid != "")
				//{
					if($cmp_id !=''){
					$cmp_id = $cmp_id;
					$query_fetch->where('company_name', '=', $cmp_id);
					}
					
				$query_fetch->orderBy($order,$dir);
				$paidlist = $query_fetch->get()->toArray();
				      
           
                
            }else{
                 //dd($dir);
                $query_fetch = DB::table('memberprofiles');
                $query_fetch->select('id','member_no','member_name','company_name','company_names','employee_no','ic_no_new','race','sex','dob','doj','member_status');
				
				//if($monthlyyear_paid != "")
				//{
					if($cmp_id !=''){
					$cmp_id = $cmp_id;
                    $query_fetch->where('company_name', '=', $cmp_id);
					}
				$query_fetch->groupBy('id');
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
                    $query_fetch = DB::table('memberprofiles');
                    $query_fetch->select('id','member_no','member_name','company_name','company_names','employee_no','ic_no_new','race','sex','dob','doj','member_status');
				
					//if($monthlyyear_paid != "")
					//{
						if($cmp_id !=''){
							$cmp_id = $cmp_id;
						$query_fetch->orWhere('company_name', '=', $cmp_id);
						}
                        $query_fetch->orWhere('member_no', '=',$search);
                        $query_fetch->orWhere('ic_no_new', '=',$search);
                        $query_fetch->orWhere('race', 'LIKE',"%{$search}%");
                        $query_fetch->orWhere('dob', 'LIKE',"%{$search}%");
                        $query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
                       // $query_fetch->orWhere('member_status', 'LIKE',"%{$search}%");
                       $query_fetch->orWhere('company_name', 'LIKE',"%{$search}%");
                    $query_fetch->groupBy('id');
                   
					$query_fetch->orderBy($order,$dir);
					$paidlist = $query_fetch->get()->toArray();
			}else{
                    $query_fetch = DB::table('memberprofiles');
                    $query_fetch->select('id','member_no','member_name','company_name','company_names','employee_no','ic_no_new','race','sex','dob','doj','member_status');
				
					//if($monthlyyear_paid != "")
					//{
						if($cmp_id !=''){
						$cmp_id = $cmp_id;
						$query_fetch->orWhere('company_name', '=', $cmp_id);
						}
                        $query_fetch->orWhere('member_no', '=',$search);
                        //$query_fetch->orWhere('member_status', 'LIKE',"%{$search}%");
                    $query_fetch->orWhere('ic_no_new', '=',$search);
                        $query_fetch->orWhere('race', 'LIKE',"%{$search}%");
                        $query_fetch->orWhere('dob', 'LIKE',"%{$search}%");
                        $query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
                       /* $query_fetch->orWhere('member_status', 'LIKE',"%{$search}%");*/
                   $query_fetch->orWhere('company_name', 'LIKE',"%{$search}%");	
					$query_fetch->groupBy('id');
					//$query_fetch->orWhere('company_name', 'LIKE',"%{$search}%");
					$query_fetch->offset($start);
					$query_fetch->limit($limit);
					$query_fetch->orderBy($order,$dir);
					$paidlist = $query_fetch->get()->toArray();
			}
			//dd($paidlist);
            $query_pt = DB::table('memberprofiles');
            $query_fetch->select('id','member_no','member_name','company_name','company_names','employee_no','ic_no_new','race','sex','dob','doj','member_status');
				
			//if($monthlyyear_paid != "")
			//{
				if($cmp_id !=''){
					$cmp_id = $cmp_id;
				$query_pt->where('company_name', '=', $cmp_id);
				}
                $query_pt->Where('member_no', '=',$search);
                $query_pt->orWhere('ic_no_new', '=',$search);
                $query_pt->orWhere('race', 'LIKE',"%{$search}%");
                $query_pt->orWhere('dob', 'LIKE',"%{$search}%");
                $query_pt->orWhere('doj', 'LIKE',"%{$search}%");
                $query_pt->orWhere('member_status', 'LIKE',"%{$search}%");
               // $query_pt->orWhere('company_name', 'LIKE',"%{$search}%");	
			$query_pt->groupBy('id');
			//$query_pt->orWhere('company_name', 'LIKE',"%{$search}%");
			$totalFiltered = $query_pt->get()->count();
        }

		//dd($paidlist[0]->id);
		//exit;
        $data = array();
        if(!empty($paidlist))
        {
        foreach ($paidlist as $mprofile)
        {
            $view =  route('memberprofiles.show',$mprofile->id);
           // $view =  $mprofile['id'];
            $edit =  route('memberprofiles.edit',$mprofile->id);
            $print =  route('memberprofiles.print',$mprofile->id);
           // $edit = $mprofile['id'];
            $member_status ="";
            if($mprofile->member_status == "1")
            {
                $member_status = '<span class="chip green lighten-5"><span class="green-text">Active</span></span>';
            }
            if($mprofile->member_status == "2")
            {
                $member_status = '<span class="chip red lighten-5"><span class="red-text">Resigned</span></span>';
            }
            //$nestedData['mp_id'] = $mprofile['id'];
            $nestedData['member_no'] = $mprofile->member_no;
           // $nestedData['company_name'] = $mprofile->company_name;
           $nestedData['company_name'] = DB::table('companies')->where('id' ,$mprofile->company_name)->value('company_name');
           
            $nestedData['member_name'] = $mprofile->member_name;
            $nestedData['ic_no_new'] = $mprofile->ic_no_new;
            $nestedData['race'] = DB::table('races')->where('id' ,$mprofile->race)->value('name');
            if(isset($mprofile->dob) &&($mprofile->dob!="0000-00-00")){
                $dob = $mprofile->dob;
            }
            else{
                $dob = "";

            }
            if(isset($mprofile->doj) &&($mprofile->doj!="0000-00-00")){
                $doj = $mprofile->doj;
            }
            else{
                $doj = "";

            }
            if(isset($mprofile->sex) &&($mprofile->sex!="NULL")){
                $sex = $mprofile->sex;
            }
            else{
                $sex = "";

            }
            $nestedData['sex'] = $sex;
            $nestedData['dob'] = $dob;
            $nestedData['doj'] = $doj;
            $nestedData['member_status'] = $member_status;
            $nestedData['options'] = "<a href='".$edit."'><i class='material-icons' style='color: #00bcd4!important;'>edit</i></a>&nbsp;<a href='".$view."'><i class='material-icons' style='color: #ff6f00!important;'>remove_red_eye</i></a>&nbsp;&nbsp;<a href='".$print."'><i class='material-icons' style='color: #f2000!important;'>print</i></a>";
            $data[] = $nestedData;

        }
    }
    $json_data = array(

        "draw"            => intval($request->input('draw')),  
        "recordsTotal"    => intval($totalData),  
        "recordsFiltered" => intval($totalFiltered), 
        "data"            => $data   
        );
       // dd($json_data);
    echo json_encode($json_data);
    //echo json_encode($json_data);
	}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['race_list'] = Race::where('status','=','1')->get();
        $data['company_list'] = Company::where('status','=','1')->get();
        $data['designation_list'] = DB::table('designation')->where('status','=','1')->get();
        $data['department_list'] = DB::table('department')->where('status','=','1')->get();
        $data['relation_list'] = DB::table('relation')->where('status','=','1')->get();
        return view('memberprofile.memberprofile_add')->with('data',$data);
    }
	public function findMemberNoExists(Request $request)
	{
		$member_no =  $request->input('member_no');
         $id = $request->input('mp_id');
        if(!empty($id))
        { 
            $data_exists = Memberprofile::where([
                  ['member_no','=',$member_no],
                  ['id','!=',$id],
                  //['status','=','1']
                  ])->count();
        }
        else
        {   
            $data_exists = Memberprofile::where([
                ['member_no','=',$member_no]
               // ['status','=','1'],
                ])->count(); 
        } 
        if($data_exists > 0)
        {
              return "false";
        }
        else{
              return "true";
        }
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data = $request->all();
        //return 1;
        $request->validate(
            [
                'member_name' => 'required',
                'ic_no_new' => 'required',
                'race' => 'required',
                'sex' => 'required',
                'company_name' => 'required',
                'member_no' => 'required',
                'employee_no' => 'required'
            ], 
            [
                'member_name.required' => 'please enter member name',
                'ic_no_new.required' => 'please enter ic new no',
                'race.required' => 'please choose race',
                'sex.required' => 'please choose sex',
                'company_name.required' => 'please choose company name',
                'member_no.required' => 'please enter member no',
                'employee_no.required' => 'please enter employee no'
            ]
        );
		$data['dob'] = date("Y-m-d", strtotime($data['dob']));
        $data['doj'] = date("Y-m-d", strtotime($data['doj']));
        $data['promoted_date'] = date("Y-m-d", strtotime($data['promoted_date']));
        $data['already_member'] = $data['memberofunion'];
        $data['meet_date'] = date("Y-m-d", strtotime($data['meet_date']));
        $data['approved_date'] = date("Y-m-d", strtotime($data['approved_date']));
        $data['approved_status'] = $data['approvedrejected'];
        $data['marital_status'] = $data['mstatus'];

        $data['designation'] = $data['designation'];
        $data['department'] = $data['department'];
        
        $emailid = $request->input('email_id');
        $emailid = $emailid=='' ? $request->input('member_no').'@amco.com' : $emailid;

        $data['email_id'] = $emailid;

        $password = bcrypt($request->input('ic_no_new'));

        $saveData = Memberprofile::create($data);
        //dd($saveData);
        
        $userid = DB::table('users')->insertGetId(
            ['name' => $request->input('member_name'), 'email' => $emailid, 'is_admin' =>0, 'password' => $password ]
        );
            
		if($saveData == true)
		{
            $memberid = $saveData->id;

            $check_nominee_auto_id = $request->input('nominee_auto_id');
			if( isset($check_nominee_auto_id)){
				$nominee_count = count($request->input('nominee_auto_id'));
				for($j =0; $j<$nominee_count; $j++){
					$nominee_auto_id = $request->input('nominee_auto_id')[$j];
                    $nominee_name = $request->input('nomineename')[$j];
                    $nominee_address = $request->input('nominee_address')[$j];
                    $nominee_age = $request->input('nominee_age')[$j];
                    $nominee_relationship = $request->input('nominee_relationship')[$j];
                    $nominee_nric = $request->input('nominee_nric')[$j];

                    if($nominee_auto_id==''){
                        $nomineeid = DB::table('member_nominees')->insertGetId(
                            ['member_id' => $memberid, 'name' => $nominee_name, 'home_address' => $nominee_address, 'age' => $nominee_age, 'relationship' => $nominee_relationship, 'nric_no' => $nominee_nric, 'status' =>1 ]
                        );
                    }
                }
            } 
            
            $gaurdname = $request->input('gaurdname');
            $gaurd_address = $request->input('gaurd_address');
            $gaurd_age = $request->input('gaurd_age');
            $gaurd_relationship = $request->input('gaurd_relationship');
            $gaurd_nric = $request->input('gaurd_nric');

            $gid = DB::table('member_guardian')->insertGetId(
                ['member_id' => $memberid, 'name' => $gaurdname, 'home_address' => $gaurd_address, 'age' => $gaurd_age, 'relationship' => $gaurd_relationship, 'nric_no' => $gaurd_nric, 'status' =>1 ]
            );
            
			return  redirect('/memberprofiles')->with('success', 'Member profile inserted successfully!');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Memberprofile  $memberprofile
     * @return \Illuminate\Http\Response
     */
    public function show(Memberprofile $memberprofile)
    {
        return view('memberprofile.memberprofile_view', compact('memberprofile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memberprofile  $memberprofile
     * @return \Illuminate\Http\Response
     */
    public function edit(Memberprofile $memberprofile)
    {
		$race_list = Race::where('status','=','1')->get();
        $company_list = Company::where('status','=','1')->get();
        $designation_list = DB::table('designation')->where('status','=','1')->get();
        $department_list = DB::table('department')->where('status','=','1')->get();
        $relation_list = DB::table('relation')->where('status','=','1')->get();
		return view('memberprofile.memberprofile_edit',compact('memberprofile','race_list','company_list','designation_list','department_list','relation_list'));
        //$data['member_list'] = Memberprofile::where('id',$memberprofile->id)->first();
       // return view('admin.memberprofile_list')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memberprofile  $memberprofile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memberprofile $memberprofile)
    {
        $data = $request->all();
       
        $request->validate(
            [
                'member_name' => 'required',
                'ic_no_new' => 'required',
                'race' => 'required',
                'sex' => 'required',
                'company_name' => 'required',
                'member_no' => 'required'
               
            ], 
            [
                'member_name.required' => 'please enter member name',
                'ic_no_new.required' => 'please enter ic new no',
                'race.required' => 'please choose race',
                'sex.required' => 'please choose sex',
                'company_name.required' => 'please choose company name',
                'member_no.required' => 'please enter member no'                
            ]
        );
        
       // $datedj = str_replace('/', '-', $data['doj']);
        
        if($data['dob'] != null){
            $datedb = str_replace('/', '-', $data['dob']);
            $data['dob'] = date('Y-m-d', strtotime($datedb));
        }
        else{
             $data['dob'] = "0000-00-00";
        }
        if($data['doj'] != null){
            $datedj = str_replace('/', '-', $data['doj']);
            $data['doj'] = date('Y-m-d', strtotime($datedj));
        }
        else{
             $data['doj'] = "0000-00-00";
        }
        if(isset($data['resign_date'])){
        if($data['resign_date'] != null){
            $dateresign_date = str_replace('/', '-', $data['resign_date']);
            $data['resign_date'] = date('Y-m-d', strtotime($dateresign_date));
        }
        else{
             $data['resign_date'] = "0000-00-00";
        }

        $data['promoted_date'] = $data['promoted_date']!= null ?  date("Y-m-d", strtotime($data['promoted_date'])) : '';
        $data['already_member'] = $data['memberofunion'];
        $data['meet_date'] = $data['meet_date']!= null ? date("Y-m-d", strtotime($data['meet_date'])) : '';
        $data['approved_date'] = $data['approved_date']!= null ? date("Y-m-d", strtotime($data['approved_date'])) : '';
        
        $data['approved_status'] = $data['approvedrejected'];
        $data['marital_status'] = $data['mstatus'];

        $data['designation'] = $data['designation'];
        $data['department'] = $data['department'];
    }
       // dd($data['resign_date']);
        //dd($data['doj']);
       // dd($data['doj']);
        //dd(date('Y-m-d', strtotime($datedb)));
		//$data['dob'] = date('Y-m-d', strtotime($datedb));
		//$data['doj'] =date('Y-m-d', strtotime($datedj));
        $updateData = $memberprofile->update($data);
       // dd($data->id);
        $memberid = $request->input('id');
		if($updateData == true)
		{
            $check_nominee_auto_id = $request->input('nominee_auto_id');
			if( isset($check_nominee_auto_id)){
				$nominee_count = count($request->input('nominee_auto_id'));
				for($j =0; $j<$nominee_count; $j++){
					$nominee_auto_id = $request->input('nominee_auto_id')[$j];
                    $nominee_name = $request->input('nomineename')[$j];
                    $nominee_address = $request->input('nominee_address')[$j];
                    $nominee_age = $request->input('nominee_age')[$j];
                    $nominee_relationship = $request->input('nominee_relationship')[$j];
                    $nominee_nric = $request->input('nominee_nric')[$j];

                    if($nominee_auto_id==''){
                        $nomineeid = DB::table('member_nominees')->insertGetId(
                            ['member_id' => $memberid, 'name' => $nominee_name, 'home_address' => $nominee_address, 'age' => $nominee_age, 'relationship' => $nominee_relationship, 'nric_no' => $nominee_nric, 'status' =>1 ]
                        );
                    }else{
                        DB::table('member_nominees')
                        ->where('id', $nominee_auto_id)
                        ->update(['member_id' => $memberid, 'name' => $nominee_name, 'home_address' => $nominee_address, 'age' => $nominee_age, 'relationship' => $nominee_relationship, 'nric_no' => $nominee_nric, 'status' =>1 ]);
                    }
                }
            } 
            
            $gaurd_auto_id = $request->input('gaurd_auto_id');
            $gaurdname = $request->input('gaurdname');
            $gaurd_address = $request->input('gaurd_address');
            $gaurd_age = $request->input('gaurd_age');
            $gaurd_relationship = $request->input('gaurd_relationship');
            $gaurd_nric = $request->input('gaurd_nric');

            if($gaurd_auto_id==''){
                $gid = DB::table('member_guardian')->insertGetId(
                    ['member_id' => $memberid, 'name' => $gaurdname, 'home_address' => $gaurd_address, 'age' => $gaurd_age, 'relationship' => $gaurd_relationship, 'nric_no' => $gaurd_nric, 'status' =>1 ]
                );
            }else{
                DB::table('member_guardian')
                ->where('id', $gaurd_auto_id)
                ->update(['member_id' => $memberid, 'name' => $gaurdname, 'home_address' => $gaurd_address, 'age' => $gaurd_age, 'relationship' => $gaurd_relationship, 'nric_no' => $gaurd_nric, 'status' =>1 ]);
            }
            

			return  redirect('/memberprofiles')->with('success', 'Member profile updated successfully!');
		}
		
       // return redirect()->route('memberprofile.index')->with('success','Product updated successfully');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memberprofile  $memberprofile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memberprofile $memberprofile)
    {
        //
    }

    public function PrintMember(Request $request,$memberid){
       // return $memberid;
        $memberprofile = Memberprofile::find($memberid); 
        return view('memberprofile.memberprofile_print',compact('memberprofile'));
    }
}
