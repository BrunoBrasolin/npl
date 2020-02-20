<?php

use Classes\Errors;

require_once 'connect.php';
$team_id = $_POST["team_id"];
try {
  $Team->remove($team_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
