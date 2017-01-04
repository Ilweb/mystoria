<form action="index.php" method="post" id="form" enctype="multipart/form-data"><input type="hidden" name="content" value="Submenus" /><input type="hidden" name="action" value="save" /><input type="hidden" name="id" value="<?php echo $submenu->id; ?>"/><table class="full">	<tr class="line">		<th><?php echo $lang['Language']; ?></th>		<td>			<input class="checkButton" type="radio" name="lang" id="c_bg" value="bg" />			<label for="c_bg"><img src="<?php echo IMAGE_URL.'flags/bg.png'; ?>" alt="bg" title="български" /></label>						<input class="checkButton" type="radio" name="lang" id="c_ru" value="ru" />			<label for="c_ru"><img src="<?php echo IMAGE_URL.'flags/ru.png'; ?>" alt="ru" title="русский" /></label>		</td>	</tr>	<tr class="line">		<th><?php echo $lang['Category']; ?></th>		<td>			<select name="category">				<?php				while ($cat = $categories->fetch_object())				{					echo '<option value="'.$cat->id.'"';					if ($cat->id == $submenu->category)					{						echo ' selected="selected"';					}					echo '>'.$lang[$cat->category].'</option>';				}				?>			</select>		</td>	</tr>	<tr class="line">		<th><?php echo $lang['Submenu']; ?></th>		<td>			<select name="parent_id">				<option value="0"></option>			</select>		</td>	</tr>	<tr class="line">		<th><?php echo $lang['Title']; ?></th>		<td><input class="textbox required" type="text" name="title" value="<?php echo $submenu->title; ?>"/></td>	</tr>	<tr class="line">		<th colspan="2"><?php echo $lang['Description']; ?></th>	</tr>	<tr class="line">		<td colspan="2">			<textarea name="description" style="width: 95%; height: 100px;"><?php echo $submenu->description; ?></textarea>		</td>	</tr>	<tr class="line">		<th><?php echo $lang['Upload image']; ?></th>		<td><input type="file" name="upload_file" /></td>	</tr>	<tr class="line">		<th><?php echo $lang['Image']; ?></th>		<td>			<select name="image">				<option value="">-- -- -- --</option>				<?php				foreach (scandir(IMAGE_DIR.'submenus/') as $key=>$file)				{					if (!is_dir(IMAGE_DIR.'submenus/'.$file))					{						echo '<option value="'.$file.'"';						if ($file == $submenu->image)						{							echo ' selected="selected"';						}						echo '>'.$file.'</option>';					}				}				?>			</select>		</td>	</tr>	<tr class="line">		<th><?php echo $lang['Featured']; ?></th>		<td><input type="checkbox" name="featured" <?php if ($submenu->featured) echo 'checked="checked"'; ?> value="1"/></td>	</tr>	<tr class="line">		<th><?php echo $lang['Order']; ?></th>		<td><input class="int" type="text" name="order_no" value="<?php echo $submenu->order_no; ?>"/></td>	</tr>	<tr class="line">		<th><?php echo $lang['External']; ?></th>		<td><input class="textbox" type="text" name="external" value="<?php echo $submenu->external; ?>"/></td>	</tr></table><script type="text/javascript">jQuery("#c_<?php echo $submenu->lang; ?>").attr("checked", "checked");function loadParents(){	jQuery.post("index.php",	{		content: "Submenus",		action: "loadParents",		category: jQuery('select[name="category"]').val(),		lang: jQuery('input[name="lang"]:checked').val(),		id: "<?php echo $submenu->id; ?>"	},	function(data)	{		jQuery('select[name="parent_id"]').html('<option value="0"></option>');		jQuery('select[name="parent_id"]').append(data);		jQuery('select[name="parent_id"]').val(<?php echo $submenu->parent_id; ?>);	});}prepareUI();loadParents();jQuery('select[name="category"], input[name="lang"]').change(function(){	loadParents();});function saveMenu(){	if (validate('#form'))	{		jQuery("#form").submit();	}	else	{		jQuery(".alertDlg").html('<?php echo $lang['Fill in red']; ?>');		jQuery(".alertDlg").dialog("open");	}}</script></form>