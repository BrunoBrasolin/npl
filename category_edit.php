<?php

use Classes\Errors;

require_once 'connect.php';
$category = $_POST["category"];
$category_id = $_POST["category_id"];
try {
  $Category->edit($category, $category_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
