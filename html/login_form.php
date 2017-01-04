<div class="container">

<form id="login" name="login_form" method="post" action="<?php echo ROOT_URL; ?>">
	<input type="hidden" name="content" value="users" />
	<input type="hidden" name="action" value="checkUser" />
	<?php
	if (isset($error) && ($error != ''))
	{
		echo '<div class="ui-state-highlight"><span class="ui-icon ui-icon-alert" style="float: left; margin-left;"></span>'.$error.'</div>';
	}
	?>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<?php 
			if (isset($login))
			{
				echo '<h1>'.$title.'</h1>';
			}
			?>
			<div class="form-group required">
				<label for="fuser"><?php echo $lang['Username']; ?></label>
				<input type="text" class="form-control" id="fuser" name="user_name" />
			</div>
			<div class="form-group required">
				<label for="fpass"><?php echo $lang['Password']; ?></label>
				<input type="password" class="form-control" id="fpass" name="user_pass" />
			</div>
			<div class="form-group">
				<input class="btn btn-block btn-primary" type="submit" value="<?php echo $lang['Log in']; ?>" /> 
			</div>
		</div>
		<div class="col-sm-3"></div>
	</div>
</form>
</div>