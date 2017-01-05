<?php
$this->showView('sticky_header');
?>
<div class="info_inner">
	<h3><?php echo $lang['Contact us']; ?></h3>
	<div><p>Lorem ipsum dollar sit amet</p></div>
	<div class="cont_e">
		<div>
			<div class="under"><?php echo $lang['Address']; ?></div>
			<div class="under_info"><?php echo $lang['1504 Sofia']; ?><br>
			<?php echo $lang['Tsar Osvoboditel 15, CA 94043']; ?>
			</div>
			<div class="under"><?php echo $lang['Email']; ?></div>
			<div class="under_info">hello@escapemystoria.com</div>
			<div class="under"><?php echo $lang['Phone number']; ?></div>
			<div class="under_info">+359 888 11 22 33</div>
		</div>
		<div id="wall_5"  data-stellar-background-ratio="0.5">
			
		</div>
	</div>
	<div></div>
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
    center: new google.maps.LatLng(42.6945, 23.334850),
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    }
  };
  var map = new google.maps.Map(document.getElementById('wall_5'),
    mapOptions);
  
  
  infowindow.open(map);
  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');
  
  
</script>