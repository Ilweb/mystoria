<div class="container">
<h1><?php echo $lang['Articles']; ?></h1>
<div class="row">
	<div class="col-sm-6"><a class="add btn btn-primary btn-block" href="index.php?content=articles&action=edit"><?php echo $lang['New article']; ?></a></div>
	<div class="col-sm-6">
		<select name="category" class="form-control">
		<?php
		echo '<option value="0">'.$lang['All categories'].'</option>';
		while ($cat = $categories->fetch_object())
		{
			echo '<option value="'.$cat->id.'">'.$cat->category.'</option>';
		}
		?>
		</select>
	</div>
</div>
<?php
if ($pages > 1)
{
	$this->pages($page, $pages);
}
?>
<div class="table-responsive">          
  <table class="table">
		<tr>
			<th>#</th>
			<th style="width: 120px;">-</th>
			<th><?php echo $lang['Language']; ?> </th>
			<th style="width: 60px;">-</th>
			<th><?php echo $lang['Title']; ?></th>
			<th><?php echo $lang['Category']; ?></th>
			<th><?php echo $lang['Publish date']; ?></th>
		</tr>
		<?php 
		$i = 0;	
		while ($article = $result->fetch_object())
		{
			$i++;
			if ($i % 2)
			{
				$class = 'odd';
			}
			else
			{
				$class = 'even';
			}
			?>
			<tr class="<?php echo $class.' article'.$article->id; ?>">
				<td><?php echo $article->id; ?></td>
				<td>
					<a class="edit btn btn-primary btn-md" href="index.php?content=articles&action=edit&id=<?php echo $article->id; ?>" title="<?php echo $lang['Edit']; ?>"><i class="fa fa-edit"></i></a>
					<a class="delete btn btn-danger btn-md" onclick="deleteArticle(<?php echo $article->id; ?>);"><i class="fa fa-close"></i></a>
				</td>
				<td>
					<?php
					switch ($article->lang)
					{
						case 'bg':
							echo '<img src="'.IMAGE_URL.'flags/bg.png" alt="bg" title="'.$lang['Bulgarian'].'" />';
							break;
						case 'en':
							echo '<img src="'.IMAGE_URL.'flags/en.png" alt="en" title="'.$lang['English'].'" />';
							break;
						case 'ru':
							echo '<img src="'.IMAGE_URL.'flags/ru.png" alt="ru" title="'.$lang['Russian'].'" />';
							break;
					}
					?>
				</td>
				<td>
				<?php 
				if ($article->important)
				{
					echo '<span class="ui-icon ui-icon-pause" style="float: left;" title="'.$lang['Important'].'"></span> ';
				}
				if ($article->feedback)
				{
					echo '<span class="ui-icon ui-icon-contact" style="float: left;" title="'.$lang['Feedback'].'"></span> ';
				}
				if ($article->featured)
				{
					echo '<span class="ui-icon ui-icon-star" style="float: left;" title="'.$lang['Featured'].'"></span> ';
				}
				?>
				</td>
				<td>
					<?php 
					echo '<a href="'.ROOT_URL.$article->lang.'/'.$article->cat_url.'/'.$article->url.'.html" target="_blank">'.$article->title.'</a>'; 
					?>
				</td>
				<td>
					<?php 
					echo $article->category; 
					if ($article->parent != "")
					{
						echo ' -> '.$article->parent;
					}
					echo ' -> '.$article->submenu;
					?>
				</td>
				<td>
					<?php 
					if (!$article->publish_date)
					{
						$article->publish_date = $lang['Never']; 
					}
					if ($article->published)
					{
						echo $article->publish_date;
					}
					else
					{
						echo '<span class="red">'.$article->publish_date.'</span>';
					}
					?>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
</div>
<script type="text/javascript">
jQuery('select[name="category"]').val('<?php echo $category; ?>');
jQuery(".page").change(function()
{
	jQuery("body > .container").load("index.php",
	{
		content: "articles",
		page: jQuery(".page:checked").val(),
		category: jQuery('select[name="category"]').val()
	});
});
jQuery('select[name="category"]').change(function()
{
	jQuery("body > .container").load("index.php",
	{
		content: "articles",
		page: 1,
		category: jQuery(this).val()
	});
});

function deleteArticle(id)
{
	if (confirm("<?php echo $lang['Delete article q']; ?> #"+id+"?"))
	{
		jQuery.get("index.php",
		{
			content: "articles",
			action: "delete",
			article: id
		});
		jQuery(".article"+id).hide(1000);
	}
}
</script>