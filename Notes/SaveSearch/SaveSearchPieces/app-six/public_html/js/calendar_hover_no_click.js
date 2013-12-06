
// helper functions
Date.prototype.format = function (fmt) {
	var date = this;

	return fmt.replace(
		/\{([^}:]+)(?::(\d+))?\}/g,
		function (s, comp, pad) {
			var fn = date['get' + comp];

			if (fn) {
				var v = (fn.call(date) +
					(/Month$/.test(comp) ? 1 : 0)).toString( );

				return pad && (pad = pad - v.length)
					? new Array(pad + 1).join('0') + v
					: v;
			} else {
				return s;
			}
		}
	);
};


(function ( $ ) {

	$.fn.removeClassPrefix = function (prefix) {
		this.each( function ( i, it ) {
			var classes = it.className.split(" ").map(function (item) {
			   return item.indexOf(prefix) === 0 ? "" : item;
			});
			it.className = classes.slice(0).join(" ");
		});

		return this;
	}

})( jQuery );


var start_date;
var end_date;
var dragging = false;
var this_date;

if ('undefined' == typeof VIEW_PAGE) {
	VIEW_PAGE = false;
}

$('.td-date').on({
	click: function(evt) {
		// don't register a click event if we are dragging
		if (dragging) {
			return false;
		}

		var pos = get_position(evt);
		if ( ! start_date) {
			if ( ! $(this).hasClass('reserved')) {
				$(this).tooltip('show');
			}

			if (0 >= pos) {
				do_date(this, 1, 'click');
			}
			else {
				do_prev_date(this, 1);
			}
		}
		else if ( ! end_date) {
			if (0 >= pos) {
				do_date(this, 2);
			}
			else {
				do_prev_date(this, 2);
			}
		}
		else {
			// clear everything
			start_date = end_date = false;
			date_clear( );
			clear_inputs( );

			$('#calc_discount').html('$0.00');
			$('#calc_nights').html('0');
			$('#calc_pernight').html('$0.00');
			$('#calc_subtotal').html('$0.00');
		}
	},
	

	mousedown: function(evt) {
		evt.preventDefault( ); // prevent actual text selection
		if (start_date) {
			return false;
		}

		dragging = true;

		
		this_date = get_date(this);

		var pos = get_position(evt);
		if (0 >= pos) {
			do_date(this, 1);
		}
		else {
			do_prev_date(this, 1);
		}
	},
/*	
	mousemove: function(evt) {
		var pos = get_position(evt);
		// if pos is negative, we are on the date; if positive, then the prev date
		if (0 >= pos) {
			do_date(this);
		}
		else {
			do_prev_date(this);
		}
	},
*/
	
	mouseup: function(evt) {
		if ( ! dragging || ! start_date) {
			return false;
		}

		dragging = false;

		var date = get_date(this);
		if (this_date.getTime( ) == date.getTime( )) {
			start_date = end_date = this_date = false;
			// start_date will be reinstated by the "click" function
			return;
		}

		var pos = get_position(evt);
		if (0 >= pos) {
			do_date(this, 2);
		}
		else {
			do_prev_date(this, 2);
		}
	},
	mouseleave: function( ) {
		date_clear( );
	}
	

});

$('.remove_res').on({
	click: function(evt) {
		evt.stopPropagation( );
		var classList = $(this).parent( ).prev( ).attr('class').split(/\s+/);
		$('#ReservationId').val(classList[3].replace('res_', ''));
		$('#form_modal_remove').modal('show').on('hide', function( ) {
			start_date = end_date = false;
			date_clear( );
		});
	}
});

if ( ! VIEW_PAGE) {
	$('.td-date').tooltip({
		title: 'Click another night<br />to set availablity',
		trigger: 'manual'
	});

	$('#form_modal').modal({
		show: false
	});
}

