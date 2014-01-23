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
	public $components = array('Paginator', 'Session', 'Payscape.Payscape');

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
		
		$transaction = $this->Transaction->find('first', $options);
		
		$type = $transaction['Transaction']['type'];
		
			if($type=='refund'){
				
				$refund_transactionid = $transaction['Transaction']['refund_transactionid'];
				
		
				
				$sql = "SELECT id, amount FROM transactions WHERE transactionid = $refund_transactionid";				
				$order = $this->Transaction->query($sql);
				
				
				$order = array_shift($order);
				
				$this->set('order', $order);
			}
			
			if($type=='void'){
			
				$void_transaction_id = $transaction['Transaction']['void_transaction_id'];
			
				$sql = "SELECT transactionid FROM transactions WHERE id = $void_transaction_id";
			
				$voidorder = $this->Transaction->query($sql);
			
			
				$voidorder = array_shift($voidorder);
			
				$this->set('voidorder', $voidorder);
			}			

		$this->set('transaction', $transaction);
		
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
			
		$incoming = array();
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		$incoming['tax'] = "0.00";
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
		
		$this->request->data['Transaction']['tax'] = '0.00';
		$this->request->data['Transaction']['time'] = $time;
		$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];
		$this->request->data['Transaction']['type'] = 'sale';
		$this->request->data['Transaction']['payment'] = 'check';

		$result_array = $this->Payscape->Sale($incoming);
			
		// for testing 
	//	$this->set('incoming', $incoming);
	//	$this->set('result_array', $result_array);
		
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

		//		return $this->redirect(array('action' => 'index'));

		} else {
		$this->Session->setFlash(__('Transaction unsuccessful, no data has been saved. Please, try again.'));
		}
		
		$process = 2;
	
	} else {
		$process = 1;
	}	// post
	
		
		$this->set('process', $process);

}// add_check


public function add_credit_card() {


	/* test data */

	$username = 'demo';
	$password = 'password';


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

	$time = gmdate('YmdHis');

	if ($this->request->is('post')) {


			
		$incoming = array();
		/* required fields*/
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
		$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];


		/* optional fields*/
		$incoming['cvv'] = $this->request->data['Transaction']['cvv'];		
		$incoming['tax'] = $this->request->data['Transaction']['tax']; 			
		$incoming['orderdescription'] = $this->request->data['Transaction']['orderdescription'];
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
		$this->request->data['Transaction']['payment'] = 'credit card';
		
		
		$result_array = $this->Payscape->Sale($incoming);
		
		/* for testing */
	//	$this->set(compact('incoming', 'result_array'));
		
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
						



		} else {
		$this->Session->setFlash(__('The transaction was not successful, no data has been saved. Please, try again.'));
		}
			$process = 2;
			
		} else { 
			$process = 1;
			
		}// post
		
		$this->set('process', $process);

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

	if ($this->request->is('post')) {
			

			
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



		$result_array = $this->Payscape->Auth($incoming);

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


			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
			}
	
			$process = 2;
			
		} else { 
			$process = 1;
			
		} // post
		
		$this->set('process', $process);

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
	
		$result_array = $this->Payscape->Capture($incoming);
	
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
	
	
	
	
}// capture

