<?php
App::uses('AppController', 'Controller');
/**
 * Transactions Controller
 *
 * @property Transaction $Transaction
 * @property PaginatorComponent $Paginator
 */
class TransactionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Payscape');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Transaction->recursive = 0;
		$this->set('transactions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Transaction->exists($id)) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		$options = array('conditions' => array('Transaction.' . $this->Transaction->primaryKey => $id));
		$this->set('transaction', $this->Transaction->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */



public function add_check() {

	$posturl = 'https://secure.payscapegateway.com/api/transact.php';
	
	$order_id = 'Test';

	/* test data */

	$username = 'demo';
	$password = 'password';
	$time = gmdate('YmdHis');



	/* triggers */

	/*
	 * To cause a declined message, pass an amount less than 1.00.
	* To trigger a fatal error message, pass an invalid card number.
	* To simulate an AVS match, pass 888 in the address1 field, 77777 for zip.
	* To simulate a CVV match, pass 999 in the cvv field.
	*
	* */

	if ($this->request->is('post')) {
				
	/*	 	
		$data_debug = $this->request->data;

		echo "<pre>";
		debug($data_debug);
		echo "</pre>";

		exit();
	*/		
			

			
		$incoming = array();
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		$incoming['tax'] = $this->request->data['Transaction']['tax'];
		$incoming['orderdescription'] = $this->request->data['Transaction']['orderdescription'];

		$incoming['type'] = 'sale';
		$incoming['payment'] = 'check';
				
		$incoming['checkname'] = $this->request->data['Transaction']['checkname'];						
		$incoming['checkaba'] = $this->request->data['Transaction']['checkaba'];
		$incoming['checkaccount'] = $this->request->data['Transaction']['checkaccount'];
		$incoming['account_holder_type'] = $this->request->data['Transaction']['account_holder_type'];
		$incoming['account_type'] = $this->request->data['Transaction']['account_type'];
		$incoming['sec_code'] = 'WEB';
		$incoming['orderid'] = $this->request->data['Transaction']['orderid'];
		
			
		$incoming['firstname'] = $this->request->data['Transaction']['firstname'];
		$incoming['lastname'] = $this->request->data['Transaction']['lastname'];
		$incoming['company'] = $this->request->data['Transaction']['company'];
		$incoming['address1'] = $this->request->data['Transaction']['address1'];
		$incoming['city'] = $this->request->data['Transaction']['city'];
		$incoming['state'] = $this->request->data['Transaction']['state'];
		$incoming['zip'] = $this->request->data['Transaction']['zip'];
		$incoming['country'] = $this->request->data['Transaction']['country'];
		$incoming['phone'] = $this->request->data['Transaction']['phone'];
		$incoming['fax'] = $this->request->data['Transaction']['fax'];
		$incoming['email'] = $this->request->data['Transaction']['email'];
		
		$this->request->data['Transaction']['time'] = $time;
		$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];
		$this->request->data['Transaction']['type'] = 'sale';
		$this->request->data['Transaction']['payment'] = 'check';


		$response = $this->Payscape->Sale($incoming);
		
		parse_str($response, $result_array);
		
		// for testing 
		$this->set('incoming', $incoming);
		
		if($result_array['response']==1){
			
			$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
			$this->request->data['Transaction']['authcode'] = $result_array['authcode'];
			
			$this->set('result_array', $result_array);
			
			
						$this->Transaction->create();
						if ($this->Transaction->save($this->request->data)) {
						$this->Session->setFlash(__('Transaction successful, and the data has been saved.'));
						

						} else {
							$this->Session->setFlash(__('Transaction unsuccessful, no data has been saved'));
						}		
						
						
	//debug($response);
	//	exit();
		/*
		echo "INCOMING: <br>";
		echo "<pre>";
		debug($incoming);
		echo "<br>RESPONSE:<br>";
		debug($response);

		echo "</pre>";

		exit();
		*/


		//		return $this->redirect(array('action' => 'index'));

		} else {
		$this->Session->setFlash(__('Transaction unsuccessful, no data has been saved. Please, try again.'));
		}
	}// post

}// add_check


public function add_credit_card() {

	$posturl = 'https://secure.payscapegateway.com/api/transact.php';
	$order_id = 'Test';

	/* test data */

	$username = 'demo';
	$password = 'password';
	$time = gmdate('YmdHis');

	$visa = "4111111111111111";
	$mastercard = "5431111111111111";
	$discover = "6011601160116611";
	$american_express = "341111111111111";
	$cc_expire = '1025'; // 10/25
	$cvv = "123";

	/* triggers */

	/*
	 * To cause a declined message, pass an amount less than 1.00.
	* To trigger a fatal error message, pass an invalid card number.
	* To simulate an AVS match, pass 888 in the address1 field, 77777 for zip.
	* To simulate a CVV match, pass 999 in the cvv field.
	*
	* */


	$this->set(compact('visa', 'mastercard', 'discover', 'american_express', 'cc_expire', 'account_ach', 'routing_ach'));



	if ($this->request->is('post')) {
			

		/* for testing
		 	
		$data_debug = $this->request->data;

		echo "<pre>";
		echo "Debug DATA";
		debug($data_debug);
		echo "</pre>";

		exit();
			
		*/
			
		$incoming = array();
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		$incoming['tax'] = $this->request->data['Transaction']['tax']; 			
		$incoming['orderdescription'] = $this->request->data['Transaction']['orderdescription'];
		$incoming['orderid'] = $this->request->data['Transaction']['orderid'];
		
		$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
		$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];
		$incoming['cvv'] = $this->request->data['Transaction']['cvv'];

		$incoming['firstname'] = $this->request->data['Transaction']['firstname'];
		$incoming['lastname'] = $this->request->data['Transaction']['lastname'];
		$incoming['company'] = $this->request->data['Transaction']['company'];
		$incoming['address1'] = $this->request->data['Transaction']['address1'];
		$incoming['city'] = $this->request->data['Transaction']['city'];
		$incoming['state'] = $this->request->data['Transaction']['state'];
		$incoming['zip'] = $this->request->data['Transaction']['zip'];
		$incoming['country'] = $this->request->data['Transaction']['country'];
		$incoming['phone'] = $this->request->data['Transaction']['phone'];
		$incoming['fax'] = $this->request->data['Transaction']['fax'];
		$incoming['email'] = $this->request->data['Transaction']['email'];
		$this->request->data['Transaction']['time'] = $time;
		$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];
	
		$this->request->data['Transaction']['type'] = 'sale';
		$this->request->data['Transaction']['payment'] = 'credit card';
		
		
		$response = $this->Payscape->Sale($incoming);
		
		//debug($response);
		
		// for testing
		$this->set('incoming', $incoming);
		
		
		parse_str($response, $result_array);
		
		if($result_array['response']==1){
			
			$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
			$this->request->data['Transaction']['authcode'] = $result_array['authcode'];
				
			$this->set('result_array', $result_array);
		
						$this->Transaction->create();
						if ($this->Transaction->save($this->request->data)) {
						$this->Session->setFlash(__('Transaction successful, and data has been saved.'));
						} else {
										$this->Session->setFlash(__('Transaction was not successful, no data has been saved'));
						}
						

	//debug($incoming);
		//exit();
		/*
		echo "PAYSCAPE: <br>";
		echo "<pre>";
		print_r($incoming);
		echo "</pre>";

		exit();
		*/




		


/*
		echo "<pre>";
		echo "PAYSCAPE DEBUG: <br>";
		
		debug($payscape);
		echo "<hr>";
		echo "INCOMING: <br>";
		debug($incoming);
		echo "<pre>";
		exit();
*/

		} else {
		$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
		}
		}// post

}// add_credit_card

