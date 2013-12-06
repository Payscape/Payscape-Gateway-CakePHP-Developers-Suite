var counters = {'sort' : 0};

$(document).ready( function( ) {

	$('div.addable').on('click', '.add', function( ) {

		var $this = $(this);

		// get the counter name
		var cntr = 'sort';
		var myregexp = /cnt_(\w+)/;
		var match = myregexp.exec($this.attr('class'));

		if (match != null) {
			cntr = match[1];
		}

		var $holder = $this.parents('div.addable');

		// clone the clone div
		var clone = $('div.clone', $holder).clone(true)
						.removeClass('clone').show( )
						.outerHTML( ).replace(/NNN/g, counters[cntr]);

		// stick the new clone into the wrapping div
		$holder.find('.add').parent( ).before(clone);

		// increment our counter
		++counters[cntr];

		$this.trigger('addable-modify').trigger('addable-add');

	}).find('.add').css('cursor', 'pointer');

	// this runs all the delete buttons
	$('div.addable').on('click', '.delete', function( ) {

		$(this).parents('.removable').remove( );
		$('div.addable').trigger('addable-modify').trigger('addable-delete');

	}).find('.delete').css('cursor', 'pointer');

});


(function($) {
	$.fn.outerHTML = function( ) {

		// IE, Chrome & Safari will comply with the non-standard outerHTML, all others (FF) will have a fall-back for cloning
		return ( ! this.length) ? this : (this[0].outerHTML || (
		  function(el) {
			  var div = document.createElement('div');
			  div.appendChild(el.cloneNode(true));
			  var contents = div.innerHTML;
			  div = null;
			  return contents;
		})(this[0]));

	}
})(jQuery);

