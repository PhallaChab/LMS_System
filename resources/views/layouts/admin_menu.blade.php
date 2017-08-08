<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Phalla CHAB">

    <title>HR Admin</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}" >
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css" >
    <link rel="stylesheet" href="{{asset('css/sb-admin.css')}}" type="text/css" >
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.css')}}" >
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}" >
    <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.css') }}">
    
    <style type="text/css" media="screen">
        .glyphicon-search{
            left: -20px;
            top: 4px;
        }
        .table.dataTable thead .sorting:after{
            content:none;
        }
        table.dataTable thead .sorting_asc:after{
            content:none;
        }
        tr th{
            text-align: center;
        }
        table.dataTable thead .sorting{
            background-image: none;
        }
        table.dataTable thead .sorting_asc{
            background-image: none;
        }
        div.dataTables_info{
            display: none;
        }
    </style>
</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">LMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                @if (!Auth::guest()) 
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/imgs/emptyimg.jpg" style="width: 30px;margin-right: 10px;">{{ Auth::user()->name }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/profile"><i class="fa fa-fw fa-user" style="margin-right: 5px;"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#" id="changePass"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                               </form>
                        </li>
                    </ul>
                </li>
                @endif 
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="top">

                <ul class="nav navbar-nav side-nav">
                    <?php
                        function active_menu($url){
                            $current_url     = Route::getFacadeRoot()->current()->uri();
                            if($current_url == $url){
                                return 'active';
                            }else{
                                return '';
                            }    
                        }
                    ?>
                    <li class='<?=active_menu('admin')?>'>
                        <a href="/admin">
                        <i class="fa fa-fw fa-dashboard"></i>Dashboard</a>
                    </li>
                    @if (Auth::guest())
                        
                    @else
                        @if(Auth::user()->role_id=='1')
                        <li class='<?=active_menu('admin/managerole')?>'>
                            <a href="/admin/managerole">
                            <i class="glyphicon glyphicon-briefcase"></i>Manage Roles</a>
                        </li>
                        <li class='<?=active_menu('admin/manageuser')?>'>
                            <a href="/admin/manageuser">
                            <i class="glyphicon glyphicon-user"></i>Manage User</a>
                        </li>
                        <li class='<?=active_menu('admin/leaverequest')?>'>
                            <a href="/admin/leaverequest">
                            <i class="fa fa-fw fa-table"></i>All Leave Requests</a>
                        </li>
                        @endif
                        @if(Auth::user()->role_id=='2' or Auth::user()->role_id=='3')
                        <li class='<?=active_menu('admin/leaverequest')?>'>
                            <a href="/admin/leaverequest">
                            <i class="fa fa-fw fa-table"></i>All Leave Requests</a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->role_id=='3' or Auth::user()->role_id=='4' or Auth::user()->role_id=='2')
                            <li class="<?=active_menu('paddingRequest')?>">
                            <a href="/paddingRequest"><span class="glyphicon glyphicon-th-list"></span>Pending Request</a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id!='3')
                        <li class="<?=active_menu('applyLeave')?>">
                            <a href="/applyLeave"><span class="glyphicon glyphicon-tasks"></span>Apply Leave</a>
                        </li>
                        <li class="<?=active_menu('leaveRequest')?>">
                            <a href="/leaveRequest"><span class="glyphicon glyphicon-stats"></span> Take Leave Request</a>
                        </li>
                        @endif
                    @endif
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
    </div>

    <div class="modal fade" id="modelChangePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-12 col-xs-12">
                        <div class="alert alert-info" style="margin:0px; padding:15px 15px 0px;">
                            <h4 align="center">Change Profile</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body" style="padding-top:0px;">

                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('js/sweetalert-dev.js')}}"></script>
    <script src ="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
    @yield('jquery');
    <script>
        $(function(){

            $(document).on('click', "#changePass",function () {
                var url = "/changePassword";
                $('.modal-body').load(url,function(result){
                    $('#modelChangePassword').modal({show:true});
                });
            });
        });
        $(document).ready(function(){
            //datatable
            $('#mainMenuTable').DataTable();
            $('#mainMenuTable_filter > label').append('<span class="glyphicon glyphicon-search"></span>');

            $('#listPostTable').DataTable();
            $('#listPostTable_filter > label').append('<span class="glyphicon glyphicon-search"></span>');
            $('#mainMenuTable1').DataTable();
            $('#mainMenuTable1_filter > label').append('<span class="glyphicon glyphicon-search"></span>');
        });
    </script>
</body>

</html>