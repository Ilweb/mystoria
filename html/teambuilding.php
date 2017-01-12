<?php
$this->showView('sticky_header');
?>
<div class="back team">
	<div><span><?php echo $lang['Team building']; ?></span><img src="<?php echo ROOT_URL; ?>images/logo.png"></div>
</div>
<div class="additional_info">
	<div>
		<div>
			<?php
			for ($i = 0; $i <= 1 && isset($team[$i]); $i++)
			{
				?>
				<div class="first_info">
					<?php echo $team[$i]->body; ?>
				</div>
				<?php
			}
						?>
		</div>
		<div class="fst_img"></div>
	</div>
	<div>
	<div class="sec_img"></div>
		<div>
			<?php
			for ($i = 2; $i <= 3 && isset($team[$i]); $i++)
			{
				?>
				<div class="first_info">
					<?php echo $team[$i]->body; ?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<div class="contacts">
	<div>
		<div>
			<div><?php echo $lang['Phone number']; ?></div>
			<div><a href="tel:+359 888 11 22 33">+359 888 11 22 33</div>
		</div>
		<div>
			<div><?php echo $lang['Email']; ?></div>
			<div><a href="mailto:hello@escapemystoria.com">hello@escapemystoria.com</a></div>
		</div>
	</div>
	<div class="moon">
		<img src="<?php echo ROOT_URL; ?>images/team/moons.png">
	</div>
</div>