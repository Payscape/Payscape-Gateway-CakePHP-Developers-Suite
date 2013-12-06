
// no doc ready, load at bottom of page

$('#SearchSavedSearchId').on('change', function( ) {
	// just submit the form, because the sliders will have to be updated as well
	refresh_results( );
	$(this).parents('form').submit( );
});

// Triggered Enter how many times pressed because in the first we need to select place and in second submit form these kind of things...
var xTriggered = 0;
var page = '';


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
		sm_ajax_results();
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

	var timeout_map;
	google.maps.event.addListener(map, 'idle', function () {

//		alert("how nice.");	
	window.clearTimeout(timeout_map);
	timeout_map = window.setTimeout(function () {
		map_update(map.getBounds( ));
		refresh_results();

		});
	}, 500); //time in ms, that will reset if next 'bounds_changed' call is send, otherwise code will be executed after that time is up
	
	
	

	

});

$('#SearchSort').on('change', function( ) {
	refresh_results( );
});

$('#SearchStartDate').on('change', function( ) {
	refresh_results( );
});

$('#SearchEndDate').on('change', function( ) {
	refresh_results( );
});

$('#SearchSleepingCapacity').on('change', function( ) {
	refresh_results( );
});




$('.search-category .checkbox input:checkbox').on('click', function( ) {
	refresh_results( );
});

/* Daily Prices */
if ('undefined' == typeof daily_rate_val) { 
	var daily_rate_val = "0:2000"; 
	}
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

// put our ajax and pop functions here. 





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


// populate save search elements
	
	var amenities = '';
	
	var startdate = $("#SearchStartDate").val();
	var enddate = $("#SearchEndDate").val();
	var sleepingcapacity = $("#SearchSleepingCapacity").val();
	var searchrateby = $("#SearchRateBy").val();
	
	var dailyratemin = $("#SearchDailyRateMin").val();
	var dailyratemax = $("#SearchDailyRateMax").val();
	
	var bedmi = $("#SearchBedroomsMin").val();
	var bedma = $("#SearchBedroomsMax").val();
	
	var bathmi = $("#SearchBathroomsMin").val();
	var bathma = $("#SearchBathroomsMax").val();
	
	var sqfootmin = $("#SearchSquareFootageMin").val();
	var sqfootmax = $("#SearchSquareFootageMax").val();
	var amenities = return_data.form.amenities;
	
	var scity = $("#SearchCity").val();
	var sstate = $("#SearchState").val();
	var sstateabbr = $("#SearchStateAbbr").val();
	var scountry = $("#SearchCountry").val();
	var scountryabbr = $("#SearchCountryAbbr").val();
	
	var slatitude = $("#SearchLatitude").val();
	var slongitude = $("#SearchLongitude").val();
	
	var sdestination = return_data.form.destination
	
	$("#startdate1").val(startdate);
	$("#enddate1").val(enddate);
	$("#sleepingcapacity1").val(sleepingcapacity);
	$("#searchrateby1").val(searchrateby);
	
	
	$("#dailyratemin1").val(dailyratemin);
	$("#dailyratemax1").val(dailyratemax);
	
	$("#bedmin1").val(bedmi);
	$("#bedmax1").val(bedma);

	$("#bathmin1").val(bathmi);
	$("#bathmax1").val(bathma);
	
	
	
	$("#squaremin1").val(sqfootmin);
	$("#squaremax1").val(sqfootmax);	
	
	$("#amenities1").val(amenities);
	
	$("#scity1").val(scity);
	$("#sstate1").val(sstate);
	$("#sstateabbr1").val(sstateabbr);
	$("#scountry1").val(scountry);
	$("#scountryabbr1").val(scountryabbr);
	$("#slatitude1").val(slatitude);
	$("#slongitude1").val(slongitude);
	$("#sdestination1").val(sdestination);
	
	//amenities = amenities.replace(",", "%2c");
	
	var a = $('<a />');
	a.attr('href', 'searches/popup?start_date='+startdate
			+'&end_date='+enddate
			+'&sleepingcapacity='+sleepingcapacity
			+'&rate_by='+searchrateby
			+'&daily_rate.min='+dailyratemin
			+'&daily_rate.max='+dailyratemax
			+'&bedrooms.min='+bedmi
			+'&bedrooms.max='+bedma 
			+'&bathrooms.min='+bathmi
			+'&bathrooms.max='+bathma
			+'&square_foot.min='+sqfootmin
			+'&square_foot.max='+sqfootmax
			+'&amenities='+amenities
			+'&destination='+sdestination			
			+'&city='+scity
			+'&state='+sstate
			+'&state_abbr='+sstateabbr
			+'&country='+scountry
			+'&country_abbr='+scountryabbr
			+'&latitude='+slatitude
			+'&longitude='+slongitude
			
	);
	


	a.text("Save This Search!");
	a.addClass("thickbox btn btn-info");

	$("#SaveSearchAjxClicker").html(a);
	
	google.maps.event.addListener(sm_map, 'idle', function() {
		setTimeout(function(){
			
			if ($('#redoSearchBox').is(':checked')) {
				sm_ajax_results()	
			}		
		}, 2000);
	});
	   
	results_ajax_jqXHR = false;
	function sm_ajax_results(){

		$('#ajxResults, #ajxResultsP').animate({opacity:0.5});
		
		var sm_map_ne_lat = sm_map.getBounds().getNorthEast().lat();
		var sm_map_ne_lng = sm_map.getBounds().getNorthEast().lng();
		var sm_map_sw_lat = sm_map.getBounds().getSouthWest().lat();
		var sm_map_sw_lng = sm_map.getBounds().getSouthWest().lng();		
			
		results_ajax_jqXHR = $.post(ROOT_URL+"searches/ajax_results", {
				"data[Search][end_date]" : enddate,
				"data[Search][sleepingcapacity]" : sleepingcapacity,
				"data[Search][rate_by]" : searchrateby,
				"data[Search][daily_rate.min]" : dailyratemin,
				"data[Search][daily_rate.max]" : dailyratemax,
				"data[Search][bedrooms.min]" : bedmi,
				"data[Search][bedrooms.max]" : bedma, 
				"data[Search][bathrooms.min]" : bathmi,
				"data[Search][bathrooms.max]" : bathma,
				"data[Search][square_foot.min]" : sqfootmin,
				"data[Search][square_foot.max]" : sqfootmax,
				"data[Search][amenities]" : amenities,
				"data[Search][sm_map_ne_lat]" : sm_map_ne_lat,
				"data[Search][sm_map_ne_lng]" : sm_map_ne_lng,				
				"data[Search][sm_map_sw_lat]" : sm_map_sw_lat,
				"data[Search][sm_map_sw_lng]" : sm_map_sw_lng				
		},	
		
			function (res_ajax) {
				return_data = $.parseJSON(res_ajax);
				update_content(false);
				results_ajax_jqXHR = false;
			} 
		           
		  );
		  	
		  // refresh the map
		map_update(sm_map.getBounds( ));

	}// ajax results
	
	
	// update the maps
	// clear previous markers (if any)
	if (sm_markers) {
		for (i in sm_markers) {
			if ( ! sm_markers.hasOwnProperty(i)) {
				
				continue;
			}
			$("#smallMarkers").empty().append("/nl/[2] "+sm_markers[i]);
			sm_markers[i].setMap(null);
		}
	}
	sm_markers = false;

	if (lg_markers) {
		for (i in lg_markers) {
			if ( ! lg_markers.hasOwnProperty(i)) {
				continue;
			}
			$("#largeMarkers").empty().append("<br>1 "+sm_markers[i]);
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