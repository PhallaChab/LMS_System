@extends('layouts.admin_menu')

@section('content')
<style>
   .glyphicon-plus{
        left: 12px;
        color: #fff;
        top: -2px;
    }
    #addroles{
        padding-left:20px;
        margin-left: -13px;
        margin-bottom: 10px;
    }
</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Manage Role
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="glyphicon glyphicon-stats"></i> Manage Role
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="submitRole">
                    {{ csrf_field() }}
                    <input type="hidden" name="roleID" value="" id="roleID">
                    <div class="col-md-5 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <label for="name">Role</label>
                                <input type="text" id="name" class="form-control" name="name" value="" required>
                            </div>
                            <div class="col-md-12 col-xs-12" style="margin-top: 10px;margin-bottom: 10px">
                                <button type="submit" class="btn btn-info">Submit</button>
                                <button type="reset" class="btn btn-default" data-dismiss="modal">Cencel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;?>
                            @foreach(App\Tbl_roles::all() as $role)
                                <tr style="text-align: center;">
                                    <td>{{ $x }}</td>
                                    <td>{{ $role->name }}</td></td>
                                    <td>
                                        <a href="#" class="editrole label label-info" id="edit_{{$role->id}}" style="font-size: 12px"><span class="glyphicon glyphicon-edit"></span>Edit</a>
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
@endsection

@section('jquery')
    <script>
        $(function(){
            $(document).on('submit', "#submitRole",function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "/createRole",
                    data: formData,
                    success: function (response) {
                        if(response == 'yes'){
                            swal({
                                title:"Role created Successfull!",
                                text:"Successfull sumbit!",
                                type:"success",  
                                timer: 1000,   
                                showConfirmButton: false
                            });
                            window.setTimeout(function(){ document.location.reload(true); }, 1000);
                        }
                        
                    },
                    error: function () {
                        alert('SYSTEM ERROR, TRY LATER AGAIN');
                    }
                });
            });
            //edit role 
            $(document).on('click', ".editrole",function () {
                var get_Id=$(this).attr('id');
                var id=get_Id.substr(5,get_Id.length);
                var url = '/editrole/'+id;
                $.get(url,function(data){
                    var json = JSON.parse(data);
                    $('#roleID').val(id);
                    $('#name').val(json[0].name);
                });
            });
        });
    </script>
@endsection

