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
}
