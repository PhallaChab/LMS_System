@extends('layouts.admin_menu')

@section('content')
<style>
   .glyphicon-plus{
        left: 12px;
        color: #fff;
        top: -2px;
    }
    #addleaves{
        padding-left:20px;
        margin-left: -13px;
        margin-bottom: 10px;
    } 
</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Manage Leave Request
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="glyphicon glyphicon-stats"></i> Manage Leave Request
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="mainMenuTable1">
                        <thead>
                            <tr style="font-size: 12px;">
                                <th >#</th>
                                <th>Transaction Code</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Supervisor</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Date</th>
                                <th width="160px">Reason</th>
                                <th>Request</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px;">
                        <?php $x = 1;$lastTotal=0;$total = 0;?>
                        @foreach(App\Tbl_Leaves::where('employee_id',Auth::user()->id)->get() as $leave)
                            <?php 
                                $sd = date('d', strtotime($leave->start_date));
                                $ed = date('d', strtotime($leave->end_date));
                                $totatdate = $ed-$sd+1;
                                $total+=$totatdate;
                                $lastTotal=$total_date-$total;
                                $userName = $leave->getUserName();
                            ?>
                            <tr>
                                <td>{{ $x }}</td>
                                <td>Req{{ date('Ymd') }}{{ $leave->transaction_code }}</td>
                                <td>{{ $userName['name'][$leave->employee_id] }}</td>
                                <td>{{ $userName['position'][$leave->employee_id] }}</td>
                                <td>{{ $userName['dept'][$leave->employee_id] }}</td>
                                <td>{{ $userName['name'][$leave->supervisor_id] }}</td>
                                <td>{{ date('M d, Y', strtotime($leave->start_date)) }}</td>
                                <td>{{ date('M d, Y', strtotime($leave->end_date)) }}</td>
                                <td>{{ $totatdate }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td>
                                @if($leave->status==0) 
                                    <p style="color: blue">Pendding</p>
                                @elseif($leave->status==1)
                                    <p style="color: green">Approved</p>
                                @elseif($leave->status==2)
                                    <p style="color: red">Rejected</p>
                                @endif</td>
                                <td>

                                @if($leave->status==0)
                                    <a href="#" class="editleave label label-info" id="edit_{{$leave->id}}" style="font-size: 12px"><span class="glyphicon glyphicon-edit"></span>Edit</a>
                                    <a href="#" class="deleteleave label label-danger" id="delete_{{$leave->id}}" style="font-size: 12px"><span class="glyphicon glyphicon-trash"></span>Delete</a>
                                @else
                                    <p>Seen</p>
                                @endif
                                </td>
                            </tr>
                            <?php $x++; ?>
                            
                        @endforeach
                        
                            <tfooter>
                                <tr>

                                    <td colspan="6" style="text-align: right;">Reamin Days</td>
                                    <td colspan="6">
                                    
                                    @if(!empty($lastTotal))
                                     {{ $lastTotal}}
                                    @else
                                    {{ $total_date }}
                                    @endif
                                    </td>
                                </tr>
                            </tfooter>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- add new leaves -->
<div class="modal fade" id="ModalDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Leave</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('jquery')
    <script>
        $(function(){
            $(".show_current_date").datetimepicker({
                // value:new Date(),
                timepicker:false,
                format:'d-M-Y'
            });
            $(document).on('submit', "#editLeave",function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "/updateLeave",
                    data: formData,
                    success: function (response) {
                        if(response == 'yes'){
                            swal({
                                title:"Udate Request Successfull!",
                                text:"Successfull sumbit!",
                                type:"success",  
                                timer: 1000,   
                                showConfirmButton: false
                            });
                            $('#ModalDialog').modal('toggle');
                            window.setTimeout(function(){ document.location.reload(true); }, 1000);
                        }
                        
                    },
                    error: function () {
                        alert('SYSTEM ERROR, TRY LATER AGAIN');
                    }
                });
            });
            //edit leave 
            $(document).on('click', ".editleave",function () {
                var get_Id=$(this).attr('id');
                var id=get_Id.substr(5,get_Id.length);
                var url = '/editleave/'+id;
                $('.modal-body').load(url,function(result){
                    $('#ModalDialog').modal({show:true});
                }); 
            });

            //delete leave
            $(document).on('click','.deleteleave',function(){
                var get_id = $(this).attr('id');
                var id = get_id.substr(7,get_id.length);
                if(confirm("Are you sure want to delete?")==true){
                    $.ajax({
                        type: "get",
                        url: "/deleteleave",
                        data: {leave_id:id},
                        success: function (response) {
                           if(response == 'yes'){
                                swal({
                                    title:"Delete data Success",
                                    text:"This update ready!",
                                    type:"success",  
                                    timer: 1000,   
                                    showConfirmButton: false
                                });
                                window.setTimeout(function(){ document.location.reload(true); }, 500);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection

