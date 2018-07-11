<?php
/**
 * Class Load
 * All view and model requests will be handled by this
 *
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
class Load {
	/**
	 * view action
	 *
	 * @param $name
	 * @param array|null $vars
	 * @return bool
	 * @throws Exception
	 */
	public function view($name,array $vars = null){
		$file = 'views/'.$name.'.php';

		if(is_readable($file)){

			if(isset($vars)){
				extract($vars);
			}
			require($file);
			return true;
		}
		throw new Exception('View issues');
	}

	/**
	 * model action
	 * all model requests will be handled by this
	 * 
	 * @param $name
	 * @return bool
	 * @throws Exception
	 */
	public function model($name){
		$model = $name.'Model';
		$modelPath = 'models/'.$model.'.php';

		if(is_readable($modelPath)){
			require_once($modelPath);
			return true;
		}

		throw new Exception('Model issues.');
	}
}