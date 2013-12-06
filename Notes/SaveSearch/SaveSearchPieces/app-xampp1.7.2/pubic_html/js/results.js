
// no doc ready, load at bottom of page

$('#SearchSavedSearchId').on('change', function( ) {
	// just submit the form, because the sliders will have to be updated as well
	$(this).parents('form').submit( );
});

// Triggered Enter how many times pressed because in the first we need to select place and in second submit form these kind of things...
var xTriggered = 0;
$('#geocomplete').keypress( function(evt) {
	if ( evt.which == 13 ) {
		evt.preventDefault( );

		xTriggered++;
		if (xTriggered > 1) {
			$('#SearchResultsForm').submit( );
		}
	}
});

var redo_search = moved = false;
$('#SearchRedoSearchMap').on('click', function( ) {
	redo_search = $(this).prop('checked');
	moved = true;

	if (redo_search) {
		map_update(sm_map.getBounds( ));
	}
});

function show_redo_search_box( ) {
	console.log('MOVED');
}

// extend jquery ui accordion to allow multiple
// sections at once if the multiple option is true
$.extend($.ui.accordion.prototype.options, {multiple: false});
var _toggle = $.ui.accordion.prototype._toggle;
var _clickHandler = $.ui.accordion.prototype._clickHandler;
$.extend($.ui.accordion.prototype, {
	_toggle: function(toShow, toHide, data, clickedIsActive, down){
		if (this.options.collapsible && this.options.multiple && toShow.is(':visible')) {
			arguments[1] = arguments[0];
			arguments[3] = true;
		}
		else if (this.options.collapsible && this.options.multiple) {
			arguments[1] = $([]);
		}
		_toggle.apply(this,arguments);
		this.active
			.removeClass( 'ui-state-active ui-corner-top' )
			.addClass( 'ui-state-default ui-corner-all' )
	},
	_clickHandler: function(event, target){
		if ($(target).next().is(':visible:not(:animated)')) {
			this.active = $(target);
		}
		_clickHandler.apply(this,arguments)
	}
});

$('#accordion').accordion({
	autoHeight  : false,
	navigation  : false,
	icons       : false,
	collapsible : true,
	multiple    : true,
	active      : 1
});
$('#accordion div.s-title:eq(0), #accordion div.s-title:eq(1)').click( );

var sidebar, offset, topPadding = 10;

// On window load. This waits until images have loaded which is essential
$(window).load( function( ) {
	sidebar = $('.search-sidebar');
	offset = sidebar.offset( );
	$(window).scroll( function( ) {
		if ($(window).scrollTop() > $('.search-result-content').position( ).top) {
			sidebar.addClass('floating');
		}
		else {
			sidebar.removeClass('floating');
		}
	});
});

$('#photo-view').on('click', function( ) {
	$('.searchresult:visible').fadeOut('fast');
	$('.searchresult-photo-lists').fadeIn('fast');
	$('#photo-view').addClass('active');
	$('#map-view').removeClass('active');
	$('#list-view').removeClass('active');
	$('div.search-sidebar div.map-cnt').slideDown( );
});

$('#list-view').on('click', function( ) {
	$('.searchresult:visible').fadeOut('fast');
	$('.searchresult-lists').fadeIn('fast');
	$('#list-view').addClass('active');
	$('#map-view').removeClass('active');
	$('#photo-view').removeClass('active');
	$('div.search-sidebar div.map-cnt').slideDown( );
});

$('#map-view').on('click', function( ) {
	$('.searchresult:visible').fadeOut('fast');
	$('.searchresult-map').fadeIn('fast');
	$('#map-view').addClass('active');
	$('#photo-view').removeClass('active');
	$('#list-view').removeClass('active');
	$('div.search-sidebar div.map-cnt').slideUp( );
	user_activity = false;
	google.maps.event.trigger(map, 'resize');
	map.fitBounds(bounds);
});

