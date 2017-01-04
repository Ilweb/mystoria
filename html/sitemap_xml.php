<?php
header ("Content-Type:text/xml");  
echo '<?xml version="1.0" encoding="UTF-8"?>';
$domain = DOMAIN;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
		xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
		<url>
			<loc><?php echo "http://".$domain.ROOT_URL.$locale.'contacts.html'; ?></loc>
		</url>
		<?php
		if ($locale == 'bg/')
		{
			?>
			<url>
				<loc><?php echo "http://".$domain.ROOT_URL.$locale.'semeen-hotel-akladi.html'; ?></loc>
			</url>
			<url>
				<loc><?php echo "http://".$domain.ROOT_URL.$locale.'tseni.html'; ?></loc>
			</url>
			<?php
		}
		
		while ($category = $categories->fetch_object())
		{
			?>
			<url>
				<loc><?php echo "http://".$domain.ROOT_URL.$locale.$category->url.'/'; ?></loc>
			</url>
			<?php
		}
		while ($article = $articles->fetch_object())
		{
			?>
			<url>
				<loc><?php echo "http://".$domain.ROOT_URL.$locale.$article->cat_url.'/'.$article->url.'.html'; ?></loc>
				<lastmod><?php echo $article->lastmod; ?></lastmod>
				<?php
				$dir = 'articles/'.$article->id;
				$images = RichController::getImages($dir);
				$prps = array(
					"byHeight"=>true,
					"watermark"=>!true
				);
				foreach ($images as $key => $image)
				{
					?>
					<image:image>
						<image:loc><?php echo "http://".$domain.View::thumbnail($dir.'/'.$image,  600, $prps); ?></image:loc>
					</image:image>
					<?php
				}
				?>
			</url>
			<?php
		}
		?>
</urlset>