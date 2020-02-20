<?php

use Classes\Errors;

require_once 'connect.php';
$category_id = $_POST["category_id"];
if (!is_numeric($category_id)) {
  throw new InvalidArgumentException("Failed to get Category ID!");
}
try {
  $Category->remove($category_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
