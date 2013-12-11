<?php 
class PayscapeComponent extends Component
{

	const key 		= '\!b2#1wu%4_tUdpAxO|GDWW?20:V.w';		// Replace with your Payscape Key
	const keyid 	= '449510';				// Replace with your Payscape Key ID
	const url 		= 'https://secure.payscapegateway.com/api/transact.php';
	const userid 	= 'demo'; 					//Replace with your UserID from Payscape.com
	const password	= 'password';				//Replace with your Password from Payscape.com

	public function send($query){
		/*
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, self::url);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
	    curl_setopt($ch, CURLOPT_POST, 1);

	    if (!($transaction = curl_exec($ch))) {
	        return ERROR;
	    }
	    curl_close($ch);
	    unset($ch);
		*/
		
		/* use the CakePHP HttpSocket to send the request */
		App::uses('HttpSocket', 'Network/Http');
		$HttpSocket = new HttpSocket();
		return $HttpSocket->post(self::url,$query);

		/*
	    debug($query);
	    debug($transaction);

	    $transaction = explode("&",$transaction);
	    for($i=0;$i<count($transaction);$i++) {
	        $rtransaction = explode("=",$transaction[$i]);
	        $this->responses[$rtransaction[0]] = $rtransaction[1];
	    }
	    return $this->responses['response'];
	    */
	}
	

	
	public function Sale($incoming=null){
			
		$time = gmdate('YmdHis');
		$type = 'sale';
		
		$amount = $incoming['amount'];
		
		
		$payment_type = $incoming['payment']; // 0 credit card, 1 check
		
		$order_id = 'Test';
		$hash = md5($order_id|$amount|$time|self::key);

		
		// check for required fields
		$required = array('ccnumber', 'ccexp', 'amount');
		
/*
 * differentiate between check and credit card payment
 * */
		
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			
			$transaction = array();
			$transaction['username'] = self::userid;
			$transaction['password'] = self::password;
			$transaction['type'] = 'sale';
			//$transaction['key'] = self::key;
			//$transaction['key_id'] = self::keyid;
			//$transaction['hash'] = $hash;
			//$transaction['time'] = $time;
			//$transaction['redirect'] = self::redirect_url;
			//$transaction['checkaccount'] = self::account_ach;
			//$transaction['checkaba'] = self::routing_ach;
			
				if($payment_type==1){
					/* user supplied required check transaction */
					$transaction['checkaccount'] = self::account_ach;
					$transaction['checkaba'] = self::routing_ach;
					$transaction['account_holder_type'] = self::account_holder_type;
					$transaction['account_type'] = self::account_type;
					$transaction['checkname'] = self::checkname;
						
				} else {
		
					/* user supplied required credit card transaction */
						
					$transaction['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');
					$transaction['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
					$transaction['amount'] = (isset($incoming['amount']) ? $incoming['amount'] : '');
					$transaction['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');
						
				}	
			
			/* user supplied optional transaction */
			
			$transaction['firstname'] = (isset($incoming['firstname']) ? $incoming['firstname'] : '');
			$transaction['lastname'] = (isset($incoming['lastname']) ? $incoming['lastname'] : '');
			$transaction['company'] = (isset($incoming['company']) ? $incoming['company'] : '');
			$transaction['address1'] = (isset($incoming['address1']) ? $incoming['address1'] : '');
			$transaction['city'] = (isset($incoming['city']) ? $incoming['city'] : '');
			$transaction['state'] = (isset($incoming['state']) ? $incoming['state'] : '');
			$transaction['zip'] = (isset($incoming['zip']) ? $incoming['zip'] : '');
			$transaction['country'] = (isset($incoming['country']) ? $incoming['country'] : '');
			$transaction['phone'] = (isset($incoming['phone']) ? $incoming['phone'] : '');
			$transaction['fax'] = (isset($incoming['fax']) ? $incoming['fax'] : '');
			$transaction['email'] = (isset($incoming['email']) ? $incoming['email'] : '');
			$transaction['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');
		
			return self::send($transaction);
		} else {
		    $response['Message'] = 'Required Values Are Missing';
		    $response['error'] = 1;
			return $response;
		}// count array	
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
