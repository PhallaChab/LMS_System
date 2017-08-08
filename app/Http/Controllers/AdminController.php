<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\User;
use App\Tbl_roles;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function createNewUser()
    {
        //
        $userID = request('userID');
        $name = request('name');
        $email = request('email');
        $position = request('position');
        $department = request('department');
        $role=request('role');
        $password = bcrypt(request('password'));
        $gender = request('gender');
        $totalDate= request('totaldate');
        $manager = request('manager');

        if($userID){
            $queryUpdate = User::where('id',$userID)
            ->update([
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'role_id'=>$role,
                'position'=>$position,
                'department'=>$department,
                'manage_by'=>$manager,
                'gender'=>$gender,
                'total_date'=>$totalDate
            ]);
        }else{
            $query = User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'role_id'=>$role,
                'position'=>$position,
                'department'=>$department,
                'manage_by'=>$manager,
                'gender'=>$gender,
                'total_date'=>$totalDate
            ]);
        }

    }

    public function showmanageUser()
    {
        //
        return view('admin.Manage_user');
    }
    public function addUserForm()
    {
        $users = User::get();
        return view('vendor.newUser')->with(array('users'=>$users));
    }
    public function editUser($id)
    {
        //
        $users = User::get();
        $selectUserID = User::where('id',$id)->get();
        $roles=Tbl_roles::get();
        $oldPass=Auth::user()->password;
        return view('vendor.newUser')->with(array(
                        'getIdUser'=>$id,
                        'selectUserID'=>$selectUserID,
                        'users'=>$users,
                        'roles'=>$roles
                    ));
    }

    public function destroyUser()
    {
        //
        $id = request('user_id');
        $deleteQuery = User::where('id',$id)->delete();
        if($deleteQuery){
            echo 'yes';
        }else{
            echo 'no';
        }
    }

    //==================manage leave request=================
    public function showAllLeave()
    {
        return view('admin.Manage_leave_request');
    }

    public function userProfile(){
        return view('profile');
    }

    //manage role
    public function indexRole(){
        return view('admin.Manage_role');
    }
    public function createRole(){
        $role = request('name');
        $roleid = request('roleID');
        if($roleid){
            $query = Tbl_roles::where('id',$roleid)->update([
                'name'=>$role
            ]);
        }else{
            $query = Tbl_roles::create([
                'name'=>$role
            ]);
        }
        
        if($query){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function editrole($id){
        $query = Tbl_roles::where('id',$id)->get();
        return json_encode($query);
    }
}