$('#SearchSort').on('change', function( ) {
	refresh_results( );
});

$('.search-category .checkbox input:checkbox').on('click', function( ) {
	refresh_results( );
});

/* Daily Prices */
if ('undefined' == typeof daily_rate_val) { var daily_rate_val = "0:2000"; }
var minPriceValue = 0;
var maxPriceValue = 1000;
$('#slider-range-price').slider({
	range: true,
	min: minPriceValue,
	max: maxPriceValue,
	step: 10,
	values: daily_rate_val.split(';'),
	slide: function( event, ui ) {
		$( '#SearchDailyRateMin' ).val( ui.values[ 0 ] );
		$( '#SearchDailyRateMax' ).val( ui.values[ 1 ] );
		$( '#dailyRateMin' ).text( '$' + ui.values[ 0 ] );

		if (ui.values[1] == maxPriceValue) {
			$( '#dailyRateMax' ).text( '$' + ui.values[ 1 ] + '+' );
		}
		else {
			$( '#dailyRateMax' ).text( '$' + ui.values[ 1 ] );
		}
	},
	change: function ( event, ui ) {
		refresh_results( );
	}
});

$( '#dailyRateMin' ).text( '$' + $('#slider-range-price').slider('values', 0) );
$( '#dailyRateMax' ).text( '$' + $('#slider-range-price').slider('values', 1) + (($('#slider-range-price').slider('values', 1) == maxPriceValue) ? '+' : '') );

/* Sq Ft Area */
if ('undefined' == typeof sq_foot_val) { var sq_foot_val = "500:25000"; }
var minSqFtValue = 500;
var maxSqFtValue = 12000;
$('#slider-range-SqFt').slider({
	range: true,
	min: minSqFtValue,
	max: maxSqFtValue,
	step: 100,
	values: sq_foot_val.split(';'),
	slide: function( event, ui ) {
		$( '#SearchSquareFootageMin' ).val( ui.values[ 0 ] );
		$( '#SearchSquareFootageMax' ).val( ui.values[ 1 ] );
		$( '#SqFtMin' ).text( ui.values[ 0 ] );

		if (ui.values[1] == maxSqFtValue) {
			$( '#SqFtMax' ).text( ui.values[ 1 ] + '+' );
		}
		else {
			$( '#SqFtMax' ).text( ui.values[ 1 ] );
		}
	},
	change: function ( event, ui ) {
		refresh_results( );
	}
});

$( '#SqFtMin' ).text( $('#slider-range-SqFt').slider('values', 0) );
$( '#SqFtMax' ).text( $('#slider-range-SqFt').slider('values', 1) + (($('#slider-range-SqFt').slider('values', 1) == maxSqFtValue) ? '+' : '') );

/* Bathroom */
if ('undefined' == typeof bath_val) { var bath_val = "1:10"; }
var minBathValue = 1;
var maxBathValue = 10;
$('#slider-range-Bath').slider({
	range: true,
	min: minBathValue,
	max: maxBathValue,
	step: 1,
	values: bath_val.split(';'),
	slide: function( event, ui ) {
		$( '#SearchBathroomsMin' ).val( ui.values[ 0 ] );
		$( '#SearchBathroomsMax' ).val( ui.values[ 1 ] );
		$( '#BathMin' ).text( ui.values[ 0 ] );

		if (ui.values[1] == maxBathValue) {
			$( '#BathMax' ).text( ui.values[ 1 ] + '+' );
		}
		else {
			$( '#BathMax' ).text( ui.values[ 1 ] );
		}
	},
	change: function ( event, ui ) {
		refresh_results( );
	}
});

$( '#BathMin' ).text( $('#slider-range-Bath').slider('values', 0) );
$( '#BathMax' ).text( $('#slider-range-Bath').slider('values', 1) + (($('#slider-range-Bath').slider('values', 1) == maxBathValue) ? '+' : '') );

