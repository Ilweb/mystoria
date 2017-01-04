<div class="dark">
	<h1><?php echo $title; ?></h1>
	<form action="index.php" method="post" id="form" enctype="multipart/form-data">
	<input type="hidden" name="content" value="Articles" />
	<input type="hidden" name="action" value="save" />
	<input type="hidden" name="id" value="<?php echo $article->id; ?>"/>
	<table class="full">
		<tr class="line">
			<th><?php echo $lang['Language']; ?></th>
			<td>
				<input class="checkButton" type="radio" name="lang" id="c_bg" value="bg" />
				<label for="c_bg"><img src="<?php echo IMAGE_URL.'flags/bg.png'; ?>" alt="bg" title="български" /></label>
				
				<input class="checkButton" type="radio" name="lang" id="c_en" value="en" />
				<label for="c_en"><img src="<?php echo IMAGE_URL.'flags/en.png'; ?>" alt="en" title="English" /></label>
			</td>
		</tr>
		<tr class="line">
			<th><?php echo $lang['Title']; ?></th>
			<td><input class="textbox required" type="text" name="title" value="<?php echo $article->title; ?>"/></td>
		</tr>
		<tr class="line">
			<th><?php echo $lang['Category']; ?></th>
			<td>
				<select name="category">
					<?php
					while ($cat = $categories->fetch_object())
					{
						echo '<option value="'.$cat->id.'"';
						if ($cat->id == $article->category)
						{
							echo ' selected="selected"';
						}
						echo '>'.$cat->category.'</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<tr class="line">
			<th><?php echo $lang['Submenu']; ?></th>
			<td>
				<select name="submenu">
					<option value="0"></option>
				</select>
			</td>
		</tr>
		<tr class="line">
			<th><?php echo $lang['Publish date']; ?></th>
			<td><input class="date" type="text" name="publish_date" value="<?php echo $article->publish_date; ?>"/></td>
		</tr>
		<tr class="line">
			<th>Featured</th>
			<td><input type="checkbox" name="featured" <?php if ($article->featured) echo 'checked="checked"'; ?> value="1"/></td>
		</tr>
		<tr class="line" style="display:none;">
			<th><?php echo $lang['Important']; ?></th>
			<td><input type="checkbox" name="important" <?php if ($article->important) echo 'checked="checked"'; ?> value="1"/></td>
		</tr>
		<tr class="line" style="display:none;">
			<th><?php echo $lang['Feedback']; ?></th>
			<td><input type="checkbox" name="feedback" <?php if ($article->feedback) echo 'checked="checked"'; ?> value="1"/></td>
		</tr>
		<tr class="line">
			<th colspan="2"><?php echo $lang['Body']; ?></th>
		</tr>
		<tr class="line">
			<td colspan="2">
				<textarea class="tinymce" name="body" style="width: 95%; height: 350px;"><?php echo $article->body; ?></textarea>
			</td>
		</tr>
		<?php 
		if (!$article->id)
		{
			?>
			<tr class="line">
				<th><?php echo $lang['Upload image']; ?></th>
				<td><input type="file" name="image_file" /></td>
			</tr>
			<?php
		}
		else
		{
			?>
			<tr class="line">
				<td colspan="2"><iframe src="index.php?content=articles&action=editGallery&id=<?php echo $article->id; ?>" frameborder="0" style="border:none; width:100%; height:320px;" allowTransparency="true"></iframe></td>
			</tr>
			<?php
		}
		?>
		<tr class="line">
			<th><?php echo $lang['YouTube video']; ?></th>
			<td><input class="textbox" type="text" name="video" value="<?php echo $article->video; ?>"/></td>
		</tr>
		<tr>
			<td colspan="2" class="videoHere">
			<?php
			if (strlen($article->video) == 11)
			{
				echo '<iframe width="600" height="340" src="http://www.youtube.com/embed/'.$article->video.'" frameborder="0" allowfullscreen></iframe>';
			}
			?>
			</td>
		</tr>
	</table>
	<div style="clear: both; padding: 5px 0;">
		<a class="submit"><?php echo $lang['Save']; ?></a>
		<a class="cancel" href="index.php?content=articles"><?php echo $lang['Cancel']; ?></a>
	</div>
</div>
<script type="text/javascript">
jQuery("#c_<?php echo $article->lang; ?>").attr("checked", "checked");
function loadParents()
{
	jQuery.post("index.php",
	{
		content: "Articles",
		action: "loadParents",
		category: jQuery('select[name="category"]').val(),
		lang: jQuery('input[name="lang"]:checked').val()
	},
	function(data)
	{
		jQuery('select[name="submenu"]').html('<option value="0"></option>');
		jQuery('select[name="submenu"]').append(data);
		jQuery('select[name="submenu"]').val(<?php echo $article->submenu; ?>);
	});
}
prepareUI();
loadParents();
jQuery('select[name="category"], input[name="lang"]').change(function()
{
	loadParents();
});
jQuery('input[name="video"]').change(function()
{
	jQuery(".videoHere").html('');
	jQuery.post("index.php",
	{
		content: "articles",
		action: "youtubeLink",
		url: jQuery(this).val()
	},
	function(data)
	{
		jQuery('input[name="video"]').val(data);
		if (data.length)
		{
			jQuery(".videoHere").html('<iframe width="600" height="340" src="http://www.youtube.com/embed/'+data+'" frameborder="0" allowfullscreen></iframe>');
		}
	});
});
jQuery(".submit").click(function()
{
	if (validate('#form'))
	{
		jQuery.post("index.php",
		{
			content: "articles",
			action: "checkUrl",
			id: '<?php echo $article->id; ?>',
			title: jQuery('input[name="title"]').val()
		},
		function(data)
		{
			if (data == "OK")
			{
				jQuery("#form").submit();
			}
			else
			{
				jQuery('input[name="title"]').addClass('invalid1');
				jQuery(".alertDlg").html('<?php echo $lang['Choose another title']; ?>');
				jQuery(".alertDlg").dialog("open");
			}
		});
	}
	else
	{
		jQuery(".alertDlg").html('<?php echo $lang['Fill in red']; ?>');
		jQuery(".alertDlg").dialog("open");
	}
});
</script>
</form>