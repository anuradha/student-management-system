<?php
/**
 * Class Request
 * All requests will be handled by this
 * 
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
class Request{

	/**
	 * @var mixed|string
	 */
	private $_controller;

	/**
	 * @var string
	 */
	private $_method;

	/**
	 * @var array
	 */
	private $_args;

	/**
	 * Request constructor.
	 */
	public function __construct()
	{
		//split url to get the controller and method
		$spliturl = explode('/',$_SERVER['REQUEST_URI']);
		$spliturl = array_filter($spliturl);

		//assign student as the default controller and default action
		$this->_controller = ($c = array_shift($spliturl))? $c: 'student';
		$this->_method = ($c = array_shift($spliturl))? $c.'Action': 'indexAction';
		$this->_args = (isset($spliturl[0])) ? $spliturl : array();
	}

	/**
	 * Get controller
	 * @return mixed|string
	 */
	public function getController(){
		return $this->_controller;
	}

	/**
	 * Get method/action
	 * @return string
	 */
	public function getMethod(){
		return $this->_method;
	}

	/**
	 * Get args
	 * @return array
	 */
	public function getArgs(){
		return $this->_args;
	}
}