<script>

			$(function(){
			    setTimeout(function(){
			    	$("#Kangaroo").click();;
				  },4000); // 10 seconds
			
			});

	var results_ajax_jqXHR = '';   
	results_ajax_jqXHR = false;
	
	function kangaroo( ){

		$('#ajxResults, #ajxResultsP').animate({opacity:0.5});
		
		var map_ne_lat = "49.3457868";
		var map_ne_lng = "-66.9513812";
		var map_sw_lat = "25.7433195";
		var map_sw_lng = "-124.7844079";

		var map_ne = "49.3457868,-66.9513812";
		var map_sw = "25.7433195,-124.7844079";
		
				
		results_map_jqXHR = $.post(ROOT_URL+"searches/results", {
			"data[Search][n_latitude]" : map_ne_lat,
			"data[Search][e_longitude]" : map_ne_lng,				
			"data[Search][s_latitude]" : map_sw_lat,
			"data[Search][w_longitude]" : map_sw_lng,
			"data[Search][map_ne]" : map_ne,
			"data[Search][map_sw]" : map_sw				
	},	
		
			function (res_ajax) {
				return_data = $.parseJSON(res_ajax);
				update_content(false);
				results_ajax_jqXHR = false;
			} 
		           
		  )// post
		  refresh_results();
	}// kangaroo 
		
</script>