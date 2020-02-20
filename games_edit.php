<?php

use Classes\Errors;

require_once 'connect.php';
$game_id = $_POST["game_id"];
$home_team_id = $_POST["home_team_id"];
$away_team_id = $_POST["away_team_id"];
$home_score = $_POST["home_score"];
$away_score = $_POST["away_score"];
$date = $_POST["date"];
try {
  $Game->edit($game_id, $home_team_id, $away_team_id, $home_score, $away_score, $date);
} catch (Exception $e) {
  Errors::solveError($e);
}
