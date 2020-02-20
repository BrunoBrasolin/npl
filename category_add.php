<?php

use Classes\Errors;

require_once 'connect.php';
$category = $_POST["category"];
$id = NULL;
try {
  $Category->set($category, $id);
} catch (Exception $e) {
  Errors::solveError($e);
}
