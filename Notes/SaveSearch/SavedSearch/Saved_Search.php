<?php 

	function save_search() {
	
			$message = "Please enter a title for your search";
		
		$this->set('message', $message);
		
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
				'destination'=>'',
				'city'=>'',
				'state'=>'',
				'state_abbr'=>'',
				'country'=>'',
				'country_abbr'=>'',
				'latitude'=>'',
				'longitude'=>'',
		
		);
		
		
		if ( ! empty($this->request->data)) {	
				
				
				// bof: save search
				$search = $this->request->data;
				$search_values = $search;
				
				$amenities = $search_values['Search']['data']['amenities'];
				$amenities_array = explode(',', $amenities);
				
				if(count($amenities)>0){
					$this->loadModel('Amenity');
					$amenities_description = $this->Amenity->find('all',
							array(
									'fields'=>'name',
									'conditions'=>array('Amenity.id'=>$amenities_array),
							)
					);
				
				}
				
				
				
				// data
				$data = $search['Search']['data'];
				
				$keep = array(
						'start_date'=>'',
						'end_date'=>'',
						'sleeping_capacity',
						'rate_by',
						'start_date',
						'end_date',
						'bedrooms',
						'bathrooms',
						'square_footage',
						'daily_rate',
						'amenities',
				);
				
				$clean_data = array( );
				foreach ($keep as $key) {
					if ( ! empty($data[$key])) {
						$clean_data[$key] = $data[$key];
					}
				}
				
				if (empty($clean_data['amenities'])) {
					$clean_data['amenities'] = array( );
				}
				
				// go
				
				$go = $search['Search']['go'];
				
				$keepgo = array(
						'destination',
						'city',
						'state',
						'state_abbr',
						'country',
						'country_abbr',
						'latitude',
						'longitude'
				
				);
				
				$clean_go = array( );
				foreach ($keepgo as $key) {
					if ( ! empty($go[$key])) {
						$clean_go[$key] = $go[$key];
					}
				}
				/*
				 echo "<br>Data: <br>";
				echo "<pre>";
				debug($clean_data);
				echo "<br>Go:<br>";
				debug($clean_go);
				echo "<pre>";
				exit();
				*/
				$search['Search']['data'] = serialize($clean_data);
				$search['Search']['go'] = serialize($clean_go);
				$search['Search']['user_id'] = $this->user['User']['id'];
				
				if($this->Search->save($search)){
					$search_id = $this->Search->id;
				
					$saved_search = $this->Search->find('first', array(
							'conditions' => array(
									'Search.id' => $search_id,
							),
					));
				
				
					$message = isset($this->request->data['Search']['id']) ? "Your Saved Search has been updated successfully" : "Your Saved Search has been created successfully";
					$this->Session->setFlash($message, 'default', 's');
				
					$return_search = $data;
					$return_search['saved_search_id'] = $saved_search['Search']['id'];
				
					$this->Session->write('Search.form', $return_search);
				
					$this->redirect(array('controller' => 'searches', 'action' => 'results'));				
					
				} 
		
		}// request data
		
		$this->set('savedsearches', $this->Search->find('all', array('conditions' => array('user_id' => $this->user['User']['id']))));
		$this->set('user_info', $this->user);
		$this->_setSelects(true);
		
	}// end save search