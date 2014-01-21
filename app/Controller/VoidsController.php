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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Void->recursive = 0;
		$this->set('voids', $this->Paginator->paginate());
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
		
		$options = array('conditions' => array('Void.' . $this->Void->transaction_id => $transaction_id));
		$this->set('void', $this->Void->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	
	/* the following methods are not used, Void records are created by the Transactions controller */
	
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
