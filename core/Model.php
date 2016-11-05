<?php

/**
 * Superclass from which all other models must derive.
 * It contains an instance of the database.
 */
class Model {

  protected $db;

  /**
   * Initialize the model class with an instance of the database
   * so that every model can access it directly.
   */
  public function __construct() {
    $this->db = new DB();
  }

}
