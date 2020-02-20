<?php

namespace Classes;

use Classes\Connection;
use Classes\Errors;
use PDO;
use PDOException;

require_once 'Classes/Connection.php';
require_once 'Classes/Errors.php';
require_once 'config.php';
class Player
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
  public function search($search)
  {
    $query = $this->conn->prepare("SELECT * FROM ((((`player`
    INNER JOIN `position` ON `player`.`position_id` = `position`.`id`)
    INNER JOIN `category` ON `player`.`category_id` = `category`.`id`)
    INNER JOIN `team` ON `player`.`team_id` = `team`.`id`)
    INNER JOIN `sex` ON `player`.`sex_id` = `sex`.`id`) WHERE `name` LIKE :search;");
    $query->bindValue(':search', '%' . $search . '%');
    $query->execute();
    $players = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($players, $result);
    }
    return $players;
  }
  public function get()
  {
    $query = $this->conn->prepare("SELECT * FROM ((((`player`
    INNER JOIN `position` ON `player`.`position_id` = `position`.`id`)
    INNER JOIN `category` ON `player`.`category_id` = `category`.`id`)
    INNER JOIN `team` ON `player`.`team_id` = `team`.`id`)
    INNER JOIN `sex` ON `player`.`sex_id` = `sex`.`id`);");
    $query->execute();
    $players = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($players, $result);
    }
    return $players;
  }
  public function set($name, $height, $team_id, $number, $position_id, $category_id, $year, $sex, $id)
  {
    $query = $this->conn->prepare("INSERT INTO `player` VALUES (:id, :name, :height, :team_id, :number, :position_id, :category_id, :year, :sex, NULL);");
    $query->bindValue(':id', $id);
    $query->bindValue(':name', $name);
    $query->bindValue(':height', $height);
    $query->bindValue(':team_id', $team_id);
    $query->bindValue(':number', $number);
    $query->bindValue(':position_id', $position_id);
    $query->bindValue(':category_id', $category_id);
    $query->bindValue(':year', $year);
    $query->bindValue(':sex', $sex);
    $result = $query->execute();
    if ($result) {
      return [
        'id' => $id,
        'name' => $name,
        'height' => $height,
        'team_id' => $team_id,
        'number' => $number,
        'position_id' => $position_id,
        'category_id' => $category_id,
        'year' => $year,
        'sex' => $sex
      ];
    } else {
      return false;
    }
  }
  public function setImage($player_id, $directory)
  {
    $query = $this->conn->prepare("UPDATE `player` SET `directory` = :directory WHERE `player`.`playerid` = :id;");
    $query->bindValue('directory', $directory);
    $query->bindValue('id', $player_id);
    $query->execute();
    header('Location: player_profile.php?player=' . $player_id);
  }
  public function getImage($player_id)
  {
    $query = $this->conn->prepare("SELECT `directory` FROM `player` WHERE `player`.`playerid` = :id");
    $query->bindValue('id', $player_id);
    if ($query->execute()) {
      return $query->fetch(PDO::FETCH_OBJ);
    }
  }
  public function getId($playerid)
  {
    $query = $this->conn->prepare("SELECT * FROM ((((player
    INNER JOIN `position` ON `player`.`position_id` = `position`.`id`)
    INNER JOIN `category` ON `player`.`category_id` = `category`.`id`)
    INNER JOIN `team` ON `player`.`team_id` = `team`.`id`)
    INNER JOIN `sex` ON `player`.`sex_id` = `sex`.`id`) WHERE `playerid` = :playerid;");
    $query->bindValue(':playerid', $playerid);
    if ($query->execute())
      $result = $query->fetch(PDO::FETCH_ASSOC);
    else
      $result = false;
    return $result;
  }
  public function edit($playerid, $name, $height, $team_id, $number, $position_id, $category_id, $year, $sex)
  {
    $query = $this->conn->prepare("UPDATE `player` SET `name` = :name, `height` = :height, `team_id` = :team_id, `number` = :number, `position_id` = :position_id, `category_id` = :category_id, `year` = :year, `sex_id` = :sex_id WHERE `player`.`playerid` = :playerid;");
    $query->bindValue(':name', $name);
    $query->bindValue(':height', $height);
    $query->bindValue(':team_id', $team_id);
    $query->bindValue(':number', $number);
    $query->bindValue(':position_id', $position_id);
    $query->bindValue(':category_id', $category_id);
    $query->bindValue(':year', $year);
    $query->bindValue(':sex_id', $sex);
    $query->bindValue(':playerid', $playerid);
    $query->execute();
  }
  public function getTeam($team_id)
  {
    $query = $this->conn->prepare("SELECT * FROM ((((player
    INNER JOIN `position` ON `player`.`position_id` = `position`.`id`)
    INNER JOIN `category` ON `player`.`category_id` = `category`.`id`)
    INNER JOIN `team` ON `player`.`team_id` = `team`.`id`)
    INNER JOIN `sex` ON `player`.`sex_id` = `sex`.`id`) WHERE `team_id` = :team_id;");
    $query->bindValue(':team_id', $team_id);
    $query->execute();
    $players = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($players, $result);
    }
    return $players;
  }

  public function getStat($player_id)
  {
    $query = $this->conn->prepare("SELECT * FROM ((`stats`
    INNER JOIN `player` ON `stats`.`player_id` = `player`.`playerid`)
    INNER JOIN team ON `stats`.`team_against_id` = `team`.`id`) WHERE `stats`.`player_id` = :player_id;");
    $query->bindValue(':player_id', $player_id);
    $query->execute();
    $stats = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($stats, $result);
    }
    return $stats;
  }

  public function remove($player_id)
  {
    $query = $this->conn->prepare("DELETE FROM player WHERE `player`.`playerid` = :player_id");
    $query->bindValue(':player_id', $player_id);
    $result = $query->execute();
    if ($result) {
      return true;
    } else {
      return false;
    }
  }
}
