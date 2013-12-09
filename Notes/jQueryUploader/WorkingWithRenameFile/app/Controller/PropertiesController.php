<?php 
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');
App::uses('String', 'Utility');

/**
 * PHP 5
 * Properties Results Handling Controller
 *
 * Controller used by Properties Results etc.
 *
 * @package       Cake.Controller
 */
class PropertiesController extends AppController {

	public $name = 'Properties';
	public $uses = array('Property', 'PendingProperty', 'Feedback');
	//public $behaviors = array('MeioUpload.MeioUpload', 'Image.Image');
	public $behaviors = array('Image.Image' );
	
	public $components = array('FileUpload.Upload'); // By Default your files will be stored in `app/webroot/files` . Check the docs in upload component for options
		public $helpers = array('TimeZone');
	


	/**
	 * This method takes the property_image_id as id
	 * and deletes the image in database
	 * @param int $property_id
	 * @param int $id
	 */
	function beforeFilter( ) {
		parent::beforeFilter( );
		if ($this->Auth->user('id') && $this->Cookie->read('CreateSpace')) {
			$this->create_space_continue($this->Auth->user('id'));
		}
	}

	function delete_photo($property_id, $id = '') {
		if (isset($id)) {
			$this->Property->PropertyImage->delete($id);
		}

		$this->Session->setFlash('Photo deleted successfully', 'default', 's');
		$this->redirect(array('controller' => 'properties', 'action' => 'create', 'photos', $property_id, 'tab2'));
	}

	/**
	 * This method is for an ajax call and it saves the
	 * propertyimage name in the database
	 */
	function add_photo_description() {
		$this->Property->PropertyImage->id = $this->request->data['id'];
		$this->Property->PropertyImage->set('name', $this->request->data['name']);
		$this->Property->PropertyImage->save(null, false);
		$this->autoRender = false;
	}

	/**
	 * Action for deletion of property goes here....
	 * @param INT $id
	 */
	function delete_property($id = null) {
		$this->Property->delete($id, true);
		$msg = "Your property has deleted successfully";
		$this->Session->setFlash($msg, 'default', 's');
		$this->redirect(array('controller' => 'properties',
			'action' => 'listings', $id
		));
	}

	/**
	 * This method is for an ajax call and it returns
	 * calculated costs for property
	 * propertyimage name in the database
	 */
	function calculate_cost($id = null) {
		// if the user hits this function, then they've gone on to the view page
		// so remove the dates
		$this->Session->delete('Dates');

		$this->layout = 'ajax';
		$return = array('status' => 0);

		if ( ! empty($this->request->data)) {
			extract($this->request->data);

			$start = preg_replace('%(\d{2})\D*(\d{2})\D*(\d{4})%', '$3/$1/$2', $start);
			$end = preg_replace('%(\d{2})\D*(\d{2})\D*(\d{4})%', '$3/$1/$2', $end);

			$price = $this->Property->get_price($id, $start, $end);

			$return['total'] = $price['total_price'];
			$return['nights'] = $price['days'];
			$return['discount'] = $price['discounted'];
			$return['sub_total'] = $price['total_price'] + $price['discounted'];
			$return['cost_per_night'] = round($price['total_price'] / $return['nights'], 2);
			$return['status'] = 1;
		}

		$this->set('results', $return);
	}

	function listings( ) {
		if (empty($this->request->data)) {
			$this->request->data = $this->User->find('first', array(
				'contain' => array(
					'Property' => array(
						'PropertyImage' => array(
							'limit' => 1,
						),
					),
				),
				'conditions' => array(
					'User.id' => $this->Auth->user('id'),
					'User.active' => 1,
				),
			));
			unset($this->request->data['User']['password']);
		}

		$this->set('user', $this->request->data);
		$this->set('user_info', $this->user);
	}

	function create_space_continue($user_id) {
		if ( ! $user_id) {
			return false;
		}

		if ($this->Cookie->read('CreateSpace')) {
			if ($this->Session->check('CreateSpace.token')) {
				$result = $this->PendingProperty->find('first', array(
					'conditions' => array(
						'PendingProperty.token' => $this->Session->read('CreateSpace.token'),
					),
					'order' => array(
						'PendingProperty.created' => 'DESC',
					),
				));
			}
			else {
				$result = $this->PendingProperty->find('first', array(
					'conditions' => array(
						'PendingProperty.ip' => env('REMOTE_ADDR'),
					),
					'order' => array(
						'PendingProperty.created' => 'DESC',
					),
				));
			}

			if ( ! empty($result)) {
				$this->PendingProperty->delete($result['PendingProperty']['id']);
				$this->Cookie->delete('CreateSpace');
				$this->Session->delete('CreateSpace');

				$property = json_decode($result['PendingProperty']['data'], true);
				$property['Property']['user_id'] = $user_id;

				$this->Property->create( );
				if ($this->Property->save($property)) {
					$id = $this->Property->getLastInsertID( );
					$this->Session->write('NewProperty', $id);

					$this->Session->setFlash(__('Your listing has been created successfully.'), 'default', 's');
				}
				else {
					$this->Session->setFlash(__('Unable to create your listing, please try again.'), 'default', 's');
				}
			}
		}
	}

