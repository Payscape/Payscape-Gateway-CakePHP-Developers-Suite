<?php 
class PayscapeComponent extends Component
{
	//const ipaddress = $_SERVER['SERVER_ADDR'];
	const key 		= '\!b2#1wu%4_tUdpAxO|GDWW?20:V.w';		// Replace with your Payscape Key
	const keyid 		= '449510';				// Replace with your Payscape Key ID
	
	const url 		= 'https://secure.payscapegateway.com/api/transact.php';
	const userid 	= 'demo'; 					//Replace with your UserID from Payscape.com
	const password	= 'password';				//Replace with your Password from Payscape.com
	const redirect_url	= 'transactions/complete';	//Replace with the URL of your success page;
	
	const account_ach = '123123123'; // Replace with your Bank Account Number (ACH)	
	const routing_ach = '123123123'; // Replace with your Bank Routing Number (ACH)
	const account_holder_type = 'business'; // Replace with your Payscape Account Holder Type (business / personal)
	const account_type = 'checking'; // Replace with your bank account type (checking / savings)
	const checkname = 'Test'; // Replace with the name on your ACH Account


	//protected function send($query){
	public function send($query){
		
	/*	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $transactiondata);

		$output = curl_exec($ch);
		
		curl_close($ch);
		debug($ch);
		return $output;
	*/
		
		/* use the CakePHP HttpSocket to send the request */
		App::uses('HttpSocket', 'Network/Http');
		$HttpSocket = new HttpSocket();
		return $HttpSocket->post(self::url,$query);

		/*
		 
		 debug($query); 
		 
		*/
		
		// set up curl to point to your requested URL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::url);
		// tell curl to return the result content instead of outputting it
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		// execute the request
		$output = curl_exec($ch);
		
		if (curl_errno($ch)) {
			// this would be your first hint that something went wrong
			die('Couldn\'t send request: ' . curl_error($ch));
		} else {
			// check the HTTP status code of the request
			$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if ($resultStatus == 200) {
				// everything went better than expected
			} else {
				// the request did not complete as expected. common errors are 4xx
				// (not found, bad request, etc.) and 5xx (usually concerning
				// errors/exceptions in the remote script execution)
		
				die('Request failed: HTTP status code: ' . $resultStatus);
			}
		}// curl_errno
		
		debug($transactiondata);
		debug($ch);
		debug($output);
		exit();
	
	}// send
	

	
	public function Sale($incoming=null){
			
		$time = gmdate('YmdHis');
		$type = 'sale';
		
		$amount = $incoming['amount'];
		$order_id = 'Test';
		$hash = md5($order_id|$amount|$time|self::key);
		$payment = $incoming['payment'];

		
		// check for required fields
		
		if($payment=='check'){
			$required = array('checkaccount', 'checkaba', 'amount');
		} else {
			$required = array('ccnumber', 'ccexp', 'amount');
		}

		

		
	if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
	
		
		$transactiondata = array();
		$transactiondata['username'] = self::userid;
		$transactiondata['password'] = self::password;
		$transactiondata['type'] = 'sale';
		$transactiondata['key'] = self::key;
		$transactiondata['key_id'] = self::keyid;
		$transactiondata['hash'] = $hash;
		$transactiondata['time'] = $time;
		$transactiondata['redirect'] = self::redirect_url;
		$transactiondata['username'] = self::userid;
		$transactiondata['password'] = self::password;
		$transactiondata['type'] = $type;

		$transactiondata['redirect'] = self::redirect_url;
		

		if($payment=='check'){
			$transactiondata['account_holder_type'] = (isset($incoming['account_holder_type']) ? $incoming['account_holder_type'] : '');
			$transactiondata['account_type'] = (isset($incoming['account_type']) ? $incoming['account_type'] : '');
			$transactiondata['checkname'] = (isset($incoming['checkname']) ? $incoming['checkname'] : '');
			$transactiondata['checkaccount'] = (isset($incoming['account_ach']) ? $incoming['account_ach'] : '');
			$transactiondata['checkaba'] = (isset($incoming['routing_ach']) ? $incoming['routing_ach'] : '');				
		} else {
			$transactiondata['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');
			$transactiondata['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
				
		}
		
		/* user supplied required data */
		
		$transactiondata['amount'] = (isset($incoming['amount']) ? $incoming['amount'] : '');
		
		/* user supplied optional data */
		
		$transactiondata['firstname'] = (isset($incoming['firstname']) ? $incoming['firstname'] : '');
		$transactiondata['lastname'] = (isset($incoming['lastname']) ? $incoming['lastname'] : '');
		$transactiondata['company'] = (isset($incoming['company']) ? $incoming['company'] : '');
		$transactiondata['address1'] = (isset($incoming['address1']) ? $incoming['address1'] : '');
		$transactiondata['city'] = (isset($incoming['city']) ? $incoming['city'] : '');
		$transactiondata['state'] = (isset($incoming['state']) ? $incoming['state'] : '');
		$transactiondata['zip'] = (isset($incoming['zip']) ? $incoming['zip'] : '');
		$transactiondata['country'] = (isset($incoming['country']) ? $incoming['country'] : '');
		$transactiondata['phone'] = (isset($incoming['phone']) ? $incoming['phone'] : '');
		$transactiondata['fax'] = (isset($incoming['fax']) ? $incoming['fax'] : '');
		$transactiondata['email'] = (isset($incoming['email']) ? $incoming['email'] : '');
		$transactiondata['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');
	/*	
		echo "DATA:";
		echo "<pre>";
		print_r($transactiondata);
		echo "</pre>";
		exit();
	*/	
		return self::send($transactiondata);


			} else {
				
		    $response['Message'] = 'Required Values Are Missing';
		    $response['error'] = 1;
			return $response;
		}// count array
		
		
		
	}// sale
	
	
	public function Auth($incoming=null){
		
	}// auth
	
	public function Credit($incoming=null){
		
	}// credit
	
	public function Validate($incoming=null){
		
	}// validate
	
	public function Capture($incoming=null){
		
	}// capture
	
	public function Void($incoming=null){
		
	}// void
	
	public function Refund($incoming=null){
		
	}// refund
	
	
	public function Update($incoming=null){
		
	}// update
	
	
}// end PayscapeComponent
