<?php
$this->showView('sticky_header');
?>
<div class="back team">
	<div><span><?php echo $lang['Team building']; ?></span><img src="<?php echo ROOT_URL; ?>images/logo.png"></div>
</div>
<div class="additional_info">
	<div>
		
			<?php
			foreach ($team as $key => $t)
			{
				if ($key % 2)
				{
					?>
					<div>
						<div class="first_info">
							<?php echo $t->body;?>
						</div>
					</div>
					<div class="fst_img" <?php if (isset($t->image)) echo 'style="background-image: url(../images/articles/'.$t->id.'/'.$t->image.')"' ?>></div>
					<?php
				}
				else
				{
					?>
					<div class="sec_img" <?php if (isset($t->image)) echo 'style="background-image: url(../images/articles/'.$t->id.'/'.$t->image.')"' ?>></div>
					<div>
						<div class="sec_info">
							<?php echo $t->body; ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		
	</div>
</div>
<div class="contacts">
	<div>
		<div>
			<div><?php echo $lang['Phone number']; ?></div>
			<div><a href="tel:<?php echo $settings['Contact Phone']; ?>"><?php echo $settings['Contact Phone']; ?></div>
		</div>
		<div>
			<div><?php echo $lang['Email']; ?></div>
			<div><a href="mailto:<?php echo $settings['Contact email']; ?>"><?php echo $settings['Contact email']; ?></a></div>
		</div>
	</div>
	<div class="moon">
		<img src="<?php echo ROOT_URL; ?>images/team/moons.png">
	</div>
</div>