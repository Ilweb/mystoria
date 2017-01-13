<?php
$this->showView('sticky_header');
?>
<div class="backVP">
<?php
foreach ($promos as $key => $p)
{
	if (($key + 1) % 2 == 0)
	{
		?>
		<div class="first_chos second_chos" >
			<div>
				<div><img src="<?php echo ROOT_URL; ?>images/FAQ/arrow.png"></div>
				<div>
					<div>
					<?php echo $p->title; ?>
					</div>
					<div>
					<?php echo $p->body; ?>
					</div>
					<?php
					if ($p->featured)
					{
						?>
						<div class="choose second">
							<div><?php echo $lang['RESERVE NOW']; ?></div>
						</div>
						<?php
					}
					?>
				</div>
				
			</div>
		</div>
		<?php
	}
	else if (($key + 1) % 3 == 1)
	{
		?>
		<div class="first_chos">
			<div>
				<div>
					<div><?php echo $p->title; ?></div>
					<div><?php echo $p->body; ?></div>
					<?php
					if ($p->featured)
					{
						?>
						<div class="choose second">
							<div><?php echo $lang['RESERVE NOW']; ?></div>
						</div>
						<?php
					}
					?>
				</div>
				<div><img src="<?php echo ROOT_URL; ?>images/FAQ/ship.png"></div>
			</div>
		</div>
		<?php
	}
	if (($key + 1) % 3 == 0)
	{
		?>
		<div class="first_chos third_chos">
			<div>
				<div>
					<div>
					<?php echo $p->title; ?>
					</div>
					<div>
					<?php echo $p->body; ?>
					</div>
					<?php
					if ($p->featured)
					{
						?>
						<div class="choose second">
							<div><?php echo $lang['RESERVE NOW']; ?></div>
						</div>
						<?php
					}
					?>
				</div>
				<div><img src="<?php echo ROOT_URL; ?>images/FAQ/book.png"></div>
			</div>
		</div>
		<?php
	}
}
?>
</div>