<p>Total <?php echo $count ?> reservations matching the filter</p>
<table class="table table-striped table-hover table-responsive">
	<thead>
		<tr>
			<th>-</th>
			<th>ID</th>
			<th>Date & Time</th>
			<th>Name</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($reservations as $r)
	{
		echo '<tr>';
		echo '<td><a class="btn btn-primary btn-xs" href="'.ROOT_URL.'index.php?content=reservations&action=edit&id='.$r->id.'"><i class="fa fa-edit"></i> Edit</a></td>';
		echo '<td>'.$r->id.'</td>';
		echo '<td>'.date('d.m.Y H:i', strtotime($r->start_time)).'</td>';
		echo '<td>'.$r->name.'</td>';
		echo '<td><strong>'.$r->status.'</strong></td>';
		echo '</tr>';
	}
	?>
	</tbody>
</table>
<?php
if (isset($pages) && ($pages > 1))
{
	?>
	<ul class="pagination">
	<?php
	if ($page > 1)
	{
		?>
		<li><a href="#" data-page="<?php echo $page - 1; ?>" data-toggle="tooltip" title="Previous page"><span class="fa fa-chevron-left"></span></a></li>
		<?php
	}
	for ($i = 1; $i <= $pages; $i++)
	{
		if (($i == 1) || ($i == $pages) || (($i > $page - 3) && ($i < $page + 3)))
		{
			echo '<li'.($page == $i ? ' class="active"' : '').'><a href="#" data-page="'.$i.'">'.$i.'</a></li>';
		}
	}
	if ($page < $pages)
	{
		?>
		<li><a href="#" data-page="<?php echo $page + 1; ?>" data-toggle="tooltip" title="Next page"><span class="fa fa-chevron-right"></span></a></li>
		<?php
	}
	?>
	</ul>
	<?php
}
?>