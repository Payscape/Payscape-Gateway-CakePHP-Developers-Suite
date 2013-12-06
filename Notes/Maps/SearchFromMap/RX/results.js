Add a timeout, that runs your code 500ms after the event fires, each time the event fires clear the timeout and create a new one.
google.maps.event.addListener(map, 'bounds_changed', (function () {
    var timer;
    return function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            // here goes an ajax call
        }, 500);
    }
}()));

00
// wtf?
google.maps.event.addListener(this.map.map, 'idle', function() {
    if (this.isMapDragging) {
        this.idleSkipped = true;
        return;
    }
    this.idleSkipped = false;
    this._respondToMapChange();
}.bind(this));
google.maps.event.addListener(this.map.map, 'dragstart', function() {
    this.isMapDragging = true;
}.bind(this));
google.maps.event.addListener(this.map.map, 'dragend', function() {
    this.isMapDragging = false;
    if (this.idleSkipped == true) {
        this._respondToMapChange();
        this.idleSkipped = false;
    }
}.bind(this));
google.maps.event.addListener(this.map.map, 'bounds_changed', function() {
    this.idleSkipped = false;
}.bind(this));

0

here is another that is supposed to delay

function scheduleDelayedCallback() { 

    var now = new Date();

    if (now.getTime() - lastEvent.getTime() >= 750) {
        // minimum time has passed, go ahead and update or whatever
        $("#main").html('Lade...'); 
        // reset your reference time
        lastEvent = now;
    }
    else {
        this_function_needs_to_be_delayed(); // don't know what this is.
    }
} 

function scheduleDelayedCallback() {
    lastEvent = new Date();
    setTimeout(fireIfLastEvent, 750);
}


1
this supposedly removes redundant bounds_changed calls 

var timeout;
google.maps.event.addListener(map, 'bounds_changed', function () {
window.clearTimeout(timeout);
timeout = window.setTimeout(function () {
	//do stuff on event
	});
}, 500); //time in ms, that will reset if next 'bounds_changed' call is send, 
otherwise code will be executed after that time is up

ok, here we go 


FireIfLastEvent

function fireIfLastEvent()
{
    if (lastEvent.getTime() + 500 <= new Date().getTime())
    {
        alert('i am cool');
    }
}


function scheduleDelayedCallback()
{
    lastEvent = new Date();
    setTimeout(fireIfLastEvent, 500);
}


we sat this aside, but if it keeps creating timeouts 
until there are no more events, it would susttain until
all behavior has ended, which would be what we're looking for:

============
4	
This code will ensure it has been half a second since the event was last fired before doing its thing (the commented TODO). I think this is what you want.

	var mapMoveTimer;
	google.maps.event.addListener(map, 'bounds_changed', function(){
	  clearTimeout(mapMoveTimer);
	  mapMoveTimer = setTimeout(function(){
	    // TODO: stuff with map
	  }, 500); 
	});


============
5 

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
