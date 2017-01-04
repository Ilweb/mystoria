<div class="galleryDiv">
	<ul class="gallerySlider">
		<?php
		$largeImages = array();
		for ($i = 0; ($i < count($images)); $i++)
		{
			$largeImages[] = $this->thumbnail($dir.'/'.$images[$i], 600, 
				array(
					"byHeight"=>true,
					"watermark"=>true
				)
			);
			echo '<li style="display: none;"><img ';
			echo 'src="'.$this->thumbnail(
				$dir.'/'.$images[$i], 
				600,
				array(
					"crop"=>1.6,
					"keepHigh"=>true,
					"watermark"=>true
				)
			);
			echo '" itemprop="image" onclick="popupImage('.$i.');" /></li>';
		}
		?>
	</ul>
	<div class="galleryUI">
		<div class="arrow" style="left: 0;">
			<a class="prev"></a>
		</div>
		<div class="arrow" style="right: 0;">
			<a class="next"></a>
		</div>
	</div>
</div>
<?php
if (count($images) > 1)
{
	echo '<div class="smallGallery">';
	for ($i = 0; ($i < count($images)); $i++)
	{
		echo '<img ';
		echo 'src="'.$this->thumbnail(
			$dir.'/'.$images[$i], 
			125,
			array(
				"crop"=>1
			)
		);
		echo '" onclick="popupImage('.$i.');" />';
	}
	echo '</div>';
}
$this->variables['largeImages'] = $largeImages;
$this->showView('gallery_dialog');
?>
<script type="text/javascript">

var currentImage = -1;
var t;

jQuery(".galleryUI .prev").click(function()
{
	if (currentImage <= 0)
	{
		currentImage = jQuery(".gallerySlider img").length;
	}
	clearTimeout(t);
	changeImage(--currentImage);
});

jQuery(".galleryUI .next").click(function()
{
	if (currentImage >= jQuery(".gallerySlider img").length - 1)
	{
		currentImage = -1;
	}
	clearTimeout(t);
	changeImage(++currentImage);
});

function changeImage(index)
{
	var active_li = jQuery(".gallerySlider .active");
	jQuery(active_li).removeClass("active");
	
	jQuery(".galleryUI").hide();
	
	var speed = 500;
	//jQuery(active_li).fadeOut(speed);
	jQuery(active_li).hide();
	
	jQuery(jQuery(".gallerySlider li")[index]).addClass("active");
	active_li = jQuery(".gallerySlider .active");
	
	jQuery(active_li).fadeIn(speed, 
	function()
	{
		jQuery(".galleryUI").show();
	});
}

function nextImageEvent()
{
	jQuery(".galleryUI .next").click();
	
	t = setTimeout("nextImageEvent()", 12000);
}

if (jQuery(".gallerySlider li").length > 1)
{
	nextImageEvent();
}
else
{
	if (jQuery(".gallerySlider li").length == 1)
	{
		jQuery(".galleryUI").hide();
		jQuery(".gallerySlider li").addClass("active");
		jQuery(".gallerySlider li").show();
	}
	else
	{
		jQuery(".galleryDiv").hide();
	}
}

jQuery("body").keydown(function(event)
{
	if(event.which == 37)
	{
		if (jQuery(".imageDialog").dialog("isOpen"))
		{
			jQuery(".imageDialog .prev").click();
		}
		else
		{
			jQuery(".galleryUI:visible .prev").click();
		}
	}
	if(event.which == 39)
	{
		if (jQuery(".imageDialog").dialog("isOpen"))
		{
			jQuery(".imageDialog .next").click();
		}
		else
		{
			jQuery(".galleryUI:visible .next").click();
		}
	}
});
</script>