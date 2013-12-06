we sat this aside, but if it keeps creating timeouts 
until there are no more events, it would susttain until
all behavior has ended, which would be what we're looking for:
============

Add a timeout, that runs your code 500ms after the event fires, 
each time the event fires clear the timeout 
and create a new one.


	eg.

google.maps.event.addListener(map, 'bounds_changed', (function () {
    var timer;
    return function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            // here goes an ajax call
        }, 500);
    }
}()));

=============
	google.maps.event.addListener(map, 'bounds_changed', (function () {
	    var timer;
	    return function() {
	        clearTimeout(timer);
	        timer = setTimeout(function() {
	        	
	            // here goes an ajax call
				if ($('#redoSearchBox').is(':checked')) {
					sm_ajax_results()	
				}	
	        }, 500);
	    }
	}()));	
	
=============


// results.refresh_results.js

var results_jqXHR = false;
function refresh_results( ) {
	$('#ajxResults, #ajxResultsP').animate({opacity:0.5});

	// stop the previous call
	if (results_jqXHR) {
		results_jqXHR.abort( );
	}

	results_jqXHR = $.post(
		ROOT_URL+'search',
		$('#SearchResultsForm').serialize( ),
		function (res) {
			return_data = $.parseJSON(res);
			update_content(false);
			results_jqXHR = false;
		}
	);
	

}

// new function to prevent from firing multiple times. 

map.zoomInProgress = false;//adding flag to already existing map object to keep dom clean
google.maps.event.addListener(map, 'idle', function(){
  if(map.dragInProgress == false){//only first shall pass
    map.dragInProgress = true;
    window.setTimeout(function(){
        console.log('Note how you will see this console message only once.');
        if ($('#redoSearchBox').is(':checked')) {
 	       sm_ajax_results();	        	
        }
        map.dragInProgress = false;//reset the flag for next drag
    }, 1000);
  }
});

// the last functions we used, 
// but they kept firing multiple times. 


google.maps.event.addListener(sm_map, 'dragend', function() {	    
	
	if ($('#redoSearchBox').is(':checked')) {		
		    	CookSomePie();
	}
});

//here we go. we need a DragInProgress and ZoomInProgress function




function CookSomePie(){ 
	alert("Cici!");
	sm_ajax_results();
	  setTimeout(CookSomePie, 1000);     
	}





// time out function that actually works. 

// for testing
var delay;
google.maps.event.addListener(sm_map, 'idle', function() {
		if ($('#redoSearchBox').is(':checked')) {
			clearTimeout(delay);
			delay = setTimeout('alert("497")', 200);
			//sm_ajax_results();
		}
});

// for our function

var delay;
google.maps.event.addListener(sm_map, 'idle', function() {
		if ($('#redoSearchBox').is(':checked')) {
			clearTimeout(delay);
			delay = setTimeout('alert("497")', 200);
			//sm_ajax_results();
		}
});

// time out functions that for one reason or another were useless 

google.maps.event.addListener(map, 'bounds_changed', (function () {
    var timer;
    return function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
        	if ($('#redoSearchBox').is(':checked')) {
        	sm_ajax_results();
        	}
        }, 500);
    }
}()));

this doesn't do anything. 

let's try this:

var frequencyReduce = function(delay, callback){
    var timer;
    return function(){
        clearTimeout(timer);
        timer = setTimeout(callback, delay);
    };
};

google.maps.event.addListener(map, 'bounds_changed', frequencyReduce(500, function(){
    // here goes an ajax call
}));


	
google.maps.event.addListener(map, 'bounds_changed', (function () {
    var timer;
    return function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
        	if ($('#redoSearchBox').is(':checked')) {
        	sm_ajax_results();
        	}
        }, 500);
    }
}()));	

$(function() {
	  setInterval(sm_ajax_results, 1000);
	});
	
