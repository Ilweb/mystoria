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
  
