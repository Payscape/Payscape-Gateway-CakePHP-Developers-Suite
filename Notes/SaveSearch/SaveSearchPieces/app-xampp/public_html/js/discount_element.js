
$(document).ready( function( ) {
	var totAllowedDiscounts = 5; //Total number of discounts

	$('div.addable').on('addable-modify', function( ) {

		if (5 > $('div.addable div.removable:not(div.clone)').length) {
			$('#add_button').show( );
		}
		else {
			$('#add_button').hide( );
		}

	});

	$('#discounts').on('change', 'input, select', function( ) {
		// remove any previous errors
		$('#discounts input.error, #discounts select.error').removeClass('error');
		$('#discounts *.error').remove( );
		$('div.submit input').prop('disabled', false);

		// check and make sure our discounts are always increasing
		var entries = [];
		$('#discounts input, #discounts select').each( function(idx, elem) {
			$elem = $(elem);
			if ('hidden' == $elem.attr('type')) {
				return; // continue for .each( )
			}

			if (/NNN/.test($elem.attr('id'))) {
				return; // continue for .each( )
			}

			var id = $elem.attr('id').match(/^Discount(\d+)(.+)/);
			var type = id[2];
			id = id[1];

			if ('undefined' == typeof entries[id]) {
				entries[id] = { 'id' : id };
			}

			entries[id][type] = $elem.val( );
		});

		entries.sort(function(a, b) { return parseInt(a.LowerBound) - parseInt(b.LowerBound) });

		for (var i = 1; i < entries.length; ++i) {
			if (('undefined' == typeof entries[i]) || ('undefined' == typeof entries[i - 1])
				|| ('' == entries[i].LowerBound) || ('' == entries[i - 1].LowerBound)
			) {
				continue;
			}

			if (parseInt(entries[i].Discount) <= parseInt(entries[i - 1].Discount)) {
				$('#Discount'+entries[i].id+'LowerBound').addClass('error')
					.parent( ).append(
						'<div class="error">'
						+ 'This discount must be more than the previous discount (' + entries[i - 1].LowerBound + ' days: ' + entries[i - 1].Discount + '% off)' +
						'</div>'
					);

				$('div.submit input').prop('disabled', true);

				break;
			}
		}
	});
});

