<form action="index.php" method="post" id="form" enctype="multipart/form-data">
<input type="hidden" name="content" value="Pages" />
<input type="hidden" name="action" value="save" />
<input type="hidden" name="id" value="<?php echo $page->id; ?>"/>
<table class="full">
	<tr class="line">
		<th><?php echo $lang['Title']; ?></th>
		<td><input class="textbox required" type="text" name="title" value="<?php echo $page->title; ?>"/></td>
	</tr>
	<tr class="line">
		<th colspan="2"><?php echo $lang['Body']; ?></th>
	</tr>
	<tr class="line">
		<td colspan="2">
			<textarea class="tinymce" name="body" style="width: 95%; height: 350px;"><?php echo $page->body; ?></textarea>
		</td>
	</tr>
	<?php 
	if (!$page->id)
	{
		?>
		<tr class="line">
			<th><?php echo $lang['Upload image']; ?></th>
			<td><input type="file" name="image_file" /></td>
		</tr>
		<?php
	}
	else
	{
		?>
		<tr class="line">
			<td colspan="2"><iframe src="index.php?content=pages&action=editGallery&id=<?php echo $page->id; ?>" frameborder="0" style="border:none; width:100%; height:320px;" allowTransparency="true"></iframe></td>
		</tr>
		<?php
	}
	?>
</table>
<div style="clear: both; padding: 5px 0;">
	<a class="submit"><?php echo $lang['Save']; ?></a>
	<a class="cancel" href="index.php?content=Pages"><?php echo $lang['Cancel']; ?></a>
</div>
<div class="dialog alertDlg"></div>
<script type="text/javascript">
prepareUI();
jQuery(".alertDlg").dialog({
	modal: true,
	autoOpen: false,
	resizable: false,
	title: "<?php echo $lang['Caution']; ?>",
	buttons: {
		"<?php echo $lang['OK']; ?>": function()
		{
			jQuery(this).dialog("close");
		}
	}
});
jQuery(".submit").click(function()
{
	if (validate('#form'))
	{
		jQuery.post("index.php",
		{
			content: "Pages",
			action: "checkUrl",
			id: '<?php echo $page->id; ?>',
			title: jQuery('input[name="title"]').val()
		},
		function(data)
		{
			if (data == "OK")
			{
				jQuery("#form").submit();
			}
			else
			{
				jQuery('input[name="title"]').addClass('invalid1');
				jQuery(".alertDlg").html('<?php echo $lang['Choose another title']; ?>');
				jQuery(".alertDlg").dialog("open");
			}
		});
	}
	else
	{
		jQuery(".alertDlg").html('<?php echo $lang['Fill in red']; ?>');
		jQuery(".alertDlg").dialog("open");
	}
});
</script>
</form>