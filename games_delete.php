<?php

use Classes\Errors;

require_once 'connect.php';
$game_id = $_POST["game_id"];
try {
  $Game->remove($game_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
