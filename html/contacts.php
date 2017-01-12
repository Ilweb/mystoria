<?php
$this->showView('sticky_header');
?>
<div class="info_inner">
	<h3><?php echo $lang['Contact us']; ?></h3>
		<div><p>Lorem ipsum dollar sit amet</p></div>
			<div class="cont_e">
				<div>
					<div class="under"><?php echo $lang['Address']; ?></div>
					<div class="under_info">
					<?php echo $lang['1504 Sofia']; ?><br>
					<?php echo $lang['Tsar Osvoboditel 15, CA 94043']; ?>
					</div>
					<div class="under"><?php echo $lang['Email']; ?></div>
					<div class="under_info"><a href="mailto:<?php echo $settings['Contact email']; ?>"><?php echo $settings['Contact email']; ?></a></div>
					<div class="under"><?php echo $lang['Phone number']; ?></div>
					<div class="under_info"><a href="tel:<?php echo $settings['Contact Phone']; ?>"><?php echo $settings['Contact Phone']; ?></a>
					</div>
				</div>
					<div class="backwo">
	<div class="id"><?php echo $lang['1504 Sofia']?> </div><div class="adress">
	<?php echo $lang['Tsar Osvoboditel 15, CA 94043']?></div><div class="email">hello@escapemystoria.com </div><div class="contact">+359 888 11 22 33</div>
</div>
				<div id="wall_5"  data-stellar-background-ratio="0.5"></div>

			</div>
</div>

<script type="text/javascript" src="<?php echo ROOT_URL; ?>js/map.js"></script>
