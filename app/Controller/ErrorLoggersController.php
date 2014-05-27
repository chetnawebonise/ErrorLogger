<?php
App::uses('AppController', 'Controller');
/**
 * ErrorLoggers Controller
 *
 * @property ErrorLogger $ErrorLogger
 * @property PaginatorComponent $Paginator
 */
class ErrorLoggersController extends AppController {

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
		$this->ErrorLogger->recursive = 0;
		$this->set('errorLoggers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ErrorLogger->exists($id)) {
			throw new NotFoundException(__('Invalid error logger'));
		}
		$options = array('conditions' => array('ErrorLogger.' . $this->ErrorLogger->primaryKey => $id));
		$this->set('errorLogger', $this->ErrorLogger->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ErrorLogger->create();
			if ($this->ErrorLogger->save($this->request->data)) {
				$this->Session->setFlash(__('The error logger has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The error logger could not be saved. Please, try again.'));
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
		if (!$this->ErrorLogger->exists($id)) {
			throw new NotFoundException(__('Invalid error logger'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ErrorLogger->save($this->request->data)) {
				$this->Session->setFlash(__('The error logger has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The error logger could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ErrorLogger.' . $this->ErrorLogger->primaryKey => $id));
			$this->request->data = $this->ErrorLogger->find('first', $options);
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
		$this->ErrorLogger->id = $id;
		if (!$this->ErrorLogger->exists()) {
			throw new NotFoundException(__('Invalid error logger'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ErrorLogger->delete()) {
			$this->Session->setFlash(__('The error logger has been deleted.'));
		} else {
			$this->Session->setFlash(__('The error logger could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
