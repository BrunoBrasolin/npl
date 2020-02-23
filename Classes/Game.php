<?php

namespace Classes;

use Classes\Connection;
use Classes\Errors;
use PDO;
use PDOException;

require_once 'Classes/Connection.php';
require_once 'Classes/Errors.php';
require_once 'config.php';
class Game
{
  private $conn;

  function __construct()
  {
    try {
      $this->conn = Connection::getConnection();
    } catch (PDOException $e) {
      Errors::solveError($e);
    }
  }
  public function get()
  {
    $query = $this->conn->prepare("SELECT `game`.`gameid`, `home`.`team` as `home_team`, `away`.`team` as `away_team`, `home_score`, `away_score`, `date`, `home_team_id`, `away_team_id` FROM `game` INNER JOIN `team` as `home` on `home_team_id` = `home`.`id` INNER JOIN `team` as `away` on `away_team_id` = `away`.`id` ORDER BY `date` DESC;");
    $query->execute();
    $games = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($games, $result);
    }
    return $games;
  }
  public function getCarousel()
  {
    $query = $this->conn->prepare("SELECT `game`.`gameid`, `home`.`team` as `home_team`, `away`.`team` as `away_team`, `home_score`, `away_score`, `date`, `home_team_id`, `away_team_id` FROM `game` INNER JOIN `team` as `home` on `home_team_id` = `home`.`id` INNER JOIN `team` as `away` on `away_team_id` = `away`.`id` ORDER BY `date` ASC LIMIT 5;");
    $query->execute();
    $games = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($games, $result);
    }
    return $games;
  }
  public function set($home_team_id, $away_team_id, $home_score, $away_score, $date)
  {
    $query = $this->conn->prepare("INSERT INTO `game` VALUES (NULL, :home_team_id, :away_team_id, :home_score, :away_score, :date);");
    $query->bindValue(':home_team_id', $home_team_id);
    $query->bindValue(':away_team_id', $away_team_id);
    $query->bindValue(':home_score', $home_score);
    $query->bindValue(':away_score', $away_score);
    $query->bindValue(':date', $date);
    $query->execute();
  }
  public function homeWin($home_team_id, $away_team_id)
  {
    $query = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` + 1 WHERE `team`.`id` = :home_team_id");
    $query->bindValue(':home_team_id', $home_team_id);
    $query2 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` + 1 WHERE `team`.`id` = :away_team_id");
    $query2->bindValue(':away_team_id', $away_team_id);
    $query->execute();
    $query2->execute();
  }
  public function awayWin($away_team_id, $home_team_id)
  {
    $query = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` + 1 WHERE `team`.`id` = :away_team_id");
    $query->bindValue(':away_team_id', $away_team_id);
    $query2 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` + 1 WHERE `team`.`id` = :home_team_id");
    $query2->bindValue(':home_team_id', $home_team_id);
    $query->execute();
    $query2->execute();
  }
  public function getId($gameid)
  {
    $query = $this->conn->prepare("SELECT `game`.`gameid`, `home`.`team` as `home_team`, `away`.`team` as `away_team`, `home_score`, `away_score`, `date`, `home_team_id`, `away_team_id` FROM `game` INNER JOIN `team` as `home` on `home_team_id` = `home`.`id` INNER JOIN `team` as `away` on `away_team_id` = `away`.`id` WHERE `game`.`gameid` = :gameid;");
    $query->bindValue(':gameid', $gameid);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  public function edit($gameid, $home_team_id, $away_team_id, $home_score, $away_score, $date)
  {
    $game = $this->getId($gameid);
    if ($home_score > $away_score && $game['home_score'] < $game['away_score']) {
      $query2 = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` + 1 WHERE `team`.`id` = $home_team_id");
      $query4 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` - 1 WHERE `team`.`id` = $home_team_id");
      $query3 = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` - 1 WHERE `team`.`id` = $away_team_id");
      $query5 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` + 1 WHERE `team`.`id` = $away_team_id");
    }
    if ($away_score > $home_score && $game['away_score'] < $game['home_score']) {
      $query2 = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` + 1 WHERE `team`.`id` = $away_team_id");
      $query4 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` - 1 WHERE `team`.`id` = $away_team_id");
      $query3 = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` - 1 WHERE `team`.`id` = $home_team_id");
      $query5 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` + 1 WHERE `team`.`id` = $home_team_id");
    }
    $query = $this->conn->prepare("UPDATE `game` SET `home_team_id` = :home_team_id, `away_team_id` = :away_team_id, `home_score` = :home_score,`away_score` = :away_score, `date` = :date WHERE `game`.`gameid` = :id;");
    $query->bindValue(':id', $gameid);
    $query->bindValue(':home_team_id', $home_team_id);
    $query->bindValue(':away_team_id', $away_team_id);
    $query->bindValue(':home_score', $home_score);
    $query->bindValue(':away_score', $away_score);
    $query->bindValue(':date', $date);
    $query->execute();
    $query2->execute();
    $query3->execute();
    $query4->execute();
    $query5->execute();
  }
  public function getStat($game_id)
  {
    $query = $this->conn->prepare("SELECT * FROM (((stats INNER JOIN player ON `stats`.`player_id` = `player`.`playerid`) INNER JOIN team ON `stats`.`team_against_id` = `team`.`id`) INNER JOIN game ON `stats`.`game_id` = `game`.`gameid`) WHERE `stats`.`game_id` = game_id;");
    $query->bindValue(':game_id', $game_id);
    $query->execute();
    $stats = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($stats, $result);
    }
    return $stats;
  }
  public function remove($game_id)
  {
    $game = $this->getId($game_id);
    $home_team_id = $game['home_team_id'];
    $away_team_id = $game['away_team_id'];
    if ($game['home_score'] > $game['away_score'])
      $query2 = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` - 1 WHERE `team`.`id` = $home_team_id");
      $query3 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` - 1 WHERE `team`.`id` = $away_team_id");
    if ($game['away_score'] > $game['home_score'])
      $query2 = $this->conn->prepare("UPDATE `team` SET `wins` = `wins` - 1 WHERE `team`.`id` = $away_team_id");
      $query3 = $this->conn->prepare("UPDATE `team` SET `losses` = `losses` - 1 WHERE `team`.`id` = $home_team_id");
    $query = $this->conn->prepare("DELETE FROM `game` WHERE `game`.`gameid` = :game_id");
    $query->bindValue(':game_id', $game_id);
    $query->execute();
    $query2->execute();
    $query3->execute();
  }
}
