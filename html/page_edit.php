<form action="index.php" method="post" id="form" enctype="multipart/form-data">
<input type="hidden" name="content" value="Pages" />
<input type="hidden" name="action" value="save" />
<input type="hidden" name="id" value="<?php echo $page->id; ?>"/>

<div class="container">
	<h1><?php echo $lang['Edit']; ?></h1>
	<div class="row buttonrow">
		<div class="col-sm-6 title"><?php echo $lang['Title']; ?></div>
		<div class="col-sm-6"><input class=" textbox required" type="text" name="title" value="<?php echo $page->title; ?>"/></div>
	</div>
	<div class="line">
		<div colspan="2"><?php echo $lang['Body']; ?></div>
	</div>
	<div class="line">
		<div colspan="2">
			<textarea class="tinymce" name="body" style="width: 100%; height: 350px;"><?php echo $page->body; ?></textarea>
		</div>
	</div>
	<?php 
	if (!$page->id)
	{
		?>
		<div class="line">
			<div><?php echo $lang['Upload image']; ?></div>
			<div><input type="file" name="image_file" /></div>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="line">
			<div colspan="2"><iframe src="index.php?content=pages&action=editGallery&id=<?php echo $page->id; ?>" frameborder="0" style="border:none; width:100%; height:320px;" allowTransparency="true"></iframe></div>
		</div>
		<?php
	}
	?>

	<div style="clear: bodiv; padding: 5px 0;">
		<a class="btn btn-primary btn-md submit"><?php echo $lang['Save']; ?></a>
		<a class="btn btn-danger btn-md cancel" href="index.php?content=Pages"><?php echo $lang['Cancel']; ?></a>
	</div>
	</div>
</div>
<div class="dialog alertDlg"></div>
<script type="text/javascript">
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
				alert('<?php echo $lang['Choose anodiver title']; ?>');
			}
		});
	}
	else
	{
		jQuery(".alertDlg").html('<?php echo $lang['Fill in red']; ?>');
		alert('<?php echo $lang['Fill in red']; ?>');
	}
});
</script>
</form>