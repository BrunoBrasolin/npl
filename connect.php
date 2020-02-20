<?php if (!isset($_SESSION)) {
  session_start();
}
ini_set('display_errors', 1);

use Classes\Account;
use Classes\Game;
use Classes\Stat;
use Classes\Team;
use Classes\Errors;
use Classes\Player;
use Classes\Category;

require_once 'Classes\Account.php';
require_once 'Classes\Game.php';
require_once 'Classes\Stat.php';
require_once 'Classes\Team.php';
require_once 'Classes\Errors.php';
require_once 'Classes\Player.php';
require_once 'Classes\Category.php';

try {
  $Account = new Account();
  $Player = new Player();
  $Team = new Team();
  $Game = new Game();
  $Stat = new Stat();
  $Category = new Category();
} catch (Exception $e) {
  Errors::solveError($e);
}
if (isset($_SESSION["player_id"])) {
  $session_playerid = $_SESSION["player_id"];
  try {
    $session_player = $Player->getId($session_playerid);
  } catch (Exception $e) {
    Errors::solveError($e);
  }
}
