<?php
if (SHOW_FOOTER)
{
	?>
	<footer>
	<div class="footer_condition">
		<div class="inner_set">
			<div>Mystoria tm</div>
			<div>Lorem ipsum dolor sit amet, consectetur
					adipiscing elit. Quisque leo massa, vulputate
					non magna sit amet, tincidunt aliquet eros.
					Lorem ipsum dolor sit amet, consectetur
					adipiscing elit. Quisque leo massa.
			</div>
			<div>
				<a><i class="fa fa-twitter-square"></i></a>
				<a><i class="fa fa-facebook-square"></i></a>
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
			<a>First company title</a>
			<a>Second company title</a>
			<a>Third company title</a>
			<a>Fourth company title</a>
		
		</div>
	</div>	
	</footer>
	<?php
}
?>
<div class="dialog alertDlg"></div>
</body>