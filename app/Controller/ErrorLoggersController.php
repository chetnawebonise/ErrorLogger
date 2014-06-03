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
	public $components = array('Paginator', 'SwiftMailer');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ErrorLogger->recursive = 0;
		$this->set('errorLoggers', $this->Paginator->paginate());
	}
}
