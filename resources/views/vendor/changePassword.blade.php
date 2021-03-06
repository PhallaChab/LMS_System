
<div class="panel panel-default" style="border:none; padding:0px 0px;">
    <div class="panel-body" >
        <form class="form-horizontal" id="changePassForm" role="form" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="userID" name="userID" value="{{ $currentUser->id }}">
            <div class="form-group">
                <label for="username" class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" value="{{ $currentUser->name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                    <input id="useremail" type="email" class="form-control" name="useremail" value="{{ $currentUser->email }}">
                </div>
            </div>
            <div class="form-group">
                <label for="oldpassword" class="col-md-4 control-label">Old Password</label>
                <div class="col-md-6">
                    <input type="password" name="oldpassword" class="form-control" id="oldpassword">
                </div>
            </div>
            <div class="form-group">
                <label for="newpassword" class="col-md-4 control-label">New Password</label>
                <div class="col-md-6">
                    <input id="newpassword" type="password" class="form-control" name="newpassword">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Update
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cencel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function(){
        
        $(document).on('submit', "#changePassForm",function (e) {
		 	e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				type: "POST",
				processData: false,
				contentType: false,
				url: "/updatePassword",
				data: formData,
				success: function (response) {
                   if(response=='yes'){
                        swal({
                            title:"Update data success!",
                            text:"Update data success!",
                            type:"success",  
                            timer: 1000,   
                            showConfirmButton: false
                        });
    				   $('#modelChangePassword').modal('toggle');
                        //window.setTimeout(function(){ document.location.reload(true); }, 1000);
                    }else if(response=='nono'){
                        swal({
                            title:"Something Wrong. Please check again!",
                            text:"Cannot update data!",
                            type:"error",  
                            timer: 1000,   
                            showConfirmButton: false
                        });
                    }
				},
				error: function () {
					alert('SYSTEM ERROR, TRY LATER AGAIN');
				}
			});
		});
    });
</script>