<?php
class FileUploadController extends FileUploadAppController {

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow("*");
	}

	public function index()
	{
	
		
		
	}
	
	public function create($property_id){
		if(isset($property_id)){
			$property_id = (int) $property_id;
		}
		
		echo "property_id: $property_id";
		exit();
	}
}// end