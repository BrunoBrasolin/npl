<?php

use Classes\Errors;

require_once 'connect.php';
$user = $_POST["user"];
$pass = $_POST["pass"];
try {
  $Account->login($user, $pass);
} catch (Exception $e) {
  Errors::solveError($e);
}
