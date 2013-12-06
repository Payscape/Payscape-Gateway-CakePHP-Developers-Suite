<?php
class BillingOrchardComponent extends Component {

	const apikey 	= 'ApiKey';					//Api Key available from your BillingOrchard.com Account
	const key 		= 'BillingOrchard2012';
	const url 		= 'https://billingorchardapi.com/webservice/ChooseService.php';
	const userid 	= 12345; 					//Replace with your UserID from BillingOrchard.com 

	private function send($data){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::url);
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
		$sig = base64_encode(hash_hmac('sha256', self::apikey.$service.$timestamp, self::key,true)); 
		$object = json_encode($data);
		$encoded = array(
			'jsonData' => '{"apikey":"'.self::apikey.'","sig":"'.$sig.'","timestamp":"'.$timestamp.'","service":"'.$service.'","object":'.$object.'}'
		);
		return $encoded;
	}

	//
	// VIEWS
	//

	public function ViewUsers($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['UserID'] = $incoming;
		}
		$encoded = self::encode('ViewUsers',$data);
		return self::send($encoded);  
	}

	public function ViewClients($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['ClientID'] = $incoming;
		}
		$encoded = self::encode('ViewClients',$data);
		return self::send($encoded);  
	}

	public function ViewHourlyServices($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['ItemID'] = $incoming;
		}
		$encoded = self::encode('ViewHourlyServices',$data);
		return self::send($encoded);  
	}

	public function ViewInvoices($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['Invoice'] = $incoming;
		}
		$encoded = self::encode('ViewInvoices',$data);
		return self::send($encoded);  
	}

	public function ViewPayments($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['PaymentID'] = $incoming;
		}
		$encoded = self::encode('ViewPayments',$data);
		return self::send($encoded);  
	}

	public function ViewBilledMisc($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['BMID'] = $incoming;
		}
		$encoded = self::encode('ViewBilledMisc',$data);
		return self::send($encoded);  
	}

	public function ViewMiscItems($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['MiscID'] = $incoming;
		}
		$encoded = self::encode('ViewMiscItems',$data);
		return self::send($encoded);  
	}

	public function ViewBilledHourly($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['BHID'] = $incoming;
		}
		$encoded = self::encode('ViewBilledHourly',$data);
		return self::send($encoded);  
	}

	public function ViewSubscribers($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['CID'] = $incoming;
		}
		$encoded = self::encode('ViewSubscribers',$data);
		return self::send($encoded);  
	}

	public function ViewRecurringBilling($incoming=null){
		$data = array();
		if($incoming != ''){
			$data['RBID'] = $incoming;
		}
		$encoded = self::encode('ViewRecurringBilling',$data);
		return self::send($encoded);  
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
			$encoded = self::encode('UpdateClients',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}
	
	public function UpdateHourlyServices($incoming){
		$required = array('ItemID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = self::encode('UpdateHourlyServices',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}
	
	public function UpdateInvoices($incoming){
		$required = array('Invoice');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = self::encode('UpdateInvoices',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}
	
	public function UpdateBilledMisc($incoming){
		$required = array('BMID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = self::encode('UpdateBilledMisc',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}
	
	public function UpdateMiscItems($incoming){
		$required = array('MiscID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = self::encode('UpdateMiscItems',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}
	
	public function UpdateBilledHourly($incoming){
		$required = array('BHID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = self::encode('UpdateBilledHourly',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}
	
	public function UpdateSubscribers($incoming){
		$required = array('CID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = self::encode('UpdateSubscribers',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}
	
	public function UpdateRecurringBilling($incoming){
		$required = array('RBID');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$data = array(); 
			foreach($incoming as $k => $v){
				$data[$k] = $v;
			}
			$encoded = self::encode('UpdateRecurringBilling',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
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
			$encoded = self::encode('AddClients',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
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
			$encoded = self::encode('AddHourlyServices',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
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
			$data['UserID'] = self::userid;
			$data['InvoiceCustom'] = (isset($incoming['InvoiceCustom']) ? $incoming['InvoiceCustom'] : 0);
			$data['TotalTax'] = $incoming['TotalTax'];
			$data['ProjectID'] = (isset($incoming['ProjectID']) ? $incoming['ProjectID'] : 0);
			$data['LastChargeDate'] = (isset($incoming['LastChargeDate']) ? $incoming['LastChargeDate'] : '');
			$data['Resent'] = (isset($incoming['Resent']) ? $incoming['Resent'] : '');
			$data['LastResendDate'] = (isset($incoming['LastResendDate']) ? $incoming['LastResendDate'] : '');
			$encoded = self::encode('AddInvoices',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
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
			$encoded = self::encode('AddPayments',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}

	public function AddBilledMisc($incoming){
		$required = array('ClientID', 'DateCompleted', 'Qty', 'Title', 'Description', 'Rate');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['UserID'] = self::userid;
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
			$encoded = self::encode('AddBilledMisc',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
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
			$encoded = self::encode('AddMiscItems',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}

	public function AddBilledHourly($incoming){
		$required = array('ClientID','DateCompleted','Service','Hours','Rate','Description');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['UserID'] = self::userid;
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
			$encoded = self::encode('AddBilledHourly',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
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
			$encoded = self::encode('AddSubscribers',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}

	public function AddRecurringBilling($incoming){
		$required = array('ClientID','DateCompleted','Qty','Title','Description','Rate','NextBillingDate','FrequencyUnit','FrequencyDuration');
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {   
			$data = array();
			$data['UserID'] = self::userid;
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
			$encoded = self::encode('AddRecurringBilling',$data);
			return self::send($encoded);          
		} else {
			return 'Missing Required Values';
		}
	}

	//
	// DELETES
	//

	public function DeleteClients($incoming=null){
		if($incoming != ''){
			$data['ClientID'] = $incoming;
			$encoded = self::encode('DeleteClients',$data);
			return self::send($encoded); 
		} else {
			return 'Missing Required Values';
		}
	}

	public function DeleteHourlyServices($incoming=null){
		if($incoming != ''){
			$data['ItemID'] = $incoming;
			$encoded = self::encode('DeleteHourlyServices',$data);
			return self::send($encoded); 
		} else {
			return 'Missing Required Values';
		}
	}

	public function DeleteInvoices($incoming=null){
		if($incoming != ''){
			$data['Invoice'] = $incoming;
			$encoded = self::encode('DeleteInvoices',$data);
			return self::send($encoded); 
		} else {
			return 'Missing Required Values';
		}
	}

	public function DeleteBilledMisc($incoming=null){
		if($incoming != ''){
			$data['BMID'] = $incoming;
			$encoded = self::encode('DeleteBilledMisc',$data);
			return self::send($encoded); 
		} else {
			return 'Missing Required Values';
		}
	}

	public function DeleteMiscItems($incoming=null){
		if($incoming != ''){
			$data['MiscID'] = $incoming;
			$encoded = self::encode('DeleteMiscItems',$data);
			return self::send($encoded); 
		} else {
			return 'Missing Required Values';
		}
	}

	public function DeleteBilledHourly($incoming=null){
		if($incoming != ''){
			$data['BHID'] = $incoming;
			$encoded = self::encode('DeleteBilledHourly',$data);
			return self::send($encoded); 
		} else {
			return 'Missing Required Values';
		}
	}

	public function DeleteRecurringBilling($incoming=null){
		if($incoming != ''){
			$data['RBID'] = $incoming;
			$encoded = self::encode('DeleteRecurringBilling',$data);
			return self::send($encoded); 
		} else {
			return 'Missing Required Values';
		}
	}
}