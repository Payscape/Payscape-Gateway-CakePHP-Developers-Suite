

var start_date = null;
var end_date = null;
var tracking = false;

// make the date fields in the modals be datepickers
$('.datepicker').datepicker({
	dateFormat: 'mm-dd-yy'
});

$('.avail_add').on('click', function(evt) {
	start_date = $(this).parent( ).data('date').clone( );
});


// connect the dates to each of the calendar divs
$('.calendar .week div').each( function(idx, elem) {
	var dat;
	var myregexp = /date_(\d{4})_(\d{2})_(\d{2})/im;
	var match = myregexp.exec($(this).attr('class'));
	if (match != null) {
		dat = match[1]+'-'+match[2]+'-'+match[3];
	}

	$(elem).data('date', Date.parse(dat));
});


$('#resmodal').on({
	// set the dates for the reservation on link click
	show: function (evt) {
		$(this).find('div.input input').val('')
			.eq(0).val(start_date.toString('MM-dd-yyyy')).end( )
			.eq(1).val(end_date.toString('MM-dd-yyyy'));
	},
	// reset on modal hide
	hide: function (evt) {
		$('.calendar .highlight').removeClass('highlight');
		start_date = null;
		end_date = null;
		tracking = false;
	}
});


// highlight the extent of the currently hovered reservation
$("div.taken").on({
	mouseenter: function( ) {
		if (tracking) {
			return;
		}

		var id;
		var myregexp = /res_(\d+)/im;
		var match = myregexp.exec($(this).attr('class'));
		if (match != null) {
			id = match[1];
		}

		$('div.taken.res_'+id).addClass('highlight');
	},
	mouseleave: function( ) {
		if (tracking) {
			return;
		}

		var id;
		var myregexp = /res_(\d+)/im;
		var match = myregexp.exec($(this).attr('class'));
		if (match != null) {
			id = match[1];
		}

		$('div.taken.res_'+id).removeClass('highlight');
	}
});





// make the drag and drop date picker work
$("a.avail_add:not(.taken)").on({
	mousedown: function(evt) {
console.warn('MOUSE-DOWN');
		tracking = true;
		start_date = $(this).parent( ).data('date');
		end_date = $(this).parent( ).data('date');
		highlight_all( );

		// stop the browser from trying to drag elements around
		evt.preventDefault( );
		return false;
	},
	mouseenter: function(evt) {
		if ( ! tracking) {
			return;
		}
console.warn('MOUSE-ENTER');

		end_date = $(this).parent( ).data('date');
		highlight_all( );
	},
	mouseup: function(evt) {
console.warn('MOUSE-UP');
		tracking = false;
		do_modal( );
	}
});


function highlight_all( ) {
	var temp = swap(start_date, end_date);
	start = temp[0];
	end = temp[1];

	// remove all highlights
	$('.highlight').removeClass('highlight');

	// highlight the start date
	$('.date_'+start.toString('yyyy_MM_dd')).addClass('highlight');

	var i = 0; // prevent infinite loops
	var curr = start.clone( ).add(1).days( );
	while (curr.between(start, end) && i < 400) {
		i++;

		if ($('.date_'+curr.toString('yyyy_MM_dd')).is('.taken')) {
			console.warn('cannot select around a reserved date');
			break;
		}

		$('.date_'+curr.toString('yyyy_MM_dd')).addClass('highlight');

		curr = curr.add(1).days( );
	}
}


function do_modal( ) {
console.warn('DO MODAL');
	var temp = swap(start_date, end_date);
	start_date = temp[0];
	end_date = temp[1];
console.log(start_date);
console.log(end_date);
console.log($('#resmodal'));

	$('#resmodal').modal('show');
}


function swap(small, large) {
	if (small > large) {
		return [large, small];
	}

	return [small, large];
}