	/*
	 * Create New Property when guest use Connect with Facebook...
	 */
	function create_space_with_fb() {
		// If trying to create listing and due some validation errors then pre-filled all relevant information in the form...
		if ($this->Cookie->read('CreateSpace')) {
			$this->loadModel('PendingProperty');
			$result = $this->PendingProperty->find('first', array('conditions'=>array('PendingProperty.ip'=>env('REMOTE_ADDR')), 'order'=>array('PendingProperty.created DESC')));
			if(!empty($result)){
				$this->PendingProperty->delete($result['PendingProperty']['id']);
				$property = json_decode($result['PendingProperty']['data'], true);
				$this->request->data = $property;

				if ( ! empty($this->request->data)) {
					if ( !empty($this->request->data['Property']['contact_email']) ) {
						//$this->Property->create( );
						$this->request->data['Property']['user_id'] = AuthComponent::user('id');

						if ($this->Property->check_limit(AuthComponent::user('id'), $this->request->data['Property']['id']) && $this->Property->save($this->request->data)) {
							$id = $this->Property->getLastInsertID( );

							// Listing created successfully then delete the Property Cookie...
							$this->Cookie->delete('CreateSpace');

							$this->Session->setFlash(__('Your listing has been created successfully and now you can upload photos.'), 'default', 's');
							$this->redirect(array('controller' => 'properties', 'action' => 'create', 'photos', $id), null, true);
						} else {
							$this->Cookie->delete('CreateSpace');
							$this->Session->setFlash(__("Unable to create your listing please try again."), 'default', 's');
							$this->redirect(array('controller' => 'users', 'action' => 'info'), null, true);
						}
					}
				}
			}else{
				$this->Cookie->delete('CreateSpace');
			}
		}
		$this->Session->setFlash(__("Unable to create your listing please try again."), 'default', 's');
		$this->redirect(array('controller' => 'users', 'action' => 'info'), null, true);
	}

	/*
	 * Create New Property functionality start from here.
	 */
	function create_space( ) {
		if (empty($this->request->data) && $this->Auth->user('id')) {
			$this->redirect(array('action' => 'create'));
		}

		if ( ! empty($this->request->data)) {
			if ( ! empty($this->request->data['Property']['connect_with_fb'])) {
				$this->Cookie->write('CreateSpace', 1);

				$data['data'] = json_encode($this->request->data);
				$data['ip'] = env('REMOTE_ADDR');
				$data['token'] = $this->_create_token('CreateSpace');

				$this->PendingProperty->create( );
				$this->PendingProperty->save($data);

				exit;
			}
			elseif ( ! $this->Property->User->duplicateEmail($this->request->data['User']['email'])) {
				App::import('Controller', 'Users');
				$Users = new UsersController;
				$Users->constructClasses( );
				$Users->request = $this->request;
				$user_id = $Users->add( );

				$this->request->data['Property']['user_id'] = $user_id;
				$this->Property->save($this->request->data);

				// User and Listing created successfully then delete the Property session...
				if ($this->Session->check('Property.CreateSpace')) {
					$this->Session->delete('Property.CreateSpace');
				}
			}
			else {
				$this->Session->write('Property.CreateSpace', $this->request->data);
				$this->Session->setFlash('That email address is already in use. You can login and create your listing.', 'default', 'f');
				$this->redirect(array('controller' => 'properties', 'action' => 'create_space'));
			}
		}

		// clear out any old pending properties
		$this->PendingProperty->deleteAll(array(
			'PendingProperty.created <' => date('Y-m-d', strtotime('-1 week')),
		));

		$faqs = m('FaqCategory')->find('first', array(
			'contain' => array(
				'Faq' => array(
					'conditions' => array(
						'Faq.active' => 1,
					),
				),
			),
			'conditions' => array(
				'FaqCategory.name' => 'LIST PROPERTY PAGE',
			),
		));
		$this->set(compact('faqs'));

		$this->_setSelects(true);
	}

