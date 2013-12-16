<?php 
class PayscapeComponent extends Component
{

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

	//protected function send($data){
	public function send($data){
		
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
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$output = curl_exec($ch);
		
		curl_close($ch);
		debug($ch);
		return $output;
	*/

		/*
		 * FOR TESTING cURL
		 use curl_getinfo() to print out the cURL post
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
		
		debug($data);
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

		
		// check for required fields
		$required = array('ccnumber', 'ccexp', 'amount');
		

		
	if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
	
		
		$data = array();
		$data['username'] = self::userid;
		$data['password'] = self::password;
		$data['type'] = 'sale';
		$data['key'] = self::key;
		$data['key_id'] = self::keyid;
		$data['account_holder_type'] = self::account_holder_type;
		$data['account_type'] = self::account_type;
		$data['checkname'] = self::checkname;
		$data['hash'] = $hash;
		$data['time'] = $time;
		$data['redirect'] = self::redirect_url;
		$data['username'] = self::userid;
		$data['password'] = self::password;
		$data['type'] = $type;
		$data['checkaccount'] = self::account_ach;
		$data['checkaba'] = self::routing_ach;
		$data['redirect'] = self::redirect_url;
		
		
		/* user supplied required data */
		
		 $data['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');
		$data['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
		$data['amount'] = (isset($incoming['amount']) ? $incoming['amount'] : '');
		
		/* user supplied optional data */
		
		 $data['firstname'] = (isset($incoming['firstname']) ? $incoming['firstname'] : '');
		$data['lastname'] = (isset($incoming['lastname']) ? $incoming['lastname'] : '');
		$data['company'] = (isset($incoming['company']) ? $incoming['company'] : '');
		$data['address1'] = (isset($incoming['address1']) ? $incoming['address1'] : '');
		$data['city'] = (isset($incoming['city']) ? $incoming['city'] : '');
		$data['state'] = (isset($incoming['state']) ? $incoming['state'] : '');
		$data['zip'] = (isset($incoming['zip']) ? $incoming['zip'] : '');
		$data['country'] = (isset($incoming['country']) ? $incoming['country'] : '');
		$data['phone'] = (isset($incoming['phone']) ? $incoming['phone'] : '');
		$data['fax'] = (isset($incoming['fax']) ? $incoming['fax'] : '');
		$data['email'] = (isset($incoming['email']) ? $incoming['email'] : '');
		$data['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');
	/*	
		echo "DATA:";
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		exit();
	*/	
		return self::send($data);


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