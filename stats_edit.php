<?php

use Classes\Errors;

require_once 'connect.php';
$stat_id = $_POST["stat_id"];
$player_id = $_POST["player_id"];
$team_against_id = $_POST["team_against_id"];
$game_id = $_POST["game_id"];
$dpm = $_POST["dpm"];
$dpa = $_POST["dpa"];
$tpm = $_POST["tpm"];
$tpa = $_POST["tpa"];
$ftm = $_POST["ftm"];
$fta = $_POST["fta"];
$assists = $_POST["assists"];
$drebounds = $_POST["drebounds"];
$orebounds = $_POST["orebounds"];
$steals = $_POST["steals"];
$blocks = $_POST["blocks"];
$fouls = $_POST["fouls"];
$turnovers = $_POST["turnovers"];
$min = $_POST["min"];
try {
  $Stat->edit($stat_id, $player_id, $team_against_id, $game_id, $dpm, $dpa, $tpm, $tpa, $ftm, $fta, $assists, $drebounds, $orebounds, $steals, $blocks, $fouls, $turnovers, $min);
} catch (Exception $e) {
  Errors::solveError($e);
}