public function authorize_credit_card() {

	$posturl = 'https://secure.payscapegateway.com/api/transact.php';
	$order_id = 'Test';

	/* test data */

	$username = 'demo';
	$password = 'password';
	$time = gmdate('YmdHis');

	$visa = "4111111111111111";
	$mastercard = "5431111111111111";
	$discover = "6011601160116611";
	$american_express = "341111111111111";
	$cc_expire = '1025'; // 10/25
	$cvv = "123";

	/* triggers */

	/*
	 * To cause a declined message, pass an amount less than 1.00.
	* To trigger a fatal error message, pass an invalid card number.
	* To simulate an AVS match, pass 888 in the address1 field, 77777 for zip.
	* To simulate a CVV match, pass 999 in the cvv field.
	*
	* */


	$this->set(compact('visa', 'mastercard', 'discover', 'american_express', 'cc_expire', 'account_ach', 'routing_ach'));



	if ($this->request->is('post')) {
			

		/* for testing

		$data_debug = $this->request->data;

		echo "<pre>";
		echo "Debug DATA";
		debug($data_debug);
		echo "</pre>";

		exit();
			
		*/
			
		$incoming = array();
		$incoming['amount'] =  $this->request->data['Transaction']['amount'];
		$incoming['tax'] =  $this->request->data['Transaction']['tax'];
		$incoming['orderdescription'] =  $this->request->data['Transaction']['orderdescription'];
		$incoming['orderid'] = $this->request->data['Transaction']['orderid'];
		
		$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
		$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];
		$incoming['cvv'] = $this->request->data['Transaction']['cvv'];

		$incoming['firstname'] = $this->request->data['Transaction']['firstname'];
		$incoming['lastname'] = $this->request->data['Transaction']['lastname'];
		$incoming['company'] = $this->request->data['Transaction']['company'];
		$incoming['address1'] = $this->request->data['Transaction']['address1'];
		$incoming['city'] = $this->request->data['Transaction']['city'];
		$incoming['state'] = $this->request->data['Transaction']['state'];
		$incoming['zip'] = $this->request->data['Transaction']['zip'];
		$incoming['country'] = $this->request->data['Transaction']['country'];
		$incoming['phone'] = $this->request->data['Transaction']['phone'];
		$incoming['fax'] = $this->request->data['Transaction']['fax'];
		$incoming['email'] = $this->request->data['Transaction']['email'];
		
		$this->request->data['Transaction']['type'] = 'auth';
		$this->request->data['Transaction']['payment'] = 'credit card';
		$this->request->data['Transaction']['time'] = $time;
		$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];



		$response = $this->Payscape->Auth($incoming);

		//debug($response);
		
		// for testing
		$this->set('incoming', $incoming);
		

		parse_str($response, $result_array);

		if($result_array['response']==1){
			
			$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
			$this->request->data['Transaction']['authcode'] = $result_array['authcode'];
	
			$this->set('result_array', $result_array);
				
			
			$this->Transaction->create();
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('Transaction successful, and data has been saved.'));
			} else {
				$this->Session->setFlash(__('Transaction was not successful, no data has been saved'));
			}


			//debug($incoming);
			//exit();
			/*
			 echo "PAYSCAPE: <br>";
			echo "<pre>";
			print_r($incoming);
			echo "</pre>";

			exit();
			*/







			/*
			 echo "<pre>";
			echo "PAYSCAPE DEBUG: <br>";

			debug($payscape);
			echo "<hr>";
			echo "INCOMING: <br>";
			debug($incoming);
			echo "<pre>";
			exit();
			*/

		} else {
			$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
		}
	}// post

}// auth_credit_card

