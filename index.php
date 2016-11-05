<?php

/**
 * Includes all necessary core's framework files
 */
include_once('core/FrontController.php');
include_once('core/Controller.php');
include_once('core/Model.php');
include_once('core/DB.php');


// TODO: Autoload classes
include_once('application/controllers/IndexController.php');

/**
 * Creates the FrontController.
 * It decides which controller and which action to call
 * according to the URI
 */
$frontController = new FrontController();
$frontController->run();
