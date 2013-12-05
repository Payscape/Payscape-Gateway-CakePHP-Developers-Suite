<?php
class BillingOrchard {

	var $apikey 	= 'ApiKey';					//Api Key available from your BillingOrchard.com Account
	var $key 		= 'BillingOrchard2012';
	var $url 		= 'https://billingorchardapi.com/webservice/ChooseService.php';
	var $userid 	= 12345; 					//Replace with your UserID from BillingOrchard.com 

	private function send($data){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		curl_close($ch);
		return json_decode($output, true);
	}

	private function encode($service,$data){
		$timestamp = gmdate("Ymd H:i",time());
		$sig = base64_encode(hash_hmac('sha256', $this->apikey.$service.$timestamp, $this->key,true)); 
		$object = json_encode($data);
		$encoded = array(
			'jsonData' => '{"apikey":"'.$this->apikey.'","sig":"'.$sig.'","timestamp":"'.$timestamp.'","service":"'.$service.'","object":'.$object.'}'
		);
		return $encoded;
	}

	//
	// VIEWS
	//

	public function ViewUsers($incoming=null){
		$encoded = $this->encode('ViewUsers',$incoming);
		return $this->send($encoded);  
	}

	public function ViewClients($incoming=null){
		$encoded = $this->encode('ViewClients',$incoming);
		return $this->send($encoded);  
	}

	public function ViewHourlyServices($incoming=null){
		$encoded = $this->encode('ViewHourlyServices',$incoming);
		return $this->send($encoded);  
	}

	public function ViewInvoices($incoming=null){
		$encoded = $this->encode('ViewInvoices',$incoming);
		return $this->send($encoded);  
	}

	public function ViewPayments($incoming=null){
		$encoded = $this->encode('ViewPayments',$incoming);
		return $this->send($encoded);  
	}

	public function ViewBilledMisc($incoming=null){
		$encoded = $this->encode('ViewBilledMisc',$incoming);
		return $this->send($encoded);  
	}

	public function ViewMiscItems($incoming=null){
		$encoded = $this->encode('ViewMiscItems',$incoming);
		return $this->send($encoded);  
	}

	public function ViewBilledHourly($incoming=null){
		$encoded = $this->encode('ViewBilledHourly',$incoming);
		return $this->send($encoded);  
	}

	public function ViewSubscribers($incoming=null){
		$encoded = $this->encode('ViewSubscribers',$incoming);
		return $this->send($encoded);  
	}

	public function ViewRecurringBilling($incoming=null){
		$encoded = $this->encode('ViewRecurringBilling',$incoming);
		return $this->send($encoded);  
	}

	//
	// UPDATES
	//

