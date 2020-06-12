<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Company;
use DB;
use Illuminate\Support\Facades\Crypt;
class MasterController extends Controller
{
    public function companylist()
    {
        return view('masters.company.list');
    }
    public function get_company_list(Request $request)
    {
        $columns = array( 

            0 => 'company_name', 
            1 => 'id',
        );
        $totalData = DB::table('companies')->select('id','company_name')
                    ->count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');    
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {            
            if( $limit == -1){
                
                $company = DB::table('companies')->select('id','company_name')
                ->orderBy($order,$dir)
                ->get()->toArray();
            }else{
                $company =  DB::table('companies')->select('id','company_name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get()->toArray();
            }
        }
        else {
        $search = $request->input('search.value'); 
        if( $limit == -1){
            $company =DB::table('companies')->select('id','company_name')
                    ->where(function($query) use ($search){
                        $query->orWhere('company_name', 'LIKE',"%{$search}%");
                    })
                    ->orderBy($order,$dir)
                    ->get()->toArray();
        }else{
            $company = DB::table('companies')->select('id','company_name')
                        ->where(function($query) use ($search){
                            $query->orWhere('company_name', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get()->toArray();
        }
        $totalFiltered = DB::table('companies')->select('id','company_name')
                    ->orWhere('company_name', 'LIKE',"%{$search}%")
                    ->count();
        }
        $table ="company";
    //  $data = $this->CommonAjaxReturn($hotels, 0, 'hotels.hoteldestroy', 0,$table); 
    //    $data = $this->CommonAjaxReturn($hotels, 2, '', 0,$table,'master.edithotel'); 
      //  $data = $this->CommonAjaxReturn($hotels, 2, '', 1,$table,'master.edithotel'); 

      $data = array();
      if(!empty($company))
      {
          foreach ($company as $company)
          {
              $companycount = DB::table('companies')->select('id','company_name')
                    ->count();
              
              if($companycount>=1){
                 
                  $nestedData['id'] = $company->id;
                  $nestedData['company_name'] = $company->company_name;
                  $enc_id = Crypt::encrypt($company->id);
                  $edit = route('editcompany',$enc_id);
                  $delete = route('companydestroy',$enc_id);
                  $actions = '';
                  $actions .="<p><a href='".$edit."' style='float:left'><i class='material-icons' style='color: #00bcd4!important;'>edit</i></a>";
                  $actions .="<a style='float:left'><form style='display:inline-block;' action='$delete' method='POST'>".method_field('DELETE').csrf_field();
                  $actions .="&nbsp;&nbsp;<button  type='submit' class='btn-sm ' onclick='return ConfirmDeletion()' style='background: none;border: none;'><i style='color:red' class='material-icons'>
                  delete
                  </i></button> </form></p>";
                  $nestedData['options'] = $actions;
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
}


	public function companysave()
	{
		return view('masters.company.new');

    } 
    public function relationshipNew()
	{
		return view('masters.relationship.new');

	} 
 public function companyStore(Request $request)
 {
     $request->validate([
        'company_name'=>'required',
    ],
    [
        'company_name.required'=>'Please enter Company name',
    ]);
    $data = $request->all();  

    $saveCompany = Company::create($data);
       
        if($saveCompany == true)
        {
            return  redirect('companylist')->with('message','Company Added Succesfully');
        }
   }
   public function editcompanyDetail($companyid)
   {
       $id = Crypt::decrypt($companyid);
       $data['company_view'] = Company::where('id','=',$id)->get();
       return view('masters.company.edit')->with('data',$data);
   }
   public function editrelationshipDetail($relationid)
   {
       $id = Crypt::decrypt($relationid);
       $data['relation_view'] = DB::table('relation')->where('status','=',1)->where('id','=',$id)->first();
       return view('masters.relationship.edit')->with('data',$data);
   }
   public function UpdateCompanyDetail(request $request)
   {
      // return 1;
        $request->validate([
            'company_name'=>'required',
        ],
        [
            'company_name.required'=>'Please enter Company name',
        ]);
        $data = $request->all();
        $data['id'] = $request->companyid;
        $Company = Company::find($data['id'])->update($data);
        return  redirect('companylist')->with('message','Company Updated Succesfully');
   }
   public function companyDestroy($companyid)
   {
       $id = Crypt::decrypt($companyid);
        $Company = new Company();
        $Company->where('id','=',$id)->delete();
        return  redirect('companylist')->with('message','Company Deleted Succesfully');
   }
    public function relationshiplist()
    {
      $data['relationship_view'] = DB::table('relation')->where('status','=',1)->get();
      return view('masters.relationship.list')->with('data',$data);
    }
    public function UpdateRelationDetail(request $request)
    {
        //return 1;
         $request->validate([
             'relation_name'=>'required',
         ],
         [
             'relation_name.required'=>'Please enter relation name',
         ]);
         $data = $request->all();
         $data['id'] = $request->autoid;
         $relation = DB::table('relation')->where('id','=',$data['id'])->update(['relation_name' => $data['relation_name']]);
         return  redirect('relationship')->with('message','Relation Updated Succesfully');
    }
    public function RelationshipDestroy($relationid)
   {
        $id = Crypt::decrypt($relationid);
        DB::table('relation')->where('id','=',$id)->delete();
        return  redirect('relationship')->with('message','Relationship Deleted Succesfully');
   }
   public function relationshipStore(Request $request)
   {
       $request->validate([
          'relationship_name'=>'required',
      ],
      [
          'relationship_name.required'=>'Please enter Relationship name',
      ]);
      $data = $request->all();  
  
     // $saveCompany = Company::create($data);

      $saveRelation =  DB::table('relation')->insert(
         ['relation_name' => $data['relationship_name'], 'status' => 1]
        );
         
          if($saveRelation == true)
          {
              return  redirect('relationship')->with('message','Relationship Added Succesfully');
          }
     }

    public function designationlist()
    {
      $data['designation_view'] = DB::table('designation')->where('status','=',1)->get();
      return view('masters.designation.list')->with('data',$data);
    }
    public function designationNew()
	{
		return view('masters.designation.new');

    } 
    
    public function DesignationStore(Request $request)
    {
        $request->validate([
           'designation_name'=>'required',
       ],
       [
           'designation_name.required'=>'Please enter Designation name',
       ]);
       $data = $request->all();  
   
      // $saveCompany = Company::create($data);
 
       $saveRelation =  DB::table('designation')->insert(
          ['designation' => $data['designation_name'], 'status' => 1]
         );
          
           if($saveRelation == true)
           {
               return  redirect('designation')->with('message','Designation Added Succesfully');
           }
      }
      public function editdesignationDetail($designationid)
      {
          $id = Crypt::decrypt($designationid);
          $data['designation_view'] = DB::table('designation')->where('status','=',1)->where('id','=',$id)->first();
          return view('masters.designation.edit')->with('data',$data);
      }
      public function UpdateDesignationDetail(request $request)
      {
            //return 1;
            $request->validate([
                'designation_name'=>'required',
            ],
            [
                'designation_name.required'=>'Please enter Designation name',
            ]);
            $data = $request->all();
            $data['id'] = $request->autoid;
            $relation = DB::table('designation')->where('id','=',$data['id'])->update(['designation' => $data['designation_name']]);
            return  redirect('designation')->with('message','Designation Updated Succesfully');
      }
        public function DesignationDestroy($designationid)
        {
                $id = Crypt::decrypt($designationid);
                DB::table('designation')->where('id','=',$id)->delete();
                return  redirect('designation')->with('message','Designation Deleted Succesfully');
        }
        public function departmentlist()
        {
          $data['department_view'] = DB::table('department')->where('status','=',1)->get();
          return view('masters.department.list')->with('data',$data);
        }
        public function departmentNew()
        {
            return view('masters.department.new');
    
        } 
        
        public function DepartmentStore(Request $request)
        {
            $request->validate([
               'department_name'=>'required',
           ],
           [
               'department_name.required'=>'Please enter department name',
           ]);
           $data = $request->all();  
       
          // $saveCompany = Company::create($data);
     
           $saveRelation =  DB::table('department')->insert(
              ['department' => $data['department_name'], 'status' => 1]
             );
              
               if($saveRelation == true)
               {
                   return  redirect('department')->with('message','Department Added Succesfully');
               }
          }
          public function editdepartmentDetail($designationid)
          {
              $id = Crypt::decrypt($designationid);
              $data['department_view'] = DB::table('department')->where('status','=',1)->where('id','=',$id)->first();
              return view('masters.department.edit')->with('data',$data);
          }
          public function UpdateDepartmentDetail(request $request)
          {
                //return 1;
                $request->validate([
                    'department_name'=>'required',
                ],
                [
                    'department_name.required'=>'Please enter Department name',
                ]);
                $data = $request->all();
                $data['id'] = $request->autoid;
                $des = DB::table('department')->where('id','=',$data['id'])->update(['department' => $data['department_name']]);
                return  redirect('department')->with('message','Department Updated Succesfully');
          }
            public function DepartmentDestroy($designationid)
            {
                    $id = Crypt::decrypt($designationid);
                    DB::table('department')->where('id','=',$id)->delete();
                    return  redirect('department')->with('message','Department Deleted Succesfully');
            }
            public function racelist()
            {
              $data['race_view'] = DB::table('races')->where('status','=',1)->get();
              return view('masters.race.list')->with('data',$data);
            }
            public function raceNew()
            {
                return view('masters.race.new');
        
            } 
            
            public function RaceStore(Request $request)
            {
                $request->validate([
                   'race_name'=>'required',
               ],
               [
                   'race_name.required'=>'Please enter race name',
               ]);
               $data = $request->all();  
           
               // $saveCompany = Company::create($data);
         
                $saveRelation =  DB::table('races')->insert(
                  ['name' => $data['race_name'], 'status' => 1]
                 );
                  
                if($saveRelation == true)
                {
                    return  redirect('race')->with('message','Race Added Succesfully');
                }
            }
            public function editraceDetail($raceid)
            {
                $id = Crypt::decrypt($raceid);
                $data['race_view'] = DB::table('races')->where('status','=',1)->where('id','=',$id)->first();
                return view('masters.race.edit')->with('data',$data);
            }
            public function UpdateRaceDetail(request $request)
            {
                //return 1;
                $request->validate([
                    'race_name'=>'required',
                ],
                [
                    'race_name.required'=>'Please enter Race name',
                ]);
                $data = $request->all();
                $data['id'] = $request->autoid;
                $des = DB::table('races')->where('id','=',$data['id'])->update(['name' => $data['race_name']]);
                return  redirect('race')->with('message','Race Updated Succesfully');
            }
            public function RaceDestroy($raceid)
            {
                $id = Crypt::decrypt($raceid);
                DB::table('races')->where('id','=',$id)->delete();
                return  redirect('race')->with('message','Race Deleted Succesfully');
            }

            public function costcenterlist()
            {
              $data['cost_view'] = DB::table('company_branches')->where('status','=',1)->get();
              return view('masters.costcenter.list')->with('data',$data);
            }
            public function costcenterNew()
            {
                return view('masters.costcenter.new');
        
            } 
            
            public function CostcenterStore(Request $request)
            {
                $request->validate([
                   'cost_center'=>'required',
               ],
               [
                   'cost_center.required'=>'Please enter cost center',
               ]);
               $data = $request->all();  
           
               // $saveCompany = Company::create($data);
         
                $saveRelation =  DB::table('company_branches')->insert(
                  ['branch_name' => $data['cost_center'], 'company_id' => 1, 'status' => 1]
                 );
                  
                if($saveRelation == true)
                {
                    return  redirect('costcenter')->with('message','Cost Center Added Succesfully');
                }
            }
            public function editcostcenterDetail($raceid)
            {
                $id = Crypt::decrypt($raceid);
                $data['cost_view'] = DB::table('company_branches')->where('status','=',1)->where('id','=',$id)->first();
                return view('masters.costcenter.edit')->with('data',$data);
            }
            public function UpdateCostcenterDetail(request $request)
            {
                //return 1;
                $request->validate([
                    'cost_center'=>'required',
                ],
                [
                    'cost_center.required'=>'Please enter cost_center name',
                ]);
                $data = $request->all();
                $data['id'] = $request->autoid;
                $des = DB::table('company_branches')->where('id','=',$data['id'])->update(['branch_name' => $data['cost_center']]);
                return  redirect('costcenter')->with('message','Cost center Updated Succesfully');
            }
            public function CostcenterDestroy($raceid)
            {
                $id = Crypt::decrypt($raceid);
                DB::table('company_branches')->where('id','=',$id)->delete();
                return  redirect('costcenter')->with('message','Cost Center Deleted Succesfully');
            }
}
