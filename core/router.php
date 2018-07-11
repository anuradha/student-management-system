<?php
/**
 * Class Router
 *
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
class Router {
	/**
	 * router class
	 * all routing requests will be handled by this
	 *
	 * @param Request $request
	 * @throws Exception
	 */
	public static function route(Request $request) {
		$controller = $request->getController().'Controller';
		$method = $request->getMethod();
		$args = $request->getArgs();
		
		$controllerFile = 'controllers/'.$controller.'.php';
		if(is_readable($controllerFile)){
			require_once $controllerFile;

			$controller = new $controller;
			$method = (is_callable(array($controller,$method))) ? $method : 'index';

			if(!empty($args)){
				call_user_func_array(array($controller,$method),$args);
			}else{
				call_user_func(array($controller,$method));
			}
			return;
		}

		throw new Exception('404 - '.$request->getController().' not found');
	}
}
