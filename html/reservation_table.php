<p>Total <?php echo $count ?> reservations matching the filter</p>
<table class="table table-striped table-hover table-responsive">
	<thead>
		<tr>
			<th>Edit</th>
			<th>ID</th>
			<th>Date & Time</th>
			<th>Name</th>
			<th>Phone</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($reservations as $r)
	{
		echo '<tr>';
		echo '<td>';
		echo '<a class="btn btn-primary btn-xs" href="'.ROOT_URL.'index.php?content=reservations&action=edit&id='.$r->id.'"><i class="fa fa-edit"></i> Edit</a>';
		echo '</td>';
		echo '<td>'.$r->id.'</td>';
		echo '<td>'.date('d.m.Y H:i', strtotime($r->start_time)).'</td>';
		echo '<td>'.$r->name.'</td>';
		echo '<td>'.$r->phone.'</td>';
		echo '<td><strong>'.$r->status.'</strong></td>';
		echo '<td>';
		if (in_array($r->status, array("pending", "confirmed")) && (strtotime($r->start_time) < time()))
		{
			echo '<a class="btn btn-success btn-xs" href="'.ROOT_URL.'index.php?content=reservations&action=edit&id='.$r->id.'&state=completed"><i class="fa fa-check"></i> Complete</a>';
		}
		elseif ($r->status == "pending")
		{
			echo '<a class="btn btn-warning btn-xs" onclick="statusConfirm('.$r->id.')"><i class="fa fa-check"></i> Confirm</a>';
		}
		elseif ($r->status == "completed")
		{
			if ($r->time)
			{
				echo '<a class="btn btn-link btn-xs" data-toggle="tooltip" title="'.$r->time.'"><i class="fa fa-clock-o"></i></a>';
			}
			if ($r->image)
			{
				echo '<a class="btn btn-link btn-xs" data-toggle="tooltip" title="'.$r->team.'" target="_blank" href="'.IMAGE_URL.'reservations/'.$r->id.'/'.$r->image.'"><i class="fa fa-image"></i></a>';
			}
		}
		echo '</td>';
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
<script type="text/javascript">
$('[data-toggle="tooltip"]').tooltip(); 
</script>