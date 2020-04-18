<?php

namespace App\Http\Controllers;

use App\Model\Memberprofile;
use Illuminate\Http\Request;
use DB;
class ResignmemberController extends Controller
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
	public function resignmember()
	{
		return view('resignmember.list');
	}
	public function get_resignmember_list(Request $request)
	{
		$resign_memberno = $_POST['resign_memberno'];
		$columns = array( 
            0 => 'member_name',
			1 => 'member_no',
            2 => 'ic_no_new',
            3 => 'member_status',
            4 => 'options'
        );
		
		$query_pt = DB::table('memberprofiles');
		$query_pt->select('memberprofiles.*');
		if($resign_memberno != "")
		{
			$query_pt->where('member_no', '=', $resign_memberno);
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
				if($resign_memberno != "")
				{
					$query_fetch->where('member_no', '=', $resign_memberno);
				}
				$query_fetch->orderBy($order,$dir);
				$resignmemberlist = $query_fetch->get()->toArray();
                
            }else{
				$query_fetch = DB::table('memberprofiles');
				$query_fetch->select('memberprofiles.*');
				if($resign_memberno != "")
				{
					$query_fetch->where('member_no', '=', $resign_memberno);
				}
				$query_fetch->offset($start);
				$query_fetch->limit($limit);
				$query_fetch->orderBy($order,$dir);
				$resignmemberlist = $query_fetch->get()->toArray();
            }
        }
		else {
			$search = $request->input('search.value'); 
			if( $limit == -1){
					$query_fetch = DB::table('memberprofiles');
					$query_fetch->select('memberprofiles.*');
					if($resign_memberno != "")
					{
						$query_fetch->where('member_no', '=', $resign_memberno);
					}
					$query_fetch->orWhere('member_no', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('ic_no_new', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('member_status', 'LIKE',"%{$search}%");
					$query_fetch->orderBy($order,$dir);
					$resignmemberlist = $query_fetch->get()->toArray();
			}else{
					$query_fetch = DB::table('memberprofiles');
					$query_fetch->select('memberprofiles.*');
					if($resign_memberno != "")
					{
						$query_fetch->where('member_no', '=', $resign_memberno);
					}
					$query_fetch->orWhere('member_no', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('member_name', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('ic_no_new', 'LIKE',"%{$search}%");
					$query_fetch->orWhere('member_status', 'LIKE',"%{$search}%");
					$query_fetch->offset($start);
					$query_fetch->limit($limit);
					$query_fetch->orderBy($order,$dir);
					$resignmemberlist = $query_fetch->get()->toArray();
			}
			
			$query_pt = DB::table('memberprofiles');
			$query_pt->select('memberprofiles.*');
			if($resign_memberno != "")
			{
				$query_fetch->where('member_no', '=', $resign_memberno);
			}
			$query_pt->orWhere('member_no', 'LIKE',"%{$search}%");
			$query_pt->orWhere('member_name', 'LIKE',"%{$search}%");
			$query_pt->orWhere('ic_no_new', 'LIKE',"%{$search}%");
			$query_pt->orWhere('member_status', 'LIKE',"%{$search}%");
			$totalFiltered = $query_pt->get()->count();
		 
        }
		//dd($paidlist);
		//exit;
		$data = array();
        if(!empty($resignmemberlist))
        {
            foreach ($resignmemberlist as $resignmember)
            {
				$member_status ="";
				$resignstatus ="";
				$view = url("/resignmember_view/{$resignmember->id}");
				if($resignmember->member_status == "1")
				{
					$member_status = '<span class="chip green lighten-5"><span class="green-text">Active</span></span>';
					$resignstatus = "<a data-target='modal_resignmember' class='btn modal-trigger waves-effect waves-light  btn gradient-45deg-red-pink box-shadow-none border-round mr-1 mb-1' onclick='resignMemberStatusUpdate($resignmember->id);'>Resign</a>&nbsp;";
				}
				if($resignmember->member_status == "2")
				{
					$member_status = '<span class="chip red lighten-5"><span class="red-text">Resigned</span></span>';
					$resignstatus = "<a class='waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1'>Resigned</a>";
				}
				$nestedData['member_name'] = '<p style="text-align:left">'.$resignmember->member_name.'</p>';
				$nestedData['member_no'] = '<p style="text-align:center">'.$resignmember->member_no.'</p>';
                $nestedData['ic_no_new'] = '<p style="text-align:center">'.$resignmember->ic_no_new.'</p>';
                $nestedData['member_status'] = '<p style="text-align:center">'.$member_status.'</p>';
                $nestedData['options'] = "<p style='text-align:center'>".$resignstatus."<a class='waves-effect waves-light  btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1' href='".$view."'>View</a></p>";
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
	public function update_memberresignstatus(Request $request)
	{
		$id = $_POST['resign_id'];
		$resign_date = date("Y-m-d", strtotime($_POST['resign_date']));
		$resign_remark = $_POST['resign_remark'];
		$query_fetch = DB::table('memberprofiles')->where("id","=",$id)->update(array("member_status"=>2, "resign_date"=>$resign_date, "resign_remark"=>$resign_remark));
		return redirect("resignmember");
	}
	public function update_memberactivestatus($id)
	{
		$query_fetch = DB::table('memberprofiles')->where("id","=",$id)->update(array("member_status"=>1));
	}
	
	public function resignmember_view($id)
	{
		$memberprofile = Memberprofile::where('id','=',$id)->first();
		return view('resignmember.view', compact('memberprofile'));
	}
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
