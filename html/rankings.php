<?php
$this->showView('sticky_header');
var_dump($teams);
?>

<div>
	<div class="info_inner">
		<h3><?php echo $lang['Rankings']; ?></h3>
		<div><p><?php echo $lang['These are the people with<br/> best times in our room!']; ?></p></div>
		<div class="top"><?php echo $lang['top 3 teams']; ?></div>
		<div class="nth_row">
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
							<span><?php echo $teams[$i]->team; ?></span>
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
		<div class="nth_row">
			<div class="rest" id="third_place">
			<a href="<?php echo ROOT_URL; ?>images/rankings/image3.png" data-lightbox="example-4"><img src="<?php echo ROOT_URL; ?>images/rankings/image3.png" alt=""/></a>
				<div class="timings">
					<div><span><?php echo $lang['Team friends']; ?></span><img src="<?php echo ROOT_URL; ?>images/record.png"></div>
				</div>
			</div>
			<div class="rest" id="fourth_place">
			<a href="<?php echo ROOT_URL; ?>images/rankings/image4.png" data-lightbox="example-6"><img src="<?php echo ROOT_URL; ?>images/rankings/image4.png" alt=""/></a>
				<div class="timings">
					<div><span><?php echo $lang['Team friends']; ?></span><img src="<?php echo ROOT_URL; ?>images/record.png"></div>
				</div>
			</div>
			<div class="rest" id="fourth_place">
			<a href="<?php echo ROOT_URL; ?>images/rankings/image4.png" data-lightbox="example-5"><img src="<?php echo ROOT_URL; ?>images/rankings/image4.png" alt=""/></a>
				<div class="timings">
					<div><span><?php echo $lang['Team friends']; ?></span><img src="<?php echo ROOT_URL; ?>images/record.png"></div>
				</div>
			</div>	
		</div>
		<div class="nth_row">
			<div class="rest" id="third_place">
			<a href="<?php echo ROOT_URL; ?>images/rankings/image4.png" data-lightbox="example-7"><img src="<?php echo ROOT_URL; ?>images/rankings/image4.png" alt=""/></a>
				<div class="timings">
					<div><span><?php echo $lang['Team friends']; ?></span><img src="<?php echo ROOT_URL; ?>images/record.png"></div>
				</div>
			</div>
			<div class="rest" id="fourth_place">
			<a href="<?php echo ROOT_URL; ?>images/rankings/image4.png" data-lightbox="example-8"><img src="<?php echo ROOT_URL; ?>images/rankings/image4.png" alt=""/></a>
				<div class="timings">
					<div><span><?php echo $lang['Team friends']; ?></span><img src="<?php echo ROOT_URL; ?>images/record.png"></div>
				</div>
			</div>
			<div class="rest" id="fourth_place">
			<a href="<?php echo ROOT_URL; ?>images/rankings/image4.png" data-lightbox="example-9"><img src="<?php echo ROOT_URL; ?>images/rankings/image4.png" alt=""/></a>
				<div class="timings">
					<div><span><?php echo $lang['Team friends']; ?></span><img src="<?php echo ROOT_URL; ?>images/record.png"></div>
				</div>
			</div>
		</div>
		</div>
</div>