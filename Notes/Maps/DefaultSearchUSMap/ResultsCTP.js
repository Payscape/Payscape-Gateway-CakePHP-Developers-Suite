   $(function(){
        setTimeout(function(){

        	//alert("Kangaroo = 1, delay = 5000 miliseconds (1/2 second)!");
    		
    		kangaroo_results( );
        
    	  },2000); // 5 seconds

    });

 	
    
	var results_ajax_jqXHR = '';   
	results_ajax_jqXHR = false;
	
		function kangaroo_results( ){
					
			$('#ajxResults, #ajxResultsP').animate({opacity:0.5});
			
			
			var map_ne_lat = 49.3457868;
			var map_ne_lng = 66.9513812;
			var map_sw_lat = 25.7433195;
			var map_sw_lng = 124.7844079;		
				
			results_map_jqXHR = $.post(ROOT_URL+"searches/results", {
					"data[Search][n_latitude]" : map_ne_lat,
					"data[Search][e_longitude]" : map_ne_lng,				
					"data[Search][s_latitude]" : map_sw_lat,
					"data[Search][w_longitude]" : map_sw_lng				
			},	

			function (res_ajax) {
				return_data = $.parseJSON(res_ajax);
				update_content(false);
				results_ajax_jqXHR = false;
			} 
		});