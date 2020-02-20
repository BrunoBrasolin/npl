<?php

use Classes\Errors;

require_once 'connect.php';
$name = $_POST["name"];
$height = $_POST["height"];
$team_id = $_POST["team_id"];
$number = $_POST["number"];
$position_id = $_POST["position"];
$category_id = $_POST["category_id"];
$year = $_POST["year"];
$sex = $_POST["sex"];
$id = NULL;
try {
  $Player->set($name, $height, $team_id, $number, $position_id, $category_id, $year, $sex, $id);
} catch (Exception $e) {
  Errors::solveError($e);
}
