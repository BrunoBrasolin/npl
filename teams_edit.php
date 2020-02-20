<?php require_once 'connect.php';
$team_id = $_POST["team_id"];
$coach = $_POST["coach"];
$team = $_POST["team"];
$arena = $_POST["arena"];
try {
  $Team->edit($team, $coach, $arena, $team_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
