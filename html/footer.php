<?php
if (SHOW_FOOTER)
{
	?>
	<footer>
	<div class="footer_condition">
		<div class="inner_set">
			<div>Mystoria tm</div>
			<div><?php echo $settings['Footer '.strtoupper(LOCALE)]; ?></div>
			<div>
				<a target="_blank" href="<?php echo $settings["Facebook URL"] ?>"><i class="fa fa-twitter-square"></i></a>
				<a target="_blank" href="<?php echo $settings["Twitter URL"] ?>"><i class="fa fa-facebook-square"></i></a>
				&copy; <?php date('Y');?></div>	
		</div>
		
		<div class="inner_set">
			<div><?php echo $lang['Pages']; ?></div>
			<a href="<?php echo LOCALE_URL; ?>faq.php"><?php echo $lang['FAQ']; ?></a>
			<a href="<?php echo LOCALE_URL; ?>rankings"><?php echo $lang['Rankings']; ?></a>
			<a href="<?php echo LOCALE_URL; ?>terms.php"><?php echo $lang['Terms & Conditions']; ?></a>
			<a href="<?php echo LOCALE_URL; ?>vp.php"><?php echo $lang['Vouchers and Promotions']; ?></a>
			
		</div>
		
		<div class="inner_set">
			<div><?php echo $lang['Partners']; ?></div>
			<?php
			for ($i = 1; $i <= 4; $i++)
			{
				if (isset($settings["Partner $i"]) && !empty($settings["Partner $i"]))
				{
					echo '<a target="_blank" href="'.$settings["Partner $i URL"].'">'.$settings["Partner $i"].'</a>';
				}
			}
			?>
		
		</div>
	</div>	
	</footer>
	<?php
}
?>
<div class="dialog alertDlg"></div>
</body>