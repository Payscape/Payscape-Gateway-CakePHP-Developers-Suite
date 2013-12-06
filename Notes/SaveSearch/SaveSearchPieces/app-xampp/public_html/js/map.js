
// basic Google map functions
var map;
var bounds;

function place_marker(options) {
	var defaults = {
		map : map,
		bounds : bounds,
		draggable : false,
		extend : false
	};

	options = options || {};
	var o = jQuery.extend(defaults, options);

	// make sure the lat lons are within limits
	var lat = parseFloat(o.lat);
	if ((-90 > lat) || (lat > 90)) {
		return false;
	}

	var lng = parseFloat(o.lng);
	if ((-180 > lng) || (lng > 180)) {
		return false;
	}

	var mapLatLong = new google.maps.LatLng(lat, lng);
	var marker = new google.maps.Marker({
		position: mapLatLong,
		map: o.map,
		draggable: o.draggable
	});

	if (o.extend && ('undefined' != typeof o.bounds)) {
		o.bounds.extend(mapLatLong);
		o.map.fitBounds(o.bounds);
	}

	return marker;
}

function place_circle(options) {
	var defaults = {
		map : map,
		bounds : bounds,
		editable : false,
		extend : false
	};

	options = options || {};
	var o = jQuery.extend(defaults, options);

	// make sure the lat longs are within limits
	var lat = parseFloat(o.lat);
	if ((-90 > lat) || (lat > 90)) {
		return false;
	}

	var lng = parseFloat(o.lng);
	if ((-180 > lng) || (lng > 180)) {
		return false;
	}

	var mapLatLong = new google.maps.LatLng(lat, lng);
	var circle = new google.maps.Circle({
		center: mapLatLong,
		radius: o.rad,
		map: o.map,
		editable: o.editable
	});

	if (o.extend) {
		o.map.fitBounds(circle.getBounds( ));
	}

	return circle;
}

