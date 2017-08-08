<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use App\User;

class ChangepasswordController extends Controller
{
    //
    public function index(){
    	$currentUser = Auth::user();
    	return view('vendor.changePassword')->with('currentUser',$currentUser);
    }
    public function updatePassword(){
    	$userID = Auth::user()->id;
        $userpass = Auth::user()->password;
        $username = request('username');
        $email = request('useremail');
        $oldPass = request('oldpassword');
        $newpass = bcrypt(request('newpassword'));

        if (Hash::check($oldPass, $userpass))
        {
            $updatPass = User::where('id',$userID)
                ->update([
                    'password' => $newpass,
                    'name' => $username,
                    'email'=> $email
                ]);
            if($updatPass){
                echo "yes";
            }else{
                echo "no";
            }
        }else{
            echo "nono";
        }  

    }
}