public function capture($transactionid=0){
	
	$type = 'capture';
	
	if($this->request->is('post')){

		
	//	$transactionid = $this->request->data['Transaction']['transactionid'];

			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}
		
		$sql = "SELECT id, amount, transactionid, orderid, authcode FROM transactions WHERE `transactionid` = $transactionid";
		
		$transaction = $this->Transaction->query($sql);
		$transaction = array_shift($transaction);		
		
		//debug($transaction);
		//exit();
		
		$transactions_id = $transaction['transactions']['id'];
		$auth_amount = $transaction['transactions']['amount'];
		$transactionid = $transaction['transactions']['transactionid'];
		$orderid = $transaction['transactions']['orderid'];
		$authcode = $transaction['transactions']['authcode'];
		$process = 1;
		$capture_message = "Process Authorization Capture for Transaction  #$transactionid";
		
		
		$transactionid = $this->request->data['Transaction']['transactionid'];
		
			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}
										
		$amount = $this->request->data['Transaction']['amount'];
		
		$incoming = array();
		$incoming['type'] = $type;
		$incoming['transactionid'] = $transactionid;
		
		/* 
		 * Required only if Amount is less than Authorized Amount 
		 * cannot be greater than Authorized Amount
		 * 
		 * */
		
			if($amount < $auth_amount){
				$incoming['amount'] = $amount;
			} else {
				$incoming['amount'] = $auth_amount;
			}
	
		$response = $this->Payscape->Capture($incoming);
		parse_str($response, $result_array);


	
		if($result_array['response']==1){
			$response_code = $result_array['response'];
			$authtransactionid = $result_array['transactionid'];
			$authcode = $result_array['authcode'];
			$capture_message = "The Capture was successful ";
			
				
			$transaction_data = array(
					'id'=>$transactions_id,
					'capture'=>$response_code,
					'type'=>'capture'
			);
			
			// debug($transaction_data);
			// exit();
			
		
		
			/* save the submission and transaction details */

		
				if(! $this->Transaction->save($transaction_data)){
					
					$capture_message .= " but could not be saved to the database";
					$this->Session->setFlash($capture_message);
					
				} else {
					$capture_message .= " and has been Saved to the database.";
					$this->Session->setFlash($capture_message);
					$process = 2;
					
				}
				
		} else {
			$capture_message = "Transaction has failed.";
			$this->Session->setFlash($capture_message);
		}
		
		/*
		 * for testing
		 * */
		$this->set(compact('result_array', 'incoming', 'process'));
					
		
	}// post
	
	/*
	 * get the Auth information for the Capture Form
	*
	* */
	
	if(isset($transactionid)){
		$transactionid = (int) $transactionid;
	}
	
	if($transactionid==0){
		$this->redirect(array('controller' => 'transactions',
				'action' => 'index'
		));
	}
	
	$sql = "SELECT id, amount, transactionid, orderid, authcode FROM transactions WHERE `transactionid` = $transactionid";
	
	$transaction = $this->Transaction->query($sql);
	$transaction = array_shift($transaction);
	
	//debug($transaction);
	//exit();
	
	$amount = $transaction['transactions']['amount'];
	$transactionid = $transaction['transactions']['transactionid'];
	$orderid = $transaction['transactions']['orderid'];
	$authcode = $transaction['transactions']['authcode'];
	$process = 1;
	$capture_message = "Process Authorization Capture for Transaction  #$transactionid";
	
	
	$this->set(compact('process', 'transaction', 'amount', 'orderid', 'authcode', 'capture_message', 'transactionid'));
	
	
	
	
}// captdure

