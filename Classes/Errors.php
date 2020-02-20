<?php

namespace Classes;

use Exception;

require_once 'config.php';
class Errors
{
  public static function solveError(Exception $e)
  {
    if (DEBUG) {
      echo $e->getCode();
    } else {
      echo "<pre>";
      echo print_r($e);
      echo "</pre>";
    }
    exit;
  }
}