$(".start_val").datepicker({
	dateFormat: 'mm/dd/yy',
	minDate: 0,
	changeMonth: true,
	changeYear: true,
	onClose: function(selectedDate, inst) {
		do_datepicker_select(selectedDate, inst, this);

		if ('' == selectedDate) {
			var min_date = 1;
		}
		else {
			// add a day to make it more intuitive
			var min_date = new Date(inst.selectedYear, inst.selectedMonth, parseInt(inst.selectedDay) + 1, 12, 0, 0, 0);
		}

		$('.end_val').datepicker('option', 'minDate', min_date);
	}
});

$(".end_val").datepicker({
	dateFormat: 'mm/dd/yy',
	minDate: 1,
	changeMonth: true,
	changeYear: true,
	onClose: function(selectedDate, inst) {
		do_datepicker_select(selectedDate, inst, this);

		if ('' == selectedDate) {
			var max_date = null;
		}
		else {
			// subtract a day to make it more intuitive
			var max_date = new Date(inst.selectedYear, inst.selectedMonth, parseInt(inst.selectedDay) - 1, 12, 0, 0, 0);
		}

		$('.start_val').datepicker('option', 'maxDate', max_date);
	}
});


if ('undefined' !== typeof dates) {
	if (dates.start && dates.end) {
		start_date = new Date(dates.start * 1000); // JS dates in milliseconds
		end_date = new Date(dates.end * 1000);

		refresh_all( );
	}
}


function do_datepicker_select(date, inst, elem) {
	var is_start = (-1 !== elem.id.toLowerCase( ).indexOf('start'));

	if ('' == date) {
		date = false;
	}
	else {
		date = date.split('/');
		date = new Date(parseInt(date[2]), parseInt(date[0]) - 1, parseInt(date[1]), 12, 0, 0, 0); // set to noon to prevent DST issues

		if (check_invalid_date(date, is_start)) {
			alert('Invalid Date');
			$(elem).val(inst.lastVal);
			return;
		}
	}

	if (is_start) {
		start_date = date;
	}
	else {
		// subtract a day to make it more intuitive
		date = new Date(date.getFullYear( ), date.getMonth( ), date.getDate( ) - 1, 12, 0, 0, 0);
		end_date = date;
	}

	refresh_all( );
}


function check_invalid_date(date, is_start) {
	var $elem = $('.cal_'+date.format('{FullYear}_{Month:2}_{Date:2}'));

	if (is_start) {
		return $elem.is('[class~="reserved"]');
	}
	else {
		// grab the prev date
		var prev = new Date(date.getTime( ) - (1000 * 60 * 60 * 24));
		prev.setHours(12);
		var $prev = $('.cal_'+prev.format('{FullYear}_{Month:2}_{Date:2}'));

		return ($prev.is('[class~="reserved"]'));
	}
}


function update_inputs( ) {
	if (start_date) {
		$('.start_val').val(start_date.format('{Month:2}/{Date:2}/{FullYear}'));
		$('.start_val').datepicker('option', 'maxDate', this_end_date);
		var min_date = new Date(start_date.getFullYear( ), start_date.getMonth( ), start_date.getDate( ) + 1, 12, 0, 0, 0);
	}
	else {
		var min_date = 1;
	}
	$('.end_val').datepicker('option', 'minDate', min_date);

	if (end_date) {
		// add a day to make it more intuitive
		var this_end_date = new Date(end_date.getFullYear( ), end_date.getMonth( ), end_date.getDate( ) + 1, 12, 0, 0, 0);
		$('.end_val').val(this_end_date.format('{Month:2}/{Date:2}/{FullYear}'));
		$('.end_val').datepicker('option', 'minDate', start_date);
		var max_date = end_date;
	}
	else {
		var max_date = null;
	}
	$('.start_val').datepicker('option', 'maxDate', max_date);
}


function clear_inputs( ) {
	$('.start_val').val('');
	$('.start_val').datepicker('option', 'maxDate', null);
	$('.end_val').val('');
	$('.end_val').datepicker('option', 'minDate', 1);
}