	/*
	 * Create New Property functionality end here.
	 */
	function create($step = 'basic', $id = 0) {
		$this->Session->delete('NewProperty');

		if (is_numeric($step)) {
			$id = $step;
			$step = 'basic';
		}

		if (('basic' != $step) && empty($id)) {
			$this->Session->setFlash('Please fill this form before proceeding' , 'default' , 'n');
			$this->redirect(array('controller' => 'properties', 'action' => 'create'));
		}

		if ($id) {
			
			$property_id = (int) $id;
			$this->set('property_id', $property_id);
			
			$this->Property->contain(array(
				'PropertyImage' => array(
					'order' => array(
						'PropertyImage.sort' => 'asc',
					),
				),
				'Amenity',
				'Discount' => array(
					'order' => array(
						'Discount.lower_bound' => 'asc',
					),
				),
				'Price' => array(
					'order' => array(
						'Price.start_date' => 'asc',
					),
				),
			));
			$property = $this->Property->findById($id);

			$this->set('Property', $property);
		}

		if (empty($this->request->data) && empty($id) && ('basic' == $step)) {
			$this->Session->delete('Create');
		}

		// Added isset conditions because when we try to create new listing and new listing have no id then it's redirect on the dashboard...
		if ( ! empty($id)) {
			$this->_confirm_editability($id);
		}

		switch ($step) {
			case 'photos' :
				
				/*
				 * bof: new uploader
				
				

	$upload_dir = 'img/files/' . $property_id . '/images/';
	$this->set('upload_dir', $upload_dir);

	require_once(APP . 'Vendor' . DS. 'UploadHandler'.DS. 'UploadHandler.php');
	
	$options = array(
			'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'img/files/' . $property_id . '/images/',
			'upload_url' => $this->get_full_url().'img/files/' . $property_id . '/images/',
				
			);

				
				 // eof: new uploader
*/				
				
				
				
				
				 //Here url parameter "file" is used for
				// uploading image files using drag and drop feature
				
		

				
				if ( ! empty($this->request->query['file'])) {
					Configure::write('debug', 1);
					$tmp_filename = $this->request->params['form']['file']['tmp_name'];

					//lets handle the image if we know it's a big one
					if ($this->request->params['form']['file']['name'] == 'blob'){
						//this session is a flag that lets us know if we are in middle of a streamed image or the beginning.
						$image = $this->Session->read('stream');
						$path = TMP.'tmp_img.jpg';
						
						$path = TMP . 'plupload' . 'tmp_img.jpg';

						if (empty($image)) {
							//setup the flag if this is the first stream.
							$this->Session->write('stream', '1');
							$iHandle = fopen($path, 'w');
						}
						else {
							$iHandle = fopen($path, 'a');
						}

						$tHandle = fopen($this->request->params['form']['file']['tmp_name'], 'rb');
						//lets add the current chunk to the uploaded temp file.
						fwrite($iHandle, stream_get_contents($tHandle));
						fclose($tHandle);
						fclose($iHandle);

						//are we at the end of the stream?
						//if so lets fix the params so we won't have to touch the behavior.
						if ($this->request->params['form']['file']['size'] != 1048576){
							$this->request->params['form']['file']['name'] = time().'.jpg';
							$this->request->params['form']['file']['tmp_name'] = $path;
							$this->request->params['form']['file']['type'] = 'image/jpeg';
							$this->request->params['form']['file']['size'] = filesize($path);
							$tmp_filename = $this->request->params['form']['file']['tmp_name'];
							//this is the last part of the stream so lets remove the session
							$this->Session->delete('stream');
						}
						else {
							exit;
						}
					}
					$this->request->data['PropertyImage']['image'] = $this->request->params['form']['file'];
					$this->Property->PropertyImage->set($this->request->data);

					if ( ! $this->Property->PropertyImage->validates()) {
						$errors = $this->Property->PropertyImage->validationErrors;
						echo json_encode(array('errors' => $errors));
						exit;
					}

					if (file_exists($tmp_filename)) {
						$filename = time() . "_" . rand(0, 100);

						if (is_uploaded_file($tmp_filename)) {
							move_uploaded_file($tmp_filename, TMP . $filename);
						}
						else {
							copy($tmp_filename, TMP . $filename);
						}

						$this->request->params['form']['file']['tmp_name'] = TMP . $filename;
						echo json_encode($this->request->params['form']['file']);
						exit;
					}
				}

// 418
	/*
	 * 
	 * from here to marker 498 is no longer used
	 
	
				if ( ! empty($this->request->data)) {
					
				// bof:custom upload	
	$site_url =  Router::url('/', true);
					
					$options = array
					(
							'script_url' => $site_url.'site_url',
						//	'upload_dir' => APP.WEBROOT_DIR.DS.'img'.DS.'offer_picture'.DS,
						//	'upload_url' => SITE_URL.'img/offer_picture/',										

							'upload_dir' => APP.WEBROOT_DIR.DS.'img'.DS.'files'.$property_id .DS.'images'.DS,
							'upload_url' => $site_url.'/img/files/'. $property_id . '/images/',
											
						//	'max_number_of_files' => 3,
					'' => array
							(
									'max_width' => 640,
									'max_height' => 430,
									'jpeg_quality' => 100,
							)
					);
					
					$upload_handler = new UploadHandler($options, $initialize = false);
					switch ($_SERVER['REQUEST_METHOD'])
					{
						case 'HEAD':
						case 'GET':
							$upload_handler->get();
							break;
						case 'POST':
							$upload_handler->post();
							break;
						case 'DELETE':
							$upload_handler->delete();
							break;
						default:
							header('HTTP/1.0 405 Method Not Allowed');
					}
					
					
					 //eof: custom
					 
					
					if (isset($this->request->data['save_images'])) {
						$tempVar = $this->request->data['save_images'];
					}
					
					// if any invalid mimetypes are uploaded than show an error
					// and redirect to the same page
					
					
					if (isset($this->request->data['error'])) {
						$this->Session->setFlash($this->request->data['error'], 'default', 'f');
						$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
					}
					
					$full = $this->Property->PropertyImage->process($this->request->data);
					unset($this->request->data['PropertyImage']);
					
					if ($full) {
						$this->Session->setFlash(__('Only 8 images allowed.', true), 'default', 's');
						$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
					}
					
					
					// test the number of images
					$image_count = (int) $this->Property->PropertyImage->find('count', array(
							'conditions' => array(
									'PropertyImage.property_id' => $this->request->data['Property']['id'],
							),
					));
					
					if ( ! $image_count) {
						$this->Property->invalidate('images', 'You must upload at least one image');
						$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
					}
					
					// save these because Cake kills them when we read( )
					$validation_errors = $this->Property->validationErrors;
					
					$message = (($count_imgs > 1) ? 'Photos have ' : 'Photo has ') . 'been uploaded';
					$this->Session->setFlash(__($message, true), 'default', 's');
					$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
					
					
					
				} // if ! empty request data
	*/
// 498				

				break;

			case 'terms' :
				// set the timezone to UTC so we don't mess anything up
				$TZ = date_default_timezone_get( );
				date_default_timezone_set('UTC');

				if ( ! empty($this->request->data)) {
					$this->request->data['Property']['id'] = $id;

					// clean up the dates
					$this->request->data = $this->Property->Discount->clean_and_verify($this->request->data);
					if ( ! empty($this->request->data['Discount'][0])) {
						$this->request->data['Discount'][0]['property_id'] = $id;
					}

					$this->request->data = $this->Property->Price->clean_and_verify($this->request->data);
					if ( ! empty($this->request->data['Price'][0])) {
						$this->request->data['Price'][0]['property_id'] = $id;
					}

					// remove the title from the validation
					unset($this->Property->validate['title']);

					if ($this->Property->check_limit(AuthComponent::user('id'), $this->request->data['Property']['id']) && $this->Property->saveAll($this->request->data)) {
						$this->Session->setFlash(__('Property Saved', true), 'default', 's');
						$this->redirect(array('action' => 'create', 'calendar', $this->Property->id));
					}
					else {
						$this->Session->setFlash(__('There are errors in the form, please try again.', true), 'default', 'f');

						// revert the dates back
						foreach ($this->request->data['Discount'] as $key => $discount) {
							// alter our dates for the form
							if ( ! empty($discount['start_date'])) {
								$discount['start_date'] = date('m/d/Y', strtotime($discount['start_date']));
							}

							if ( ! empty($discount['end_date'])) {
								$discount['end_date'] = date('m/d/Y', strtotime($discount['end_date']));
							}

							$this->request->data['Discount'][$key] = $discount;
						}

						foreach ($this->request->data['Price'] as $key => $price) {
							// alter our dates for the form
							if ( ! empty($price['start_date'])) {
								$price['start_date'] = date('m/d/Y', strtotime($price['start_date']));
							}

							if ( ! empty($price['start_date'])) {
								$price['end_date'] = date('m/d/Y', strtotime($price['end_date']));
							}

							$this->request->data['Price'][$key] = $price;
						}
					}
				}
				else {
					foreach ($property['Discount'] as $key => $discount) {
						// alter our dates for the form
						if ( ! empty($discount['start_date'])) {
							$discount['start_date'] = date('m/d/Y', strtotime($discount['start_date']));
						}

						if ( ! empty($discount['end_date'])) {
							$discount['end_date'] = date('m/d/Y', strtotime($discount['end_date']));
						}

						$property['Discount'][$key] = $discount;
					}

					foreach ($property['Price'] as $key => $price) {
						// alter our dates for the form
						if ( ! empty($price['start_date'])) {
							$price['start_date'] = date('m/d/Y', strtotime($price['start_date']));
						}

						if ( ! empty($price['start_date'])) {
							$price['end_date'] = date('m/d/Y', strtotime($price['end_date']));
						}

						$property['Price'][$key] = $price;
					}
				}

				date_default_timezone_set($TZ);
				break;

			case 'calendar' :
				// set the timezone to UTC so we don't mess anything up
				$TZ = date_default_timezone_get( );
				date_default_timezone_set('UTC');

				// generate the calendar
				// grab the first of the display
				$now = time( );
				if ( ! empty($this->request->params['named']['mo'])) {
					if ((int) $this->request->params['named']['mo'] < date('Ym')) {
						$this->redirect(array('controller' => 'properties', 'action' => 'create', $step, $id));
					}

					$now = strtotime($this->request->params['named']['mo'].'15');
				}

				$start_date = strtotime('first sunday of this month', $now);
				if ($start_date !== strtotime('first day of this month', $now)) {
					$start_date = strtotime('last sunday of last month', $now);
				}

				$end_date = strtotime('last saturday of this month', $now);
				if ($end_date !== strtotime('last day of the month', $now)) {
					$end_date = strtotime('first saturday of next month', $now);
				}

				// grab the prices for the display
				$prices = $this->Property->get_daily_price($id, $start_date - DAY, $end_date);

				// grab the reservation statuses for the display
				$reservations = $this->Property->get_daily_status($id, $start_date, $end_date);

				$this->set(compact('start_date', 'end_date', 'prices', 'reservations'));

				date_default_timezone_set($TZ);
				break;

			case 'basic' :
				// no break
			default :
				if ( ! empty($this->request->data)) {
					$this->request->data['Property']['user_id'] = $this->user['User']['id'];

					if ($this->Property->check_limit(AuthComponent::user('id'), $this->request->data['Property']['id']) && $this->Property->save($this->request->data)) {
						$this->Session->setFlash(__('Property Saved', true), 'default', 's');
						$this->redirect(array('action' => 'create', 'photos', $this->Property->id));
					}
					else {
						$this->Session->setFlash(__('There are errors in the form, please try again.', true), 'default', 'f');
					}
				}

				break;
		}

		if (empty($this->request->data) && ! empty($property)) {
			$this->request->data = $property;
		}

		$states = array( );
		if (isset($this->request->data['Property']['country_id']) && $this->request->data['Property']['country_id'] !='') {
			$states = $this->Property->State->find('list', array(
				'conditions' => array(
					'State.country_id' => $this->request->data['Property']['country_id'],
				),
			));
		}
		if(empty($this->request->data['Property']['contact_email'])){
			$this->request->data['Property']['contact_email'] = $this->Auth->user('contact_email');
		}
		if(empty($this->request->data['Property']['contact_primary_phone'])){
			$this->request->data['Property']['contact_primary_phone'] = $this->Auth->user('contact_primary_phone');
		}
		$this->set("user_email",$this->Auth->user("email"));
		$this->set('states', $states);

		$this->set('id', $id);
		$this->set('step', $step);
		$this->_setSelects( );
		$this->render('create_' . $step);
	}