public function credit($transactionid=0){
	
		if(isset($transactionid)){
			$transactionid = (int) $transactionid;
		}
		
		if($transactionid==0){
		
			$this->Session->setFlash(__('Invalid Transaction.'));
		
			$this->redirect(array('controller'=>'transactions', 'action'=>'index'));
		}

	$type = 'credit';
	$time = gmdate('YmdHis');
	$base_url = $this->base;
	$this->set('base_url', $base_url);
	
		if ($this->request->is('post')) {
		
		
		
	
		$sql = "SELECT
		id,
		time,
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
		tax,
		payment,
		orderdescription,
		orderid,
		transactionid
		FROM `transactions`
		WHERE transactionid = $transactionid";		
		
		$transaction = $this->Transaction->query($sql);
		$transaction = array_shift($transaction);
		
	//	debug($transaction);
		
		$incoming = array();
		$incoming['type'] = $type;
		$incoming['transactionid'] = $transactionid;
		$incoming['amount'] = $transaction['transactions']['amount'];
		$incoming['tax'] = $transaction['transactions']['tax'];
		$incoming['payment'] = $transaction['transactions']['payment'];
		$incoming['orderid'] = $transaction['transactions']['orderid'];
		$incoming['orderdescription'] = $transaction['transactions']['orderdescription'];		
		$incoming['time'] = $time;	
	
		
		$incoming['firstname'] = $transaction['transactions']['firstname'];
		$incoming['lastname'] = $transaction['transactions']['lastname'];
		$incoming['company'] = $transaction['transactions']['company'];
		$incoming['address1'] = $transaction['transactions']['address1'];
		$incoming['city'] = $transaction['transactions']['city'];
		$incoming['state'] = $transaction['transactions']['state'];
		$incoming['zip'] = $transaction['transactions']['zip'];
		$incoming['country'] = $transaction['transactions']['country'];
		$incoming['phone'] = $transaction['transactions']['phone'];
		$incoming['fax'] = $transaction['transactions']['fax'];
		$incoming['email'] = $transaction['transactions']['email'];
	
			
		$result_array = $this->Payscape->Credit($incoming);
		
	
		
		if($result_array['response']==1){
		
				
			
			$this->request->data['Transaction']['time'] = $time;
			$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$this->request->data['Transaction']['type'] = $type;
	
			$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
			$this->request->data['Transaction']['authcode'] = $result_array['authcode'];
			
	/* begin */ 		
			$this->request->data['Transaction']['amount'] = $transaction['transactions']['amount'];
			$this->request->data['Transaction']['tax'] = $transaction['transactions']['tax'];
			$this->request->data['Transaction']['payment'] = $transaction['transactions']['payment'];
			$this->request->data['Transaction']['orderid'] = $transaction['transactions']['orderid'];
			$this->request->data['Transaction']['orderdescription'] = $transaction['transactions']['orderdescription'];
		
			
			
			$this->request->data['Transaction']['firstname'] = $transaction['transactions']['firstname'];
			$this->request->data['Transaction']['lastname'] = $transaction['transactions']['lastname'];
			$this->request->data['Transaction']['company'] = $transaction['transactions']['company'];
			$this->request->data['Transaction']['address1'] = $transaction['transactions']['address1'];
			$this->request->data['Transaction']['city'] = $transaction['transactions']['city'];
			$this->request->data['Transaction']['state'] = $transaction['transactions']['state'];
			$this->request->data['Transaction']['zip'] = $transaction['transactions']['zip'];
			$this->request->data['Transaction']['country'] = $transaction['transactions']['country'];
			$this->request->data['Transaction']['phone'] = $transaction['transactions']['phone'];
			$this->request->data['Transaction']['fax'] = $transaction['transactions']['fax'];
			$this->request->data['Transaction']['email'] = $transaction['transactions']['email'];
	
			$this->Transaction->create();
			if ($this->Transaction->save($this->request->data)) {
				$process = 2;
				
				$id = $transaction['transactions']['id'];
				$sql_update = "UPDATE transactions SET type = 'credited' WHERE id = $id";
					
				if($query = $this->Transaction->query($sql_update)){
					$refund_message = "<br> The original transaction has been updated to 'credited'";
				}
				
				$this->Session->setFlash(__('Credit Transaction successful, and the data has been saved.' . $refund_message));
			} else {
				$this->Session->setFlash(__('Credit Transaction unsuccessful, no data has been saved'));
			}
		
		} else {
			$this->Session->setFlash(__('Credit Transaction unsuccessful, no data has been saved. Please, try again.'));
		} // result array
		
		/* for testing */
		$process = 2;
		$this->set('process', $process);
	
	
	} else {
		$process = 1; 
	}// is post
	
	
	/*
	 * get the Sale information for the Credit Form
	* */
	
	$sql = "SELECT 
	id,
	time,
	amount,	
	tax,
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

	if ($this->request->is('post')) {
			
		$incoming = array();
		$incoming['type'] = $type;

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

		$this->request->data['Transaction']['type'] = $type;


		$result_array = $this->Payscape->ValidateCreditCard($incoming);



		if($result_array['response']==1){
			$this->request->data['Transaction']['validated'] = $result_array['response'];	
			$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
			$this->request->data['Transaction']['authcode'] = $result_array['authcode'];
			

			

			$this->set('result_array', $result_array);

			$this->Transaction->create();
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('Transaction successful, and data has been saved.'));
				
			} else {
				$this->Session->setFlash(__('Transaction was not successful, no data has been saved'));
				
			}


		} else {
			$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
		}
		$process = 2;
	} else {
		$process = 1; 
	}// post
	
		$this->set('process', $process);

}// validate

