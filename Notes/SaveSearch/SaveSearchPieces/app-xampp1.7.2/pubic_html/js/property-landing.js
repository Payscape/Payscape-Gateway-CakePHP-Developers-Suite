/* performing on the product landing js....
 * Added on | 29 Oct 2012....
 *
 **/

// Property Landing page tabs for Photos Slider, Maps, Calendar etc...
function loadTabs1(tab) {
	jQuery('#photos, #maps, #calendars').removeClass('current');
	if(tab == 'photos') {
		jQuery('#photos').addClass('current');jQuery('#sc2').hide();jQuery('#sc3').hide();jQuery('#sc1').show();
	} else if(tab == 'maps') {
		jQuery('#maps').addClass('current');jQuery('#sc1').hide();jQuery('#sc3').hide();jQuery('#sc2').show();
	} else if(tab == 'calendars') {
		jQuery('#calendars').addClass('current');jQuery('#sc3').show();jQuery('#sc1').hide();jQuery('#sc2').hide();
	}
	return false;
}

function loadTabs2(tab) {
	jQuery('#description, #amenities, #house-rules').removeClass('current');
	if(tab == 'description') {
		jQuery('#description').addClass('current');jQuery('#d-sc2').hide();jQuery('#d-sc3').hide();jQuery('#d-sc1').show();
	} else if(tab == 'amenities') {
		jQuery('#amenities').addClass('current');jQuery('#d-sc1').hide();jQuery('#d-sc3').hide();jQuery('#d-sc2').show();
	} else if(tab == 'house-rules') {
		jQuery('#house-rules').addClass('current');jQuery('#d-sc1').hide();jQuery('#d-sc2').hide();jQuery('#d-sc3').show();
	}
}

function loadTabs3(tab) {
	jQuery('#reviews, #rules').removeClass('current');
	if(tab == 'reviews') {
		jQuery('#reviews').addClass('current');jQuery('#r-sc2').hide();jQuery('#r-sc1').show();
	} else if(tab == 'rules') {
		jQuery('#rules').addClass('current');jQuery('#r-sc1').hide();jQuery('#r-sc2').show();
	}
}

// Social Links twitter js
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

// google+ js
(function() {
	var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
	po.src = "https://apis.google.com/js/plusone.js";
	var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
})();

// fb js
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));

// Photos Slider configure settings below for Property landing page....
Galleria.loadTheme(img_path+'js/themes/classic/galleria.classic.min.js');
Galleria.run('#vFishPhotosGallery');

Galleria.configure({
	transition: 'fade',
	imageCrop: true,
	trueFullscreen: true,
	fullscreenCrop: true,
	lightbox: false,
	showInfo: true,
	showCounter: false
});

/**
*Adding property in the wishlist items by using an ajax call added on 08 October 2012
**/
function addToWishList(id) {
   $('#addToWishList_'+id).removeClass('white-btn'); $('#addToWishList_'+id).addClass('wishlist-pre-loader'); $('#addToWishList_'+id).html('<span>&nbsp;Adding...</span>');
   $.ajax({
	   url  :  add_to_wishlist_url,
	   type :  'Post',
	   data :  {'property_id' : id},
	   success : function(m) {
		   if(m == true) {
			   $('#addToWishList_'+id).attr('onclick','').unbind('click');
			   $('#addToWishList_'+id).removeClass('wishlist-pre-loader');
			   $('#addToWishList_'+id).addClass('white-btn inactive');
			   $('#addToWishList_'+id).html('Add to Wish List');
		   }
	   }
   });
}

$('.cal_update').on('click', function(e) {
	var href = $(this).attr('href').replace(/(width=\d+&height=\d+).*/i, '$1');
	var start = encodeURIComponent($('#start_date').val( ));
	var end = encodeURIComponent($('#end_date').val( ));

	if (start && end) {
		$('.cal_update').attr('href', href+'&start='+start+'&end='+end);
	}
});