google.maps.event.addListener(sm_map, 'idle', function() {
	 var idleTimeout = window.setTimeout('idle', timeout);
	   google.maps.event.addListener(sm_map, 'bounds_changed', function() {
			if ($('#redoSearchBox').is(':checked')) {
				sm_ajax_results();
				window.clearTimeout(idleTimeout);
			}
	   });
}

 function mapSettleTime() {
     clearTimeout(mapupdater);
     mapupdater=setTimeout(getMapMarkers,500);
 }
	
	
google.maps.event.addListener(map, 'idle', function() { 
	  // fires when movement has stopped 
	google.maps.event.addListener(sm_map, 'bounds_changed', function() {		
	
		if ($('#redoSearchBox').is(':checked')) {
			sm_ajax_results();
		} 			
	})
}

// this helped, but still not quite it. 

google.maps.event.addListener(sm_map, 'idle', function() {	
	
	
	if (window.scheduledUpdate) {
	        clearTimeout(window.scheduledUpdate);
	}
	    
		if ($('#redoSearchBox').is(':checked')) {
		    window.scheduledUpdate = setTimeout(function(){
		    	sm_ajax_results()}
		    , 2000);
		}
	}

=== MAP ============================

	
	google.maps.event.addListener(map, 'bounds_changed', function() {
		setTimeout(function(){			
				map_ajax_results();
				
		}, 2000);
	});
	
	var results_map_jqXHR = '';   
	results_map_jqXHR = false;
	function map_ajax_results(){

		$('#ajxResults, #ajxResultsP').animate({opacity:0.5});
		
		var map_ne_lat = map.getBounds().getNorthEast().lat();
		var map_ne_lng = map.getBounds().getNorthEast().lng();
		var map_sw_lat = map.getBounds().getSouthWest().lat();
		var map_sw_lng = map.getBounds().getSouthWest().lng();		
			
		results_map_jqXHR = $.post(ROOT_URL+"searches/ajax_results", {
				"data[Search][end_date]" : enddate,
				"data[Search][sleepingcapacity]" : sleepingcapacity,
				"data[Search][rate_by]" : searchrateby,
				"data[Search][daily_rate.min]" : dailyratemin,
				"data[Search][daily_rate.max]" : dailyratemax,
				"data[Search][bedrooms.min]" : bedmi,
				"data[Search][bedrooms.max]" : bedma, 
				"data[Search][bathrooms.min]" : bathmi,
				"data[Search][bathrooms.max]" : bathma,
				"data[Search][square_foot.min]" : sqfootmin,
				"data[Search][square_foot.max]" : sqfootmax,
				"data[Search][amenities]" : amenities,
				"data[Search][sm_map_ne_lat]" : map_ne_lat,
				"data[Search][sm_map_ne_lng]" : map_ne_lng,				
				"data[Search][sm_map_sw_lat]" : map_sw_lat,
				"data[Search][sm_map_sw_lng]" : map_sw_lng				
		},	
		
			function (res_map) {
				return_data = $.parseJSON(res_map);
				update_content(false);
				results_map_jqXHR = false;
			} 
		           
		  );
		  	
		  // refresh the map
		map_update(map.getBounds( ));


	}// map ajax results
	
=== MAP ====
	
	
	google.maps.event.addListener(map, 'bounds_changed', function() {
		setTimeout(function(){			
				map_ajax_results();
				
		}, 2000);
	});
	
	var results_map_jqXHR = '';   
	results_map_jqXHR = false;
	function map_ajax_results(){

		$('#ajxResults, #ajxResultsP').animate({opacity:0.5});
		
		var map_ne_lat = map.getBounds().getNorthEast().lat();
		var map_ne_lng = map.getBounds().getNorthEast().lng();
		var map_sw_lat = map.getBounds().getSouthWest().lat();
		var map_sw_lng = map.getBounds().getSouthWest().lng();		
			
		results_map_jqXHR = $.post(ROOT_URL+"searches/ajax_results", {
				"data[Search][end_date]" : enddate,
				"data[Search][sleepingcapacity]" : sleepingcapacity,
				"data[Search][rate_by]" : searchrateby,
				"data[Search][daily_rate.min]" : dailyratemin,
				"data[Search][daily_rate.max]" : dailyratemax,
				"data[Search][bedrooms.min]" : bedmi,
				"data[Search][bedrooms.max]" : bedma, 
				"data[Search][bathrooms.min]" : bathmi,
				"data[Search][bathrooms.max]" : bathma,
				"data[Search][square_foot.min]" : sqfootmin,
				"data[Search][square_foot.max]" : sqfootmax,
				"data[Search][amenities]" : amenities,
				"data[Search][sm_map_ne_lat]" : map_ne_lat,
				"data[Search][sm_map_ne_lng]" : map_ne_lng,				
				"data[Search][sm_map_sw_lat]" : map_sw_lat,
				"data[Search][sm_map_sw_lng]" : map_sw_lng				
		},	
		
			function (res_map) {
				return_data = $.parseJSON(res_map);
				update_content(false);
				results_map_jqXHR = false;
			} 
		           
		  );
		  	
		  // refresh the map
		map_update(map.getBounds( ));


	}// map ajax results