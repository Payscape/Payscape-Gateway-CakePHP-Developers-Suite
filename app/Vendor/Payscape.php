<?php 

define("APPROVED", 1);
define("DECLINED", 2);
define("ERROR", 3);


class Payscape
{

	var $key 		= '\!b2#1wu%4_tUdpAxO|GDWW?20:V.w';		// Replace with your Payscape Key
	var $keyid 		= '449510';				// Replace with your Payscape Key ID
	
	var $url 		= 'https://secure.payscapegateway.com/api/transact.php';
	var $userid 	= 'demo'; 					//Replace with your UserID from Payscape.com
	var $password	= 'password';				//Replace with your Password from Payscape.com
	var $redirect_url	= 'transactions/complete';	//Replace with the URL of your success page;
	
	var $account_ach = '123123123'; // Replace with your Bank Account Number (ACH)	
	var $routing_ach = '123123123'; // Replace with your Bank Routing Number (ACH)
	var $account_holder_type = 'business'; // Replace with your Payscape Account Holder Type (business / personal)
	var $account_type = 'checking'; // Replace with your bank account type (checking / savings)
	var $checkname = 'Test'; // Replace with the name on your ACH Account
	
	protected function send($data){
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
		return $output;
	}
	

	
	public function Sale($incoming=null){
		
		$time = gmdate('YmdHis');
		$type = 'sale';
		
		$amount = $incoming['amount'];
		$order_id = 'Test';
		$hash = md5($order_id|$amount|$time|$key);

		
		// check for required fields
		$required = array('ccnumber', 'ccexp', 'amount');
				

			if(count(array_intersect_key(array_flip($incoming, $required))===count($required))){
				$data = array();
				$data['username'] = $userid;
				$data['password'] = $password;
				$data['type'] = 'sale';
				$data['key'] = $key;    
				$data['key_id'] = $keyid;
				$data['account_holder_type'] = $account_holder_type;
				$data['account_type'] = $account_type;
				$data['checkname'] = $checkname;
				$data['hash'] = $hash;
				$data['time'] = $time;
				$data['redirect'] = $redirect_url;
				$data['username'] = $userid;
				$data['password'] = $password;
				$data['type'] = $type;
				$data['hash'] = $hash;
				$data['time'] = $time;
				$data['checkaccount'] = $account_ach;
				$data['checkaba'] = $routing_ach;
				$data['redirect'] = $redirect_url;
				
				
		
				$data['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');
				$data['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
				$data['amount'] = (isset($incoming['amount']) ? $incoming['amount'] : '');
				
				/* user supplied optional data */
				
				$data['firstname'] = (isset($incoming['firstname']) ? $incoming['ccv'] : '');
				$data['lastname'] = (isset($incoming['lastname']) ? $incoming['ccv'] : '');
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

				return $this->send($data);

			} else {
				
		    $response['Message'] = 'Required Values Are Missing';
		    $response['error'] = 1;
			return $response;
		}
		
		
		
	}
	
	
	public function Auth($incoming=null){
		
	}
	
	public function Credit($incoming=null){
		
	}
	
	public function Validate($incoming=null){
		
	}
	
	public function Capture($incoming=null){
		
	}
	
	public function Void($incoming=null){
		
	}
	
	public function Refund($incoming=null){
		
	}
	
	
	public function Update($incoming=null){
		
	}
	
	
}// end Payscape
?>