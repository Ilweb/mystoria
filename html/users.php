<div class="left">
	<?php $this->showView('user_list'); ?>
</div>
<script type="text/javascript">
function loadUser(user_id)
{
	jQuery(".right").load("index.php",
	{
		content: "UserAdmin",
		action: "edit",
		id: user_id
	});
}

function newUser()
{
	jQuery(".right").load("index.php",
	{
		content: "UserAdmin",
		action: "edit"
	});
}

function deleteUser(id)
{
	if (confirm("<?php echo $lang['Delete user q']; ?> #"+id+"?"))
	{
		jQuery.get("index.php",
		{
			content: "UserAdmin",
			action: "delete",
			user: id
		});
		jQuery(".user"+id).hide(1000);
	}
}
</script>
<div class="right">

</div>
<div style="clear: both;"></div>