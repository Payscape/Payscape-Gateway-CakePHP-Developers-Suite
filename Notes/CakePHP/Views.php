<?php 
	/*
	 * render a View
	 * controller; Searches
	 * method: function get_state($country_id)
	 * */

$this->render('ajax_get_state');


	/*
	 * render an Element
	 * */


	/*
	 * pass values to the view from the controller
	 * */

	$text = "Aarf!";
	$firebugs = "Fireflies";
	
	$this->set('text', $text);
	
	$this->set(array('text'=>$text, 'firebugs'=>$firebugs));
	/*
	 * this is NOT correct. 
	 * if we want to "set" multiple values, we first declare them, 
	 * then do this:
	 * */
	
	$this->set(compact('text', 'firebugs'));

?>