	// Modified on Oct 5th 2012....
	function view($id) {
		$this->Property->check_update_visibility($id);
		
	    if(isset($id)){
            $selected_id = $id;
            $base_url = $this->base;
            $properties_id = $selected_id;
            $this->set('properties_id', $properties_id);
                
            $this->set('selected_id', $selected_id);
            $this->set('base_url', $base_url);
        }  
        
		$this->Property->contain(array(
			'Country' => array(
				'fields' => array(
					'name',
				),
			),
			'State' => array(
				'fields' => array(
					'name',
					'abbr',
				),
			),
			'PropertyImage' => array(
				'order' => array(
					'PropertyImage.sort' => 'asc',
				),
			),
			'PropertyType' => array(
				'fields' => array(
					'name',
				),
			),
			'User',
			'Review' => array(
				'User',
				'conditions' => array(
					'verified' => 1,
				)
			),
			'Amenity' => array(
				'AmenitiesProperty'
			),
			'Discount'
		));
		$property = $this->Property->findById($id);

		// only allow non-published properties to be viewed by their owners (and admin) and also redirect on missing properties
		if (empty($property)
			|| (empty($property['Property']['published'])
				&& (
					empty($this->user)
					|| (
						('1' !== (string) $this->user['User']['group_id'])
						&& ((string) $this->user['User']['id'] !== (string) $property['Property']['user_id'])
					)
				)
			)
		) {
			$this->Session->setFlash(__('Invalid Property', true), 'default', 'f');
			$this->redirect('/');
		}

		$property_short_array = array( );
		if ( ! empty($property['PropertyType']['name'])) { $property_short_array[] = $property['PropertyType']['name']; }
		if ( ! empty($property['Property']['city'])) { $property_short_array[] = $property['Property']['city']; }
		if ( ! empty($property['State']['abbr'])) { $property_short_array[] = $property['State']['abbr']; }
		if ( ! empty($property['Property']['zip'])) { $property_short_array[] = $property['Property']['zip']; }
		if ( ! empty($property['Country']['name'])) { $property_short_array[] = $property['Country']['name']; }
		$property_short_info = implode(', ', $property_short_array);

		$property_plugin_url 	= Router::url('/', true).'properties/view/'.$property['Property']['id'];		
		$fb_like_url_for_layout = $property_plugin_url;

		$property_rating = $this->Property->calculate_ratings($id);
		$rating_types = $this->Property->Review->Rating->RatingType->find( 'all', array('fields' => array('name'), 'conditions' => array('active' => 1)) );

//		$wishlisted_ids = $this->Property->WishlistItem->Wishlist->getPids();
//		$custom_wishlist_count = $this->Property->WishlistItem->Wishlist->find('count', array('conditions' => array('user_id' => $this->user['User']['id'], 'is_custom_list' => 1)));
		
	
		$wishlist_id = $this->Property->WishlistItem->Wishlist->getWishlistID($this->user['User']['id']);

		
		$wishlisted_ids = $this->Property->WishlistItem->getPids($wishlist_id['Wishlist']['id']);
		
		$custom_wishlist_count = $this->Property->WishlistItem->Wishlist->find('count', array('conditions' => array('user_id' => $this->user['User']['id'], 'is_custom_list' => 1)));
		$now = time( );
		$start_date = strtotime('first sunday of this month', $now);
		if ($start_date !== strtotime('first day of this month', $now)) {
			$start_date = strtotime('last sunday of last month', $now);
		}

		$then = strtotime('+1 year', $now);
		$end_date = strtotime('last saturday of this month', $then);
		if ($end_date !== strtotime('last day of the month', $then)) {
			$end_date = strtotime('first saturday of next month', $then);
		}
		$this->set('reservations', $this->Property->get_daily_status($id, $start_date, $end_date));

		$this->set('amenities_list', $this->Property->Amenity->find('all'));

		$selected_amenities = array();
		if(count($property['Amenity']) > 0) {
			foreach($property['Amenity'] as $selected_amenity) {
				$selected_amenities[] = $selected_amenity['AmenitiesProperty']['amenity_id'];
			}
		}
		$this->set('selected_amenities', $selected_amenities);
		$this->set( 'title_for_layout',	$property['Property']['title'].' - '.$property_short_info );
		$property_host_name = my_ife($property['Property']['contact_name'], my_ife($property['User']['contact_name'], $property['User']['first_name'], false), false);
		$this->set( compact('fb_like_url_for_layout', 'property_plugin_url', 'property', 'property_short_info', 'property_rating', 'rating_types', 'wishlisted_ids', 'custom_wishlist_count', 'property_host_name') );

		if ($this->Session->check('Dates')) {
			$this->set('dates', $this->Session->read('Dates'));
		}
	}