/* Bedroom */
if ('undefined' == typeof bed_val) { var bed_val = "1:10"; }
var minBedValue = 1;
var maxBedValue = 10;
$('#slider-range-Bed').slider({
	range: true,
	min: minBedValue,
	max: maxBedValue,
	step: 1,
	values: bed_val.split(';'),
	slide: function( event, ui ) {
		$( '#SearchBedroomsMin' ).val( ui.values[ 0 ] );
		$( '#SearchBedroomsMax' ).val( ui.values[ 1 ] );
		$( '#BedMin' ).text( ui.values[ 0 ] );

		if (ui.values[1] == maxBedValue) {
			$( '#BedMax' ).text( ui.values[ 1 ] + '+' );
		}
		else {
			$( '#BedMax' ).text( ui.values[ 1 ] );
		}
	},
	change: function ( event, ui ) {
		refresh_results( );
	}
});

$( '#BedMin' ).text( $('#slider-range-Bed').slider('values', 0) );
$( '#BedMax' ).text( $('#slider-range-Bed').slider('values', 1) + (($('#slider-range-Bed').slider('values', 1) == maxBedValue) ? '+' : '') );


function AddToWishList(id) {
	$('#addToWishList_'+id).removeClass('wishlist-btn'); $('#addToWishList_'+id).addClass('wishlist-pre-loader'); $('#addToWishList_'+id).html('<span>&nbsp;Adding...</span>');
	$.ajax({
		url  :  addto_wishlist_url,
		type :  'Post',
		data :  {'property_id' : id},
		success : function(m) {
			if(m == true) {
				$('#addToWishList_'+id).attr('onclick','').unbind('click');
				$('#addToWishList_'+id).removeClass('wishlist-pre-loader');
				$('#addToWishList_'+id).addClass('wishlist-btn inactive');
				$('#addToWishList_'+id).html('<span>Add to wishlist</span>');
			}
		}
	});
}

var results_jqXHR = false;
function refresh_results( ) {
	$('#ajxResults, #ajxResultsP').animate({opacity:0.5});

	// stop the previous call
	if (results_jqXHR) {
		results_jqXHR.abort( );
	}

	results_jqXHR = $.post(
		ROOT_URL+'search',
		$('#SearchResultsForm').serialize( ),
		function (res) {
			return_data = $.parseJSON(res);
			update_content(false);
			results_jqXHR = false;
		}
	);
}

var sm_markers = false;
var lg_markers = false;
function update_content(first) {
	var i;

	first = !! (first || false);

	// take all the content that is recieved from elsewhere and place it where it's needed
	// this will update maps and everything

	$('#ajxResults').empty( ).append(return_data.list);
	$('#ajxResultsP').empty( ).append(return_data.photo);
	$('#ajxPage').empty( ).append(return_data.page);


	// update the maps
	// clear previous markers (if any)
	if (sm_markers) {
		for (i in sm_markers) {
			if ( ! sm_markers.hasOwnProperty(i)) {
				continue;
			}

			sm_markers[i].setMap(null);
		}
	}
	sm_markers = false;

	if (lg_markers) {
		for (i in lg_markers) {
			if ( ! lg_markers.hasOwnProperty(i)) {
				continue;
			}

			lg_markers[i].setMap(null);
		}
	}
	lg_markers = false;

	info_windows = return_data.map.info_boxes;

	// clone the lat_lons object
	// because it will get overwritten by the place_markers function
	sm_markers = jQuery.extend(true, {}, return_data.map.lat_lons);
	lg_markers = jQuery.extend(true, {}, return_data.map.lat_lons);

	// small map
	sm_markers = place_markers(sm_markers, {map: sm_map, bounds: sm_bounds, extend: first});

	// large map
	lg_markers = place_markers(lg_markers, {info_box: true, extend: first});
	google.maps.event.trigger(map, 'resize');

	$('#ajxResults, #ajxResultsP').animate({opacity:1});
}

update_content(true);