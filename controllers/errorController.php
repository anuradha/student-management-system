<?php
/**
 * Class errorController
 * all error requests will be hanled by this
 *
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
class errorController {
	/**
	 * errorController constructor.
	 */
	public function __construct()
	{
		$this->load = new Load();
	}

	/**
	 * index Action
	 */
	public function index() {}

	/**
	 * error Action
	 * report all invalid URLs (404)
	 * @param $message
	 */
	public function error($message) {
		$vars['error'] = $message;
		$this->load->view('404', $vars);
	}
}
