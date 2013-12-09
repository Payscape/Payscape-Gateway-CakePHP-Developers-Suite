<?php 

	/*
	 * Prepare the required data that we will be receiving from Form Input
	 * 
	 */

	/* Sale transaction */

	$type = 'sale';
	$key_id = $this->request->data['key_id']; 

	$hash =  "/* check this out */";
	
	$time = gmdate('YmdHis');

 
	$data = array(
		
			`type` => $type,
			`key_id` => $key_id,
			`hash` => $hash,
			`time` => $time,
			`ccnumber` => $ccnumber,
			`ccexp` => $ccexp,
			`checkname` => $checkname,
			`checkaba` => $checkaba,
			`chackaccount` => $checkacount,
			`account_holder_type` => $account_holder_type,
			`account_type` => $account_type,
			`amount` => $amount,
			`cvv` => $cvv,
			`payment` => $payment,
			`ipaddress` => $ipaddress,
			`firstname` => $firstname,
			`lastname` => $lastname,
			`company` => $company,
			`address1` => $address_one,
			`city` => $city,
			`state` => $state,
			`zip` => $zip,
			`country` => $country,
			`phone` => $phone,
			`fax` => $fax,
			`email` => $email,
			
	);

?>