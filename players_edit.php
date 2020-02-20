<?php

use Classes\Errors;

require_once 'connect.php';
$player_id = $_POST["player_id"];
$name = $_POST["name"];
$height = $_POST["height"];
$team_id = $_POST["team_id"];
$number = $_POST["number"];
$position_id = $_POST["position_id"];
$category_id = $_POST["category_id"];
$year = $_POST["year"];
$sex = $_POST["sex"];
try {
  $Player->edit($player_id, $name, $height, $team_id, $number, $position_id, $category_id, $year, $sex);
} catch (Exception $e) {
  Errors::solveError($e);
}
