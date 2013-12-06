/** performing Google Places Auto Complete action for searching of city,state and country etc...
 * and adding two datepickers on the event of selection for checkin date and checkout date
 **/

$(function() {
	$('form').each( function(i, elem) {
		$(elem).find('input[data-geocomplete="true"]').geocomplete({
			details: '#' + $(elem).attr('id'),
			detailsAttribute: 'data-geo',
			types: ['geocode'],
			componentRestrictions: {country: 'us'}
		});
	}).on('submit', function(evt) {
		evt.preventDefault( );

		$(this).find('input[data-geocomplete="true"]').trigger('geocode');

		var self = this;
		window.setTimeout( function( ) { self.submit( ); }, 500);
	});
});

