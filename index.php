<?php
/**
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
session_start();
define('BASE_URL', 'http://www.sprii-local.com/');

/* include core files */
require_once('core/request.php');
require_once('core/router.php');
require_once('core/load.php');
require_once('controllers/errorController.php');
require_once('models/studentModel.php');

try {
	Router::route(new Request); //route to the specific page based on the request
} catch(Exception $e) {
	$controller = new errorController;
	$controller->error($e->getMessage());
}