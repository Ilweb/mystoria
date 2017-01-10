<?php
$this->showView('gallery_header');
?>

		<form action="index.php" method="post" id="form"   enctype="multipart/form-data">
		<input type="hidden" name="content" value="<?php echo $class; ?>" />
		<input type="hidden" name="action" value="uploadImage" />
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<input type="file" style="outline: none;" name="image_file" />
		<input type="submit" class="button btn btn-warning" style="margin-top: 10px; " value="Качи снимка">
		</form>


<ul class="editImages">
<?php
foreach ($images as $key=>$image)
{
	
	echo '<li style="display:inline-block; list-style-type:none;padding:10px;">';
	echo '<div class="number" style="width:100%; position:absolute; background-color:rgba(255,250,250, 0.7);"></div>';
	echo '<img style="margin-bottom:5px;"alt="'.$image.'" class="smallImage" src="'.$this->thumbnail(
			$dir.$image, 
			145,
			array(
				"crop"=>1
			)
		).'" />';
	echo '<a class="delete btn btn-danger btn-md" style="display:block;" onclick="deleteImage(\'index.php?content='.$class.'&action=deleteImage&id='.$id.'&image='.$image.'\', \''.$image.'\');">'.$lang['Delete'].'</a>';
	
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