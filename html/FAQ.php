<?php
$this->showView('sticky_header');
?>
<div class="info_inner FAQ">

	<h3>FAQ</h3>
	<div><p><?php echo $lang['Frequently asked questions']; ?></p></div>
	<div>
		<div>
		<?php
		for ($i = 0; $i <= 1 && isset($questions[$i]); $i++)
		{
			?>
			<div class="info_part">
				<h4><?php echo $questions[$i]->title; ?></h4>
				<?php echo $questions[$i]->body; ?>
			</div>
			<?php
		}
		?>
		</div>
	<div class="book"><img src="<?php echo ROOT_URL; ?>images/FAQ/book.jpg"></div>
		<div>
			<div>
				
			<?php
			for ($i = 2; $i <= 3 && isset($questions[$i]); $i++)
			{
				?>
				<div class="info_part">
					<h4><?php echo $questions[$i]->title; ?></h4>
					<?php echo $questions[$i]->body; ?>
				</div>
				<?php
			}
			?>
			</div>
		</div>
	</div>
	<div class="add_explanation">
		<?php
		for ($i = 4; isset($questions[$i]); $i++)
		{
			?>
			<div <?php if ($i >= 8) echo 'style="display: none;"'; ?>><h5><?php echo $questions[$i]->title; ?></h5><?php echo $questions[$i]->body; ?></div>
			<?php
		}
		?>
	</div>
	<?php
	if (count($questions) > 8)
	{
		?>
	
		<div class="choose second out">
			<div><a href="#" id="loadMore" style="display: block; padding: 2px;">Load More</a></div>
		</div>


		<?php
	}
	?>
</div>
<script
<script>
$(function () {
$(".add_explanation > div").slice(0, 4).show();
	$("#loadMore").on('click', function (e) {
  	  e.preventDefault();
   		 $(".add_explanation > div:hidden").slice(0, 1000).slideDown();
			if ($(".add_explanation > div:hidden").length == 0) {
       			 $(".out").fadeOut('slow');
   				}
	        $('html,body').animate({
	            scrollTop: $(this).offset().top
	        }, 1500);
	      
    });
});



</script>