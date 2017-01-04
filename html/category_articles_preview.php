<?php
if ($catObj->id == 2)
{
	echo '<div class="articlePreview"><div class="pagePreview">';
	echo '<h1>'.$title.'</h1>';
	foreach ($articles as $key => $article)
	{
		echo '<div>';
		if ($article->title != $title)
		{
			echo '<h2>'.$article->title.'</h2>';
		}
		echo htmlspecialchars_decode($article->body);
		
		if (count($article->images))
		{
			?>
			<div class="galleryDiv fullGallery">
				<ul class="gallerySlider">
					<?php
					$largeImages = array();
					for ($i = 0; ($i < count($article->images)); $i++)
					{
						$largeImages[] = $this->thumbnail($article->dir.'/'.$article->images[$i], 600, 
							array(
								"byHeight"=>true,
								"watermark"=>true
							)
						);
						echo '<li style="display: none;"><img ';
						echo 'src="'.$this->thumbnail(
							$article->dir.'/'.$article->images[$i], 
							900,
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
					<div class="arrow" style="left: 20px;">
						<a class="prev"></a>
					</div>
					<div class="arrow" style="right: 20px;">
						<a class="next"></a>
					</div>
				</div>
			</div>
			<?php
		}
		if (count($article->images) > 1)
		{
			echo '<div class="smallGallery fullGallery">';
			for ($i = 0; ($i < count($article->images)); $i++)
			{
				echo '<img ';
				echo 'src="'.$this->thumbnail(
					$article->dir.'/'.$article->images[$i], 
					125,
					array("crop"=>1)
				);
				echo '" onclick="popupImage('.$i.');" />';
			}
			echo '</div>';
		}
		echo '</div>';
	}
	echo '</div></div>';
	?>
	<script type="text/javascript">
	jQuery(".gallerySlider").each(function()
	{
		jQuery(this).find("li").first().show();
	});
	
	jQuery(".galleryUI .prev").click(function()
	{
		jQuery(this).parents(".galleryDiv").find("li:visible").hide();
		jQuery(this).parents(".galleryDiv").find("li:last").prependTo(jQuery(this).parents(".galleryDiv").find("ul.gallerySlider"));
		jQuery(this).parents(".galleryDiv").find("li:first").show();
	});

	jQuery(".galleryUI .next").click(function()
	{
		jQuery(this).parents(".galleryDiv").find("li:visible").hide();
		jQuery(this).parents(".galleryDiv").find("li:first").appendTo(jQuery(this).parents(".galleryDiv").find("ul.gallerySlider"));
		jQuery(this).parents(".galleryDiv").find("li:first").show();
	});
	</script>
	<?php
}
else
{
	foreach ($articles as $key => $article)
	{
		if ($article->featured)
		{
			$this->variables["article"] = $article;
			$this->variables["images"] = $article->images;
			$this->variables["dir"] = 'articles/'.$article->id;
			$this->showView('article_preview');
		}
	}
	
	if ($catObj->id == 1)
	{
		echo '<div class="articlePreview"><div class="pagePreview">';
		$this->showView('map');
		echo '</div></div>';
	}
}
?>