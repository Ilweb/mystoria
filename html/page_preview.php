<div class="articlePreview">
	<div class="pagePreview">
		<h1><?php echo $article->title; ?></h1>
		<?php
		//$this->showView('share'); 
		echo htmlspecialchars_decode($article->body); 
		//$this->showView('gallery_preview');
		if (strlen($article->video) == 11)
		{
			echo '<iframe width="610" height="400" src="http://www.youtube.com/embed/'.$article->video.'" frameborder="0" allowfullscreen></iframe>';
		}
		?>
	</div>
</div>