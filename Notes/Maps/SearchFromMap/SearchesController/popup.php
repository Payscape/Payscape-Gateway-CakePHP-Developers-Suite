<?php 

	function popup( ) { 
		
	
		
		//http://localhost:8082/vfish22.localdomain/public_html/searches/popup?start_date=&end_date=&sleepingcapacity=1&rate_by=&daily_rate.min=&daily_rate.max=&bedrooms.min=&bedrooms.max=&bathrooms.min=&bathrooms.max=&square_foot.min=&square_foot.max=&amenities=undefined&destination=undefined&city=&state=&state_abbr=&country=&country_abbr=&latitude=&longitude=
		
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
		
		$this->set('search', $search_values);
		$this->set('activity', '');
		$this->set('amenities_description', array());
		$this->set('post', FALSE);
		
		$amenities = array();
		$amenities_description = array();
		
		$message = "Please enter a title for your search";
		$this->set('message', $message);
		
		
	/*	
		$params = $this->params['url'];
		
		echo "params:<br> ";
		echo "<pre>";
		debug($params);
		echo "</pre>";
		exit();
*/
	if ($this->request->is('ajax')) {

	
/*
 * bof: testing
 * */	
			if(!empty($_GET)){
				$search_values = $_GET;
			}
	
	
	/*	
	echo "<pre>";
	debug($search);
	echo "</pre>";
	exit();

	$savesearch = serialize($search);
	
	foreach($search as $key=>$value){
		echo "<br>key: $key value: $value";
	}
	
	echo "<pre>";
	
	echo $savesearch;
	
	echo "<pre>";
	
	
	// Use data from serialized form
//	print_r($this->request->data['SaveSearchAjx']); // name, email, message
//	$this->render('contact-ajax-response', 'ajax'); // Render the contact-ajax-response view in the ajax layout


	exit();
		

 * eof: testing
 * */

	
			$amenities = $search_values['amenities'];
			
			$amenities_array = explode(',', $amenities);
			
			$this->loadModel('Amenity');
			
			if(count($amenities>0)){
				$amenities_description = $this->Amenity->find('all',
						array(
								'fields'=>array('name'),
								'conditions'=>array('Amenity.id' => $amenities_array),
						)
				);
			
			}
			$post = FALSE;
			$this->set('post', $post);
			$this->set('search', $search_values);
			$activity = "new_search";
			$this->set('activity', $activity);
			$this->set('amenities_description', $amenities_description);
				
			

} // is ajax
	

//		debug($search);
		
	if ($this->request->is('post')) {
	
			if ( ! empty($this->request->data)) {
				//debug($this->data);
				//exit();
				// make sure this is a valid search for this user
				if ( ! empty($this->request->data['Search']['id']))
				{
					$this_search = $this->Search->find('first', array(
							'conditions' => array(
									'Search.id' => $this->request->data['Search']['id'],
							),
					));
						
					if ( ! $this_search || ! ((int) $this->user['User']['id'] === (int) $this_search['Search']['user_id'])) {
						$this->Session->setFlash('Invalid Search', 'default', 's');
						$this->redirect(array('controller'=>'searches', 'action'=>'results'));
					}
				}			
				
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
				
				
	
			// search data	
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
				
				// search destination
	
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
			} else {
				
				$post = TRUE;
				$this->set('post', $post);
				$amenities = $search_values['Search']['data']['amenities'];
					
				$amenities_array = explode(',', $amenities);
					
				$this->loadModel('Amenity');
					
				if(count($amenities>0)){
					$amenities_description = $this->Amenity->find('all',
							array(
									'fields'=>array('name'),
									'conditions'=>array('Amenity.id' => $amenities_array),
							)
					);
						
				}
				
				$this->set('amenities_description', $amenities_description);
				$this->set('search', $search_values);
				$activity = "new_search";
				$this->set('activity', $activity);
				
				$message = "There was a problem saving your search.";
				$this->set('message', $message);
			}
		}// request data
				
	} // is post
				

}// end popup
