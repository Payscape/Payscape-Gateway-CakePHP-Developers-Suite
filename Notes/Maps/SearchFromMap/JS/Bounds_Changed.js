	google.maps.event.addListener(sm_map, 'bounds_changed', function() {		
		//var bounds = sm_map.getBounds();
		if ($('#redoSearchBox').is(':checked')) {
			sm_ajax_results();
		} 
		
		
		
		// this will fire our ajax results function
	//	ajax_results();
		
		//document.getElementById('txt_latlng').value=point.lat()+", "+point.lng();
	});
	