function get_position(evt) {
	// do some calculations to see where we are on the date
	// hard-code the width and height at 90px (+3px each side for padding)
	// and the crossing point at 64px (about 2/3 across top)
	// so we don't have to do any more calculations than we need to.
	var loc_x = evt.offsetX;
	var loc_y = evt.offsetY;

	// adjust for hovering elements inside the main date div
	if (evt.target !== evt.currentTarget) {
		loc_x += evt.target.offsetLeft;
		loc_y += evt.target.offsetTop;
	}

	var width = 96;
	if (VIEW_PAGE) {
		width = 38;
	}

	// a wild maths appears!
	var pos = ((-3 * loc_x) / (2 * loc_y)) + (width / loc_y) - 1;

	return pos;
}


function get_date(elem) {
	var id = elem.className.match(/cal_\d{4}_\d{2}_\d{2}/im)[0];
	return new Date(id.slice(4).replace(/_/g, '/')+' 12:00');
}


function do_date(elem, step) {
	step = parseInt(step);

	var $elem = $(elem);
	if ($elem.is('[class~="reserved"]') || (start_date && end_date)) {
		$elem.css('cursor', 'default');
		date_clear( );
		return false;
	}

	$elem.css('cursor', 'pointer');

	var id = elem.className.match(/cal_\d{4}_\d{2}_\d{2}/im)[0];
	var date = get_date(elem);

	if (1 == step) {
		if ( ! dragging) {
			$elem.tooltip('show');
		}

		start_date = date;
		return true;
	}
	else if (2 == step) {
		$('.cal_'+start_date.format('{FullYear}_{Month:2}_{Date:2}')).tooltip('hide');
		end_date = date;
		do_modal( );
		return true;
	}

	// grab the next date
	var next = new Date(date.getTime( ) + (1000 * 60 * 60 * 24));
	next.setHours(12);
	var $next = $('.cal_'+next.format('{FullYear}_{Month:2}_{Date:2}'));

	if ( ! start_date) {
		date_clear( );
		$next.removeClassPrefix('l_').addClass('l_active');
		$('.'+id).removeClassPrefix('r_').addClass('r_active');
	}
	else {
		do_date_span(date);
	}
}


function do_prev_date(elem, step) {
	step = parseInt(step);

	var $elem = $(elem);

	var id = elem.className.match(/cal_\d{4}_\d{2}_\d{2}/im)[0];
	var date = get_date(elem);

	// grab the prev date
	var prev = new Date(date.getTime( ) - (1000 * 60 * 60 * 24));
	prev.setHours(12);

	var $prev = $('.cal_'+prev.format('{FullYear}_{Month:2}_{Date:2}'));

	if ($prev.is('[class~="reserved"]') || (start_date && end_date)) {
		$elem.css('cursor', 'default');
		date_clear( );
		return false;
	}

	$elem.css('cursor', 'pointer');

	if (1 == step) {
		if ( ! dragging) {
			$prev.tooltip('show');
		}

		start_date = prev;
		return true;
	}
	else if (2 == step) {
		$('.cal_'+start_date.format('{FullYear}_{Month:2}_{Date:2}')).tooltip('hide');
		end_date = prev;
		do_modal( );
		return true;
	}

	if ( ! start_date) {
		date_clear( );
		$('.'+id).removeClassPrefix('l_').addClass('l_active');
		$prev.removeClassPrefix('r_').addClass('r_active');
	}
	else {
		do_date_span(prev);
	}
}


function flip_dates( ) {
	if (start_date && end_date && (start_date > end_date)) {
		var temp = start_date;
		start_date = end_date;
		end_date = temp;
	}
}