	/*
	* Contact Me, Book It, Reservation froms are submitting here and sending to email to property host...
	*/
	function contact_me($id) {
		$property = $this->Property->find('first', array(
			'contain' => array(
				'User',
			),
			'conditions' => array(
				'Property.id' => $id,
				'Property.published' => 1,
			),
		));

		if (empty($property)) {
			$this->Session->setFlash(__('Invalid Property', true), 'default', 'f');
			$this->redirect(array('controller' => 'searches', 'action' => 'results'));
		}

		if ( ! empty($this->request->query['start']) && ! empty($this->request->query['end'])) {
			extract($this->request->query);
			$this->set(compact('start', 'end'));
		}

		$to_email = my_ife($property['Property']['contact_email'], my_ife($property['User']['contact_email'], $property['User']['email'], false), false);
		$to_name = my_ife($property['Property']['contact_name'], my_ife($property['User']['contact_name'], $property['User']['first_name'] . ' ' . $property['User']['last_name'], false), false);
		$this->set(compact('property', 'to_name'));

		if ( ! empty($this->request->data)) {
			$start = preg_replace('%(\d{2})\D*(\d{2})\D*(\d{4})%', '$3/$1/$2', $this->request->data['ContactMe']['start_date']);
			$end = preg_replace('%(\d{2})\D*(\d{2})\D*(\d{4})%', '$3/$1/$2', $this->request->data['ContactMe']['end_date']);

			// Send Inquiry Email to Host...
			$mail = new CakeEmail( );
			$mail->to(array($to_email => $to_name));
			$mail->from('inquire@vacationfish.com');
			$mail->subject('VacationFish Inquiry - ' . $property['Property']['title']);
			$mail->emailFormat('text');
			$mail->template('property_contact');
			$mail->viewVars(array(
				'email_data' => $this->request->data,
				'price' => $this->Property->get_price($id, $start, $end),
			));

		/*/ debugging
			Configure::write('debug', 2);
			$mail->transport('Debug');
			debug($mail->send( ));
			die;
		//*/

			try {
				$mail->send( );
				$this->Session->setFlash('Your email was sent to the host. Thank you.', 'default', 's');
			}
			catch (Exception $e) {
$this->do_log($e);
				$this->Session->setFlash('There was an error sending your email. Please try again.', 'default', 'f');
			}

			$this->redirect(array('controller' => 'properties', 'action' => 'view', $id));
		}

		$this->_setSelects( );
	}

