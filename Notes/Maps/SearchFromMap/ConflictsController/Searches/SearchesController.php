

	// for drag and drop map searches
	function ajax_results(){
		
		$TZ = date_default_timezone_get( );
		date_default_timezone_set('UTC');
		
		if ($this->request->params['isAjax']) {
			Configure::write('debug', 0);
		
		}
		
		$this->Search->query('SET SQL_BIG_SELECTS=1');
		if ($this->request->is('ajax')) {
				
			if ($this->request->is('post')) {
				$search = array( );
				if ( ! empty($this->request->data)) {
					$this->_setSearchCriteria( );
					$search = $this->request->data['Search'];
					$sm_map_ne_lat = $this->request->data['Search']['sm_map_ne_lat'];
					$sm_map_ne_lng = $this->request->data['Search']['sm_map_ne_lng'];
					$sm_map_sw_lat = $this->request->data['Search']['sm_map_sw_lat'];
					$sm_map_sw_lng = $this->request->data['Search']['sm_map_sw_lng'];
					
				$this->set('search', $search);	
	
						
					
	// bof: conditions
		$conditions = array(
				'Property.published' => 1,					
		);
		
		if($sm_map_ne_lat > $sm_map_sw_lat){
			$conditions = array_merge($conditions, array(
					"Property.latitude <=" => $sm_map_ne_lat,
					"Property.latitude >=" => $sm_map_sw_lat,
					));
			
		} else {
			$conditions = array_merge($conditions, array(
					"Property.latitude >=" => $sm_map_ne_lat,
					"Property.latitude <=" => $sm_map_sw_lat,
			));			
		}

		if($sm_map_ne_lng > $sm_map_sw_lng){
			$conditions = array_merge($conditions, array(
					"Property.longitude <=" => $sm_map_ne_lng,
					"Property.longitude >=" => $sm_map_sw_lng,
			));
				
		} else {
			$conditions = array_merge($conditions, array(
					"Property.longitude >=" => $sm_map_ne_lng,
					"Property.longitude <=" => $sm_map_sw_lng,
			));
		}	
		
		
		$joins = array( );

		
$property_ids = $this->Property->find('list', array(
			'fields' => array(
					'Property.id',
			),
			'joins' => $joins,
			'conditions' => $conditions,
			'order' => 'rand()',
			//			'order' => $order,
			//	'limit' => 50,
	));
	
	$count_conditions = array('Property.id' => $property_ids);
	
	$total_properties = $this->Property->find('count', array(
			'conditions' => $count_conditions,
	));
	
	$this->paginate = array(
			'total_properties' => $total_properties,
			'Property' => array(
					'contain' => array(
							'Discount',
							'PropertyImage' => array(
									'order' => array(
											'PropertyImage.sort' => 'asc',
									),
									'limit' => 1,
							),
							'PropertyType',
							'User',
					),
					'conditions' => array(
							'Property.id' => $property_ids,
					),
					'limit' => 10,
	
			),
	);
	
	
	
	$properties = $this->paginate('Property');
	$this->set('properties', $properties);
	
	
	if ( ! empty($this->user['User']['id'])) {
		$custom_wishlist_count = $this->Property->WishlistItem->Wishlist->find('count', array(
				'conditions' => array(
						'user_id' => $this->user['User']['id'],
						'is_custom_list' => 1,
				),
		));
		$this->set('custom_wishlist_count', $custom_wishlist_count);
	
		$savedsearches = $this->Search->find('list', array(
				'conditions' => array(
						'user_id' => $this->user['User']['id'],
				),
		));
	
		if ( ! count($savedsearches)) {
			$savedsearches[0] = "empty";
		}
	
		$this->set('savedsearches' , $savedsearches);
	}
	
	//	$pids = $this->Property->WishlistItem->Wishlist->getPids( );
	//	$pids = $this->Property->WishlistItem->getPids( );
	
	$wishlist_id = $this->Property->WishlistItem->Wishlist->getWishlistID($this->user['User']['id']);
	$pids = $this->Property->WishlistItem->getPids($wishlist_id['Wishlist']['id']);
	
	
	$this->set('pid', $pids);
	
	$this->_setSelects(true);
	
	// revert the timezone
	date_default_timezone_set($TZ);
	
	$this->render('results_ajax');
		
	  }// !empty data			
	 }//is post
	}// is ajax
		
}// ajax_results