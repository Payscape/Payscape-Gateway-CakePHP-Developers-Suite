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


		//$this->Session->setFlash(__($payscape));
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

public function credit($id=0){
	
	if(isset($id)){
		$id = (int) $id;
	}
	
	if($id==0){
		$this->redirect(array('controller'=>'transactions', 'action'=>'index'));
	}
	
	$base_url = $this->base;
	$this->set('base_url', $base_url);
	
	$sql = "SELECT key_id,
	time,
	ccnumber,
	ccexp,
	cvv,
	checkname,
	checkaba,
	checkaccount,
	account_holder_type,
	account_type,
	amount,
	payment,
	orderid,
	transactionid
	FROM `transactions`
	WHERE transactionid = $id";
	
	$transaction = $this->Transaction->query($sql);
	
	debug($transaction);
	exit();
	
	$this->set('transaction', $transaction);
	
	
}


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