	/*
	* Email Host, Reservation froms are submitting here and sending to email to property host...
	*/
	function email_host($id) {
		if(empty($id) && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Property', true), 'default', 'f');
			$this->redirect(array('controller' => 'searches', 'action' => 'results'));
		}
		if( isset($this->request->data['Reservation']['form_type']) && $this->request->data['Reservation']['form_type'] == 'Reservation' ) {
			$form_data = $this->request->data['Reservation'];
		}
		if( isset($this->request->data['ContactMe']['form_type']) && $this->request->data['ContactMe']['form_type'] == 'ContactMe' ) {
			$form_data = $this->request->data['ContactMe'];
		}
		if(isset($this->request->query['start'])){
			extract($this->request->query);
			$this->set(compact('start', 'end'));
		}

		if($id == '') $id = $form_data['property_id'];
		$property_info = $this->Property->find('first', array('fields' => array('Property.id', 'Property.user_id', 'Property.title', 'Property.contact_email', 'Property.contact_name'), 'conditions' => array('Property.id' => $id)));
		$user_info = $this->Property->User->find('first', array('fields' => array('User.first_name', 'User.last_name', 'User.email', 'User.contact_email', 'User.contact_name'), 'conditions' => array('User.id' => $property_info['Property']['user_id'])));

		$to_email = my_ife($property_info['Property']['contact_email'], my_ife($user_info['User']['contact_email'], $user_info['User']['email'], false), false);
		$to_name = my_ife($property_info['Property']['contact_name'], my_ife($user_info['User']['contact_name'], $user_info['User']['first_name'] . ' ' . $user_info['User']['last_name'], false), false);
		$this->set(compact('property_info', 'user_info', 'to_name'));

		if ( ! empty($this->request->data)) {
			// Send Inquire Email to Host...
			$mail = new CakeEmail( );
			$mail->to(array($to_email => $to_name));
			$mail->from('inquire@vacationfish.com');
			$mail->subject('VacationFish Booking Inquire - ' . $property_info['Property']['title']);
			$mail->emailFormat('html');
			$mail->template('property_contact');
			$mail->viewVars(array('email_data' => $form_data));

		/*/ debugging
			Configure::write('debug', 2);
			$mail->transport('Debug');
			debug($mail->send( ));
			die;
		//*/

			try {
				$email->send( );
				$this->Session->setFlash('Your email was sent to host. Thank you.', 'default', 's');
			}
			catch (Exception $e) {
$this->do_log($e);
				$this->Session->setFlash('There was an error sending your email. Please try again.', 'default', 'f');
			}

			$this->redirect(array('controller' => 'properties', 'action' => 'view', $id));
		}
	}


	/*
	* Updating Property Visibility through Ajax and JQuery Iphone style checkbox in the Listing page...
	*/
	function update_visibility($id, $status) {
		$this->autoRender = false;
		$this->layout = 'ajax';
		if(empty($id)) {
			$this->Session->setFlash(__('Invalid Property', true), 'default', 'f');
			$this->redirect(array('controller' => 'searches', 'action' => 'results'));
		}

		$this->Property->id = $id;
		$this->Property->saveField('published', $status);
		exit;
	}

