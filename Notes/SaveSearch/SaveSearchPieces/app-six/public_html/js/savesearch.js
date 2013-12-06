
$('.actions-link').on('click', function( ) {
	$(this).parents('.white-box').find('.search-form').toggle( );
	$(this).parents('.white-box').find('.seperator').toggle( );
	$(this).parents('.white-box').find('.search-cnt').toggle( );
	$(this).toggleClass('expand');
});

$("#delete_search").click( function(evt) {
	if (confirm("Are you sure to delete this search")) {
		return true;
	}

	evt.preventDefault( );
});

/**
 * changing the name attribute of search field
 */
$(".search-btn").on('click', function(evt) {
	evt.preventDefault( );
	var res = $(this).parents('.search-cnt').find(".s-input").attr('name' , 'data[Search][destination]');
	if ('undefined' !== typeof res.attr('name')) {
	   $(this).parents('form').submit( );
	   console.log($(this).parents('.white-box').find('.search-form'));
	}
});

$('input[type=button][name=CancelSearch]').on('click', function( ) {
	window.location.href = current_url;
});

jQuery(".SaveSearch").validationEngine( );

/* ===== SLIDERS ===== */
$('.slider-range-Bed').slider({
	range: true,
	min: 1,
	max: 10,
	step: 1,
	values: [1, 10],
	slide: function( event, ui ) {
		var $parent = $(this).parents('.row');

		$parent.find('input.min_form').val( ui.values[ 0 ] );
		$parent.find('input.max_form').val( ui.values[ 1 ] );

		$parent.find('.min').text( ui.values[ 0 ] );
		$parent.find('.max').text( ui.values[ 1 ] );

		if (ui.values[1] == 10) {
			$parent.find('.max').text( ui.values[ 1 ] + '+' );
		}
		else {
			$parent.find('.max').text( ui.values[ 1 ] );
		}
	}
});

$('.slider-range-SqFt').slider({
	range: true,
	min: 500,
	max: 12000,
	step: 100,
	values: [500, 12000],
	slide: function( event, ui ) {
		var $parent = $(this).parents('.row');

		$parent.find('input.min_form').val( ui.values[ 0 ] );
		$parent.find('input.max_form').val( ui.values[ 1 ] );

		$parent.find('.min').text( ui.values[ 0 ] );
		$parent.find('.max').text( ui.values[ 1 ] );

		if (ui.values[1] == 12000) {
			$parent.find('.max').text( ui.values[ 1 ] + '+' );
		}
		else {
			$parent.find('.max').text( ui.values[ 1 ] );
		}
	}
});

$('.slider-range-Bath').slider({
	range: true,
	min: 1,
	max: 10,
	step: 1,
	values: [1, 10],
	slide: function( event, ui ) {
		var $parent = $(this).parents('.row');

		$parent.find('input.min_form').val( ui.values[ 0 ] );
		$parent.find('input.max_form').val( ui.values[ 1 ] );

		$parent.find('.min').text( ui.values[ 0 ] );
		$parent.find('.max').text( ui.values[ 1 ] );

		if (ui.values[1] == 10) {
			$parent.find('.max').text( ui.values[ 1 ] + '+' );
		}
		else {
			$parent.find('.max').text( ui.values[ 1 ] );
		}
	}
});

$('.slider-range-price').slider({
	range: true,
	min: 0,
	max: 2000,
	step: 10,
	values: [0, 2000],
	slide: function( event, ui ) {
		var $parent = $(this).parents('.row');

		$parent.find('input.min_form').val( ui.values[ 0 ] );
		$parent.find('input.max_form').val( ui.values[ 1 ] );

		$parent.find('.min').text( ui.values[ 0 ] );
		$parent.find('.max').text( ui.values[ 1 ] );

		if (ui.values[1] == 2000) {
			$parent.find('.max').text( ui.values[ 1 ] + '+' );
		}
		else {
			$parent.find('.max').text( ui.values[ 1 ] );
		}
	}
});

function update_slider_text( ) {
	$('[class~="slip"]').each( function(i, elem) {
		var $elem = $(elem);
		$elem.parents('.row')
			.find('.min').text( $elem.slider('option', 'values')[0] ).end( )
			.find('.min_form').text( $elem.slider('option', 'values')[0] ).end( )
			.find('.max').text( $elem.slider('option', 'values')[1] + (($elem.slider('option', 'values')[1] == $elem.slider('option', 'max')) ? '+' : '') ).end( )
			.find('.max_form').text( $elem.slider('option', 'values')[1] );
	});
}
update_slider_text( );

