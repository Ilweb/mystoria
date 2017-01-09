
<div class="container">
<div class="pagePreview dark">
	<h1><?php echo $title ?></h1>
	<?php
	if ($_SESSION['access'] >= 1000)
	{
		?>
		<a class="add" href="index.php?content=pages&action=edit"><?php echo $lang['New page']; ?></a>
		<?php
	}
	?>

	<table class="full table table-striped table-hover table-responsive">
		<tr class="  ui-widget-header"> 
			<th>#</th>
			<th style="width: 80px;"><?php echo $lang['Edit']; ?></th>
			<th><?php echo $lang['Title']; ?></th>
		</tr>
		<?php 
		$i = 0;	
		while ($page = $pages->fetch_object())
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
			<tr class="<?php echo $class.' page'.$page->id; ?>">
				<td class="col-lg-2"><?php echo $page->id; ?></td>
				<td class="col-lg-4">
					<button type="button" class="btn btn-primary btn-md"><a href="index.php?content=pages&action=edit&id=<?php echo $page->id; ?>" ><?php echo $lang['Edit']; ?></a></button>
					<?php
					if ($_SESSION['access'] >= 1000)
					{
						?>
						<button type="button" class="btn btn-danger btn-md"><a class="delete" onclick="deletepage(<?php echo $page->id; ?>);"><?php echo $lang['Delete']; ?></a></button>
						<?php
					}
					?>
				</td>
				<td class="col-lg-6">
					<?php 
					echo $page->title; 
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
prepareUI();

function deletepage(id)
{
	if (confirm("<?php echo $lang['Delete page q']; ?> #"+id+"?"))
	{
		jQuery.get("index.php",
		{
			content: "pages",
			action: "delete",
			page: id
		});
		jQuery(".page"+id).hide(1000);
	}
}
</script>