	function availability($prop_id, $year = null) {
		if (empty($prop_id)) {
			$this->Session->setFlash(__('Invalid Property', true), 'default', 'f');
			$this->redirect('/');
		}

		$this->_confirm_accessibility($prop_id);
		$this->set('prop_id', $prop_id);

		if (empty($year)) {
			$year = date('Y');
		}
		$this->set('year', $year);

		$avail = $this->Property->Reservation->find('all', array(
			'conditions' => array(
				'Reservation.property_id' => (int) $prop_id,
				'OR' => array(
					'Reservation.start_date BETWEEN ? AND ?' => array($year.'-01-01', $year.'-12-31'),
					'Reservation.end_date BETWEEN ? AND ?' => array($year.'-01-01', $year.'-12-31'),
				),
			),
			'order' => array(
				'Reservation.start_date' => 'asc',
			),
		));
		$this->set('avail', $avail);

		// grab the page data for the sidebar
		$page = m('Page')->findBySlug('availability');
		$this->set('page', $page['Page']);
	}

	function add_fav($prop_id, $add = 1) {
		Configure::write('debug', 0);

		$prop_id = (int) $prop_id;
		$user_id = (int) $this->user['User']['id'];
		$add = (bool) $add;

		if ($prop_id && $user_id) {
			if ($add) {
				$this->Property->habtmAdd('Favorited', $prop_id, $user_id);
			}
			else {
				$this->Property->habtmDelete('Favorited', $prop_id, $user_id);
			}

			echo 'OK';
			exit;
		}

		echo 'FAIL';
		exit;
	}
	/*
	* function for send tour
	*/
	function send_a_tour( ) {
		if ($this->_send_emails($this->request->data)) {
			$this->Session->setFlash(__('Mail has been sent'));
			$this->redirect($this->referer());
		}
	}

	function send_contracts( ) {

		/**
		 * Adding an array list to filter document with mime types.
		 */
		$allowed_types = array('application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.template','application/vnd.ms-excel',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-powerpoint',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			'application/vnd.oasis.opendocument.spreadsheet',
			'application/pdf','application/x-pdf','image/bmp','image/gif',
			'image/jpeg','image/tiff', 'image/png');

		if ( ! empty($this->request->data['document']['name'])) {
			if ( ! in_array($this->request->data['document']['type'], $allowed_types)) {
				$this->Session->setFlash('Invalid file, please upload documents only');
				$this->redirect($this->referer());
			}
			else {
				$user_folder = $this->user['User']['id'];
				$property_folder = $this->request->data['id'];
				$property_document_folder = WWW_ROOT."uploads".DS."property_document".DS.$user_folder.DS.$property_folder;
				if ( ! is_dir($property_document_folder)) {
					new Folder($property_document_folder, true ,0777);
				}

				$attachedFile = $property_document_folder.DS.
				$this->request->data['document']['name'];
				if ( ! move_uploaded_file($this->request->data['document']['tmp_name'], $attachedFile)) {
					$this->Session->setFlash('File could not be attached, mail was not sent');
					$this->redirect($this->referer());
				}
			}
		}

		if (isset($attachedFile)) {
			if ($this->_send_emails($this->request->data, $attachedFile)) {
				if ($this->request->data['type'] == 'contract') {
					$this->Session->setFlash('Contract is sent');
					$this->redirect($this->referer());
				}
				elseif ($this->request->data['type'] == 'packet') {
					$this->Session->setFlash('Packet is sent');
					$this->redirect($this->referer());
				}
			}
			else {
				$this->Session->setFlash('Something went wrong, please try again later');
				$this->redirect($this->referer());
			}
		} else {
			if ($this->_send_emails($this->request->data, $attachedFile = '')) {
				if ($this->request->data['type'] == 'contract') {
					$this->Session->setFlash('Contract is sent');
					$this->redirect($this->referer());
				}
				elseif ($this->request->data['type'] == 'packet') {
					$this->Session->setFlash('Packet is sent');
					$this->redirect($this->referer());
				}
			} else {
				$this->Session->setFlash('Something went wrong, please try again later');
				$this->redirect($this->referer());
			}
		}
	}


	function one_click_host( ) {
		$this->_send_emails($mail_data);
	}

	/**
	 *
	 * @param Array $mail_data
	 * @param File $attachment
	 * @return boolean
	 * @desc This function will send email and take 2 parameters, mail_data will
	 * have an array of sender's information, etc. attachment will accept
	 * a file type which complies with mime-types which are allowed.
	 * returns TRUE on successful mail sent.
	 */
	function _send_emails($mail_data, $attachment = '') {
		$mail = new CakeEmail( );
		$mail->from($this->user['User']['email']);
		$mail->to($mail_data['their_email']);

		switch ($mail_data['type']) {
			case 'tour':
				$mail->subject('Please find the attached Tour guide');
				break;

			case 'contract':
				if ( ! empty($attachment)) {
					$mail->attachments($attachment);
				}
				$mail->subject('Important contract document for property');
				break;

			case 'packet' :
				if ( ! empty($attachment)) {
					$mail->attachments($attachment);
				}
				$mail->subject('Property packet enclosed');
				break;
		}

	/*/ debugging
		Configure::write('debug', 2);
		$mail->transport('Debug');
		debug($mail->send( ));
		die;
	//*/

		try {
			$mail->send($mail_data['letter']);
			return true;
		}
		catch (Exception $e) {
$this->do_log($e);
			return false;
		}
	}

