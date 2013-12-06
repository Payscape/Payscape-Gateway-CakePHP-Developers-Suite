

	// Script added for characters remaining limits...
	$('#PropertyTitle').on('keyup focus', function( ) {
		if ('' != $(this).val( )) {
			var box = $(this).val( );
			var count = 35 - box.length;

			if (35 >= box.length) {
				$('#character_left').html(count);
			}

			return false;
		}
	}).keyup( );

	$('#PropertyDescription').on('keyup focus', function( ) {
		if ('' != $(this).val( )) {
			var size = $(this).val( ).match(/[\''\w]+/g).length;
			$('#number_desc_word').html( size );

			if (15 > size) {
				$('div.desc-form span.redtext').show( );
			}
			else {
				$('div.desc-form span.redtext').hide( );
			}
		}
	}).keyup( );

	jQuery("#PropertyCountryId").on("change", function( ) {
		$("#PropertyStateId").html("<option>Loading...</option>").val("");
		jQuery.ajax({
			type: "GET",
			url: country_url+"/"+$(this).val( ),
			success: function(msg) {
				$("#PropertyStateId").html(msg);
			}
		});
	});

	// Validating form...
	$('#PropertyCreateForm').validate({
		rules: {
			'data[Property][title]': 'required',
			'data[Property][contact_primary_phone]': 'phoneUS',
			'data[Property][zip]': 'zipcodeUS'
		}
	});
	$('#TB_window').css('height','500px;');

	// refresh map warning
	var checked = false;
	$('#PropertyCreateForm').on('submit', function(evt) {
		if ( ! checked && ('' != $('#PropertyAddress').val( )) && ('' == $('#PropertyAreaLatitude').val( ))) {
			evt.preventDefault( );
			$('#lat_lng_warning').show( );
			$('html, body').animate({
				 scrollTop: $('#lat_lng_warning').offset( ).top - 20
			}, 500);
			$('#lat_lng_warning').fadeOut( ).fadeIn( ).fadeOut( ).fadeIn( );
			checked = true;
		}
	});


/* Property Accommodates */
	if ('' != $('#PropertySleepingCapacity').val( )) {
		var accommodates_val = $('#PropertySleepingCapacity').val( );
	}
	else {
		var accommodates_val = 1;
	}

	$('#accommodates-slider').slider({
		range: 'min',
		min: 1,
		max: 10,
		value: accommodates_val,
		slide: function( event, ui ) {
			if (10 == ui.value) {
				$('#accommodatesVal').text(ui.value + '+');
			}
			else {
				$('#accommodatesVal').text(ui.value);
			}

			$('#PropertySleepingCapacity').val(ui.value);
		}
	});

	$( '#accommodatesVal' ).text( $( '#accommodates-slider' ).slider( 'value') );
	$( '#PropertySleepingCapacity' ).val( $( '#accommodates-slider' ).slider( 'value' ) );

/* Property Bedrooms */
	if ('' != $('#PropertyBedrooms').val( )) {
		var bedrooms_val = $('#PropertyBedrooms').val( );
	}
	else {
		var bedrooms_val = 1;
	}

	$('#bedrooms-slider').slider({
		range: 'min',
		min: 1,
		max: 10,
		value: bedrooms_val,
		slide: function( event, ui ) {
			if (10 == ui.value) {
				$( '#bedroomsVal' ).text( ui.value + '+' );
			}
			else {
				$( '#bedroomsVal' ).text( ui.value );
			}

			$( '#PropertyBedrooms' ).val( ui.value );
		}
	});

	$( '#bedroomsVal' ).text( $( '#bedrooms-slider' ).slider( 'value') );
	$( '#PropertyBedrooms' ).val( $( '#bedrooms-slider' ).slider( 'value' ) );

/* Property Bathrooms */
	if ('' != $('#PropertyBathrooms').val( )) {
		var bathrooms_val = $('#PropertyBathrooms').val( );
	}
	else {
		var bathrooms_val = 1;
	}

	$('#bathrooms-slider').slider({
		range: 'min',
		min: 1,
		max: 10,
		value: bathrooms_val,
		slide: function( event, ui ) {
			if (10 == ui.value) {
				$( '#bathroomsVal' ).text( ui.value + '+' );
			}
			else {
				$( '#bathroomsVal' ).text( ui.value );
			}

			$( '#PropertyBathrooms' ).val( ui.value );
		}
	});

	$( '#bathroomsVal' ).text( $( '#bathrooms-slider' ).slider( 'value') );
	$( '#PropertyBathrooms' ).val( $( '#bathrooms-slider' ).slider( 'value' ) );

/* Property Square Footage */
	if ($('#PropertySquareFootage').val( )) {
		var square_footage_val = $('#PropertySquareFootage').val( );
	}
	else {
		var square_footage_val = 2000;
	}

	var sq_footage_slider = $( '#square_footage-slider' ).slider({
		range: 'min',
		min: 500,
		max: 12000,
		step: 100,
		value: square_footage_val,
		slide: function( event, ui ) {
			if (ui.value == $(this).slider('option', 'max')) {
				$( '#square_footageVal' ).text( ui.value + '+' );
			}
			else {
				$( '#square_footageVal' ).text( ui.value );
			}

			$( '#PropertySquareFootage' ).val( ui.value );
		},
	});

	$( '#square_footageVal' ).text( $( '#square_footage-slider' ).slider( 'value') );
	$( '#PropertySquareFootage' ).val( $( '#square_footage-slider' ).slider( 'value' ));
