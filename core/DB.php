<?php

/**
 * This class gives basic functionality to have access to the information in
 * the database, encapsulating all related stuff to the connection to the
 * database.
 */
class DB {
  /**
   * Database's server name
   */
  const HOSTNAME = "localhost";
  /**
   * Database user name
   */
  const USER = "username";
  /**
   * Database user's password
   */
  const PASSWORD = "password";
  /**
   * Database name
   */
  const DBNAME = "dbname";

  private $mysqli;

  public function __construct() {
      $this->mysqli = new mysqli(
        self::HOSTNAME, self::USER, self::PASSWORD, self::DBNAME);
  }

  public function __destruct() {
    $this->mysqli->close();
  }

  /**
   * Executes a SELECT query of the fields and the table given.
   * @param string $table Table of the database
   * @param string $fields Fields requested
   * @return array An associative array with the fields requested.
   */
  public function select($table, $fields = "*") {
    return $this->fetchResult("SELECT $fields FROM $table");
  }

  /**
   * Gets the first row of the query's result.
   * @param string $query Query to execute on the database
   * @return array An associative array with the fields requested
   */
  public function fetchRow($query) {
    $result = $this->query($query);
    return $result->fetch_assoc();
  }

  /**
   * Executes the query given and returns all the rows of the result.
   * @param string $query Query to execute on the database
   * @return array An array of associative arrays with the fields requested
   */
  public function fetchResult($query) {
    $data = array();
    if($result = $this->mysqli->query($query)) {
      while($row = $result->fetch_array()) {
        array_push($data, $row);
      }
    }

    return $data;
  }

  /**
   * Executes a query on the database
   * @param string $query Query
   * @return boolean True or False if the query does not return anything.
   *         An object mysqli_result if the query returns data.
   */
  public function query($query) {
    return $this->mysqli->query($query);
  }

  /**
   * Gets the id of the last inserted row.
   * @return int Un entero
   */
  public function lastInsertId() {
    return $this->mysqli->insert_id;
  }

  /**
   * Gets only one value of the query.
   * It is used when only the first value of the query is needed.
   * @param string $query Query
   * @return object The first value of the first row of the query.
   */
  public function getResult($query) {
    $result = $this->query($query);
    return $result->fetch_row()[0];
  }
}
