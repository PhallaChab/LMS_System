<?php 
    $array_gender=array("Male"=>"Male","Female"=>"Female");
    $array_role=array("1"=>"admin","2"=>"hr","3"=>"supervisor","4"=>'employee');
?>
<style>
    .alert { margin:0px; padding:15px 15px 0px;}
</style>

<div class="alert alert-info"><h4 align="center">Enter User info:</h4></div>
<div class="panel panel-default" style="border:none; padding:0px 0px;">
    <div class="panel-body" >
        <form class="form-horizontal" id="addUsersForms" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="userID" name="userID" value="{{ isset($getIdUser)?$getIdUser:''}}">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ isset($selectUserID[0])?$selectUserID[0]->name:''}}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ isset($selectUserID[0])?$selectUserID[0]->email:''}}" required>
                    <label for="email"></label>
                </div>
            </div>
            <div class="form-group">
                <label for="position" class="col-md-4 control-label" >Position</label>
                <div class="col-md-6">
                    <input required type="text" class="form-control" name="position" value="{{ isset($selectUserID[0])?$selectUserID[0]->position:''}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Department</label>
                <div class="col-md-6">
                    <input type="text" name="department" class="form-control" value="{{ isset($selectUserID[0])?$selectUserID[0]->department:''}}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Gender</label>
                <div class="col-md-6">
                @foreach($array_gender as $k => $v)
                    <input type="radio" name="gender" required value="{{ $k }}" @if(isset($selectUserID[0]->gender)==$k) checked @endif> {{ $v }} 
                @endforeach
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Manage By</label>
                <div class="col-md-6">
                    <select name="manager" class="form-control" required>
                        <option value="" style="display: none">--Select--</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                            @if(isset($selectUserID[0]))
                                @if($selectUserID[0]->manage_by==$user->id)
                                    selected
                                @endif
                            @endif
                            >
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Total Date Leave</label>
                <div class="col-md-6">
                    <input type="number" name="totaldate" class="form-control" value="{{ isset($selectUserID[0])?$selectUserID[0]->total_date:''}}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Select Role</label>
                <div class="col-md-6">
                    <select name="role" class="form-control" required>
                        <option value="">--Select--</option>
                        <?php foreach(App\Tbl_roles::all() as $role){?>
                            <option value="{{ $role->id }}" 
                            <?php if(isset($selectUserID[0])){ if($selectUserID[0]->role_id==$role->id){ echo 'selected'; }}?> 
                            >
                                {{ $role->name }}
                            </option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" value="{{ isset($selectUserID[0])?$selectUserID[0]->password:''}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