	// this is a simple function to allow ajax creation of calendars
	function calendar($year, $month, $prop_id = null, $small = false) {
		if ( ! empty($prop_id)) {
			$start = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-01';
			$end = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-31';

			// grab the reservations for this property for this month
			$reservations = $this->Property->Reservation->find('all', array(
				'conditions' => array(
					'Reservation.property_id' => $prop_id,
					'OR' => array(
						'Reservation.start_date BETWEEN ? AND ?' => array($start, $end),
						'Reservation.end_date BETWEEN ? AND ?' => array($start, $end),
					),
				),
				'order' => array(
					'Reservation.start_date' => 'asc',
				),
			));
		}
		$this->set('reservations', $reservations);

		$this->set('year', $year);
		$this->set('month', $month);
		$this->set('prop_id', $prop_id);
		$this->set('small', $small);

		$this->layout = 'ajax';
	}

	function admin_add( ) {
		if ( ! empty($this->request->data)) {
			$this->_fix_add_sort(array('Bed'), array('number'), array('id', 'number'));
		}

		parent::admin_add( );
	}

	function admin_edit($id = null) {
		if ( ! empty($this->request->data)) {
			$this->_fix_add_sort(array('Bed'), array('number'), array('id', 'number'));
		}

		parent::admin_edit($id);
	}

	function _setSelects($active_only = false) {
		$ten_plus = range(0, 9);
		unset($ten_plus[0]);
		$ten_plus[] = '10+';

		$this->set('sleepingCapacities', $ten_plus);
		$this->set('bathrooms', $ten_plus);
		$this->set('bedrooms', $ten_plus);

		$this->set('property_types', $this->Property->PropertyType->find('list', array(
			'order' => array(
				'PropertyType.sort' => 'asc',
			),
		)));

		parent::_setSelects($active_only);
	}
	/*
	* function for confirm editability
	*/
	function _confirm_editability($prop_id) {
		if ( ! $this->Property->is_accessible($prop_id, $this->user['User']['id'])) {
			$this->Session->setFlash(__('Invalid Property', true), 'default', 'f');
			$this->redirect(array('controller' => 'users', 'action' => 'info'));
		}
	}
	/*
	* function for confirm accessibility
	*/
	function _confirm_accessibility($prop_id) {
		if ( ! ($prop = $this->Property->is_accessible($prop_id, $this->user['User']['id']))) {
			$this->Session->setFlash(__('Invalid Property', true), 'default', 'f');
			$this->redirect(array('controller' => 'users', 'action' => 'info'));
		}

		return $prop;
	}
	
	function imagesdelete($property_id, $action_id){
		if(isset($property_id)){
			$property_id = (int) $property_id;
		}
	
		if(isset($action_id)){
			$action_id = (int) $action_id;
		}
		
		if((! empty($property_id) && ($action_id == 37))){
			$imageids = $this->Property->getImageIDs($property_id);
	
		}
		
	}// imagesdelete
	
	protected function get_full_url() {
		$https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
		return
		($https ? 'https://' : 'http://').
		(!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
		(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
				($https && $_SERVER['SERVER_PORT'] === 443 ||
						$_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
						substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
	}
	
	function upload($property_id)
	{
		if(isset($property_id)){
			$property_id = (int) $property_id;
			
		//	$upload_file_name = 'mickeymouse.jpg';
		
		//	$this->saveImage($property_id, $file_name);
	
		require_once(APP . 'Vendor' . DS. 'UploadHandler/UploadHandler.php');
	
		//	'script_url' => SITE_URL.'service_pictures/upload/',		
		$script_url = 'properties/upload';
		
		//'img'.DS.'files'.DS.$property_id.'images'.DS
		$upload_dir = "img/files/$property_id/images/";
		
		//	'upload_url' => SITE_URL.'img/offer_picture/',
		$upload_url =  'img/files/' . $property_id . '/images/';
		
		
		$options = array
		(
				'property_id'=> $property_id,
				'script_url' => $script_url,
				'upload_dir' => $upload_dir,
				'upload_url' => $upload_url,
				'' => array
				(
						'max_width' => 630,
						'max_height' => 420,
				),
				// we may be able to cook up our name here
			//	'new_file_name' => $new_file_name,
		);
	
		$upload_handler = new UploadHandler($options, $initialize = false);

		switch ($_SERVER['REQUEST_METHOD'])
		{
			case 'HEAD':
			case 'GET':
				$upload_handler->get();
				break;
			case 'POST':
				$upload_handler->post();
				break;
			case 'DELETE':
				$upload_handler->delete();
				break;
			default:
				header('HTTP/1.0 405 Method Not Allowed');
		}
		// rename the file and move it to the final destination
	}// isset property_id
		// save the files names to the db
	

		
	//	echo "FILE: $file";
		
	//	exit;
	

		
	}// upload
	/*
	public function saveImage($property_id, $file){
		if((isset($property_id))&&(isset($file))){
	
			$this->Property->PropertyImage->set('sort', 4);
			$this->Property->PropertyImage->set('image', $file);
			$this->Property->PropertyImage->set('property_id', $property_id);
			$this->Property->PropertyImage->save();
		}
	
	
		//return TRUE;
	
	}// saveImage
*/
}// end Properies Controller