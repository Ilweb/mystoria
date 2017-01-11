<?php
$this->showView('adminNav');
?>

<div class="articlePreview">
	<div class="pagePreview">
		<?php
		//$this->showView('pathway');
		?>
		<h1><?php echo $article->title; ?></h1>
		<?php 
		if (count($images))
		{
			echo '<div class="articleBody">';
		}
		else
		{
			if ($article->important)
			{
				$article->body = str_replace('<p>', '<p class="half">', $article->body);
			}
		}
		//$this->showView('share'); 
		echo htmlspecialchars_decode($article->body); 
		if (strlen($article->video) == 11)
		{
			echo '<iframe width="400" height="300" src="http://www.youtube.com/embed/'.$article->video.'" frameborder="0" allowfullscreen></iframe>';
		}
		
		if (count($images))
		{
			echo '</div>';
			$this->showView('gallery_preview');
		}
		?>
	</div>
</div>