
// no doc ready here, this gets loaded at the bottom of the page
jQuery('#carousel').jcarousel({
//	wrap: 'circular'
});

$('ul.thumb-slider').on('click', 'li img', function(evt) {
	// remove any other active classes
	$('ul.thumb-slider img.active').removeClass('active');

	var $this = $(this);

	// grab the src of the clicked image
	$('#main_image img').attr('src', $this.addClass('active').attr('src').replace(/thumb_image/i, 'main_image'));

	// grab the name of the image
	$('#main_image span').text($this.attr('alt'));
}).find('li img').css('cursor', 'pointer');

// set the first item in the image carousel active
$('ul.thumb-slider li:first-child img').addClass('active');



jQuery('ul.calendars').jcarousel({
	scroll: 1,
/*	itemFirstInCallback: function (carousel, li_elem, idx, state) {
console.warn('itemFirstInCallback');
console.log(carousel);
console.log(li_elem);
console.log(idx);
console.log(state);

		// based on the direction, we need to either add a calendar
		// on the start or the end of the list
		// ... or just skip this round completly
		if ('init' == state) {
			return;
		}

		var date;
		var url = cal_url;

		if ('next' == state) {
			url += '/'+cal_dates[1]+'/'+cal_dates[0]+'/'+cal_prop;

			date = new Date(cal_dates[1], cal_dates[0] - 1);
			date.setMonth(date.getMonth( ) + 1);

			cal_dates[0] = date.getMonth( ) + 1;
			cal_dates[1] = date.getFullYear( );
		}

		// ajax off and get our calendar
		$.get(url, '', function (data, textStatus, jqXHR) {
console.log(data);
console.log(textStatus);
			if ('success' == textStatus) {
				if ('next' == state) {
					carousel.add(carousel.size( ), data);
				}
			}

		}, 'html');

	}*/
});



if ('undefined' != typeof center) {
	// create our map
	var mapOptions = {
		zoom: 14,
		center: center,
		mapTypeId: google.maps.MapTypeId.HYBRID // ROADMAP for road map
	};

	map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

	$("a[data-toggle=\'tab\']").on("shown", function (evt) {
		if ("#map" == evt.target.hash) {
			google.maps.event.trigger(map, "resize");
			map.setCenter(center);
		}
	});
}

