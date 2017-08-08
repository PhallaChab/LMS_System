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
                    Apply Leave Request
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Apply Leave Request
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="">
                        <thead>
                        <tr>
                            <th >#</th>
                            <th>Transaction Code</th>
                            <th>Employee</th>
                            <th>Supervisor</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Date</th>
                            <th>Reason</th>
                            <th>Request</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x = 1;$lastTotal=0;$total = 0;?>
                        @foreach(App\Tbl_Leaves::where('supervisor_id',$currentUserId)->get() as $leave)
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
                                <td>Req{{ date('Ym') }}{{ $leave->transaction_code }}</td>
                                <td>{{ $userName['name'][$leave->employee_id] }}</td>
                                <td>{{ $userName['position'][$leave->employee_id] }}</td>
                                <td>{{ $userName['dept'][$leave->employee_id] }}</td>
                                <td>{{ $userName['name'][$leave->supervisor_id] }}</td>
                                <td>{{ date('M d, Y', strtotime($leave->start_date)) }}</td>
                                <td>{{ date('M d, Y', strtotime($leave->end_date)) }}</td>
                                <td>{{ $totatdate }}</td>
                                <td>{{ }}
                                <td>{{ $leave->reason }}</td>
                                <td>
                                    @if($leave->status==0)
                                        <p style="color: blue">Pending</p>
                                    @elseif($leave->status==1)
                                        <p style="color: green">Approved</p>
                                    @elseif($leave->status==2)
                                        <p style="color: red">Rejected</p>
                                    @endif</td>
                                <td>
                                    @if($leave->status==0)
                                        <button type="button" name="approve" class="btn btn-primary" onclick="actionApprove({{$leave->id}});">Approve</button>
                                        <button type="button" name="reject" class="btn btn-danger" onclick="actionReject({{$leave->id}});">Reject</button>
                                    @elseif($leave->status==1)
                                        <button type="button" name="reject" class="btn btn-danger" onclick="actionReject({{$leave->id}});">Reject</button>
                                    @elseif($leave->status==2)
                                        <button type="button" name="approve" class="btn btn-primary" onclick="actionApprove({{$leave->id}});">Approve</button>
                                    @endif

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
<script>
    function actionApprove($id){
        var url='/approveRequet/'+$id;
        $.get( url, function( data ) {
            if(data=='yes'){
                swal({
                    title:"Request has been Approved!",
                    text:"Request has been Approved",
                    type:"success",  
                    timer: 1000,   
                    showConfirmButton: false
                });
                window.setTimeout(function(){ document.location.reload(true); }, 100);
            }
        });
    }
    function actionReject($id){
        var url='/rejectRequet/'+$id;
        $.get( url, function( data ) {
            if(data=='yes'){
                swal({
                    title:"Request Rejected!",
                    text:"Request Rejected!",
                    type:"success",  
                    timer: 1000,   
                    showConfirmButton: false
                });
                window.setTimeout(function(){ document.location.reload(true); }, 100);
            }
        });
    }
</script>
@endsection

