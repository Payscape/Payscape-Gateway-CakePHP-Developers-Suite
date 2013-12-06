<?php 
/**
 * PHP 5
 * Searches Results Handling Controller
 *
 * Controller used by Searches Results to render results and ajax results views etc.
 *
 * @package       Cake.Controller
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class SearchesController extends AppController {
//	var $layout = "axaj_create_properties";
	
	// for our custom pagination helper
	var $helpers = array( 'Html', 'Pagination', 'JS'=>array("Jquery"));
	
	public $name = 'Searches';
	public $components = array('RequestHandler'=>array('viewClassMap' => array(
            'json' => 'ApiKit.MyJson',
			),
        ), 'Session', 'Cookie');
	public $uses = array('Search', 'Property');
	public $result_options = array(
		'all_dates' => 'Show properties with all dates available',
		'partial_dates' => 'Show properties with partial dates available',
		'all' => 'Show all properties',
	);
	public $paginate = array( );
	
	/**
	 *  After Google Autocomplete search then redirect in this action from Home page...
	 *  and also checking if state and country exits in the DB otherwise save as a new state and country..
	 */
	function index() {
		if ( ! empty($this->request->data) || ! empty($this->request->state) ) {
			$this->_setSearchCriteria( );
			$this->request->data['Search']['results'] = 'all';
			$this->Session->write('Search.form', $this->request->data['Search']);
			$this->redirect(array('action' => 'results'));
		}

		if ( $this->Session->check('Search.form') ) {
			$this->request->data['Search'] = $this->Session->read('Search.form');
		}

		if ( ! empty($this->request->data['Search']['country']) ) {
			$this->set('states', $this->get_state($this->request->data['Search']['country']));
		}

		$this->_setSelects(true);
	}

	/*
	* Retrieving Country, State, City Ids from database By Abbreviation and also if not found in the DB then inserting as a new entry...
	*/
	function _setSearchCriteria( ) {
		// if there's no destination, clear all the location information
		if (empty($this->request->data['Search']['destination'])) {
			unset($this->request->data['Search']['destination']);
			unset($this->request->data['Search']['city']);
			unset($this->request->data['Search']['state']);
			unset($this->request->data['Search']['state_abbr']);
			unset($this->request->data['Search']['country']);
			unset($this->request->data['Search']['country_abbr']);
			unset($this->request->data['Search']['latitude']);
			unset($this->request->data['Search']['longitude']);
		}

		if ( ! empty($this->request->data['Search']['country_abbr'])) {
			$country_info = $this->Property->Country->findByTwoLetterCode(strtoupper($this->request->data['Search']['country_abbr']));
			if ( ! empty($country_info['Country']['id'])) {
				$this->request->data['Search']['country_id'] = $country_info['Country']['id'];
			}
			else {
				// Inserting New Country...
				$country_data['Country']['id'] = null;
				$country_data['Country']['name'] = $this->request->data['Search']['country'];
				$country_data['Country']['two_letter_code'] = $this->request->data['Search']['country_abbr'];
				$country_data['Country']['active'] = 0;
				unset($this->Property->Country->validate['two_letter_code']);
				unset($this->Property->Country->validate['three_letter_code']);
				$this->Property->Country->save($country_data);
				$this->request->data['Search']['country_id'] = $this->Property->Country->getLastInsertId( );
			}
		}

		if ( ! empty($this->request->data['Search']['state_abbr'])) {
			$state = $this->Property->State->findByAbbr(strtoupper($this->request->data['Search']['state_abbr']));
			if ( ! empty($state['State']['id'])) {
				$this->request->data['Search']['state_id'] = $state['State']['id'];
			}
			else {
				// Inserting New State with Country Id...
				$state_data['State']['country_id'] = $this->request->data['Search']['country_id'];
				$state_data['State']['name'] = $this->request->data['Search']['state'];
				$state_data['State']['abbr'] = $this->request->data['Search']['state_abbr'];
				$state_data['State']['active'] = 0;
				unset($this->Property->State->validate['abbr']);
				$this->Property->State->save($state_data);
				$this->request->data['Search']['state_id'] = $this->Property->State->getLastInsertId( );
			}
		}
	}

	/**
	 * this method is for advanced search using the data
	 * from the user's saved searches
	 */
	function ajax_load_search( ) {
		
	
		
		$this->autoRender = false;
		if(isset($this->request->data['id'])) {
			$id = $this->request->data['id'];
			if($id != 0 && $id != null) {
				$saved_search_data = $this->Search->findById($id);
				$unser_saved_search_data = unserialize($saved_search_data['Search']['data']);
				echo json_encode($unser_saved_search_data);
				$unser_saved_search_go = unserialize($saved_search_data['Search']['go']);
				echo json_encode($unser_saved_search_go);
			}
		}
	}

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

	/**
	* Save search
	*/
