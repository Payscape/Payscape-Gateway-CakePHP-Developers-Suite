$(document).ready( function( ){
	
	
	$('#confirmMail').live('click', function (e){
		e.preventDefault();
		var el = $(this);
		jConfirm('Are you sure you want to send this email?', 'Confirmation', 
		function(r){
			if(r == true){
				if($('#createForm').length != 0){
				var formData = document.getElementById('createForm');
				formData.submit();
				} else {
					var formData = document.getElementById('createTour');
					formData.submit();
				}
			}
		})
	});

	$('.toggler').click( function( ) {
		var $this = $(this);

		if ($this.hasClass('closed')) {
			$this.removeClass('closed')
				.nextAll('.closable').show( );
		}
		else {
			$this.addClass('closed')
				.nextAll('.closable').hide( );
		}
	}).css('cursor', 'pointer');
});

// dynamically add functions to the window.onload event
function addOnLoad(fn) {
	if (window.addEventListener) { // W3C standard
		window.addEventListener('load', fn, false); // NOTE: **not** 'onload'
	}
	else if (window.attachEvent) { // Microsoft
		window.attachEvent('onload', fn);
	}
}


