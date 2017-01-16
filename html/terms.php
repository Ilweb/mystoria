<?php
$this->showView('sticky_header');
?>


<div class="back_terms">
	<div class="info_inner terms">
		<?php
			foreach ($terms as $key => $p)
			{
		?>
		<div>
			<h3><?php echo $p->title; ?></h3>
		</div>
		<div class="sec_p">
			<?php echo $p->body; ?>
		</div>
			<?php
				}
			?>
	</div>			
</div>
