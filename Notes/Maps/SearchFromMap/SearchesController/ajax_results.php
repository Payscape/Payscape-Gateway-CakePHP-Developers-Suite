<?php 
	// for drag and drop map searches
	function ajax_results(){
		
		
		
				$search_values = array(
				'start_date'=>'',
				'end_date'=>'',
				'sleepingcapacity'=>'',
				'rate_by'=>'',
				'daily_rate_min'=>'',
				'daily_rate_max'=>'',
				'bedrooms_min'=>'',
				'bedrooms_max'=>'',
				'bathrooms_min'=>'',
				'bathrooms_max'=>'',
				'square_foot_min'=>'',
				'square_foot_max'=>'',
				'amenities'=>array(),
				);
				
		if ($this->request->is('ajax')) {
			
				if ($this->request->is('post')) {
				
					$map_ne_lat = $this->request->data['Search']['map_ne_lat'];
					$map_ne_lng = $this->request->data['Search']['map_ne_lng'];
					$map_sw_lat = $this->request->data['Search']['map_sw_lat'];
					$map_sw_lng = $this->request->data['Search']['map_sw_lng'];
					
					
					
				}//
		}
	}// ajax_results()