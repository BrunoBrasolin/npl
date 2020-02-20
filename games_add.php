<?php

use Classes\Errors;

require_once 'connect.php';
$home_team_id = $_POST["home_team_id"];
$away_team_id = $_POST["away_team_id"];
$home_score = $_POST["home_score"];
$away_score = $_POST["away_score"];
$date = $_POST["date"];
if ($home_score > $away_score) {
  try {
    $Game->homeWin($home_team_id, $away_team_id);
  } catch (Exception $e) {
    Errors::solveError($e);
  }
} else if ($away_score > $home_score) {
  try {
    $Game->awayWin($away_team_id, $home_team_id);
  } catch (Exception $e) {
    Errors::solveError($e);
  }
}
try {
  $Game->set($home_team_id, $away_team_id, $home_score, $away_score, $date);
} catch (Exception $e) {
  Errors::solveError($e);
}
