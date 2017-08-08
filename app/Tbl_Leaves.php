<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tbl_Leaves extends Model
{
    //
    protected $table = 'tbl_leaves';
    
    protected $fillable = [
		'transaction_code',
        'employee_id',
        'supervisor_id',
        'start_date',
        'end_date',
        'reason',
        'status'
	];
    public static function parent()
    {
        return $this->belongsTo('User', 'id');
    }
    public function getUserName(){
        $array_user = array();
        $user = User::all();
        foreach($user as $users){
            $array_user['name'][$users->id]=$users->name;
            $array_user['position'][$users->id]=$users->position;
            $array_user['dept'][$users->id]=$users->department;
        }
        return $array_user;
    }
}