function do_modal( ) {
	if ( ! start_date || ! end_date) {
		return false;
	}

	flip_dates( );
	calculate_cost( );

	$('.start_val').val(start_date.format('{Month:2}/{Date:2}/{FullYear}'));

	// add a day to make it more intuitive
	var this_end_date = new Date(end_date.getFullYear( ), end_date.getMonth( ), end_date.getDate( ) + 1);
	$('.end_val').val(this_end_date.format('{Month:2}/{Date:2}/{FullYear}'));

	$('#form_modal').modal('show').on('hide', function( ) {
		start_date = end_date = false;
		date_clear( );
	});
}


var cost_jqXHR = false;
function calculate_cost( ) {
	if ( ! start_date || ! end_date) {
		return false;
	}

	if (cost_jqXHR) {
		cost_jqXHR.abort( );
	}

	cost_jqXHR = $.post(
		ROOT_URL+'properties/calculate_cost/'+property_id,
		{
		   start: start_date.format('{FullYear}-{Month:2}-{Date:2}'),
		   end: end_date.format('{FullYear}-{Month:2}-{Date:2}')
		},
		function (response) {
			var results = jQuery.parseJSON(response);
			if (1 == results.status) {
				$('.calc_discount').html(results.discount);
				$('.calc_nights').html(results.nights);
				$('.calc_pernight').html(results.cost_per_night);
				$('.calc_subtotal').html(results.total);
				cost_jqXHR = false;
			}
		}
	);
}


function do_date_span(this_date) {
	// remove all activeness
	date_clear(true); // block the infinite loop callback

	if ( ! start_date) {
		return false;
	}

	// activate start date because end_date might be invalid
	activate_block(start_date);

	// now activate every block between 'start_date' and 'this_date'
	var date = new Date(start_date.getTime( )); // clone

	if (date <= this_date) {
		while (date < this_date) {
			// grab the next date
			date = new Date(date.getTime( ) + (1000 * 60 * 60 * 24));
			date.setHours(12); // set hours to prevent DST issues

			// make sure this block isn't reserved or otherwise unavailable
			if ($('.cal_'+date.format('{FullYear}_{Month:2}_{Date:2}')).is('[class~="reserved"]')) {
				// if it is, just clear the whole span
				start_date = end_date = false;
				date_clear(true); // block the infinite loop callback
				break;
			}

			activate_block(date);
		}
	}
	else {
		while (date > this_date) {
			// grab the next date
			date = new Date(date.getTime( ) - (1000 * 60 * 60 * 24));
			date.setHours(12); // set hours to prevent DST issues

			// make sure this block isn't reserved or otherwise unavailable
			if ($('.cal_'+date.format('{FullYear}_{Month:2}_{Date:2}')).is('[class~="reserved"]')) {
				// if it is, just clear the whole span
				start_date = end_date = false;
				date_clear(true); // block the infinite loop callback
				break;
			}

			activate_block(date);
		}
	}
}


function date_clear(block_loop) {
	block_loop = !! (block_loop);

	$('.l_active').removeClass('l_active');
	$('.r_active').removeClass('r_active');

	if (start_date) {
		activate_block(start_date);
	}

	if ( ! block_loop) {
		if (end_date) {
			do_date_span(end_date);
		}
	}
}


function activate_block(date) {
	var $date = $('.cal_'+date.format('{FullYear}_{Month:2}_{Date:2}'));

	// grab the next date
	var next = new Date(date.getTime( ) + (1000 * 60 * 60 * 24));
	next.setHours(12);
	var $next = $('.cal_'+next.format('{FullYear}_{Month:2}_{Date:2}'));

	$date.removeClassPrefix('r_').addClass('r_active');
	$next.removeClassPrefix('l_').addClass('l_active');
}


function refresh_all( ) {
	dragging = this_date = false;
	flip_dates( );
	do_date_span(end_date);
	update_inputs( );
	calculate_cost( );
}


function reset_all( ) {
	start_date = end_date = dragging = this_date = false;
	date_clear( );
	clear_inputs( );
}

