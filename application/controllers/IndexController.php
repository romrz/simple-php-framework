<?php

/**
 * Test controller.
 * It loads the Index Model (although it doesn't do anything).
 * The index action only shows the index view and a string is passed to the view
 * just for demonstration purposes.
 */
class IndexController extends Controller {

    protected $model;

    public function __construct() {
      $this->loadModel("Index");
      $this->model = new IndexModel();
    }

    public function index() {
      $data = array();
      $data["welcomeMessage"] = "Welcome to the index page!"
      $this->loadView("index", $data);
    }

}
