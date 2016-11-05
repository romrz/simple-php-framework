<?php

/**
 * This class handles every request to the page.
 * It parses the URI into a controller, an action and its parameters and
 * it then calls that function.
 */
class FrontController {

  // Default controller in case none is specified
  const DEFAULT_CONTROLLER = "IndexController";
  // Default action in case none is specified
  const DEFAULT_ACTION = "index";

  private $controller = self::DEFAULT_CONTROLLER;
  private $action = self::DEFAULT_ACTION;
  private $params = array();
  private $basepath = "";

  /**
   * Gets the controller, action and parameters from the URI requested.
   */
  public function __construct() {
      $this->parseURI();
  }

  private function setController($controller) {
    // Makes sure the controller starts with an uppercase letter and ends
    // with the word "Controller"
    $controller = ucfirst(strtolower($controller)) . "Controller";
    $this->controller = $controller;
  }

  private function setAction($action) {
    $this->action = $action;
  }

  private function setParams(array $params) {
    $this->params = $params;
  }

  /**
   * Parses the URI and gets the controller, action and parameters to be used
   * to execute the request.
   */
  private function parseURI() {
    $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
    $path = substr($path, strlen($this->basepath));
    list($controller, $action, $params) = explode("/", $path, 3);
    if(isset($controller) && $controller != "") {
      $this->setController($controller);
    }
    if(isset($action) && $action != "") {
      $this->setAction($action);
    }
    if(isset($params)) {
      $this->setParams(explode("/", $params));
    }
  }

  /**
   * Executes the action of the controller given by this Front Controller
   */
  public function run() {
    call_user_func_array(array(new $this->controller, $this->action), $this->params);
  }

}
