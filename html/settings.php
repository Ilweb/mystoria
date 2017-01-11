<?php
$this->showView('adminNav');
?>

<div class="container">
<h1>Settings</h1>
<form id="form" method="post" action="<?php ROOT_URL.'index.php'; ?>">
<input type="hidden" name="content" value="settings" />
<input type="hidden" name="action" value="save" />
<div class="row">
<?php
while ($row = $settings->fetch_object())
{
	?>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="set<?php echo $row->id ?>"><?php echo $row->set_key; ?></label>
			<input id="set<?php echo $row->id ?>" name="set[<?php echo $row->id ?>]" class="form-control" value="<?php echo $row->set_value; ?>" />
		</div>
	</div>
	<?php
}
?>
</div>
<h2>Available hours for reservation</h2>
<div class="row hours">
	<?php
	while ($row = $hours->fetch_object())
	{
		?>
		<div class="col-sm-4 hour">
			<div class="form-group">
				<div class="input-group">
					<input name="hours[]" class="form-control time" value="<?php echo $row->start; ?>" />
					<a class="input-group-addon btn delete-hour">
						<span class="fa fa-close"></span>
					</a>
				</div>
			</div>	
		</div>
		<?php
	}
	?>
	<div class="col-sm-4">
		<div class="form-group">
			<a class="btn btn-block btn-info add-hour">Add new hour</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<a class="submit btn btn-block btn-primary">Save settings</a>
	</div>
</div>
<script type="text/javascript">
jQuery(".hours").on("click", ".delete-hour", function()
{
	jQuery(this).parents(".hour").remove();
});

jQuery(".add-hour").click(function()
{
	jQuery(this).parent().parent().before('<div class="col-sm-4 hour">'
			+ '<div class="form-group">'
				+ '<div class="input-group">'
					+ '<input name="hours[]" class="form-control time" placeholder="HH:MM:SS" />'
					+ '<a class="input-group-addon btn delete-hour">'
						+ '<span class="fa fa-close"></span>'
					+ '</a>'
				+ '</div>'
			+ '</div>	'
		+ '</div>');
});

jQuery(".submit").click(function()
{
	if (validate1('#form'))
	{
		jQuery("#form").submit();
	}
});
</script>