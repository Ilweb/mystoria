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
<script>
  var styles = [
    {
        "featureType": "all",
        "elementType": "all",
        "stylers": [
            {
                "color": "#727691"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#594d4d"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "color": "#787c96"
            }
        ]
    }
]
    
  var markerLatLng = {lat: 42.694, lng: 23.334850};
  var styledMap = new google.maps.StyledMapType(styles,
    {name: "Styled Map"});
  var mapOptions = {
    zoom: 17,
	scrollwheel: false,
    center: new google.maps.LatLng(42.6945, 23.334850),
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    }
  };
  var map = new google.maps.Map(document.getElementById('wall_5'),
    mapOptions);
  
  var contentString = '<div class="backwo"><div class="id">1504 Sofia </div><div class="adress">Tsar Osvoboditel 15, CA 94043</div><div class="email">hello@escapemystoria.com </div><div class="contact">+359 888 11 22 33</div></div>';
  var infowindow = new google.maps.InfoWindow({
          content: contentString,
		  position: markerLatLng,

		  
  });
  infowindow.open(map);
  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');
  
  
</script>