<?php

use Classes\Errors;

require_once 'connect.php';
$player_id = $_POST["player_id"];
try {
  $Player->remove($player_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
