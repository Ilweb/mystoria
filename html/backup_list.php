<?php
if ($message != "")
{ 
	echo '<p class="ui-state-highlight">'.$message.'</p>'; 
}
?>
<p><a class="button" href="index.php?content=backup&action=dump"><?php echo $lang['New backup']; ?></a></p>
<table class="full">
<tr class="ui-widget-header">
	<th>-</th>
	<th><?php echo $lang['Backup filename']; ?></th>
	<th><?php echo $lang['Size']; ?></th>
</tr>
	<?php
	foreach (array_reverse($files) as $key=>$file)
	{
		if (!is_dir(DUMP_DIR.$file))
		{
			if ($key % 2)
			{
				$class = 'even';
			}
			else
			{
				$class = 'odd';
			}
			$dimension = ' M';
			$size = round(filesize(DUMP_DIR.$file) / (1024 * 1024), 2);
			if ($size == 0)
			{
				$dimension = ' K';
				$size = round(filesize(DUMP_DIR.$file) / 1024, 2);
			}
			$size .= $dimension;
			?>
			<tr class="backup<?php echo $key.' '.$class; ?>">
				<td class="tools" style="width: 300px;">
					<a class="restore" href="index.php?content=backup&action=restore&file=<?php echo $file; ?>"><?php echo $lang['Restore']; ?></a>
					<a class="delete" onclick="deleteBackup(<?php echo "'$file', $key"; ?>)"><?php echo $lang['Delete']; ?></a>
				</td>
				<td class="id" style="width: auto;"><a href="<?php echo DUMP_URL.$file; ?>"><?php echo $file; ?></a></td>
				<td><?php echo $size; ?></td>
			</tr>
			<?php
		}
	}
	?>
</table>
<script type="text/javascript">
function deleteBackup(filename, key)
{
	if (confirm('<?php echo $lang['Delete backup q']; ?> '+filename+'?'))
	{
		jQuery(".backup"+key).hide();
		jQuery.post("index.php",
		{
			content: "backup",
			action: "delete",
			file: filename
		});
	}
}
</script>