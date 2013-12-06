
// for instructions on pin URLs
// http://code.google.com/apis/chart/infographics/docs/dynamic_icons.html#pins

var info_window;
var pin_url = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|28A5BB|000000';
var highlight_pin_url = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|CF3F3E|000000';

function place_markers(markers, options) {
	var idx;
	var marker;

	options = options || {};
	options = jQuery.extend({
		info_box: false,
		extend: true
	}, options);

	for (idx in markers) {
		var o = jQuery.extend(options, {
			lat: markers[idx][0],
			lng: markers[idx][1]
		});

		marker = place_marker(o);

		if ( ! marker) {
			continue;
		}

		// change the marker style
		marker.setIcon(pin_url);
		google.maps.event.addListener(marker, 'click', function( ) {
			select_property(this, markers, o.info_box);
		});

		markers[idx] = marker;
	}

	return markers;
}


function select_property(marker, markers, show_info_box) {
	show_info_box = !! (('undefined' !== typeof show_info_box) ? show_info_box : false);

	// set all pins to default icon
	$.each(markers, function(idx, elem) {
		elem.setIcon(pin_url);

		if ('object' == typeof info_window) {
			info_window.close( );
			info_window = false;
		}
	});

	// unhighlight all highlighted properties
	$('.searchresult-lists .highlight').removeClass('highlight');

	// find the index of this marker in the markers object
	var id = array_search(marker, markers, true);

	// highlight the marker
	marker.setIcon(highlight_pin_url);

	// highlight the selected property
	$('.vfid_'+id).addClass('highlight');

	// scroll to the selected property
	$('html, body').animate({
		scrollTop: $('#ajxResults .vfid_'+id).offset( ).top
	}, 750);

	// generate our info window
	if (show_info_box) {
		info_window = new google.maps.InfoWindow({
			content: info_windows[id]
		});
		info_window.open(marker.getMap( ), marker);
	}
}


function map_update(these_bounds) {
	$("#SearchMapNe").val(these_bounds.getNorthEast( ).lat( )+","+these_bounds.getNorthEast( ).lng( ));
	$("#SearchMapSw").val(these_bounds.getSouthWest( ).lat( )+","+these_bounds.getSouthWest( ).lng( ));

	refresh_results( );

	var orig_redo_search = redo_search;

	// disable the data refresh
	// and sync the maps
	redo_search = false;
	var lg_bounds = map.getBounds( );
	var sm_bounds = sm_map.getBounds( );

	if (these_bounds == lg_bounds) {
		sm_map.fitBounds(lg_bounds);
	}
	else {
		map.fitBounds(sm_bounds);
	}

	bounds = these_bounds;

	// re-enable data refresh (if needed)
	redo_search = orig_redo_search;
}


// http://phpjs.org/functions/array_search:335
function array_search(needle, haystack, argStrict) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +      input by: Brett Zamir (http://brett-zamir.me)
	// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// *     example 1: array_search('zonneveld', {firstname: 'kevin', middle: 'van', surname: 'zonneveld'});
	// *     returns 1: 'surname'
	// *     example 2: ini_set('phpjs.return_phpjs_arrays', 'on');
	// *     example 2: var ordered_arr = array({3:'value'}, {2:'value'}, {'a':'value'}, {'b':'value'});
	// *     example 2: var key = array_search(/val/g, ordered_arr); // or var key = ordered_arr.search(/val/g);
	// *     returns 2: '3'

	var strict = !!argStrict,
		key = '';

	if (haystack && typeof haystack === 'object' && haystack.change_key_case) { // Duck-type check for our own array()-created PHPJS_Array
		return haystack.search(needle, argStrict);
	}
	if (typeof needle === 'object' && needle.exec) { // Duck-type for RegExp
		if (!strict) { // Let's consider case sensitive searches as strict
			var flags = 'i' + (needle.global ? 'g' : '') +
						(needle.multiline ? 'm' : '') +
						(needle.sticky ? 'y' : ''); // sticky is FF only
			needle = new RegExp(needle.source, flags);
		}
		for (key in haystack) {
			if (needle.test(haystack[key])) {
				return key;
			}
		}
		return false;
	}

	for (key in haystack) {
		if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
			return key;
		}
	}

	return false;
}