public function refund($transactionid=0){
		$type = 'refund';
	
		
		if($this->request->is('post')){

		
			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}

		
			$sql = "SELECT 
			id, 
			amount, 
			tax,
			payment,
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
			transactionid, 
			orderdescription, 			
			orderid,
			authcode 
			FROM transactions WHERE `transactionid` = $transactionid";
		
			$transaction = $this->Transaction->query($sql);
			$transaction = array_shift($transaction);
		
		
			$auth_amount = $transaction['transactions']['amount'];
			$refund_transactionid = $transaction['transactions']['transactionid'];
			$firstname = $transaction['transactions']['firstname'];
			$lasttname = $transaction['transactions']['lastname'];
			$address1 = $transaction['transactions']['address1'];
			$city = $transaction['transactions']['city'];
			$state = $transaction['transactions']['state'];
			$zip = $transaction['transactions']['zip'];
			$country = $transaction['transactions']['country'];
			$phone = $transaction['transactions']['phone'];
			$fax = $transaction['transactions']['fax'];
			$email = $transaction['transactions']['email'];
			$ipaddress = $transaction['transactions']['ipaddress'];	
			
			$orderid = $transaction['transactions']['orderid'];
			$orderdescription = $transaction['transactions']['orderdescription'];
			$authcode = $transaction['transactions']['authcode'];
			$process = 1;
			$refund_message = "Process Authorization Capture for Transaction  #$transactionid";
		
		
			$transactionid = $this->request->data['Transaction']['transactionid'];
		
			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}
		
			$amount = $this->request->data['Transaction']['amount'];
			if(empty($amount)){
				$amount = "0";
			}
		
			$incoming = array();
			$incoming['type'] = $type;
			$incoming['transactionid'] = $transactionid;
		
			/*
			 * Required only if Amount is less than Authorized Amount
			* cannot be greater than Authorized Amount
			*
			* */

			if(($amount < $auth_amount) && ($amount > 0)){
				$incoming['amount'] = $amount;
			} else {
				$incoming['amount'] = $auth_amount;
				$amount = $auth_amount;
			}
			
	//	echo "INCOMING: ";
	//	debug($incoming);			
		
			$result_array = $this->Payscape->Refund($incoming);

	//	echo "RESULT ARRAY: ";
	//	debug($result_array);
				
		
		
			if($result_array['response']==1){
				$response_code = $result_array['response'];
				$authtransactionid = $result_array['transactionid'];
				$authcode = $result_array['authcode'];
				$refund_message = "The Refund was successful ";
				
				if(($amount < $auth_amount) && ($amount > 0)){
					$this->request->data['Transaction']['amount'] = $amount;
				} else {
					$this->request->data['Transaction']['amount'] = $auth_amount;
				}
					
				$time = gmdate('YmdHis');
				$this->request->data['Transaction']['time'] = $time;
		
				$this->request->data['Transaction']['type'] = 'refund';
				$this->request->data['Transaction']['transactionid'] = $authtransactionid;
				$this->request->data['Transaction']['refund_transactionid'] = $transactionid;
				$this->request->data['Transaction']['authcode'] = $authcode;

				$this->request->data['Transaction']['firstname'] = $firstname;
				$this->request->data['Transaction']['lastname'] = $lasttname;
				$this->request->data['Transaction']['address1'] = $address1;
				$this->request->data['Transaction']['city'] = $city;
				$this->request->data['Transaction']['state'] = $state;
				$this->request->data['Transaction']['zip'] = $zip;
				$this->request->data['Transaction']['country'] = $country;
				$this->request->data['Transaction']['phone'] = $phone;
				$this->request->data['Transaction']['fax'] = $fax;
				$this->request->data['Transaction']['email'] = $email;
				$this->request->data['Transaction']['ipaddress'] = $ipaddress;
				
				$this->request->data['Transaction']['orderid'] = $orderid;
				$this->request->data['Transaction']['orderdescription'] = $orderdescription;
				

		
				/* save the submission and transaction details */
		
				$this->Transaction->create();
				if($this->Transaction->save($this->request->data)){
					$refund_message .= " and has been saved to the database";
					
						$id = $transaction['transactions']['id'];
						$sql_update = "UPDATE transactions SET type = 'refunded' WHERE id = $id";
					
							if($query = $this->Transaction->query($sql_update)){
								$refund_message .= "  and the original record has been Updated to 'refunded'";
							} else {
								$refund_message .= " but the original record could not be Updated in the database.";
							}	
											
					$this->Session->setFlash($refund_message);
						
				} else {
					$refund_message .= " but could not be Saved to the database.";
					$this->Session->setFlash($refund_message);
					$process = 2;
						
				}
		
			} else {
				$refund_message = "Refund Transaction has failed.";
				$this->Session->setFlash($refund_message);
			}
	
			$this->set(compact('result_array', 'incoming', 'process'));

			$process = 2;
		
		} else {
			$process = 1;	
		}	// post
		
		/*
		 * get the transaction information for the Refund Form
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
		
		$refund_message = "Process Refund Sale Credit Card for Transaction  #$transactionid";
		
		
		$this->set(compact('process', 'transaction', 'amount', 'orderid', 'authcode', 'transactionid'));
		
		
	}// refund
	
	public function update($transactionid=0){
		$type = 'update';
		
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
			$transactionid = $transaction['transactions']['transactionid'];
			$orderid = $transaction['transactions']['orderid'];
			$authcode = $transaction['transactions']['authcode'];
			$process = 1;
			$update_message = "Process Update for Transaction  #$transactionid";
		
		
			$transactionid = $this->request->data['Transaction']['transactionid'];
			$shipping_carrier = $this->request->data['Transaction']['shipping_carrier'];
			$tracking_number = $this->request->data['Transaction']['tracking_number'];
		
			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}
		
		
			$incoming = array();
			$incoming['type'] = $type;
			$incoming['transactionid'] = $transactionid;
			$incoming['shipping_carrier'] = $shipping_carrier;
			$incoming['tracking_number'] = $tracking_number;
		

		
			$result_array = $this->Payscape->Update($incoming);
			
		
		
		
			if($result_array['response']==1){
				$response_code = $result_array['response'];
				$authtransactionid = $result_array['transactionid'];
				$authcode = $result_array['authcode'];
				$update_message = "The Update was successful ";
					
		
				$transaction_data = array(
						'id'=>$transactions_id,
						'shipping_carrier'=>$shipping_carrier,
						'tracking_number'=>$tracking_number,
				);
					
				// debug($transaction_data);
				// exit();
					
		
		
				/* save the submission and transaction details */
		
		
				if(! $this->Transaction->save($transaction_data)){
						
					$update_message .= " but could not be saved to the database";
					$this->Session->setFlash($update_message);
						
				} else {
					$update_message .= " and has been Saved to the database.";
					$this->Session->setFlash($update_message);
					$process = 2;
						
				}
		
			} else {
				$update_message = "Transaction has failed.";
				$this->Session->setFlash($update_message);
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
		
		$sql = "SELECT id, amount, transactionid, orderid, authcode, shipping_carrier, tracking_number FROM transactions WHERE `transactionid` = $transactionid";
		
		$transaction = $this->Transaction->query($sql);
		$transaction = array_shift($transaction);
		
		//debug($transaction);
		//exit();
		
		$amount = $transaction['transactions']['amount'];
		$transactionid = $transaction['transactions']['transactionid'];
		$orderid = $transaction['transactions']['orderid'];
		$authcode = $transaction['transactions']['authcode'];
		$process = 1;
		$update_message = "Process Update for Transaction  #$transactionid";
		
		
		$this->set(compact('process', 'transaction', 'amount', 'orderid', 'authcode', 'capture_message', 'transactionid'));
		
		
	}// update
	
	public function void($transactionid){
		$type = 'void';

		$process = 1;
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		
		if($this->request->is('post')){
				$time = gmdate('YmdHis');
			
			$process = 2;
			if(isset($transactionid)){
				$transactionid = (int) $transactionid;
			}
		
			$sql = "SELECT id, firstname, lastname, company, address1, city, state, zip, country, 
			phone, fax, email, 
			amount, transactionid, orderid, orderdescription, 
			authcode FROM transactions WHERE `transactionid` = $transactionid";
		
			$transaction = $this->Transaction->query($sql);
			$transaction = array_shift($transaction);
			
			$void_transaction_id = $transaction['transactions']['id'];
			
			$amount = $transaction['transactions']['amount'];
			
			$orderid = $transaction['transactions']['orderid'];
			$authcode = $transaction['transactions']['authcode'];
			
			$void_message = "Process Void for Transaction  #$transactionid";
		
	
			$incoming = array();
			$incoming['type'] = $type;
			$incoming['transactionid'] = $transactionid;
			$incoming['amount'] = $amount;
			
	
		
			$result_array = $this->Payscape->Void($incoming);
			
		
		
			if($result_array['response']==1){
				$response_code = $result_array['response'];
				$authtransactionid = $result_array['transactionid'];
				$authcode = $result_array['authcode'];
				$void_message = "The Void was successful ";
					
				
				$this->request->data['Transaction']['type'] = 'void';
				$this->request->data['Transaction']['time'] = $time;				
				
				$this->request->data['Transaction']['amount'] = $amount;
				$this->request->data['Transaction']['orderid'] = $transaction['transactions']['orderid'];
				$this->request->data['Transaction']['orderdescription'] = $transaction['transactions']['orderdescription'];
				$this->request->data['Transaction']['ipaddress'] = $_SERVER['REMOTE_ADDR'];
				$this->request->data['Transaction']['firstname'] = $transaction['transactions']['firstname'];
				$this->request->data['Transaction']['lastname'] = $transaction['transactions']['lastname'];
				$this->request->data['Transaction']['company'] = $transaction['transactions']['company'];
				
				$this->request->data['Transaction']['address1'] = $transaction['transactions']['address1'];
				$this->request->data['Transaction']['city'] = $transaction['transactions']['city'];
				$this->request->data['Transaction']['state'] = $transaction['transactions']['state'];
				$this->request->data['Transaction']['zip'] = $transaction['transactions']['zip'];
				$this->request->data['Transaction']['country'] = $transaction['transactions']['country'];
				$this->request->data['Transaction']['phone'] = $transaction['transactions']['phone'];
				$this->request->data['Transaction']['fax'] = $transaction['transactions']['fax'];
				$this->request->data['Transaction']['email'] = $transaction['transactions']['email'];
				
				$this->request->data['Transaction']['authcode'] = $authcode;				
				$this->request->data['Transaction']['transactionid'] = $authtransactionid; 
								
				$this->request->data['Transaction']['void_transaction_id'] = $void_transaction_id;
					
		
		
				/* save the submission and transaction details */
		
				$this->Transaction->create();
				if($this->Transaction->save($this->request->data)){
		
					$void_message .= " and has been saved to the database";
											
				/* update the original record */
					$this->Transaction->id = $transaction['transactions']['id'];
					if($this->Transaction->saveField('type','voided')){
						$void_message .= " The original transaction has been updated to 'voided'";
					} else {
						$void_message .= " but the original transaction could not be updated.";
					}
				
					
					$this->Session->setFlash($void_message);
		
				} else {
					$void_message .= " but could not be Saved to the database.";
					$this->Session->setFlash($void_message);
				
		
				}
		
			} else {
				$void_message = "Transaction has failed.";
				$this->Session->setFlash($void_message);
			}
		
			/*
			 * for testing
			* */
			
			$this->set(compact('result_array', 'incoming', 'process', 'void_message'));
		
		
		}// post
		
		/*
		 * get the Auth information for the Void Form
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
		
		$amount = $transaction['transactions']['amount'];
		$transactionid = $transaction['transactions']['transactionid'];
		$orderid = $transaction['transactions']['orderid'];
		$authcode = $transaction['transactions']['authcode'];
	
		$void_message = "Process Void for Credit Card Transaction  #$transactionid";
		

		$this->set(compact('process', 'transaction', 'amount', 'orderid', 'authcode', 'transactionid', 'void_message'));
		
		
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
