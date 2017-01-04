<div class="imageDialog"><div class="image"></div></div>
<script type="text/javascript">
jQuery(".imageDialog").dialog({
	autoOpen: false,
	width: 1125,
	title: "<?php echo str_replace('"' , '\"', $title); ?>",
	modal: true,
	show: { 
		effect: 'drop'
	} ,
	hide: { 
		effect: 'drop'
	} 
});

function popupImage(i)
{
	var images = <?php echo json_encode($largeImages); ?>;
	if (i < 0)
	{
		i = images.length - 1;
	}
	if (i >= images.length)
	{
		i = 0;
	}
	jQuery(".imageDialog .image").html('<img src="' + images[i] + '" />');
	jQuery(".imageDialog .image").append('<div class="arrow pArrow"><a class="prev" onclick="popupImage(' + (i - 1) + ')"></a></div>');
	jQuery(".imageDialog .image").append('<div class="arrow nArrow"><a class="next" onclick="popupImage(' + (i + 1) + ')"></a></div>');
	jQuery(".imageDialog").dialog("option", "title", "<?php echo str_replace('"' , '\"', $title); ?> - " + (i + 1) + "/" + images.length);
	jQuery(".imageDialog").dialog("open");
}
</script>