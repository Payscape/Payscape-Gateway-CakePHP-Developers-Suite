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
	public function add() {
		
		/* if 'payment' = 'check' */
		// we want to retrieve these variables and include them in $incoming
		

		

		$posturl = 'https://secure.payscapegateway.com/api/transact.php';
		$order_id = 'Test';		
		
		/* test data */
		
		$username = 'demo';
		$password = 'password';

		
		$visa = 4111111111111111;
		$mastercard = 5431111111111111;
		$discover = 6011601160116611;
		$american_express = 341111111111111;
		$cc_expire = '1025'; // 10/25
		$cvv = 123;
				
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
					print_r($data_debug);
				echo "</pre>";	
		
			exit();
			
			*/
			
			
			$incoming = array();
			$incoming['amount'] = $this->request->data['Transaction']['amount'];
			
			
	/* credit card or check transactions */		
			$payment = $this->request->data['Transaction']['payment'];
				
			if($payment=='check'){

				$incoming['payment'] = 'check';
				$incoming['checkaba'] = $this->request->data['checkaba'];
				$incoming['checkaccount'] = $this->request->data['checkaccount'];
				$incoming['account_holder_type'] = $this->request->data['account_holder_type'];
				$incoming['account_type'] = $this->request->data['account_type'];
					
			} else {

				$incoming['payment'] = 'credit card';
				$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
				$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];
				$incoming['cvv'] = $this->request->data['Transaction']['cvv'];
				
			}
				
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
		
			$this->Transaction->create();
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction has been saved.'));
				
	//debug($incoming);
	//exit();
				/*
				echo "PAYSCAPE: <br>";
				echo "<pre>";
				print_r($incoming);
				echo "</pre>";
				
				exit();
				*/
				
				
				

	$payscape = $this->Payscape->Sale($incoming);
	
	/*
	echo "<br>PAYSCAPE:<br>";
	
	echo "<pre>";
		print_r($payscape);
	echo "<pre>";
	exit();
	*/
	
	debug($payscape);
	exit();
				
				$this->Session->setFlash(__($payscape));
		//		return $this->redirect(array('action' => 'index'));
				
			} else {				
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
			}
		}// post
				
}// add


public function add_check() {

	/* if 'payment' = 'check' */
	// we want to retrieve these variables and include them in $incoming




	$posturl = 'https://secure.payscapegateway.com/api/transact.php';
	$order_id = 'Test';

	/* test data */

	$username = 'demo';
	$password = 'password';


	$visa = 4111111111111111;
	$mastercard = 5431111111111111;
	$discover = 6011601160116611;
	$american_express = 341111111111111;
	$cc_expire = '1025'; // 10/25
	$cvv = 123;

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
			

	
	/*	 	
		$data_debug = $this->request->data;

		echo "<pre>";
		print_r($data_debug);
		echo "</pre>";

		exit();
	*/		
			
			
		$incoming = array();
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		$incoming['payment'] = 'check';
		$incoming['type'] = 'sale';
		
					
	/* credit card or check transactions */
		$payment = $this->request->data['Transaction']['payment'];
		
		
			if($payment=='check'){
		$incoming['checkname'] = $this->request->data['Transaction']['checkname'];						
		$incoming['checkaba'] = $this->request->data['Transaction']['checkaba'];
		$incoming['checkaccount'] = $this->request->data['Transaction']['checkaccount'];
		$incoming['account_holder_type'] = $this->request->data['Transaction']['account_holder_type'];
		$incoming['account_type'] = $this->request->data['Transaction']['account_type'];
			
		} else {

		$incoming['payment'] = 'credit card';
		$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
		$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];
		$incoming['cvv'] = $this->request->data['Transaction']['cvv'];

		}

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

						$this->Transaction->create();
						if ($this->Transaction->save($this->request->data)) {
						$this->Session->setFlash(__('The transaction has been saved.'));

	//debug($incoming);
		//exit();
		/*
		echo "PAYSCAPE: <br>";
		echo "<pre>";
		print_r($incoming);
		echo "</pre>";

		exit();
		*/




		$payscape = $this->Payscape->Sale($incoming);

		/*
		echo "<br>PAYSCAPE:<br>";

		echo "<pre>";
		print_r($payscape);
		echo "<pre>";
		exit();
		*/

		debug($payscape);
		exit();

		$this->Session->setFlash(__($payscape));
		//		return $this->redirect(array('action' => 'index'));

		} else {
		$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
		}
		}// post

}// add_check


public function add_credit_card() {

	/* if 'payment' = 'check' */
	// we want to retrieve these variables and include them in $incoming




	$posturl = 'https://secure.payscapegateway.com/api/transact.php';
	$order_id = 'Test';

	/* test data */

	$username = 'demo';
	$password = 'password';


	$visa = 4111111111111111;
	$mastercard = 5431111111111111;
	$discover = 6011601160116611;
	$american_express = 341111111111111;
	$cc_expire = '1025'; // 10/25
	$cvv = 123;

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
		print_r($data_debug);
		echo "</pre>";

		exit();
			
		*/
			
			
		$incoming = array();
		$incoming['amount'] = $this->request->data['Transaction']['amount'];
		
					
	/* credit card or check transactions */
		$payment = $this->request->data['Transaction']['payment'];

			if($payment=='check'){

		$incoming['payment'] = 'check';
		$incoming['checkname'] = $this->request->data['Transaction']['checkname'];		
		$incoming['checkaba'] = $this->request->data['Transaction']['checkaba'];	
		$incoming['checkaccount'] = $this->request->data['Transaction']['checkaccount'];		
		$incoming['account_holder_type'] = $this->request->data['Transaction']['account_holder_type'];
		$incoming['account_type'] = $this->request->data['Transaction']['account_type'];
		
			
		} else {

		$incoming['payment'] = 'credit card';
		$incoming['ccexp'] = $this->request->data['Transaction']['ccexp'];
		$incoming['ccnumber'] = $this->request->data['Transaction']['ccnumber'];
		$incoming['cvv'] = $this->request->data['Transaction']['cvv'];

		}

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

						$this->Transaction->create();
						if ($this->Transaction->save($this->request->data)) {
						$this->Session->setFlash(__('The transaction has been saved.'));

	//debug($incoming);
		//exit();
		/*
		echo "PAYSCAPE: <br>";
		echo "<pre>";
		print_r($incoming);
		echo "</pre>";

		exit();
		*/




		$payscape = $this->Payscape->Sale($incoming);

		/*
		echo "<br>PAYSCAPE:<br>";

		echo "<pre>";
		print_r($payscape);
		echo "<pre>";
		exit();
		*/

		debug($payscape);
		exit();

		$this->Session->setFlash(__($payscape));
		//		return $this->redirect(array('action' => 'index'));

		} else {
		$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
		}
		}// post

}// add_credit_card

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
	}}
