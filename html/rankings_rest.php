<div class="nth_row">
	<?php
	foreach ($teams as $i => $team)
	{
		if ($i % 3 == 0)
		{
			echo '</div><div class="nth_row">';
		}
	
		$large =  $this->thumbnail(
			'reservations/'.$teams[$i]->id.'/'.$teams[$i]->image, 
			1024,
			array(
				"crop"=>(383/295)
			)
		);
		
		$small =  $this->thumbnail(
			'reservations/'.$teams[$i]->id.'/'.$teams[$i]->image, 
			383,
			array(
				"crop"=>(383/295)
			)
		);
		?>
		<div class="rest">
			<a href="<?php echo $large; ?>" data-lightbox="team-<?php echo $i; ?>">
			<img  class="teamrank" src="<?php echo $small; ?>" alt="Team <?php echo $teams[$i]->team; ?>"/></a>
			<div class="timings">
				<div>
					<span><?php echo (($page - 1) * 6 + $i + 4).'. '.$teams[$i]->team; ?></span>
					<img src="<?php echo ROOT_URL; ?>images/record.png"/>
					<i><?php echo $teams[$i]->time; ?></i>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>
<?php
if (isset($pages) && ($pages > 1))
{
	?>
	<ul class="pagination">
	<?php
	if ($page > 1)
	{
		?>
		<li><a data-page="<?php echo $page - 1; ?>" data-toggle="tooltip" title="Previous page"><span class="fa fa-chevron-left"></span></a></li>
		<?php
	}
	for ($i = 1; $i <= $pages; $i++)
	{
		if (($i == 1) || ($i == $pages) || (($i > $page - 3) && ($i < $page + 3)))
		{
			echo '<li'.($page == $i ? ' class="active"' : '').'><a data-page="'.$i.'">'.$i.'</a></li>';
		}
	}
	if ($page < $pages)
	{
		?>
		<li><a data-page="<?php echo $page + 1; ?>" data-toggle="tooltip" title="Next page"><span class="fa fa-chevron-right"></span></a></li>
		<?php
	}
	?>
	</ul>
	<?php
}
?>