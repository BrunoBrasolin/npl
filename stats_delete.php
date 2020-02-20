<?php

use Classes\Errors;

require_once 'connect.php';
$stats_id = $_POST["stat_id"];
try {
  $Stat->remove($stats_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
