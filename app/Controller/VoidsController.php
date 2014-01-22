<?php
App::uses('AppController', 'Controller');
/**
 * Voids Controller
 *
 * @property Void $Void
 * @property PaginatorComponent $Paginator
 */
class VoidsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	/* view the details for a Void transaction */
	
	public function view_void($transaction_id = null) {
		if (isset($_GET['transaction_id'])) {
			$transaction_id = (int) $transaction_id;
		}
		
		$sql = "SELECT tr.amount, 
				tr.time,
				tr.transactionid,
				vd.void_date,
				vd.transactionid AS void_transactionid 
				FROM voids vd 
				LEFT JOIN transactions tr ON(tr.transaction_id = vd.transaction_id)
				WHERE vd.transaction_id = $transaction_id";
	
	echo "$sql";
	exit();	
		
//		$options = array('conditions' => array('Void.' . $this->Void->transaction_id => $transaction_id));
//		$this->set('void', $this->Void->find('first', $options));
		
		$this->set('void', $this->Void->query($sql));
	}	
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Void->recursive = 0;
		$this->set('voids', $this->Paginator->paginate());
	}




	
	/* the following methods are not used, Void records are created by the Transactions controller */

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */	
	public function view($id = null) {
		if (!$this->Void->exists($id)) {
			throw new NotFoundException(__('Invalid void'));
		}
		$options = array('conditions' => array('Void.' . $this->Void->primaryKey => $id));
		$this->set('void', $this->Void->find('first', $options));
	}	

	/**
	 * add method
	 *
	 * @return void
	 */
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Void->create();
			if ($this->Void->save($this->request->data)) {
				$this->Session->setFlash(__('The void has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The void could not be saved. Please, try again.'));
			}
		}
		$transactions = $this->Void->Transaction->find('list');
		$this->set(compact('transactions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Void->exists($id)) {
			throw new NotFoundException(__('Invalid void'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Void->save($this->request->data)) {
				$this->Session->setFlash(__('The void has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The void could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Void.' . $this->Void->primaryKey => $id));
			$this->request->data = $this->Void->find('first', $options);
		}
		$transactions = $this->Void->Transaction->find('list');
		$this->set(compact('transactions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Void->id = $id;
		if (!$this->Void->exists()) {
			throw new NotFoundException(__('Invalid void'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Void->delete()) {
			$this->Session->setFlash(__('The void has been deleted.'));
		} else {
			$this->Session->setFlash(__('The void could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
