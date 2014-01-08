<?php 
class PayscapeComponent extends Component
{
	/*
	 * PayscapeComponent v2.0
	 * Added Check of Credit Card detection so that 
	 * only the related values are sent 
	 * 
	 * */
						// this \!b2#1wu%4_tUdpAxO|GDWW?20:V.w
						// to this \!b2#I/wu%)4_tUdpAxO|GDWW?20:V.w
	const key 		= '\!b2#I/wu%)4_tUdpAxO|GDWW?20:V.w';		// Replace with your Payscape Key
	const keyid 		= '449510';				// Replace with your Payscape Key ID
	const url 		= 'https://secure.payscapegateway.com/api/transact.php';

	const userid 	= 'demo'; 					//Replace with your UserID from Payscape.com
	const userpass	= 'password';				//Replace with your Password from Payscape.com

	

	//protected function send($query){
	public function send($query){
		$query['ipaddress'] = $_SERVER["REMOTE_ADDR"];
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
		return $HttpSocket->post(self::url, $query);
	//	curl_close($ch);
		
	/*	

		debug($ch);
		debug($output);
		debug($query); 
		exit();
	*/
	}// send
	

	
	public function Sale($incoming=null){
			
		$time = gmdate('YmdHis');
		$type = 'sale';
		
		$amount = (isset($incoming['amount']) ? $incoming['amount'] : '');
		
		$order_id = (isset($incoming['order_id']) ? $incoming['order_id'] : '');
		
		$hash = md5($order_id|$amount|$time|self::key);
		$payment = (isset($incoming['payment']) ? $incoming['payment'] : '');

		
		// check for required fields
		
		if($payment=='check'){
			$required = array('checkname', 'checkaba', 'checkaccount', 'account_holder_type', 'account_type', 'sec_code', 'amount');
		} else {
			$required = array('ccnumber', 'ccexp', 'amount');
		}	
		
	if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
	
		
		$transactiondata = array();
		$transactiondata['username'] = self::userid;
		$transactiondata['password'] = self::userpass;		
		$transactiondata['type'] = $type;
//		$transactiondata['key_id'] = self::keyid;
//		$transactiondata['key'] = self::key;
//		$transactiondata['hash'] = $hash;
		$transactiondata['time'] = $time;
//		$transactiondata['redirect'] = self::redirect_url;	

//		$transactiondata['redirect'] = self::redirect_url;

		if($payment=='check'){
			$transactiondata['checkname'] = (isset($incoming['checkname']) ? $incoming['checkname'] : '');
			$transactiondata['checkaba'] = (isset($incoming['checkaba']) ? $incoming['checkaba'] : '');
			$transactiondata['checkaccount'] = (isset($incoming['checkaccount']) ? $incoming['checkaccount'] : '');				
			$transactiondata['account_holder_type'] = (isset($incoming['account_holder_type']) ? $incoming['account_holder_type'] : '');
			$transactiondata['account_type'] = (isset($incoming['account_type']) ? $incoming['account_type'] : '');
			$transactiondata['sec_code'] = 'WEB';
			$transactiondata['payment'] = 'check';
		} else {
			$transactiondata['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');
			$transactiondata['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
			$transactiondata['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');
				
				
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
		$transactiondata['ipaddress'] = $_SERVER["REMOTE_ADDR"];
		
		/*
		echo "TRANSACTION DATA:";
		echo "<pre>";
		print_r($transactiondata);
		echo "</pre>";
		//exit();
		*/
		
		return self::send($transactiondata);


			} else {
				
		    $response['Message'] = 'Required Values Are Missing';
		    $response['error'] = 1;
			return $response;
		}// count array
		
		
		
	}// sale
	
	
	public function Auth($incoming=null){

		$time = gmdate('YmdHis');
		$type = 'auth';
		
		$amount = (isset($incoming['amount']) ? $incoming['amount'] : '');
		
		$order_id = (isset($incoming['order_id']) ? $incoming['order_id'] : '');
		
		$hash = md5($order_id|$amount|$time|self::key);
		$payment = 'creditcard';
		
		
		// check for required fields
		
			$required = array('ccnumber', 'ccexp', 'amount');
		
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
		
		
			$transactiondata = array();
			$transactiondata['username'] = self::userid;
			$transactiondata['password'] = self::userpass;
			$transactiondata['type'] = $type;
			//		$transactiondata['key_id'] = self::keyid;
			//		$transactiondata['key'] = self::key;
			//		$transactiondata['hash'] = $hash;
			$transactiondata['time'] = $time;
			//		$transactiondata['redirect'] = self::redirect_url;
		
			//		$transactiondata['redirect'] = self::redirect_url;
	
				$transactiondata['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');
				$transactiondata['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
				$transactiondata['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');
		
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
			$transactiondata['ipaddress'] = $_SERVER["REMOTE_ADDR"];
		
			/*
				echo "TRANSACTION DATA:";
			echo "<pre>";
			print_r($transactiondata);
			echo "</pre>";
			//exit();
			*/
		
			return self::send($transactiondata);
		
		
		} else {
		
			$response['Message'] = 'Required Values Are Missing';
			$response['error'] = 1;
			return $response;
		}// count array
	}// auth
	
	public function Credit($incoming=null){

		$time = gmdate('YmdHis');
		$type = 'credit';
		
		$amount = (isset($incoming['amount']) ? $incoming['amount'] : '');
		
		$order_id = (isset($incoming['order_id']) ? $incoming['order_id'] : '');
		
		$hash = md5($order_id|$amount|$time|self::key);
		$payment = (isset($incoming['payment']) ? $incoming['payment'] : '');
		
		
		// check for required fields
		
		if($payment=='check'){
			$required = array('checkname', 'checkaba', 'checkaccount', 'account_holder_type', 'account_type', 'amount');
		} else {
			$required = array('ccnumber', 'ccexp', 'amount');
		}
		
		
		
		
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
		
		
			$transactiondata = array();
			$transactiondata['username'] = self::userid;
			$transactiondata['password'] = self::userpass;
			$transactiondata['type'] = 'credit';
			//		$transactiondata['key_id'] = self::keyid;
			//		$transactiondata['hash'] = $hash;
			$transactiondata['time'] = $time;
			//		$transactiondata['redirect'] = self::redirect_url;
			//		$transactiondata['key'] = self::key;
			//		$transactiondata['redirect'] = self::redirect_url;
		
			if($payment=='check'){
				$transactiondata['checkname'] = (isset($incoming['checkname']) ? $incoming['checkname'] : '');
				$transactiondata['checkaba'] = (isset($incoming['checkaba']) ? $incoming['checkaba'] : '');
				$transactiondata['checkaccount'] = (isset($incoming['checkaccount']) ? $incoming['checkaccount'] : '');
				$transactiondata['account_holder_type'] = (isset($incoming['account_holder_type']) ? $incoming['account_holder_type'] : '');
				$transactiondata['account_type'] = (isset($incoming['account_type']) ? $incoming['account_type'] : '');
				$transactiondata['payment'] = 'check';
			} else {
				$transactiondata['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');
				$transactiondata['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
				$transactiondata['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');		
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
			$transactiondata['ipaddress'] = $_SERVER["REMOTE_ADDR"];
		
			/*
				echo "TRANSACTION DATA:";
			echo "<pre>";
			print_r($transactiondata);
			echo "</pre>";
			//exit();
			*/
		
			return self::send($transactiondata);
		
		
		} else {
		
			$response['Message'] = 'Required Values Are Missing';
			$response['error'] = 1;
			return $response;
		}// count array
	}// credit
	
public function ValidateCreditCard($incoming=null){

	$key = self::key;
	$time = gmdate('YmdHis');
	$type = 'validate';
	
	/*
	echo "<pre>";
	echo "INCOMING";
	debug($incoming);
	echo "<pre>";
	exit();
	*/
	
	$response = array();

		$required = array('type', 'ccnumber', 'ccexp');
	

	if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
		$transactiondata = array();
		$transactiondata['username'] = self::userid;
		$transactiondata['password'] = self::userpass;

		$transactiondata['type'] = $type;

		/* user supplied required data */
		
		$transactiondata['ccexp'] = (isset($incoming['ccexp']) ? $incoming['ccexp'] : '');
		$transactiondata['ccnumber'] = (isset($incoming['ccnumber']) ? $incoming['ccnumber'] : '');

		/* user supplied optional data */
		$transactiondata['cvv'] = (isset($incoming['cvv']) ? $incoming['cvv'] : '');
		
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
		$transactiondata['orderid'] = (isset($incoming['orderid']) ? $incoming['orderid'] : '');



		/*
		 echo "TRANSACTIONDATA:";
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
	}
}// end ValidateCreditCard()
	
	
	public function Capture($incoming=null){
		
			$type = 'capture';
		
		
			$required = array('type', 'transactionid');
		
			if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
				$transactiondata = array();
				$transactiondata['username'] = self::userid;
				$transactiondata['password'] = self::userpass;
				$transactiondata['type'] = 'capture';
				$transactiondata['transactionid'] = (isset($incoming['transactionid']) ? $incoming['transactionid'] : '');
		
				return self::send($transactiondata);
		
			} else {
				$response['Message'] = 'Required Values <strong>type or transactionid</strong> Are Missing';
				$response['error'] = 1;
				return $response;
			}
		
}// Capture
		
		

	
	public function Void($incoming=null){
		
		$key = self::key;
		$time = gmdate('YmdHis');
		$type = 'void';
		
		
		$required = array('type', 'transactionid');
		
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$transactiondata = array();
			$transactiondata['username'] = self::userid;
			$transactiondata['password'] = self::userpass;
			$transactiondata['type'] = 'void';
			$transactiondata['transactionid'] = (isset($incoming['transactionid']) ? $incoming['transactionid'] : '');
		
			return self::send($transactiondata);
		
		} else {
			$response['Message'] = $response['Message'] = 'Required Values <strong>type or transactionid</strong> Are Missing';
			$response['error'] = 1;
			return $response;
		}
		
	}// Void
	
	public function Refund($incoming=null){
		
		$type = 'refund';
		$required = array('type', 'transactionid');
		
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$transactiondata = array();
			$transactiondata['username'] = self::userid;
			$transactiondata['password'] = self::userpass;
			
			$transactiondata['type'] = 'refund';
			$transactiondata['transactionid'] = (isset($incoming['transactionid']) ? $incoming['transactionid'] : '');
				
			// Optional, used only if you are making a partial refund.
			if(isset($incoming['amount'])){
				$transactiondata['amount'] = (isset($incoming['amount']) ? $incoming['amount'] : '');
			}
		
		
			return self::send($transactiondata);
		
		} else {
			$response['Message'] = 'Required Values <strong>type or transactionid</strong> Are Missing';
			$response['error'] = 1;
			return $response;
		}
		
	}// Refund
	
	
	public function Update($incoming=null){
		$type = 'update';
		
		$required = array('type', 'transactionid');
		
		if(count(array_intersect_key(array_flip($required), $incoming)) === count($required)) {
			$transactiondata = array();
				
			$transactiondata['type'] = $type;
			$transactiondata['username'] = self::userid;
			$transactiondata['password'] = self::userpass;
			$transactiondata['transactionid'] = (isset($incoming['transactionid']) ? $incoming['transactionid'] : '');
				
			/* optional fields */
			$transactiondata['tracking_number'] = (isset($incoming['tracking_number']) ? $incoming['tracking_number'] : '');
			$transactiondata['shipping_carrier'] = (isset($incoming['shipping_carrier']) ? $incoming['shipping_carrier'] : '');
			$transactiondata['orderid'] = (isset($incoming['orderid']) ? $incoming['orderid'] : '');
		
			return self::send($transactiondata);
		} else {
			$response['Message'] = 'Required Values <strong>type or transactionid</strong> Are Missing';
			$response['error'] = 1;
			return $response;
		}
		
	}// update
	
	
}// end PayscapeComponent
