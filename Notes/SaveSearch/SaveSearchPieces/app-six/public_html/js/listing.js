
// makes the add/edit property page work
var geocoder;
var marker;
var circle;

jQuery(document).ready( function($) {

	var mapLatLong = new google.maps.LatLng(40.675, -111.902); // center of SLC Valley
	var mapOptions = {
		zoom: 10,
		center: mapLatLong,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP // HYBRID for satellite map
	};

	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	area_map = new google.maps.Map(document.getElementById('area_canvas'), mapOptions);
	bounds = new google.maps.LatLngBounds( );
	geocoder = new google.maps.Geocoder( );

	$('#place_marker').on('click', codeAddress);

});


function update_position(lat, lng) {
	jQuery('input#PropertyLatitude').val(lat);
	jQuery('input#PropertyLongitude').val(lng);
}


function update_area(lat, lng, rad) {
	jQuery('input#PropertyAreaLatitude').val(lat);
	jQuery('input#PropertyAreaLongitude').val(lng);
	jQuery('input#PropertyAreaRadius').val(parseInt(rad));
}


function codeAddress( ) {
	var address = '';
	address += $('#PropertyAddress').val( );
	address += ', '+$('#PropertyCity').val( );
	address += ', '+$('#PropertyStateId option:selected').text( );
	address += ', '+$('#PropertyZip').val( );
	address += ', '+$('#PropertyCountryId option:selected').text( );

	geocoder.geocode({'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			draw_marker(results[0].geometry.location);
			map.setZoom(13);

			update_position(marker.getPosition( ).lat( ), marker.getPosition( ).lng( ));

			draw_circle(results[0].geometry.location, 500);
			area_map.setZoom(13);

			update_area(circle.getCenter( ).lat( ), circle.getCenter( ).lng( ), circle.getRadius( ))

			$('#lat_lng_warning').fadeOut( );
		}
		else {
			alert('Geocode was not successful for the following reason:\n' + status);
		}
	});
}


function draw_marker(LatLng) {
	// remove the current marker
	if ('undefined' != typeof marker) {
		marker.setMap(null);
		marker = null;
	}

	marker = new google.maps.Marker({
		map: map,
		draggable: true,
		position: LatLng
	});

	google.maps.event.addListener(marker, 'mouseup', function( ) {
		update_position(this.position.lat( ), this.position.lng( ));

		if (circle && ! is_overlap(circle, marker)) {
			draw_circle(marker.getPosition( ), circle.getRadius( ));
			update_area(circle.getCenter( ).lat( ), circle.getCenter( ).lng( ), circle.getRadius( ))
		}
	});

	map.setCenter(LatLng);

	return marker;
}


function draw_circle(LatLng, rad) {
	// remove the current circle
	if ('undefined' != typeof circle) {
		circle.setMap(null);
		circle = null;
	}

	var circ_opts = make_circle(LatLng, rad);
	var circle_center = new google.maps.LatLng(circ_opts.lat, circ_opts.lng);

	circle = new google.maps.Circle({
		map: area_map,
		editable: true,
		center: circle_center,
		radius: circ_opts.rad,
		strokeWeight: 0.5,
		fillColor: 'FF867C'
	});

	google.maps.event.addListener(circle, 'center_changed', function( ) {
		if ( ! is_overlap(circle, marker)) {
			alert('Circle did not cover marked property location.\n\nThe circle has been moved.');
			draw_circle(marker.getPosition( ), circle.getRadius( ));
			update_area(circle.getCenter( ).lat( ), circle.getCenter( ).lng( ), circle.getRadius( ))
		}
	});

	google.maps.event.addListener(circle, 'radius_changed', function( ) {
		if ( ! is_overlap(circle, marker)) {
			alert('Circle did not cover marked property location.\n\nThe circle has been moved.');
			draw_circle(marker.getPosition( ), circle.getRadius( ));
			update_area(circle.getCenter( ).lat( ), circle.getCenter( ).lng( ), circle.getRadius( ))
		}
	});

	area_map.setCenter(circle_center);

	return circle;
}


function make_circle(LatLng, rad) {
	var min = 50; // don't get too close...
	var max = rad - min - 50;

	var angle = Math.random( ) * 360; // between 0 and 360 degrees
	var dist = Math.floor(Math.random( ) * (max - min)) + min; // between min and max

	center = google.maps.geometry.spherical.computeOffset(LatLng, dist, angle);

	return {'lat': center.lat( ), 'lng': center.lng( ), 'rad': rad};
}


// make sure the circle overlaps the marker
function is_overlap(circle, marker) {
	var dist = google.maps.geometry.spherical.computeDistanceBetween(circle.getCenter( ), marker.getPosition( ));

	return dist < circle.getRadius( );
}

