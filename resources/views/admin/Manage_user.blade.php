@extends('layouts.admin_menu')

@section('content')
<style>
   .glyphicon-plus{
        left: 26px;
        color: #fff;
        top: -2px;
    }
    #addUsers{
        padding-left:30px;
        margin-left: -13px;
        margin-bottom: 10px;
    } 
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Manage User
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Manage User
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <i class="glyphicon glyphicon-plus"></i>
            <button type="button" class="btn btn-info" id="addUsers">
                Add User</button>
                <div class="table-responsive">
                <table class="table table-striped table-bordered" id="">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th>User Name</th>
                            <th>Manage By</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Gender</th>
                            <th>Total Date</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $x = 1;?>
                    @foreach(App\User::all() as $user)
                        <?php 
                            $managerName = $user->getManagerName();
                            $roleName = $user->getRoleName();
                        ?>
                        <tr>
                            <td>{{ $x }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $managerName[$user->manage_by] }} </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->position }}</td>
                            <td>{{ $user->department }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->total_date }} days/y</td>
                            <td>{{ $roleName[$user->role_id] }}</td>
                            <td>
                                <a href="#" class="editUser label label-info" id="edit_{{$user->id}}" style="font-size: 12px">
                                    <span class="glyphicon glyphicon-edit"></span>Edit
                                </a>&nbsp; 
                                <a href="#" class="deleteUser label label-danger" id="delete_{{$user->id}}" style="font-size: 12px">
                                    <span class="glyphicon glyphicon-trash"></span>Delete
                                </a>
                            </td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- add new users -->
<div class="modal fade" id="addNewUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add new User</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('jquery')
    <script>
        $(function () {
            //submit new user
            $(document).on('submit', "#addUsersForms",function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "/createNewUser",
                    data: formData,
                    success: function (response) {
                        if(response != 'no'){
                            swal({
                                title:"New user created!",
                                text:"New user created!",
                                type:"success",  
                                timer: 1000,   
                                showConfirmButton: false
                            });
                        }
                        $('#addNewUsers').modal('toggle');
                       window.setTimeout(function(){ document.location.reload(true); }, 1000);
                    },
                    error: function () {
                        alert('SYSTEM ERROR,TRY LATER AGAIN');
                    }
                });
            });
            //show model new users
            $(document).on('click', "#addUsers",function () {
                var url = "/addUser";
                $('.modal-body').load(url,function(result){
                    $('#addNewUsers').modal({show:true});
                });
            });
            //edit user 
            $(document).on('click', ".editUser",function () {
                var get_Id=$(this).attr('id');
                var id=get_Id.substr(5,get_Id.length);
                var url = "/editUser/"+id;
                $('.modal-body').load(url,function(result){
                    $('#addNewUsers').modal({show:true});
                });
            });
            //delete user
            $(document).on('click','.deleteUser',function(){
                var get_id = $(this).attr('id');
                var id = get_id.substr(7,get_id.length);
                if(confirm("Are you sure want to delete?")==true){
                    $.ajax({
                        type: "get",
                        url: "/deleteUser",
                        data: {user_id:id},
                        success: function (response) {
                            // alert(response);
                            if(response == 'yes'){
                                swal({
                                    title:"Delete data Success",
                                    text:"This update ready!",
                                    type:"success",  
                                    timer: 1000,   
                                    showConfirmButton: false
                                });
                                window.setTimeout(function(){ document.location.reload(true); }, 1000);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection

