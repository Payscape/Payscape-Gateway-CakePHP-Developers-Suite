<?php 
function ajax_reults(){
	
	$TZ = date_default_timezone_get( );
	date_default_timezone_set('UTC');
	
	if ($this->request->params['isAjax']) {
		Configure::write('debug', 0);
	
	}
	// deal with BlueHost BIG_SELECTS issue
	
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
	
			}
	
		}//
	}
	
	/*
	 echo "<pre>";
	print_r($search);
	echo "</pre>";
	exit();
	*/
	
	$this->set('search', $search);
	$this->request->data = array('Search' => $search);
	
	/* bof search criteria */
	$conditions = array(
			'Property.published' => 1,
	);
	$joins = array( );
	
	/*
	 // if there is a lat long from moving the map,
	// disregard any other locations
	if ( ! empty($search['map_ne']) && ! empty($search['map_sw']) && ! empty($this->request->params['isAjax'])) {
	list($search['n_latitude'], $search['e_longitude']) = explode(',', $search['map_ne']);
	list($search['s_latitude'], $search['w_longitude']) = explode(',', $search['map_sw']);
	
	unset($search['country_id']);
	unset($search['state_id']);
	unset($search['city']);
	
	$conditions = array_merge($conditions, array(
			'Property.area_latitude BETWEEN ? AND ?' => array($search['s_latitude'], $search['n_latitude']), // make sure S is before N or mMySQL chokes
	));
	
	// do some tricky stuff here in case the map display wraps the -180 longitude line
	// google maps returns valid data when the map is zoomed so far it wraps a couple times
	if (($search['w_longitude'] > $search['e_longitude'])) {
	$conditions = array_merge($conditions, array(
			array(
					'OR' => array(
							// have to wrap these in their own array or the second one will kill the first due to same key
							array(
									'Property.area_longitude BETWEEN ? AND ?' => array($search['w_longitude'], 180),
							),
							array(
									'Property.area_longitude BETWEEN ? AND ?' => array(-180, $search['e_longitude']),
							),
					),
			),
	));
	}
	else {
	$conditions = array_merge($conditions, array(
			'Property.area_longitude BETWEEN ? AND ?' => array($search['w_longitude'], $search['e_longitude']), // make sure W is before E or MySQL chokes
	));
	}
	}
	else {
	// if the user comes in via a submitted form
	// disregard all map boundary data
	unset($search['map_ne']);
	unset($search['map_sw']);
	unset($search['n_latitude']);
	unset($search['e_longitude']);
	unset($search['s_latitude']);
	unset($search['w_longitude']);
	}
	*/
	
	/*
	 *
	$sm_map_ne_lat = $this->request->data['Search']['sm_map_ne_lat'];
	$sm_map_ne_lng = $this->request->data['Search']['sm_map_ne_lng'];
	$sm_map_sw_lat = $this->request->data['Search']['sm_map_sw_lat'];
	$sm_map_sw_lng = $this->request->data['Search']['sm_map_sw_lng'];
	
	* */
	
	/*
	 $conditions = array_merge($conditions, array(
	 		'Property.latitude' => 'IS NOT NULL',
	 ));
	$conditions = array_merge($conditions, array(
			'Property.longitude' => 'IS NOT NULL',
	));
	
	*/
	
	$conditions = array_merge($conditions, array(
			'Property.latitude' => array(">= LEAST($sm_map_ne_lat, $sm_map_sw_lat)"),
	));
	/*
	 $conditions = array_merge($conditions, array(
	 		'Property.latitude' => "<= GREATEST($sm_map_ne_lat, $sm_map_sw_lat)",
	 ));
	$conditions = array_merge($conditions, array(
			'Property.longitude' => ">= LEAST($sm_map_ne_lng, $sm_map_sw_lng)",
	));
	$conditions = array_merge($conditions, array(
			'Property.longitude' => "<= GREATEST($sm_map_ne_lng, $sm_map_sw_lng)",
	));
	*/
	if ( ! empty($search['country_id'])) {
		$conditions = array_merge($conditions, array(
				'Property.country_id' => $search['country_id'],
		));
	}
	
	if ( ! empty($search['state_id'])) {
		$conditions = array_merge($conditions, array(
				'Property.state_id' => $search['state_id'],
		));
	}
	
	if ( ! empty($search['city'])) {
		$conditions = array_merge($conditions, array(
				'Property.city' => $search['city'],
		));
	}
	/*
	 echo "<pre>";
	print_r($conditions);
	echo "</pre>";
	exit();
	*/
	
	
	$today = strtotime('today');
	if ( ! empty($search['start_date'])) {
		$sd = explode('/', trim($search['start_date']));
		$start_date = mktime(0, 0, 0, $sd[0], $sd[1], $sd[2]);
	
		if ($start_date < $today) {
			$start_date = $today;
		}
	
		$this->Session->write('Dates.start', $start_date);
	}
	else {
		$start_date = $today;
	}
	
	if ( ! empty($search['end_date'])) {
		$ed = explode('/', trim($search['end_date']));
	
		// we want to edit the date here to be one day behind where they input
		// because most people will select the day they are leaving, which is not necesarily
		// the day that is marked as "reserved"
		$end_date = mktime(0, 0, 0, $ed[0], $ed[1] - 1, $ed[2]);
	
		$this->Session->write('Dates.end', $end_date);
	}
	else {
		$end_date = strtotime('3000-01-01');
	}
	
	$search['results'] = 'all_dates';
	// filter by dates
	// this is going to be tricky for the 'partial_dates' option
	if ( ! empty($search['start_date']) || ! empty($search['end_date'])) {
		switch ($search['results']) {
			case 'partial_dates' :
				// this is going to be funky...
				$joins[] = array(
				'table' => 'reservations',
				'alias' => 'Reservation',
				'type' => 'LEFT',
				'conditions' => array(
				'Reservation.property_id = Property.id',
				'OR' => array(
				'Reservation.start_date BETWEEN ? AND ?' => array(date('Y-m-d', $start_date), date('Y-m-d', $end_date)),
				'Reservation.end_date BETWEEN ? AND ?' => array(date('Y-m-d', $start_date), date('Y-m-d', $end_date)),
				),
				),
				);
				// no break
	
			case 'all' :
				// do nothing
				break;
	
			case 'all_dates' :
			default :
				// only grab properties that are completely open during this time period
				$joins[] = array(
				'table' => 'reservations',
				'alias' => 'Reserved',
				'type' => 'LEFT',
				'conditions' => array(
				'Reserved.property_id = Property.id',
				'Reserved.unavailable' => 0,
				'NOT' => array(
				'Reserved.start_date > FROM_UNIXTIME('.$end_date.')', // start_date is inclusive
				'Reserved.end_date < FROM_UNIXTIME('.$start_date.')', // end_date is inclusive
				),
				),
				);
	
				$conditions['Reserved.id'] = null;
				break;
		}
	}
	
	if ( ! empty($search['sleeping_capacity'])) {
		$conditions = array_merge($conditions, array(
				'Property.sleeping_capacity >=' => $search['sleeping_capacity'],
		));
	}
	
	if ( ! empty($search['bathrooms']['min']) && ! empty($search['bathrooms']['max'])) {
		if (10 > $search['bathrooms']['max']) {
			$conditions = array_merge($conditions, array(
					'Property.bathrooms BETWEEN ? AND ?' => array($search['bathrooms']['min'], $search['bathrooms']['max']),
			));
		}
		else {
			$conditions = array_merge($conditions, array(
					'Property.bathrooms >=' => $search['bathrooms']['min'],
			));
		}
	}
	
	if ( ! empty($search['bedrooms']['min']) && ! empty($search['bedrooms']['max'])) {
		if (10 > $search['bedrooms']['max']) {
			$conditions = array_merge($conditions, array(
					'Property.bedrooms BETWEEN ? AND ?' => array($search['bedrooms']['min'], $search['bedrooms']['max']),
			));
		}
		else {
			$conditions = array_merge($conditions, array(
					'Property.bedrooms >=' => $search['bedrooms']['min'],
			));
		}
	}
	
	if ( ! empty($search['square_footage']['min']) && ! empty($search['square_footage']['max'])) {
		if (12000 > $search['square_footage']['max']) {
			$conditions = array_merge($conditions, array(
					'Property.square_footage BETWEEN ? AND ?' => array($search['square_footage']['min'], $search['square_footage']['max']),
			));
		}
		else {
			$conditions = array_merge($conditions, array(
					'Property.square_footage >=' => $search['square_footage']['min'],
			));
		}
	}
	
	if ( isset($search['daily_rate']['min']) && $search['daily_rate']['min']!='' && ! empty($search['daily_rate']['max'])) {
		if (1000 > $search['daily_rate']['max']) {
			$conditions = array_merge($conditions, array(
					'Property.daily_rate BETWEEN ? AND ?' => array($search['daily_rate']['min'], $search['daily_rate']['max']),
			));
		}
		else {
			$conditions = array_merge($conditions, array(
					'Property.daily_rate >=' => $search['daily_rate']['min'],
			));
		}
	}
	
	if ( ! empty($search['amenities'])) {
		$joins[] = array(
				'table' => 'amenities_properties',
				'alias' => 'AmenitiesProperty',
				'type' => 'LEFT',
				'conditions' => array(
						'AmenitiesProperty.property_id = Property.id',
				),
		);
	
		$conditions['AmenitiesProperty.amenity_id'] = $search['amenities'];
	}
	
	// these dates may have been set above as part of the search parameters
	// if not, set them to midnight last night
	$start_date = ife($start_date, strtotime('today'));
	$end_date = ife($end_date, strtotime('today'));
	
	$order = array(
			//			'Property.created' => 'desc',
			//			'Property.created' => 'rand()',
	);
	if ( ! empty($search['sort'])) {
		switch ($search['sort']) {
			case 'asc' :
			case 'desc' :
				// NOTE: this does NOT take any other price into account (off-season, etc)
				$order = array(
				'Property.daily_rate' => $search['sort'],
				);
				break;
	
			case 'id' :
			default :
				$order = array(
				'Property.created' => 'desc',
				);
				break;
		}
	}
	/* eof search criteria */
	
	
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
			'conditions' => $count_conditions
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
					'order' => $order,
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
	
	
	
	
}// ajax_results