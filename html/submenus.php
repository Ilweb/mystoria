<div class="ui-widget-header">
	<a class="add" onclick="newSubmenu()"><?php echo $lang['New record']; ?></a>
</div>
<table class="full">
	<tr class="ui-widget-header">
		<th>#</th>
		<th><?php echo $lang['Language']; ?></th>
		<th><?php echo $lang['Title']; ?></th>
		<th><?php echo $lang['Order']; ?></th>
		<th style="width: 80px;">-</th>
	</tr>
	<?php 
	foreach ($submenus as $i => $submenu)
	{
		if ($i % 2)
		{
			$class = 'even';
		}
		else
		{
			$class = 'odd';
		}
		?>
		<tr class="<?php echo $class.' submenu'.$submenu->id; ?>">
			<td><?php echo $submenu->id; ?></td>
			<td><img src="<?php echo IMAGE_URL.'flags/'.$submenu->lang.'.png'; ?>" alt="<?php echo $submenu->lang; ?>" /></td>
			<td>
			<?php 
			echo $lang[$submenu->category].' -> '; 
			if (isset($submenu->parent))
			{
				echo $submenu->parent.' -> '; 
			}
			echo '<b>'.$submenu->title.'</b>';
			?>
			</td>
			<td><?php echo $submenu->order_no; ?></td>
			<td>
				<a class="edit" onclick="loadSubmenu(<?php echo $submenu->id; ?>);"><?php echo $lang['Edit']; ?></a>
				<a class="delete" onclick="deleteSubmenu(<?php echo $submenu->id; ?>);"><?php echo $lang['Delete']; ?></a>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<div class="dialog alertDlg"></div>
<div class="dialog editDlg"></div>
<div style="clear: both;"></div>
<script type="text/javascript">
jQuery(".alertDlg").dialog({
	modal: true,
	autoOpen: false,
	resizable: false,
	title: "<?php echo $lang['Caution']; ?>",
	buttons: {
		"<?php echo $lang['OK']; ?>": function()
		{
			jQuery(this).dialog("close");
		}
	}
});
jQuery(".editDlg").dialog({
	autoOpen: false,
	width: 400,
	buttons: {
		"<?php echo $lang['Save']; ?>": function()
		{
			saveMenu();
		},
		"<?php echo $lang['Cancel']; ?>":function()
		{
			jQuery(this).dialog("close");
		}
	}
});
function loadSubmenu(sid)
{
	jQuery(".editDlg").load("index.php",
	{
		content: "Submenus",
		action: "edit",
		id: sid
	});
	jQuery(".editDlg").dialog("option", "title", "<?php echo $lang['Edit record']; ?>");
	jQuery(".editDlg").dialog("open");
}

function newSubmenu()
{
	jQuery(".editDlg").load("index.php",
	{
		content: "Submenus",
		action: "edit"
	});
	jQuery(".editDlg").dialog("option", "title", "<?php echo $lang['New record']; ?>");
	jQuery(".editDlg").dialog("open");
}

function deleteSubmenu(id)
{
	if (confirm("<?php echo $lang['Delete record q']; ?> #"+id+"?"))
	{
		jQuery.get("index.php",
		{
			content: "Submenus",
			action: "delete",
			submenu: id
		});
		jQuery(".submenu"+id).hide(1000);
	}
}
</script>