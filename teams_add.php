<?php

use Classes\Errors;

include 'connect.php';
$team = $_POST["team"];
$coach = $_POST["coach"];
$arena = $_POST["arena"];
$id = NULL;
try {
  $Team->set($team, $coach, $arena, $id);
} catch (Exception $e) {
  Errors::solveError($e);
}
