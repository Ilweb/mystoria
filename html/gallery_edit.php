<?php
$this->showView('gallery_header');
?>
<form action="index.php" method="post" id="form" enctype="multipart/form-data">
	<input type="hidden" name="content" value="<?php echo $class; ?>" />
	<input type="hidden" name="action" value="uploadImage" />
	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
	<input type="file" name="image_file" />
	<input type="submit" class="button" value="Качи снимка">
</form>
<ul class="editImages">
<?php
foreach ($images as $key=>$image)
{
	echo '<li>';
	echo '<img alt="'.$image.'" class="smallImage" src="'.$this->thumbnail(
			$dir.$image, 
			145,
			array(
				"crop"=>1
			)
		).'" />';
	echo '<a class="button" onclick="deleteImage(\'index.php?content='.$class.'&action=deleteImage&id='.$id.'&image='.$image.'\', \''.$image.'\');">'.$lang['Delete'].'</a>';
	echo '<div class="number"></div>';
	echo '</li>';
}
?>
</ul>
<div style="clear: both;"></div>
<script type="text/javascript">
//jQuery("ul.editImages").width(jQuery("ul.editImages li").length * 130);
refreshNumbers();
jQuery("ul.editImages").sortable({
	update: function()
	{
		var images = [];
		for (var i = 0; i < jQuery("ul.editImages li").length; i++)
		{
			images[i] = jQuery(jQuery("ul.editImages li")[i]).find("img").attr("alt");
		}
		
		jQuery.post("index.php",
		{
			content: "<?php echo $class; ?>",
			action: "reorderImages",
			id: "<?php echo $id; ?>",
			"images": images
		});
		
		refreshNumbers();
	}
});

function refreshNumbers()
{
	jQuery("ul.editImages li").each(function(i)
	{
		jQuery(this).find(".number").html(i + 1);
	});
}
</script>
<?php
$this->showView('gallery_footer');
?>