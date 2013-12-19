<?php
App::uses('AppController', 'Controller');
/**
 * Curlies Controller
 *
 * @property Curly $Curly
 * @property PaginatorComponent $Paginator
 */
class CurliesController extends AppController {

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
		$this->Curly->recursive = 0;
		$this->set('curlies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Curly->exists($id)) {
			throw new NotFoundException(__('Invalid curly'));
		}
		$options = array('conditions' => array('Curly.' . $this->Curly->primaryKey => $id));
		$this->set('curly', $this->Curly->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Curly->create();
			if ($this->Curly->save($this->request->data)) {
				$response = "The curly has been saved.";
				return $response;
				
			} else {
				$response = "No bingo! Curly has not been saved!";
				return $response;
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Curly->exists($id)) {
			throw new NotFoundException(__('Invalid curly'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Curly->save($this->request->data)) {
				$this->Session->setFlash(__('The curly has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curly could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Curly.' . $this->Curly->primaryKey => $id));
			$this->request->data = $this->Curly->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Curly->id = $id;
		if (!$this->Curly->exists()) {
			throw new NotFoundException(__('Invalid curly'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Curly->delete()) {
			$this->Session->setFlash(__('The curly has been deleted.'));
		} else {
			$this->Session->setFlash(__('The curly could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
