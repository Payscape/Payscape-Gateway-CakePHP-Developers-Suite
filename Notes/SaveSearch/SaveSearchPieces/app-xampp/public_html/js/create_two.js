
// no doc ready here, this file gets loaded at the bottom of the page

// make sure we only allow 8 images
// we're checking here for the initial page load
if (8 <= $('.picture_wrapper .removable:not(.clone)').length) {
	$('.picture_wrapper .add').hide( );
}

$('div.addable').on('click', '.add', function( ) {
	// get the counter name
	var cntr = 'sort';
	var myregexp = /cnt_(\w+)/;
	var match = myregexp.exec($(this).attr('class'));
	if (match != null) {
		cntr = match[1];
	}

	var $holder = $(this).parents('div.addable');

	// clone the clone div
	var clone = $('div.clone', $holder).clone(true)
					.removeClass('clone').show( )
					.outerHTML( ).replace(/NNN/g, counters[cntr]);

	// stick the new clone into the wrapping div
	$holder.find('.add').parent( ).before(clone);

	// make sure we only allow 8 images
	if (('prop_image' == cntr) && (8 <= $('.picture_wrapper .removable:not(.clone)').length)) {
		$holder.find('.add').hide( );
	}

	// increment our counter
	++counters[cntr];
}).find('.add').css('cursor', 'pointer');


counters['amenities'] = 1;
$('img.amenity_plus').on('click', function( ) {
	var $clone = $(this).clone( );

	// get the value from the input field
	var val = $.trim($('#AmenityOther0').val( ));

	if ('' == val) {
		return;
	}

	$('table.other_amenities tbody').prepend(
		$('<tr>').attr({
			class : 'removable'
		}).append(
			$('<td>').text(val).append(
				$('<input>').attr({
					type : 'hidden',
					value : val,
					name : 'data[Amenity][other]['+counters['amenities']+']'
				})
			)
		).append(
			$('<td>').append(
				$clone.attr({
					src : $clone.attr('src').replace('plus', 'minus'),
					class : 'amenity-minus delete',
					alt : 'Minus'
				})
			)
		)
	);

	$('#AmenityOther0').val('');

	++counters['amenities'];
}).css('cursor', 'pointer');


$('img.bed_plus').on('click', function( ) {
	var $clone = $(this).clone( );

	// get the values from the input fields
	var bed_id = $('div.beds.addable div.beds_bed_id select').val( );
	var bed_name = $('div.beds.addable div.beds_bed_id select option:selected').text( )
	var number = Math.abs(parseInt($('div.beds.addable div.beds_number input').val( )));

	if ('NaN' == (''+number)) {
		return;
	}

	$('table.beds tbody').prepend(
		$('<tr>').attr({
			class : 'removable'
		}).append(
			$('<td>').text(bed_name).append(
				$('<input>').attr({
					type : 'hidden',
					value : bed_id,
					name : 'data[Bed]['+counters['beds']+'][bed_id]'
				})
			)
		).append(
			$('<td>').text(number).append(
				$('<input>').attr({
					type : 'hidden',
					value : number,
					name : 'data[Bed]['+counters['beds']+'][number]'
				})
			)
		).append(
			$('<td>').append(
				$clone.attr({
					src : $clone.attr('src').replace('plus', 'minus'),
					class : 'amenity-minus delete',
					alt : 'Minus'
				})
			)
		)
	);

	$('div.beds.addable div.beds_bed_id select').val('');
	$('div.beds.addable div.beds_number input').val('');

	++counters['beds'];
}).css('cursor', 'pointer');


// this runs all the delete buttons
$('div.addable').on('click', '.delete', function( ) {

	// if we are removing a picture, reshow the add button
	// but just reshow them all... it's easier
	$(this).parents('.addable').find('.add').show( )
		// and remove the item we came here to remove
		.end( ).end( ).parents('.removable').remove( );

}).find('.delete').css('cursor', 'pointer');


// drag and drop images
$('table.uploaded-images tbody').sortable({
//	containment: 'parent',
	tolerance: 'pointer',
	revert: true,
	placeholder: 'ui-state-highlight',
	stop: function(evt, ui) {
		// go through each element here and change the
		// sort order field to the current sort position
		$(this).find('tr').each( function(i, elem) {
			$(elem).find('div.sort input').val(i + 1);
		});
	}
}).find('tr').css('cursor', 'move');
