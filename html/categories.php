<div class="left">
	<div class="ui-widget-header">
		<a class="add" onclick="newCategory()"><?php echo $lang['New category']; ?></a>
	</div>
	<table>
		<tr class="ui-widget-header">
			<th>#</th>
			<th><?php echo $lang['Category']; ?></th>
			<th>Вид</th>
			<th>-</th>
		</tr>
		<?php 
		$i = 0;	
		while ($category = $categories->fetch_object())
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
			<tr class="<?php echo $class.' category'.$category->id; ?>">
				<td><?php echo $category->id; ?></td>
				<td><?php echo $category->title; ?></td>
				<td>
					<?php 
					if ($category->cat_type == 1)
					{
						echo 'Статии';
					}
					if ($category->cat_type == 2)
					{
						echo 'Продукти';
					}
					?>
				</td>
				<td>
					<a class="edit" onclick="loadCategory(<?php echo $category->id; ?>);"><?php echo $lang['Edit']; ?></a>
					<a class="delete" onclick="deleteCategory(<?php echo $category->id; ?>);"><?php echo $lang['Delete']; ?></a>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
<script type="text/javascript">
function loadCategory(cat_id)
{
	jQuery(".right").load("index.php",
	{
		content: "Categories",
		action: "edit",
		id: cat_id
	});
}

function newCategory()
{
	jQuery(".right").load("index.php",
	{
		content: "Categories",
		action: "edit"
	});
}

function deleteCategory(id)
{
	if (confirm("<?php echo $lang['Delete category q']; ?> #"+id+"?"))
	{
		jQuery.get("index.php",
		{
			content: "Categories",
			action: "delete",
			category: id
		});
		jQuery(".category"+id).hide(1000);
	}
}
</script>
<div class="right">

</div>
<div style="clear: both;"></div>