public function credit($transactionid=0){
	
		if(isset($transactionid)){
			$transactionid = (int) $transactionid;
		}
		
		if($transactionid==0){
		
			$this->Session->setFlash(__('Invalid Transaction.'));
		
			$this->redirect(array('controller'=>'transactions', 'action'=>'index'));
		}

	$type = 'credit';
	$process = 1;
	$time = gmdate('YmdHis');
	
	
	$base_url = $this->base;
	$this->set('base_url', $base_url);
	
		if ($this->request->is('post')) {
		
		$amount = $this->request->data['Transaction']['amount'];	
		
	
		$sql = "SELECT
		time,
		ccnumber,
		ccexp,
		cvv,
		ipaddress,
		firstname,
		lastname,
		company,
		address1,
		city,
		state,
		zip,
		country,
		phone,
		fax,
		email,
		amount,
		payment,
		orderdescription,
		orderid,
		transactionid
		FROM `transactions`
		WHERE transactionid = $transactionid";		
		
	//	echo $sql;
	//	echo "<br>";
		
		$transaction = $this->Transaction->query($sql);
		$transaction = array_shift($transaction);
		
	//	debug($transaction);
		

	
		$incoming = array();
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		$incoming['tax'] = $this->request->data['Transaction']['tax']; 			
		$incoming['orderdescription'] = $this->request->data['Transaction']['orderdescription'];
		$incoming['orderid'] = $this->request->data['Transaction']['orderid'];
		
		$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
		$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];
		$incoming['cvv'] = $this->request->data['Transaction']['cvv'];

		$incoming['firstname'] = $this->request->data['Transaction']['firstname'];
		$incoming['lastname'] = $this->request->data['Transaction']['lastname'];
		$incoming['company'] = $this->request->data['Transaction']['company'];
		$incoming['address1'] = $this->request->data['Transaction']['address1'];
		$incoming['city'] = $this->request->data['Transaction']['city'];
		$incoming['state'] = $this->request->data['Transaction']['state'];
		$incoming['zip'] = $this->request->data['Transaction']['zip'];
		$incoming['country'] = $this->request->data['Transaction']['country'];
		$incoming['phone'] = $this->request->data['Transaction']['phone'];
		$incoming['fax'] = $this->request->data['Transaction']['fax'];
		$incoming['email'] = $this->request->data['Transaction']['email'];
		$this->request->data['Transaction']['time'] = $time;
		$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];
	
		$this->request->data['Transaction']['type'] = 'credit';
		$this->request->data['Transaction']['payment'] = 'credit card';
		$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
		$this->request->data['Transaction']['authcode'] = $result_array['authcode'];
			
		$response = $this->Payscape->Credit($incoming);
		
		parse_str($response, $result_array);
		
		// for testing
		$this->set('incoming', $incoming);
	

		if($result_array['response']==1){
		
	

//	debug($transactiondata);
//	exit();		
		
			$this->set('result_array', $result_array);
	
			$this->Transaction->create();
			if ($this->Transaction->save($this->request->data)) {
				$process = 2;
				$this->Session->setFlash(__('Credit Transaction successful, and the data has been saved.'));
			} else {
				$this->Session->setFlash(__('Credit Transaction unsuccessful, no data has been saved'));
			}
		
		
			//debug($response);
			//	exit();
			/*
			echo "INCOMING: <br>";
			echo "<pre>";
			debug($incoming);
			echo "<br>RESPONSE:<br>";
			debug($response);
		
			echo "</pre>";
		
			exit();
			*/
		
		
		
		} else {
			$this->Session->setFlash(__('Credit Transaction unsuccessful, no data has been saved. Please, try again.'));
		} // result array
		
		/* for testing */
		
		$this->set(compact('incoming', 'result_array', 'process'));
	
	}// is post
	
	
	/*
	 * get the Sale information for the Credit Form
	* */
	
	$sql = "SELECT 
	id,
	key_id,
	time,
	ccnumber,
	ccexp,
	amount,	
	tax,
	cvv,
	payment,
	orderdescription,
	firstname,
	lastname,
	company,
	address1,
	city,
	state,
	zip,
	country,
	phone,
	fax,
	email,
	orderid,
	transactionid
	FROM `transactions`
	WHERE transactionid = $transactionid";
	
	$transaction = $this->Transaction->query($sql);
	$transaction = array_shift($transaction);
	
	
	$this->set(compact('process', 'transaction'));
	

	
	
}// Credit


