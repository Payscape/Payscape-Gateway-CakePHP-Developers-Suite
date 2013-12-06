
// makes the create property when not signed in page work
var marker;

jQuery(document).ready( function($) {

	var mapLatLong = new google.maps.LatLng(39.8, -98.6); // geographic center of contiguous USA
	var mapOptions = {
		zoom: 3,
		center: mapLatLong,
		scrollwheel: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP // HYBRID for satellite map
	};

	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

	google.maps.event.addListener(map, 'click', function(evt) {
		marker = draw_marker(evt.latLng);
		update_position(marker.getPosition( ).lat( ), marker.getPosition( ).lng( ));
	});

});


function update_position(lat, lng) {
	jQuery('input#PropertyLatitude').val(lat);
	jQuery('input#PropertyLongitude').val(lng);
}


function draw_marker(LatLng) {
	// remove the current marker
	if ('undefined' != typeof marker) {
		marker.setMap(null);
		marker = null;
	}

	marker = new google.maps.Marker({
		map: map,
		draggable: false,
		position: LatLng
	});

	return marker;
}

