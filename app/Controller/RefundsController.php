<?php
App::uses('AppController', 'Controller');
/**
 * Refunds Controller
 *
 * @property Refund $Refund
 * @property PaginatorComponent $Paginator
 */
class RefundsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Refund->recursive = 0;
		$this->set('refunds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($transaction_id = null) {
		if (isset($_GET['transaction_id'])) {
			$transaction_id = (int) $transaction_id;
		}
		$options = array('conditions' => array('Refund.' . $this->Refund->transaction_id => $id));
		$this->set('refund', $this->Refund->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	/* the following methods are not used, Refund records are created by the Transactions controller */
	public function add() {
		if ($this->request->is('post')) {
			$this->Refund->create();
			if ($this->Refund->save($this->request->data)) {
				$this->Session->setFlash(__('The refund has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The refund could not be saved. Please, try again.'));
			}
		}
		$transactions = $this->Refund->Transaction->find('list');
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
		if (!$this->Refund->exists($id)) {
			throw new NotFoundException(__('Invalid refund'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Refund->save($this->request->data)) {
				$this->Session->setFlash(__('The refund has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The refund could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Refund.' . $this->Refund->primaryKey => $id));
			$this->request->data = $this->Refund->find('first', $options);
		}
		$transactions = $this->Refund->Transaction->find('list');
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
		$this->Refund->id = $id;
		if (!$this->Refund->exists()) {
			throw new NotFoundException(__('Invalid refund'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Refund->delete()) {
			$this->Session->setFlash(__('The refund has been deleted.'));
		} else {
			$this->Session->setFlash(__('The refund could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
