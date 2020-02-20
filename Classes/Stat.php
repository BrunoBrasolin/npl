<?php
namespace Classes;

use Classes\Connection;
use Classes\Errors;
use PDO;
use PDOException;

require_once 'Classes/Connection.php';
require_once 'Classes/Errors.php';
require_once 'config.php';
class Stat
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
    $query = $this->conn->prepare("SELECT * FROM (((stats INNER JOIN player ON `stats`.`player_id` = `player`.`playerid`) INNER JOIN team ON `stats`.`team_against_id` = `team`.`id`) INNER JOIN game ON `stats`.`game_id` = `game`.`gameid`);");
    $query->execute();
    $stats = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($stats, $result);
    }
    return $stats;
  }
  public function set($player_id, $team_against_id, $game_id, $dpm, $dpa, $tpm, $tpa, $ftm, $fta, $assists, $drebounds, $orebounds, $steals, $blocks, $fouls, $turnovers, $min)
  {
    $query = $this->conn->prepare("INSERT INTO `stats` VALUES (NULL, :player_id, :team_against_id, :game_id, :dpm, :dpa, :tpm, :tpa, :ftm, :fta, :assists, :drebounds, :orebounds, :steals, :blocks, :fouls, :turnovers, :min);");
    $query->bindValue(':player_id', $player_id);
    $query->bindValue(':team_against_id', $team_against_id);
    $query->bindValue(':game_id', $game_id);
    $query->bindValue(':dpm', $dpm);
    $query->bindValue(':dpa', $dpa);
    $query->bindValue(':tpa', $tpa);
    $query->bindValue(':tpm', $tpm);
    $query->bindValue(':fta', $fta);
    $query->bindValue(':ftm', $ftm);
    $query->bindValue(':assists', $assists);
    $query->bindValue(':drebounds', $drebounds);
    $query->bindValue(':orebounds', $orebounds);
    $query->bindValue(':steals', $steals);
    $query->bindValue(':blocks', $blocks);
    $query->bindValue(':fouls', $fouls);
    $query->bindValue(':turnovers', $turnovers);
    $query->bindValue(':min', $min);
    $query->execute();
  }
  public function getId($statid)
  {
    $query = $this->conn->prepare("SELECT * FROM (((`stats` INNER JOIN `player` ON `stats`.`player_id` = `player`.`playerid`) INNER JOIN team ON `stats`.`team_against_id` = `team`.`id`) INNER JOIN game ON `stats`.`game_id` = `game`.`gameid`) WHERE `stats`.`statsid` = :statid;");
    $query->bindValue(':statid', $statid);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  public function edit($statid, $player_id, $team_against_id, $game_id, $dpm, $dpa, $tpm, $tpa, $ftm, $fta, $assists, $drebounds, $orebounds, $steals, $blocks, $fouls, $turnovers, $min)
  {
    $query = $this->conn->prepare("UPDATE `stats` SET `player_id` = :player_id, `team_against_id` = :team_against_id, `game_id` = :game_id, `2pm` = :dpm, `2pa` = :dpa, `3pm` = :tpm, `3pa` = :tpa, `ftm` = :ftm, `fta` = :fta, `assists` = :assists, `drebounds` = :drebounds, `orebounds` = :orebounds, `steals` = :steals, `blocks` = :blocks, `fouls` = :fouls, `turnovers` = :turnovers, `min` = :min WHERE `stats`.`statsid` = :statid;");
    $query->bindValue(':player_id', $player_id);
    $query->bindValue(':team_against_id', $team_against_id);
    $query->bindValue(':game_id', $game_id);
    $query->bindValue(':dpm', $dpm);
    $query->bindValue(':dpa', $dpa);
    $query->bindValue(':tpm', $tpm);
    $query->bindValue(':tpa', $tpa);
    $query->bindValue(':ftm', $ftm);
    $query->bindValue(':fta', $fta);
    $query->bindValue(':assists', $assists);
    $query->bindValue(':drebounds', $drebounds);
    $query->bindValue(':orebounds', $orebounds);
    $query->bindValue(':steals', $steals);
    $query->bindValue(':blocks', $blocks);
    $query->bindValue(':fouls', $fouls);
    $query->bindValue(':turnovers', $turnovers);
    $query->bindValue(':min', $min);
    $query->bindValue(':statid', $statid);
    $query->execute();
  }
  public function remove($stats_id)
  {
    $query = $this->conn->prepare("DELETE FROM `stats` WHERE `stats`.`statsid` = :stats_id");
    $query->bindValue('stats_id', $stats_id);
    $query->execute();
  }
}