	public function UpdateClients($incoming){
		$required = array('ClientID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateClients',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
	
	public function UpdateHourlyServices($incoming){
		$required = array('ItemID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateHourlyServices',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
	
	public function UpdateInvoices($incoming){
		$required = array('Invoice');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateInvoices',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
	
	public function UpdateBilledMisc($incoming){
		$required = array('BMID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateBilledMisc',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
	
	public function UpdateMiscItems($incoming){
		$required = array('MiscID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateMiscItems',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
	
	public function UpdateBilledHourly($incoming){
		$required = array('BHID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateBilledHourly',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
	
	public function UpdateSubscribers($incoming){
		$required = array('CID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateSubscribers',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
	
	public function UpdateRecurringBilling($incoming){
		$required = array('RBID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = $this->encode('UpdateRecurringBilling',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	//
	// ADDS
	//

	public function AddClients($incoming){
		$required = array('ClientLogin', 'ClientPassword', 'Client', 'Email');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {  
			$data = array(); 
			$data['ClientLogin'] = $incoming['ClientLogin'];
			$data['ClientPassword'] = $incoming['ClientPassword'];
			$data['Client'] = $incoming['Client'];
			$data['Email'] = $incoming['Email'];
			$data['Tel'] = (isset($incoming['Tel']) ? $incoming['Tel'] : '');
			$data['Fax'] = (isset($incoming['Fax']) ? $incoming['Fax'] : '');
			$data['Contact'] = (isset($incoming['Contact']) ? $incoming['Contact'] : '');
			$data['Address'] = (isset($incoming['Address']) ? $incoming['Address'] : '');
			$data['Address2'] = (isset($incoming['Address2']) ? $incoming['Address2'] : '');
			$data['City'] = (isset($incoming['City']) ? $incoming['City'] : '');
			$data['State'] = (isset($incoming['State']) ? $incoming['State'] : '');
			$data['Zip'] = (isset($incoming['Zip']) ? $incoming['Zip'] : '');
			$data['Country'] = (isset($incoming['Country']) ? $incoming['Country'] : '');
			$data['LastLogin'] = (isset($incoming['LastLogin']) ? $incoming['LastLogin'] : '');
			$data['Active'] = (isset($incoming['Active']) ? $incoming['Active'] : 1);
			$data['Notes'] = (isset($incoming['Notes']) ? $incoming['Notes'] : '');
			$data['CustomField'] = (isset($incoming['CustomField']) ? $incoming['CustomField'] : '');
			$data['CustomFieldValue'] = (isset($incoming['CustomFieldValue']) ? $incoming['CustomFieldValue'] : '');
			$data['ReceiveMail'] = (isset($incoming['ReceiveMail']) ? $incoming['ReceiveMail'] : 0);
			$data['NextBillDate'] = (isset($incoming['NextBillDate']) ? $incoming['NextBillDate'] : '');
			$data['FreqUnit'] = (isset($incoming['FreqUnit']) ? $incoming['FreqUnit'] : '');
			$data['FreqDuration'] = (isset($incoming['FreqDuration']) ? $incoming['FreqDuration'] : 0);
			$data['AutoCharge'] = (isset($incoming['AutoCharge']) ? $incoming['AutoCharge'] : 0);
			$data['ClientCard'] = (isset($incoming['ClientCard']) ? $incoming['ClientCard'] : '');
			$data['ClientExp'] = (isset($incoming['ClientExp']) ? $incoming['ClientExp'] : '');
			$data['ClientCardType'] = (isset($incoming['ClientCardType']) ? $incoming['ClientCardType'] : '');
			$data['ClientFirstName'] = (isset($incoming['ClientFirstName']) ? $incoming['ClientFirstName'] : '');
			$data['ClientLastName'] = (isset($incoming['ClientLastName']) ? $incoming['ClientLastName'] : '');
			$data['DateDeleted'] = (isset($incoming['DateDeleted']) ? $incoming['DateDeleted'] : '');
			$data['GST'] = (isset($incoming['GST']) ? $incoming['GST'] : 0);
			$data['PST'] = (isset($incoming['PST']) ? $incoming['PST'] : 0);
			$data['HST'] = (isset($incoming['HST']) ? $incoming['HST'] : 0);
			$data['PSTCompound'] = (isset($incoming['PSTCompound']) ? $incoming['PSTCompound'] : 0);
			$data['GSTRate'] = (isset($incoming['GSTRate']) ? $incoming['GSTRate'] : 0);
			$data['PSTRate'] = (isset($incoming['PSTRate']) ? $incoming['PSTRate'] : 0);
			$data['HSTRate'] = (isset($incoming['HSTRate']) ? $incoming['HSTRate'] : 0);
			$data['DefaultRate'] = (isset($incoming['DefaultRate']) ? $incoming['DefaultRate'] : 0);
			$data['BankAcctFirstName'] = (isset($incoming['BankAcctFirstName']) ? $incoming['BankAcctFirstName'] : '');
			$data['BankAcctLastName'] = (isset($incoming['BankAcctLastName']) ? $incoming['BankAcctLastName'] : '');
			$data['BankAcctRoutingNum'] = (isset($incoming['BankAcctRoutingNum']) ? $incoming['BankAcctRoutingNum'] : '');
			$data['BankAcctNum'] = (isset($incoming['BankAcctNum']) ? $incoming['BankAcctNum'] : '');
			$data['BankAcctHolderType'] = (isset($incoming['BankAcctHolderType']) ? $incoming['BankAcctHolderType'] : '');
			$data['BankAcctType'] = (isset($incoming['BankAcctType']) ? $incoming['BankAcctType'] : '');
			$data['AutoChargeACH'] = (isset($incoming['AutoChargeACH']) ? $incoming['AutoChargeACH'] : 0);
			$data['CustomFieldTwo'] = (isset($incoming['CustomFieldTwo']) ? $incoming['CustomFieldTwo'] : '');
			$data['CustomField2'] = (isset($incoming['CustomField2']) ? $incoming['CustomField2'] : '');
			$data['CustomFieldValue2'] = (isset($incoming['CustomFieldValue2']) ? $incoming['CustomFieldValue2'] : '');
			$data['CustomField3'] = (isset($incoming['CustomField3']) ? $incoming['CustomField3'] : '');
			$data['CustomFieldValue3'] = (isset($incoming['CustomFieldValue3']) ? $incoming['CustomFieldValue3'] : '');
			$data['CustomField4'] = (isset($incoming['CustomField4']) ? $incoming['CustomField4'] : '');
			$data['CustomFieldValue4'] = (isset($incoming['CustomFieldValue4']) ? $incoming['CustomFieldValue4'] : '');
			$data['CellNum'] = (isset($incoming['CellNum']) ? $incoming['CellNum'] : '');
			$encoded = $this->encode('AddClients',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddHourlyServices($incoming){
		$required = array('Service','Description','HourlyRate');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['Service'] = $incoming['Service'];
			$data['Description'] = $incoming['Description'];
			$data['HourlyRate'] = $incoming['HourlyRate'];
			$data['Taxable'] = (isset($incoming['Taxable']) ? $incoming['Taxable'] : 0);
			$encoded = $this->encode('AddHourlyServices',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddInvoices($incoming){
		$required = array('ClientID','InvoiceDate','DueDate','TotalCost','OutstandingAmount','TotalTax');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['ClientID'] = $incoming['ClientID'];
			$data['InvoiceDate'] = $incoming['InvoiceDate'];
			$data['DueDate'] = $incoming['DueDate'];
			$data['Notes'] = (isset($incoming['Notes']) ? $incoming['Notes'] : '');
			$data['HowSent'] = (isset($incoming['HowSent']) ? $incoming['HowSent'] : '');
			$data['Terms'] = (isset($incoming['Terms']) ? $incoming['Terms'] : '');
			$data['TotalCost'] = $incoming['TotalCost'];
			$data['OutstandingAmount'] = $incoming['OutstandingAmount'];
			$data['UserID'] = $this->userid;
			$data['InvoiceCustom'] = (isset($incoming['InvoiceCustom']) ? $incoming['InvoiceCustom'] : 0);
			$data['TotalTax'] = $incoming['TotalTax'];
			$data['ProjectID'] = (isset($incoming['ProjectID']) ? $incoming['ProjectID'] : 0);
			$data['LastChargeDate'] = (isset($incoming['LastChargeDate']) ? $incoming['LastChargeDate'] : '');
			$data['Resent'] = (isset($incoming['Resent']) ? $incoming['Resent'] : '');
			$data['LastResendDate'] = (isset($incoming['LastResendDate']) ? $incoming['LastResendDate'] : '');
			$encoded = $this->encode('AddInvoices',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddPayments($incoming){
		$required = array('ClientID','Invoice','AmountPaid','PaymentDate','AmountPaidBalance');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['Invoice'] = $incoming['Invoice'];
			$data['ClientID'] = $incoming['ClientID'];
			$data['AmountPaid'] = $incoming['AmountPaid'];
			$data['PaymentDate'] = $incoming['PaymentDate'];
			$data['Notes'] = (isset($incoming['Notes']) ? $incoming['Notes'] : '');
			$data['AmountPaidBalance'] = $incoming['AmountPaidBalance'];
			$encoded = $this->encode('AddPayments',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddBilledMisc($incoming){
		$required = array('ClientID', 'DateCompleted', 'Qty', 'Title', 'Description', 'Rate');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['UserID'] = $this->userid;
			$data['ClientID'] = $incoming['ClientID'];
			$data['DateCompleted'] = $incoming['DateCompleted'];
			$data['Qty'] = $incoming['Qty'];
			$data['Title'] = $incoming['Title'];
			$data['Description'] = $incoming['Description'];
			$data['Invoiced'] = (isset($incoming['Invoiced']) ? $incoming['Invoiced'] : 0);
			$data['InvoiceNumber'] = (isset($incoming['InvoiceNumber']) ? $incoming['InvoiceNumber'] : 0);
			$data['Taxable'] = (isset($incoming['Taxable']) ? $incoming['Taxable'] : 0);
			$data['Rate'] = $incoming['Rate'];
			$data['ProjectID'] = (isset($incoming['ProjectID']) ? $incoming['ProjectID'] : 0);
			$encoded = $this->encode('AddBilledMisc',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddMiscItems($incoming){
		$required = array('Item','Description','Rate');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['Item'] = $incoming['Item'];
			$data['Description'] = $incoming['Description'];
			$data['Rate'] = $incoming['Rate'];
			$data['Taxable'] = (isset($incoming['Taxable']) ? $incoming['Taxable'] : 0);
			$encoded = $this->encode('AddMiscItems',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddBilledHourly($incoming){
		$required = array('ClientID','DateCompleted','Service','Hours','Rate','Description');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['UserID'] = $this->userid;
			$data['DateCompleted'] = $incoming['DateCompleted'];
			$data['ClientID'] = $incoming['ClientID'];
			$data['Service']= $incoming['Service'];
			$data['Hours'] = $incoming['Hours'];
			$data['Rate'] = $incoming['Rate'];
			$data['Description'] = $incoming['Description'];
			$data['Invoiced'] = (isset($incoming['Invoiced']) ? $incoming['Invoiced'] : 0);
			$data['InvoiceNumber'] = (isset($incoming['InvoiceNumber']) ? $incoming['InvoiceNumber'] : 0);
			$data['Taxable'] = (isset($incoming['Taxable']) ? $incoming['Taxable'] : 0);
			$data['ProjectID'] = (isset($incoming['ProjectID']) ? $incoming['ProjectID'] : 0);
			$encoded = $this->encode('AddBilledHourly',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddSubscribers($incoming){
		$required = array('Company','Email','Tel','Contact','TrialVersion','Active');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['Company'] = $incoming['Company'];
			$data['Email'] = $incoming['Email'];
			$data['Tel'] = $incoming['Tel'];
			$data['Contact'] = $incoming['Contact'];
			$data['TrialSignupDate'] = (isset($incoming['TrialSignupDate']) ? $incoming['TrialSignupDate'] : '');
			$data['TrialVersion'] = $incoming['TrialVersion'];
			$data['Active'] = $incoming['Active'];
			$data['PID'] = (isset($incoming['PID']) ? $incoming['PID'] : 0);
			$data['PaidUntilDate'] = (isset($incoming['PaidUntilDate']) ? $incoming['PaidUntilDate'] : '');
			$encoded = $this->encode('AddSubscribers',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function AddRecurringBilling($incoming){
		$required = array('ClientID','DateCompleted','Qty','Title','Description','Rate','NextBillingDate','FrequencyUnit','FrequencyDuration');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['UserID'] = $this->userid;
			$data['ClientID'] = $incoming['ClientID'];
			$data['DateCompleted'] = $incoming['DateCompleted'];
			$data['Qty'] = $incoming['Qty'];
			$data['Title'] = $incoming['Title'];
			$data['Description'] = $incoming['Description'];
			$data['Taxable'] = (isset($incoming['Taxable']) ? $incoming['Taxable'] : 0);
			$data['Rate'] = $incoming['Rate'];
			$data['NextBillingDate'] = $incoming['NextBillingDate'];
			$data['FrequencyUnit'] = $incoming['FrequencyUnit'];
			$data['FrequencyDuration'] = $incoming['FrequencyDuration'];
			$data['ProjectID'] = (isset($incoming['ProjectID']) ? $incoming['ProjectID'] : 0);
			$encoded = $this->encode('AddRecurringBilling',$data);
			return $this->send($encoded);          
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	//
	// DELETES
	//

	public function DeleteClients($incoming=null){
		if($incoming != ''){
			$encoded = $this->encode('DeleteClients',$incoming);
			return $this->send($encoded); 
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function DeleteHourlyServices($incoming=null){
		if($incoming != ''){
			$encoded = $this->encode('DeleteHourlyServices',$incoming);
			return $this->send($encoded); 
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function DeleteInvoices($incoming=null){
		if($incoming != ''){
			$encoded = $this->encode('DeleteInvoices',$incoming);
			return $this->send($encoded); 
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function DeleteBilledMisc($incoming=null){
		if($incoming != ''){
			$encoded = $this->encode('DeleteBilledMisc',$incoming);
			return $this->send($encoded); 
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function DeleteMiscItems($incoming=null){
		if($incoming != ''){
			$encoded = $this->encode('DeleteMiscItems',$incoming);
			return $this->send($encoded); 
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function DeleteBilledHourly($incoming=null){
		if($incoming != ''){
			$encoded = $this->encode('DeleteBilledHourly',$incoming);
			return $this->send($encoded); 
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}

	public function DeleteRecurringBilling($incoming=null){
		if($incoming != ''){
			$encoded = $this->encode('DeleteRecurringBilling',$incoming);
			return $this->send($encoded); 
		} else {
		    $response['Message'] = 'Missing Required Values';
		    $response['error'] = 1;
			return $response;
		}
	}
}
?>