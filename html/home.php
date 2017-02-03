<div>
<div id="wall_1" class="back image">
	<div id="content_1" class="content">
		<div class="logo"><div id="innerr"><img src="<?php echo ROOT_URL; ?>images/logo.png"></div>
			<div class="buttons">
				<div class="choose"><a  onclick="goToByScroll( '#wall_4', -100 );"><?php echo $lang['Reserve now']; ?></a></div>
				<div class="choose"><a href="<?php echo LOCALE_URL; ?>teambuilding.php"><?php echo $lang['Team building']; ?></a></div>
			</div>
				<div class="language">
				<div class="choose_lang"><?php echo $lang['Change your language']; ?></div>
				<div class="variety"><a href="<?php echo ROOT_URL.'en/'; ?>" class="var">EN</a><div>/</div><a href="<?php echo ROOT_URL.'bg/'; ?>" class="var">BG</a></div>
			</div>
		</div>
	</div>
</div>
<?php
$this->showView('sticky_header');
?>
<div id="wall_3" class="room">
	<div class="whole">
		<div class="two_sides">
			<div class="left_part">
				<div id="circle">
					<div id="slider">
					<a class="control_next"><img src="<?php echo ROOT_URL; ?>images/r_arrow.png"></a>
					<a class="control_prev"><img src="<?php echo ROOT_URL; ?>images/l_arrow.png"></a>
						<ul>
						<?php
						foreach ($images as $key => $image)
						{
							echo '<li><img src="'.$this->thumbnail("articles/".$room->id."/".$image, 450, array('crop'=>(450 / 300))).'"></li>';
						}
						?>
						</ul>  
					</div>
				</div>
			</div>
			<div class="info">
				<h2><?php echo $room->title; ?></h2>
				<?php
				echo $room->body;
				?>
				<div class="times">
					<div><img src="<?php echo ROOT_URL; ?>images/success.png"><span><?php echo $lang['Success rate']; ?></span><div><span><?php echo $records->rate; ?>%</span></div></div>
					<div><img src="<?php echo ROOT_URL; ?>images/record.png"><span><?php echo $lang['Record time']; ?></span><div><span class="other"><?php echo $records->record; ?> min</span></div></div>
					<div><img src="<?php echo ROOT_URL; ?>images/3d.png"><span><?php echo $lang['Average time']; ?></span><div><span class="other"><?php echo $records->average; ?> min</span></div></div>

		<div><img src="<?php echo ROOT_URL; ?>images/3d.png" style="visibility: hidden;"><span><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i></span><div><span class="other"><?php echo $settings['Price 2 players']; ?> BGN</span></div></div>	

		<div><img src="<?php echo ROOT_URL; ?>images/3d.png" style="visibility: hidden;"><span><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i></span><div><span class="other"><?php echo $settings['Price 3 players']; ?> BGN</span></div></div>	
		<div><img src="<?php echo ROOT_URL; ?>images/3d.png" style="visibility: hidden;"><span><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i></span><div><span class="other"><?php echo $settings['Price 4 players']; ?> BGN</span></div></div>	

		<div><img src="<?php echo ROOT_URL; ?>images/3d.png" style="visibility: hidden;"><span><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i &nbsp;class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i></span><div><span class="other"><?php echo $settings['Price 5 players']; ?> BGN</span></div></div>	

		<div><img src="<?php echo ROOT_URL; ?>images/3d.png" style="visibility: hidden;"><span><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i>&nbsp;<i class="fa fa-child" aria-hidden="true"></i></span><div><span class="other"><?php echo $settings['Price 6 players']; ?> BGN</span></div></div>	

				
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->showView('reservation_form');
?>
<div class="backwo">
	<div class="id"><?php echo $lang['1504 Sofia']?> </div><div class="adress">
	<?php echo $lang['Tsar Osvoboditel 15, CA 94043']?></div><div class="email"><a href="mailto:<?php echo $settings['Contact email']; ?>"><?php echo $settings['Contact email']; ?></a></div><div class="contact"><a href="tel:<?php echo $settings['Contact Phone']; ?>"><?php echo $settings['Contact Phone']; ?></a></div>
</div>
<div id="wall_5" style="width:100%;height:350px;">
	<div id="content_5" class="content">
	
	</div>
</div>
</div>

<script type="text/javascript" src="<?php echo ROOT_URL; ?>js/map.js"></script>
	

<script type="text/javascript">
jQuery(document).ready(function ($) {
  
  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;
  
  $('#slider').css({ width: slideWidth, height: slideHeight });
  
  $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});    

  
</script>