<?php
$this->showView('gallery_header');
?>

		<form action="index.php" method="post" id="form"   enctype="multipart/form-data">
		<input type="hidden" name="content" value="<?php echo $class; ?>" />
		<input type="hidden" name="action" value="uploadImage" />
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<div class="row">
				<div class="col-sm-8">
					<label class="btn btn-info btn-block btn-file">
					Upload file<input type="file" name="image_file" style="display: none;" onchange="$('#upload-file-info').html($(this).val());"/></label>
					<span class="label label-info" id="upload-file-info"></span>
				</div>
				<div class="col-sm-4">
					<input type="submit" class="button btn btn-warning"  value="Качи снимка">
				</div>
			</div>
		</form>


<ul class="editImages">
<?php
foreach ($images as $key=>$image)
{
	
	echo '<li style="display:inline-block; position:relative; list-style-type:none;padding:10px;">';
	echo '<div class="number" style="padding: 8px; height: 30px; width:147px; position:absolute; top:5px; background-color:rgba(255,250,250, 0.7);">

	</div>';
	echo '<i class="fa fa-times" aria-hidden="true" style="padding:5px; right:13px; position:absolute; cursor:pointer" onclick="deleteImage(\'index.php?content='.$class.'&action=deleteImage&id='.$id.'&image='.$image.'\', \''.$image.'\');">'.'</i>';

	echo '<img style="margin-bottom:5px;"alt="'.$image.'" class="smallImage" src="'.$this->thumbnail(
			$dir.$image, 
			145,
			array(
				"crop"=>1
			)
		).'" />';
	
		
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