<?php

namespace Classes;

use PDO;

require_once 'Classes/Connection.php';
require_once 'Classes/Errors.php';
require_once 'config.php';

class Connection
{
  public static function getConnection()
  {
    $conn = new PDO(DB_DRIVE . ":server=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($conn == false) {
      echo "Failed to Etablish a Connection";
      exit();
    } else {
      return $conn;
    }
  }
}
