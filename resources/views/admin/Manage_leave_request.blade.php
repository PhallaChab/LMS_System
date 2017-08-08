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
                View All Leave Request
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-fw fa-table"></i> View All Leave Request
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <i class="glyphicon glyphicon-plus"></i>
           <!--  <button type="button" class="btn btn-info" id="addleaves">
                Add leave</button> -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th>Transaction Code</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Supervisor</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Request</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $x = 1;?>

                    @foreach(App\Tbl_Leaves::all() as $leave)
                        <?php $userName = $leave->getUserName(); ?>
                        <tr>
                            <td>{{ $x }}</td>
                            <td>Req{{ date('Ym') }}{{ $leave->transaction_code }}</td>
                            <td>{{ $userName['name'][$leave->employee_id] }}</td>
                            <td>{{ $userName['position'][$leave->employee_id] }}</td>
                            <td>{{ $userName['dept'][$leave->employee_id] }}</td>
                            <td>{{ $userName['name'][$leave->supervisor_id] }}</td>
                            <td>{{ date('M d, Y', strtotime($leave->start_date)) }}</td>
                            <td>{{ date('M d, Y', strtotime($leave->end_date)) }}</td>
                            <td>{{ $leave->reason }}</td>
                            <td> 
                            @if($leave->status==0) 
                                <p style="color: blue">Pending</p>
                            @elseif($leave->status==1)
                                <p style="color: green">Approved</p>
                            @elseif($leave->status==2)
                                <p style="color: red">Rejected</p>
                            @endif</td>
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


