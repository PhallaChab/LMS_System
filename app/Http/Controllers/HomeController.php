<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tbl_Leaves;
use App\Tbl_management;

use App\User;
use Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }
    public function applyLeave(){
        $currentUserId = Auth::user()->id;
        $currentUser = User::currentUser($currentUserId);
        $users = User::getUser($currentUserId);
        $array_name = array();
        $user = User::get();
        foreach($user as $u){
            $array_name[$u->id]=$u->name;
        }
        return view('leaveform.leaveform')->with(array('currentUser'=>$currentUser,'users'=>$users,'array_name'=>$array_name));
    }
    public function showLeaverequest(){
        $totaldate = Auth::user()->total_date;
        return view('leaveform.leaveRequestEachUser')->with('total_date',$totaldate);
    }
    public function createLeave(){
        $currentUserId = Auth::user()->id;
        $supervisor = request('suppervisor');
        $dateEnd = Carbon\Carbon::parse(request('enddate'));
        $dateStart = Carbon\Carbon::parse(request('startdate'));
        $reason = request('reason');

        $getLeave=Tbl_Leaves::whereYear('created_at', '=', date('Y'))
                        ->whereMonth('created_at', '=', date('n'))
                        ->get();
        $getCountLeave=$getLeave->count()+1;
        if($getCountLeave>=100){
            $newLeaveCode=$getCountLeave;
        }else if($getCountLeave>=10){
            $newLeaveCode='0'.$getCountLeave;
        }else if($getCountLeave<10 && $getCountLeave>0){
            $newLeaveCode='00'.$getCountLeave;
        }else{
            $newLeaveCode='001';
        }

        $query = Tbl_Leaves::create([
            'transaction_code'=>$newLeaveCode,
            'employee_id'=>$currentUserId,
            'supervisor_id'=>$supervisor,
            'start_date'=>$dateStart,
            'end_date'=>$dateEnd,
            'reason'=>$reason,
            'status'=>0
        ]);
        if($query){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function paddingRequest(){
        $totaldate = Auth::user()->total_date;
        $currentUserId = Auth::user()->id;
        return view('paddingRequest')->with(array('total_date'=>$totaldate,'currentUserId'=>$currentUserId));
    }
    public function approveRequet($id){
        $query = Tbl_Leaves::where('id',$id)->update(['status'=>1]);
        if($query){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function rejectRequet($id){
        $query = Tbl_Leaves::where('id',$id)->update(['status'=>2]);
        if($query){
            echo 'yes';
        }else{
            echo 'no';
        }
    }

    public function editleave($id){
        $currentUserId = Auth::user()->id;
        $currentUser = User::currentUser($currentUserId);
        $users = User::getUser($currentUserId);
        $getLeave = Tbl_Leaves::where('id',$id)->get();
        $array_name = array();
        $user = User::get();
        foreach($user as $u){
            $array_name[$u->id]=$u->name;
        }
        return view('vendor.editLeaveform')->with(array(
                                            'currentUser'=>$currentUser,
                                            'users'=>$users,
                                            'getLeave'=>$getLeave,
                                            'array_name'=>$array_name));
    }
    public function updateLeave(){
        $leaveID = request('leaveID');
        $supervisor = request('suppervisor');
        $dateEnd = Carbon\Carbon::parse(request('enddate'));
        $dateStart = Carbon\Carbon::parse(request('startdate'));
        $reason = request('reason');

        $query = Tbl_Leaves::where('id',$leaveID)->update([
            'start_date'=>$dateStart,
            'end_date'=>$dateEnd,
            'reason'=>$reason
        ]);
        if($query){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function deleteleave(){
        $leaveID = request('leave_id');
        $query = Tbl_Leaves::where('id',$leaveID)->delete();
        if($query){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
}
