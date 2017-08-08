@extends('layouts.admin_menu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> My Profile</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="well form-horizontal" action="" method="post" id="changeImgProfile">
                <fieldset>
                    <legend>View Profile</legend>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                            <p><img src="/imgs/emptyimg.jpg" alt="">
                            <div style="height: 5px;"></div>
                            <!-- <input type="file" name="userfile" id="userfile" required/>
                            </p>
                            <input type="hidden" name="old_img" value="">
                            <button type="submit" id="btn_save" name="save" class="btn btn-info">Update</button> -->
                    </div>
                    <div class="col-lg-8 col-md-8 col-xs-12">
                        <div class="form-group">
                            <p>
                                <span class="glyphicon glyphicon-user"></span> Full Name : <label class="control-label"> {{ Auth::User()->name }}</label>
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-envelope"></span> Email : <label class="control-label"> {{ Auth::User()->email }}</label>
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-oil"></span> Department : <label class="control-label">{{ Auth::User()->department }}</label>
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-briefcase"></span> Position : <label class="control-label">{{ Auth::User()->position }}</label>
                            </p>
                            <p>
                               <span class="glyphicon glyphicon-user"></span> Gender : <label class="control-label">{{ Auth::User()->gender }}</label>
                            </p>
                            <p>
                                <?php $roleName = Auth::User()->getRoleName(); ?>
                               <span class="glyphicon glyphicon-briefcase"></span> Role : <label class="control-label"> {{ $roleName[Auth::User()->role_id] }}</label>
                            </p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection