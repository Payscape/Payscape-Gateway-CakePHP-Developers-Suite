<?php

	// take the results returned and create a json object that can be used to inject the data
	echo $this->element('property_create_json', 
			array('properties' => $properties, 
			'ajax' => true));

