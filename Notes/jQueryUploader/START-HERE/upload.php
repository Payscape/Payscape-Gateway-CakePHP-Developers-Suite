<?php 
function upload($property_id)
{
	if(isset($property_id)){
		$property_id = (int) $property_id;
	}
	
	require_once(APP . 'Vendor' . DS. 'UploadHandler/UploadHandler.php');


	$options = array
	(
//	'script_url' => SITE_URL.'service_pictures/upload/',
	'script_url' => 'properties/upload/',	
// 	'upload_dir' => APP.WEBROOT_DIR.DS.'img'.DS.'offer_picture'.DS,			
	'upload_dir' => APP.WEBROOT_DIR.DS.'img'.DS.'files'.DS.$property_id.'images'.DS,
//	'upload_url' => SITE_URL.'img/offer_picture/',
	'upload_url' => SITE_URL.'img/files/' . $project_id . '/images/',	
	'' => array
			(
					'max_width' => 630,
					'max_height' => 420,
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
	exit;
 }// end upload 

