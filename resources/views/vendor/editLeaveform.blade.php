
<div class="panel panel-default" style="border:none; padding:0px 0px;">
    <div class="panel-body" >
		<form method="post" id="editLeave">
			{{ csrf_field() }}
			<input type="hidden" name="leaveID" value="{{isset($getLeave[0])?$getLeave[0]->id:''}}">
			<div class="col-xs-12 col-md-6">
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
			<div class="col-xs-12 col-md-6">
				<div class="form-group">
					<div class="col-md-12">
				  		<label for="suppervisor">Suppervisor</label>
				    	<select name="suppervisor" id="suppervisor" class="form-control" readonly>
				    		<option value="{{$getLeave[0]->supervisor_id}}">{{ $array_name[$getLeave[0]->supervisor_id] }}</option>
				    	</select>
				  	</div>
				</div>
				<div class="form-group">
				  	<div class="col-md-12">
				  	<label for="startdate">Date Start</label>
				    	<input class="form-control show_current_date" type="text" name="startdate" id="startdate" required value="{{isset($getLeave[0])?date('d-M-Y', strtotime($getLeave[0]->start_date)): ''}}">
				  	</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
				  		<label for="enddate">Date End</label>
				    	<input class="form-control show_current_date" type="text" name="enddate" id="enddate" required value="{{isset($getLeave[0])?date('d-M-Y', strtotime($getLeave[0]->end_date)):''}}">
				  	</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<div class="col-md-12">
				  	<label for="reason">Reason</label>
				    	<textarea name="reason" id="reason" class="form-control" required>{{isset($getLeave[0])?$getLeave[0]->reason:''}}</textarea>
				  	</div>
				</div>
				<div class="form-group" >
					<div class="col-md-9" style="margin-top: 10px;">
						<button type="submit" class="btn btn-info">Submit</button>
		  				<button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
		  			</div>
					</div>
			</div>
		</form>
	</div>
</div>