<?php
$this->showView('adminNav');
?>
<div class="container">
	<div class="dark">
		<h1><?php echo $title; ?></h1>
			<form action="index.php" method="post" id="form" enctype="multipart/form-data">
			<input type="hidden" name="content" value="Articles" />
			<input type="hidden" name="action" value="save" />
			<input type="hidden" name="id" value="<?php echo $article->id; ?>"/>
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group required">
						<label for="title"><?php echo $lang['Title']; ?></label>
						<input class="form-control textbox required" id="title" type="text" name="title" value="<?php echo $article->title; ?>"/>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group required">
						<label  for="flang"><?php echo $lang['Language']; ?></label>
						<div class="checkbox " style="border: none;">
							<input type="radio" class="checkButton" id="c_bg" name="lang" value="bg" />
						 	<label for="c_bg" >
                   				  <img src="<?php echo IMAGE_URL.'flags/bg.png'; ?>">
                			</label> 
							<input type="radio" class="checkButton" id="c_en" name="lang" value="en" />
							<label for="c_en" >
                   				  <img src="<?php echo IMAGE_URL.'flags/en.png'; ?>" alt="en" title="English" />
                			</label>
        				</div>
        			</div>
    			</div>	
			</div>	
			<div class="row">	
				<div class="col-sm-4">
					<div class="form-group">
						<label for="fcategory"><?php echo $lang['Category']; ?></label>
							<select name="category" id="fcategory" class="form-control">
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
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group required">
						<label for="fsubmenu"><?php echo $lang['Submenu']; ?></label>
						<select name="submenu" id="fsubmenu" class="form-control">
							<option value="0"></option>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group required">
						<label for="datepicker"><?php echo $lang['Publish date']; ?></label>
					  	<div class='input-group date' id='datepicker'>
		                    <input type='text' id="datepicker" class="form-control" name="publish_date" value="<?php echo $article->publish_date; ?> " />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group required">Featured
						<input type="checkbox" name="featured" <?php if ($article->featured) echo 'checked="checked"'; ?> value="1"/>
					</div>
				</div>
			</div>
				<div class="line" style="display:none;">
					<div class="row">
						<div class="col-lg-6 "><?php echo $lang['Important']; ?></div>
						<div class="col-lg-6">
							<input type="checkbox" name="important" <?php if ($article->important) echo 'checked="checked"'; ?> value="1"/>
						</div>
					</div>
				</div>
				<div class="line" style="display:none;">
					<div class="row">
						<div class="col-lg-6 "><?php echo $lang['Feedback']; ?></div>
						<div class="col-lg-6">
							<input type="checkbox" name="feedback" <?php if ($article->feedback) echo 'checked="checked"'; ?> value="1"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group required"><?php echo $lang['Body']; ?>
						</div>
					</div>
				<div class="col-sm-12">
					<div colspan="2">
						<textarea class="tinymce" name="body" style="width: 95%; height: 350px;"><?php echo $article->body; ?></textarea>
					</div>
				</div>
					<?php 
					if (!$article->id)
					{
						?>
						</div>
				<div class="row">
					<div class="col-sm-8">
						<label class="btn btn-info btn-block btn-file" style="margin: 20px 0 20px 0;">
						Upload file<input type="file" name="image_file" style="display: none;" onchange="$('#upload-file-info').html($(this).val());"/></label>
						<span class="label label-info" id="upload-file-info"></span>
					</div>
					<div class="col-sm-4"  >
						<input type="submit" class="button btn btn-warning btn-block"  value="Качи снимка" style="margin: 20px 0 20px 0;">
					</div>
				</div> 	
						<?php
					}
					else
					{
						?>
				<div class="col-lg-12">
					<div class="form-group required">
						<div colspan="2"><iframe src="index.php?content=articles&action=editGallery&id=<?php echo $article->id; ?>" frameborder="0" style="border:none; width:100%; height:320px;" allowTransparency="true"></iframe></div>
					</div>
				</div>
				<?php
			}
		?>
				<div class="col-sm-12">
					<div class="form-group required"><?php echo $lang['YouTube video']; ?>
						<input class="textbox" type="text" name="video" value="<?php echo $article->video; ?>"/>
					</div>
				</div>
				<?php
				if (strlen($article->video) == 11)
				{
					echo '<iframe width="600" height="340" src="http://www.youtube.com/embed/'.$article->video.'" frameborder="0" allowfullscreen></iframe>';
				}
				?>
			<div class= "row" style="clear: both; padding: 5px 0;">
				<div class="col-sm-6">
					<a class="submit btn btn-block btn-primary"><?php echo $lang['Save']; ?></a>
				</div>
				<div class="col-sm-6">
					<a class="cancel btn btn-block btn-warning" href="index.php?content=articles"><?php echo $lang['Cancel']; ?></a>
				</div>
			</div>
		</div>
	</div>
	<script>
  $( function() {
    $( "#datepicker" ).datepicker({
    	  format: 'dd.mm.yyyy'

    });

  } );
  </script>
<script type="text/javascript">
jQuery("#c_<?php echo $article->lang; ?>").prop("checked", true);

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
				//jQuery(".alertDlg").html('<?php echo $lang['Choose another title']; ?>');
				//jQuery(".alertDlg").dialog("open");
				alert('<?php echo $lang['Choose another title']; ?>');
			}
		});
	}
	else
	{
		//jQuery(".alertDlg").html('<?php echo $lang['Fill in red']; ?>');
		//jQuery(".alertDlg").dialog("open");
		alert('<?php echo $lang['Fill in red']; ?>');
	}
});
</script>
</form>