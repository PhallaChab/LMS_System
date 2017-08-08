<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Tbl_roles;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'position',
        'department',
        'gender',
        'manage_by',
        'total_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function children()
    {
        return $this->hasMany('Tbl_Leaves', 'employee_id');
    }

    public static function currentUser($currentUserId){
        return User::where('id',$currentUserId)->get();
    }
    public static function getUser($currentUserId){
        return User::where('role_id','4')
                        ->orwhere('role_id','3')
                        ->where('id','!=',$currentUserId)
                        ->get();
    }
    public static function getManagerName(){
        $array_name = array();
        $user = User::get();
        foreach($user as $u){
            $array_name[$u->id]=$u->name;
        }
        return $array_name;
    }

    public static function getRoleName(){
        $array_role = array();
        $roles = Tbl_roles::get();
        foreach($roles as $role){
            $array_role[$role->id]=$role->name;
        }
        return $array_role;
    }
}
