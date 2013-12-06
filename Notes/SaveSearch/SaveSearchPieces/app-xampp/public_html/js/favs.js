
	$('.add_fav').on('click', function( ) {
		var id;
		var myregexp = /fav_(\d+)/im;
		var match = myregexp.exec($(this).attr('class'));
		if (match != null) {
			id = match[1];
		}

		$.get(
			ROOT_URL+'/properties/add_fav/'+id,
			function(msg) {
				if ('OK' == msg) {
					// remove all the links
					$('a.add_fav.fav_'+id).remove( );
				}
			}
		);
	});

