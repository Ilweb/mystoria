<div>
<div id="wall_1" class="back image">
	<div id="content_1" class="content">
		<div class="logo"><div id="innerr"><img src="<?php echo ROOT_URL; ?>images/logo.png"></div>
			<div class="buttons">
				<div class="choose"><div onclick="goToByScroll( '#wall_4', -100 );"><?php echo $lang['Reserve now']; ?></div></div>
				<div class="choose"><div><a href="<?php echo LOCALE_URL; ?>teambuilding.php"><?php echo $lang['Team building']; ?></a></div></div>
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
					<div class="map">	
						<div class="arrows">
							<div class="left_arrow"></div>
							<div class="right_arrow"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="info">
				<h2>Kingdom of death</h2>
				<p>Отборът Ви ще се озове в специално изграден декор изпълнен с разнообразни загадки. Вашата цел е  да преминете през цялото приключение за 60 минути и да откриете изхода. С всяка разрешена загадка ще разкривате нови детайли от историята, приближавайки се до крайната цел. Обединете силите си с близки, приятели, колеги и изживейте приключението заедно.</p>

				<p>Вие познавате приказния свят, магическите Ви способности растат с всеки изминал ден. На деня кръстов 14 септември, съдбата ви подготвя изненада, която ще преобърне целия Ви свят. Вашият учител заминава на далечно пътешествие из приказните светове, а на Вас се пада не леката задача да обедините разединеното кралство.</p>
				<div class="times">
					<div><img src="<?php echo ROOT_URL; ?>images/success.png"><span><?php echo $lang['Success rate']; ?></span><div><span>70%</span></div></div>
					<div><img src="<?php echo ROOT_URL; ?>images/record.png"><span><?php echo $lang['Record time']; ?></span><div><span class="other">35 min</span></div></div>
					<div><img src="<?php echo ROOT_URL; ?>images/3d.png"><span><?php echo $lang['Average time']; ?></span><div><span class="other">57 min</span></div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->showView('reservation_form');
?>
<div id="wall_5" style="width:100%;height:350px;">
	<div id="content_5" class="content">
	</div>
</div>
</div>
<script type="text/javascript" src="<?php echo ROOT_URL; ?>js/map.js"></script>