function save_search($type='index') {

	$message = "Please enter a title for your new Search";

	$this->set('message', $message);
	
	$this->set('type', $type);

	if ( ! empty($this->request->data)) {
			//debug($this->request->data);
			//exit();

		// bof: save search
		$search = $this->request->data;
		$search_values = $search;

		$amenities = $search_values['Search']['data']['amenities'];


		if(empty($amenities)){
			$amenities = array();
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
				
		}// saved 

	} else {
			$this->request->data['Search']['data'] = array(
				'bedrooms' => array(
					'min' => 1,
					'max' => 10,
				),
				'bathrooms' => array(
					'min' => 1,
					'max' => 10,
				),
				'square_footage' => array(
					'min' => 500,
					'max' => 12000,
				),
				'daily_rate' => array(
					'min' => 0,
					'max' => 2000,
				),
			);
	}// empty search data

	$this->set('savedsearches', $this->Search->find('all', array('conditions' => array('user_id' => $this->user['User']['id']))));
	$this->set('user_info', $this->user);
	$this->_setSelects(true);

}// end save search

	/**
	 * action for deletion of saved search goes here
	 * @param INT $id it takes one $id as an argument to delete the saved search
	 */
	function delete_saved_search($id) {
		// make sure this user can delete this search
		$search = $this->Search->find('first', array(
			'conditions' => array(
				'Search.id' => $id,
				'Search.user_id' => $this->user['User']['id'],
			),
		));

		if ( ! empty($search)) {
			$this->Search->delete($id);
			$this->Session->setFlash("Your Saved Search has been deleted successfully", 'default', 's');
		}
		else {
			$this->Session->setFlash("Invalid Saved Search", 'default', 'f');
		}

		$this->redirect(array('controller' => 'searches', 'action' => 'save_search'));
	}

	/**
	 * action for Sharing Search Results....
	 */
	function share_results( ) {
		if ( ! empty($this->request->data)) {
			$mail = new CakeEmail( );
			$mail->from($this->request->data['your_email']);
			$mail->to($this->request->data['their_email']);
			$mail->subject('Vacation Fish - Share Results');
			$mail->emailFormat('html');
			$mail->template('share_search_results');
			$mail->viewVars(array(
				'their_email' 	=> $this->request->data['their_email'],
				'comments' 		=> $this->request->data['comments'],
				'share_results' => $this->request->data['share_results'],
			));

		/*/ debugging
			Configure::write('debug', 2);
			$mail->transport('Debug');
			debug($mail->send( ));
			die;
		//*/

			try {
				$mail->send( );
				$this->Session->setFlash('Your Results has been shared successfully.', 'default', 's');
			}
			catch (Exception $e) {
$this->do_log($e);
				$this->Session->setFlash('There was an error sharing your results. Please try again.', 'default', 'f');
			}
			$this->redirect(array('controller' => 'searches' , 'action' => 'results'));
		}

		$this->set('share_results_params', base64_encode( serialize ($this->Session->read('Search.shareResults') ) ) );
	}


	/**
	 * State function for searching lisitng By States from Home page Search Map...
	 * @param String Accepts state of United States and Canada
	**/
	function state($state) {
		if ( ! empty($state)) {
			$state = $this->Property->State->findByAbbr(strtoupper($state));

			// run a search with everything allowed
			$this->request->data['Search'] = array(
				'state_id' => $state['State']['id'],
				'destination' => $state['State']['name'],
				'country_id' => 1, // usa
				'sleeping_capacity' => 0,
				'rate_by' => 'daily',
				'rate_daily' => array(
					'min' => 0,
					'max' => 9999999,
				),
				'pets_allowed' => 'E',
				'smoking_allowed' => 'E',
				'square_footage' => array(
					'min' => 0,
					'max' => 9999999,
				),
				'bathrooms' => array(
					'min' => 0,
					'max' => 9999999,
				),
				'bedrooms' => array(
					'min' => 0,
					'max' => 9999999,
				),
				'results' => 'all',
			);

			$this->Session->write('Search.form', $this->request->data['Search']);
			$this->redirect(array('action' => 'results'));
		}

		$this->redirect(array('action' => 'index'));
	}
	

	function results( ) {
		
	
		
		$user = array();
		
			if($this->Auth->user()){
				$user = $this->Auth->user();
			}

			
		$this->set('user', $user);	

// changed 'order' => $order to 'order' => 'rand()'
// we want the default map view to be entire US with 10 pins randomly selected.
	
		// set the timezone to UTC so nothing gets messed up due to timezones
		$TZ = date_default_timezone_get( );
		date_default_timezone_set('UTC');
		


		if ($this->request->params['isAjax']) {
			Configure::write('debug', 0);

		}
		
		if(isset($_POST['page'])){
			$post_page = (int) $_POST['page']; 
		} else {
			$post_page = 1;
		}
		
		$this->set('post_page', $post_page);
// deal with BlueHost BIG_SELECTS issue on TriuBenDev
//	$this->Search->query('SET SQL_BIG_SELECTS=1');

		$search = array( );
		if ( ! empty($this->request->data)) {
			$this->_setSearchCriteria( );
			$search = $this->request->data['Search'];
		}
		elseif ($this->Session->check('Search.form')) {
			$search = $this->Session->read('Search.form');
		}

		// if there is a saved search, use it
		$saved_search = array( );
		$saved_search_data_holder = array();
		$saved_search_go_holder = array();
		/*
		$saved_search_data_saved = array();
		$saved_search_go_saved = array();
		$saved_search_data_holder = array();
		$saved_search_go_holder = array();
		$saved_search_go = array();
		$saved_search_data = array();
		*/
		
		if ( ! empty($search['saved_search_id'])) {
			
		
			$result = $this->Search->find('first', array(
				'conditions' => array(
					'Search.id' => $search['saved_search_id'],
					'Search.user_id' => $this->user['User']['id'],
				),
			));
// combine search criteria with location criteria
			if ($result) {
			//	$saved_search = unserialize($result['Search']['data']);
				$saved_search_data_saved = unserialize($result['Search']['data']);
				$saved_search_go_saved = unserialize($result['Search']['go']);
				
				$saved_search_data = array_merge($saved_search_data_saved, $saved_search_data_holder);
				$saved_search_go = array_merge($saved_search_go_saved, $saved_search_go_holder);
				
				
				$saved_search = array_merge($saved_search_data, $saved_search_go);
				
			}
		}
		$search = array_merge($search, $saved_search);

		if ( ! empty($this->request->query['reset']) && empty($this->request->params['isAjax'])) {
			$search = array( );
			// get search count
			$search_count = count($search);
		}

		$this->Session->write('Search.form', $search);
		$this->set('search', $search);
		$this->request->data = array('Search' => $search);

		// always on conditions
		$conditions = array(
			'Property.published' => 1,
		);
		$joins = array( );
		


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
// set default search if no user input has been entered.
 		
	$kangaroo = 0;	
	$sessionData = $this->Session->read('Search.form');
	$sessionContent = array_filter($sessionData);
	
if(isset($this->request->post->data)){	
	$postData = $this->request->post->data;
	$postContent = array_filter($postData);
} else {
	$postContent = array();
}	
	
		
		if(empty($sessionContent) && (empty($postContent))){
		//	echo "we have a clean slate!";
			$kangaroo = 1;		
		//	exit();
		} 



		$this->set('kangaroo', $kangaroo);
	
		$property_ids = $this->Property->find('list', array(
			'fields' => array(
				'Property.id',
			),
			'joins' => $joins,
			'conditions' => $conditions,
		//	'order' => 'rand()',	
//		//	'order' => $order,
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
					'State',	
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
				//'order' => $order,
		'order' => 'RAND() DESC',
				'limit' => 20,
				
			),
		);
		

  	
		$properties = $this->paginate('Property');
		$this->set('properties', $properties);

/*		
		$counter = count($property_ids);
		$this->set('counter', $counter);
		
		$property_page = $properties['page'];
		$this->set('property_page', $property_page);
*/
	

		
		
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


		
		$wishlist_id = $this->Property->WishlistItem->Wishlist->getWishlistID($this->user['User']['id']);
		$pids = $this->Property->WishlistItem->getPids($wishlist_id['Wishlist']['id']);
				
		
		$this->set('pid', $pids);

		$this->_setSelects(true);

		// revert the timezone
		date_default_timezone_set($TZ);

		if ($this->request->params['isAjax']) {
			$this->render('results_ajax');

		}
		
		/*
		echo "<pre>";
		//debug($this->data);
		
		if($this->request->isAjax()){
		
			debug($this->data);
		
		}
		echo "</pre>";
*/
		if ($this->request->is('ajax')) {
			debug($this->data);
		}
		
		$this->set( 'loggedIn', $this->Auth->loggedIn() );
		

		
		
}// results
	


	function store_compare($id, $store) {
		Configure::write('debug', 0);

		$id = (int) $id;
		$store = (bool) $store;

		if ( ! $this->Session->check('Compare')) {
			$this->Session->write('Compare', array());
		}

		$compare = $this->Session->read('Compare');

		if ($store) {
			$compare[] = $id;
		}
		else {
			$compare = array_diff($compare, array($id));
		}
		print_r($compare);

		$this->Session->write('Compare', array_unique($compare));
		exit;
	}
	


	// this pulls a complete list of states
	// for the given country
	function get_state($country_id) {
		$states = array('Fail');

		$states = $this->Property->State->find('list', array(
			'fields' => array(
				'State.id',
				'State.abbr',
			),
			'conditions' => array(
				'State.country_id' => $country_id,
				'State.active' => 1,
			),
			'order' => array(
				'State.abbr' => 'asc',
			),
				));

		if ($this->RequestHandler->isAjax( )) {
			Configure::write('debug', 0);
			$this->set(compact('states'));
			$this->layout = 'ajax';
			$this->render('ajax_get_state');
		}
		else {
			return $states;
		}
	}

	function _setSelects($active_only = false) {
		$sleep_cap = range(0, 17);
		unset($sleep_cap[0]);
			foreach ($sleep_cap as $key => $value) {
				if ($key == 1) {
					$value = $value . " Guest";
				}
				else {
					$value = $value . " Guests";
				}
		$sleep_cap[$key] = $value;
		}
		$sleep_cap[] = '18+ Guests';
		$this->set('sleepingCapacities', $sleep_cap);

		$bathrooms = range(0, 9);
		unset($bathrooms[0]);
		$bathrooms[] = '10+';
		$this->set('bathrooms', $bathrooms);

		$bedrooms = range(0, 9);
		unset($bedrooms[0]);
		$bedrooms[] = '10+';
		$this->set('bedrooms', $bedrooms);

		$this->set('property_types', $this->Property->PropertyType->find('list', array(
			'order' => array(
				'PropertyType.sort' => 'asc',
			),
		)));

		$this->set('amenities', $this->Property->Amenity->find('list',
				array('conditions' => array(
				'Amenity.main' => 1,
			),
			'order' => array(
				'Amenity.name' => 'asc',
			),
		)));

		$this->set('result_options', $this->result_options);

		if ( ! isset($this->viewVars['states'])) {
			$this->set('states', $this->Property->State->find('list', array(
				'fields' => array(
					'State.id',
					'State.abbr',
				),
				'conditions' => array(
					'State.country_id' => 1,
					'State.active' => (int) $active_only,
				),
				'order' => array(
					'State.abbr' => 'asc',
				),
			)));
		}

		$rate_by_options = array(
			'daily' => 'Daily',
			'weekly' => 'Weekly',
			'monthly' => 'Monthly',
		);
		$this->set('rate_by_options', $rate_by_options);

		parent::_setSelects($active_only);
	}
	
	/*
	 * not used
	 * */
public function contact() {
  if ($this->request->is('ajax')) {
    // Use data from serialized form
     print_r($this->request->data['SaveSearchAjx']); // name, email, message
    $this->render('contact-ajax-response', 'ajax'); // Render the contact-ajax-response view in the ajax layout
  }
}

	

}// end searches controller