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
];
    
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
  

  var contentString =  $('.backwo').html();
  $('.backwo').remove();

  var infowindow = new google.maps.InfoWindow({
          content: contentString,
		  position: markerLatLng

		  
  });
  infowindow.open(map);
  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');
  