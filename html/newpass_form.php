<h1><?php echo $title; ?></h1>
<form id="passForm" method="post" action="<?php echo LOCALE_URL; ?>">
	<input type="hidden" name="content" value="users" />
	<input type="hidden" name="action" value="setPass" />
	<p>
		<?php echo $lang['Set pass text']; ?>
	</p>
	<p>
		<label for="user_pass"><?php echo $lang['Password']; ?></label><br/>
		<input class="textbox" type="password" name="user_pass" id="user_pass" />
	</p>
	<p>
		<label for="pass2"><?php echo $lang['Confirm password']; ?></label><br/>
		<input class="textbox" type="password" name="pass2" id="pass2" />
	</p>
	<a class="button submitPass"><?php echo $lang['Confirm']; ?></a> 
</form>
<script type="text/javascript">
jQuery(".submitPass").click(function()
{
	if (jQuery("#user_pass").val() != jQuery("#pass2").val())
	{
		jQuery(".alertDlg").html('<?php echo $lang['Pass not match']; ?>');
		jQuery(".alertDlg").dialog("open");
	}
	else if (jQuery("#user_pass").val() == '')
	{
		jQuery(".alertDlg").html('<?php echo $lang['Fill new pass']; ?>');
		jQuery(".alertDlg").dialog("open");
	}
	else
	{
		jQuery("#passForm").submit();
	}
});
</script>