public function validate_credit_card() {

	$type = 'validate';
	$time = gmdate('YmdHis');
	
	/* test data */

	$visa = "4111111111111111";
	$mastercard = "5431111111111111";
	$discover = "6011601160116611";
	$american_express = "341111111111111";
	$cc_expire = '1025'; // 10/25
	$cvv = "123";

	/* triggers */

	/*
	 * To cause a declined message, pass an amount less than 1.00.
	* To trigger a fatal error message, pass an invalid card number.
	* To simulate an AVS match, pass 888 in the address1 field, 77777 for zip.
	* To simulate a CVV match, pass 999 in the cvv field.
	*
	* */


	$this->set(compact('visa', 'mastercard', 'discover', 'american_express', 'cc_expire', 'account_ach', 'routing_ach'));



	if ($this->request->is('post')) {
			

	//	 for testing
		
		/*
		$data_debug = $this->request->data;

		echo "<pre>";
		echo "Debug DATA";
		debug($data_debug);
		echo "</pre>";

		exit();
		*/	
		
			
		$incoming = array();
		$incoming['type'] = $type;
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		$incoming['tax'] = $this->request->data['Transaction']['tax'];
		$incoming['orderdescription'] = $this->request->data['Transaction']['orderdescription'];
		$incoming['orderid'] = $this->request->data['Transaction']['orderid'];

		$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
		$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];
		$incoming['cvv'] = $this->request->data['Transaction']['cvv'];
		$incoming['payment'] = 'credit card';

		$incoming['firstname'] = $this->request->data['Transaction']['firstname'];
		$incoming['lastname'] = $this->request->data['Transaction']['lastname'];
		$incoming['company'] = $this->request->data['Transaction']['company'];
		$incoming['address1'] = $this->request->data['Transaction']['address1'];
		$incoming['city'] = $this->request->data['Transaction']['city'];
		$incoming['state'] = $this->request->data['Transaction']['state'];
		$incoming['zip'] = $this->request->data['Transaction']['zip'];
		$incoming['country'] = $this->request->data['Transaction']['country'];
		$incoming['phone'] = $this->request->data['Transaction']['phone'];
		$incoming['fax'] = $this->request->data['Transaction']['fax'];
		$incoming['email'] = $this->request->data['Transaction']['email'];
		$this->request->data['Transaction']['time'] = $time;
		$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];

		$this->request->data['Transaction']['type'] = $type;
		$this->request->data['Transaction']['payment'] = 'credit card';


		$response = $this->Payscape->ValidateCreditCard($incoming);

	//	debug($response);

		// for testing
		$this->set('incoming', $incoming);


		parse_str($response, $result_array);

		if($result_array['response']==1){
				
			$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
			$this->request->data['Transaction']['authcode'] = $result_array['authcode'];
			
			
	//debug($this->request->data);
			

			$this->set('result_array', $result_array);

			$this->Transaction->create();
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('Transaction successful, and data has been saved.'));
				
			} else {
				$this->Session->setFlash(__('Transaction was not successful, no data has been saved'));
				
			}


			//debug($incoming);
			//exit();
			/*
			 echo "PAYSCAPE: <br>";
			echo "<pre>";
			print_r($incoming);
			echo "</pre>";

			exit();
			*/







			/*
			 echo "<pre>";
			echo "PAYSCAPE DEBUG: <br>";

			debug($payscape);
			echo "<hr>";
			echo "INCOMING: <br>";
			debug($incoming);
			echo "<pre>";
			exit();
			*/

		} else {
			$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
		}
	}// post

}// validate

	public function refund($transactionid=0){
		$type = 'refund';
		
		if($this->request->is('post')){

		
			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}
		
			$sql = "SELECT id, amount, transactionid, orderid, authcode FROM transactions WHERE `transactionid` = $transactionid";
		
			$transaction = $this->Transaction->query($sql);
			$transaction = array_shift($transaction);
		
			//debug($transaction);
			//exit();
		
			$auth_amount = $transaction['transactions']['amount'];
			$transactionid = $transaction['transactions']['transactionid'];
			$orderid = $transaction['transactions']['orderid'];
			$authcode = $transaction['transactions']['authcode'];
			$process = 1;
			$refund_message = "Process Authorization Capture for Transaction  #$transactionid";
		
		
			$transactionid = $this->request->data['Transaction']['transactionid'];
		
			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}
		
			$amount = $this->request->data['Transaction']['amount'];
		
			$incoming = array();
			$incoming['type'] = $type;
			$incoming['transactionid'] = $transactionid;
		
			/*
			 * Required only if Amount is less than Authorized Amount
			* cannot be greater than Authorized Amount
			*
			* */
		
			if($amount < $auth_amount){
				$incoming['amount'] = $amount;
			} else {
				$incoming['amount'] = $auth_amount;
			}
		
			$response = $this->Payscape->Refund($incoming);
			parse_str($response, $result_array);
		
		
		
			if($result_array['response']==1){
				$response_code = $result_array['response'];
				$authtransactionid = $result_array['transactionid'];
				$authcode = $result_array['authcode'];
				$refund_message = "The Refund was successful ";
					
		
				$this->request->data['Transaction']['type'] = 'refund';
				$this->request->data['Transaction']['transactionid'] = $authtransactionid;
				$this->request->data['Transaction']['authcode'] = $authcode;

					
		
		
				/* save the submission and transaction details */
		
				$this->Transaction->create();
				if($this->Transaction->save($this->request->data)){
						
					$refund_message .= " and has been saved to the database";
					$this->Session->setFlash($refund_message);
						
				} else {
					$refund_message .= " but could not be Saved to the database.";
					$this->Session->setFlash($refund_message);
					$process = 2;
						
				}
		
			} else {
				$refund_message = "Transaction has failed.";
				$this->Session->setFlash($refund_message);
			}
		
			/*
			 * for testing
			* */
			$this->set(compact('result_array', 'incoming', 'process'));
				
		
		}// post
		
		/*
		 * get the Auth information for the Capture Form
		*
		* */
		
		if(isset($transactionid)){
			$transactionid = (int) $transactionid;
		}
		
		if($transactionid==0){
			$this->redirect(array('controller' => 'transactions',
					'action' => 'index'
			));
		}
		
		$sql = "SELECT id, amount, transactionid, orderid, authcode FROM transactions WHERE `transactionid` = $transactionid";
		
		$transaction = $this->Transaction->query($sql);
		$transaction = array_shift($transaction);
		
		//debug($transaction);
		//exit();
		
		$amount = $transaction['transactions']['amount'];
		$transactionid = $transaction['transactions']['transactionid'];
		$orderid = $transaction['transactions']['orderid'];
		$authcode = $transaction['transactions']['authcode'];
		$process = 1;
		$refund_message = "Process Refund Sale Credit Card for Transaction  #$transactionid";
		
		
		$this->set(compact('process', 'transaction', 'amount', 'orderid', 'authcode', 'transactionid'));
		
		
	}// refund
	
	public function update($transactionid=0){
		
	}// update
	
	public function void($transactionid){
		
	}// void

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Transaction->exists($id)) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Transaction.' . $this->Transaction->primaryKey => $id));
			$this->request->data = $this->Transaction->find('first', $options);
		}
	//	$keys = $this->Transaction->Key->find('list');
	//	$this->set(compact('keys'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Transaction->delete()) {
			$this->Session->setFlash(__('The transaction has been deleted.'));
		} else {
			$this->Session->setFlash(__('The transaction could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


}// end TransactionsController
