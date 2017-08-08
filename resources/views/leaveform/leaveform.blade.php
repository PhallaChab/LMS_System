@extends('layouts.admin_menu')

@section('content')
<style>
	label{
		padding-bottom: 5px;
		padding-top: 5px;
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
	                    <i class="glyphicon glyphicon-tasks"></i> Apply Leave Request
	                </li>
	            </ol>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="col-md-12">
					<form method="post" id="submitLeave">
						{{ csrf_field() }}
						<div class="col-xs-6">
							<div class="form-group">
								<div class="col-md-12">
								    <label for="name">Name</label>
								    <input type="text" id="name" class="form-control" name="name" value="{{$currentUser[0]->name}}" required readonly>
							    </div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
								    <label for="position">Position</label>
								    <input type="text" id="position" class="form-control" name="position" value="{{$currentUser[0]->position}}" readonly required>
							    </div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
								    <label for="department">Department</label>
								    <input type="text" id="department" class="form-control" name="department" value="{{$currentUser[0]->department}}" readonly required>
							    </div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<div class="col-md-12">
							  		<label for="suppervisor">Suppervisor</label>
							    	<select name="suppervisor" id="suppervisor" class="form-control" readonly>
							    		<option value="{{$currentUser[0]->manage_by}}">{{ $array_name[$currentUser[0]->manage_by] }}</option>
							    	</select>
							  	</div>
							</div>
							<div class="form-group">
							  	<div class="col-md-12">
							  	<label for="startdate">Date Start</label>
							    	<input class="form-control show_current_date" type="text" value="" name="startdate" id="startdate" required>
							  	</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
							  		<label for="enddate">Date End</label>
							    	<input class="form-control show_current_date" type="text" value="" name="enddate" id="enddate" required>
							  	</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<div class="col-md-12">
							  	<label for="reason">Reason</label>
							    	<textarea name="reason" id="reason" class="form-control" required></textarea>
							  	</div>
							</div>
							<div class="form-group" >
								<div class="col-md-9" style="margin-top: 10px;">
									<button type="submit" class="btn btn-info">Submit</button>
		              				<button type="reset" class="btn btn-default">Cencel</button>
		              			</div>
              				</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	<!-- </div> -->

@endsection

@section('jquery')
<script>
	$(function(){
		$(".show_current_date").datetimepicker({
            value:new Date(),
            timepicker:false,
            format:'d-M-Y'
        });
		$(document).on('submit', "#submitLeave",function (e) {
		 	e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				type: "POST",
				processData: false,
				contentType: false,
				url: "/addLeaveform",
				data: formData,
				success: function (response) {
					if(response == 'yes'){
                        swal({
                            title:"Submit Request Successfull!",
                            text:"Successfull sumbit!",
                            type:"success",  
                            timer: 1000,   
                            showConfirmButton: false
                        });
                        window.setTimeout(function(){ window.location = "/leaveRequest"; }, 600);
                    }
				   	
				},
				error: function () {
					alert('SYSTEM ERROR, TRY LATER AGAIN');
				}
			});
		});
	});
</script>
@endsection