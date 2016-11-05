<?php

/**
 * Super class from which every controller must derive.
 * It has basic functionality like loading a view and a model.
 */
class Controller {

  public function __construct() {
  }

  /**
   * Loads an existing model.
   * @param string $model Name of the model to be loaded.
   * @return void
   */
  protected function loadModel($model) {
    // TODO: Error handling
    include_once("application/models/" . $model . "Model.php");
  }

  /**
   * Loads an existing view in the directory views/ with the data passed.
   * @param string $view View's filename.
   * @param array $data Data that will be available on the view.
   * @return void
   */
  protected function loadView($view, $data = array()) {
    foreach($data as $varName => $value) {
      ${$varName} = $value;
    }
    // TODO: Error handling
    include_once("application/views/" . $view . ".php");
  }

}
