


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>   
            <a class="navbar-brand" href="<?php echo LOCALE_URL; ?>">Mystoria</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=reservations">Reservations</a></li><li><a href="<?php echo ROOT_URL; ?>index.php?content=articles">Articles</a></li>
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=pages">Pages</a></li>
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=settings">Settings</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li  data-toggle="modal" data-target="#myModal"><a href="#" ><span class="fa fa-lock" aria-hidden="true""></span> Password</a></li>
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=users&action=logout"><span class="fa fa-times" aria-hidden="true"> </span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade changePass" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Change Password</h4>
			</div>
			<div class="modal-body">
                <div class="form-group required">
                    <label for="current_password" >Current password</label>
                    <input type="password"  class="form-control" id="current_password" name="current_password">
                </div>
                <div class="form-group required password1 " id="password1">
                    <label for="new_password ">New password</label>
                    <input type="password"  class="form-control" id="new_password" name="new_password">
                </div>
                <div class="form-group required password2" id="password2">
                    <label for="confirm_password ">Confirm password</label>
                    <input type="password"  class="form-control" id="confirm_password" name="confirm_password">
                </div> 
			</div>
			<div class="modal-footer">
                <div class="row">
                     <div class="col-sm-6">
                        <button type="button" id="btnSubmit" class="btn btn-success btn-block"><?php echo $lang['Save']; ?></button>
                    </div>
                    <div class="col-sm-6">
    				    <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><?php echo $lang['Cancel']; ?></button>
                    </div>
			 </div>
		  </div>
	   </div>
    </div>
</div>

<script type="text/javascript">
	$(function () {
		$("#btnSubmit").click(function () {
		
			clearAlerts(".modal-body");
			
			if (jQuery("#new_password").val() != jQuery("#confirm_password").val())
			{
				addAlert(".modal-body", '<?php echo $lang['Pass not match']; ?>', 'danger');
			}
			else if (jQuery("#new_password").val() == '')
			{
				addAlert(".modal-body", '<?php echo $lang['Fill new pass']; ?>', 'danger');
			}
			else 
			{
				jQuery.post("index.php",
				{
					content: "users",
					action: "changePassword",
					password: jQuery("#current_password").val(),
					new_pass: jQuery("#new_password").val()
				},
				function(data)
				{
					if (jQuery.trim(data) == 'OK')
					{
						jQuery("#myModal").modal("hide");
					}
					else
					{
						addAlert(".modal-body", data, 'danger');
					}
				});
			}
		});
	});
    </script>