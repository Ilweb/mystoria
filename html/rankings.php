<?php
$this->showView('sticky_header');
?>

<div>
	<div class="info_inner">
		<h3><?php echo $lang['Rankings']; ?></h3>
		<div><p><?php echo $lang['These are the people with<br/> best times in our room!']; ?></p></div>
		<div class="top"><?php echo $lang['top 3 teams']; ?></div>
		<div class="nth_row ">

		<?php
		for ($i = 0; $i < 3; $i++)
		{
			if (isset($teams[$i]))
			{
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
				<div>
					<a href="<?php echo $large; ?>" data-lightbox="team-<?php echo $i; ?>"><img src="<?php echo $small; ?>" alt="Team <?php echo $teams[$i]->team; ?>"/></a>
					<div class="timings">
						<div>
							<span><?php echo ($i + 1).'. '.$teams[$i]->team; ?></span>
							<img src="<?php echo ROOT_URL; ?>images/record.png"/>
							<i><?php echo $teams[$i]->time; ?></i>
						</div>
					</div>
				</div>
				<?php
			}
		}
		?>
		</div>	
		<div class="other"><?php echo $lang['The rest of participants']; ?></div>
		<div id="restRankings"></div>
	</div>
</div>

<script type="text/javascript">

function loadRankings(page)
{
	$("#restRankings").load("<?php echo ROOT_URL ?>",
	{
		content: "main",
		action: "restRankings",
		"page": page
	});
}

loadRankings(1);

jQuery("#restRankings").on("click", ".pagination a", function()
{
	loadRankings(jQuery(this).data("page"));
});

</script>