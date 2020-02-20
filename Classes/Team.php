<?php

namespace Classes;

use Classes\Connection;
use Classes\Errors;
use PDO;
use PDOException;

require_once 'Classes/Connection.php';
require_once 'Classes/Errors.php';
require_once 'config.php';
class Team
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
    $query = $this->conn->prepare("SELECT * FROM `team` ORDER BY `team`.`wins` DESC");
    $query->execute();
    $teams = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($teams, $result);
    }
    return $teams;
  }
  public function set($team, $coach, $arena, $id)
  {
    $query = $this->conn->prepare("INSERT INTO `team` VALUES (:id, :team, :coach, :arena, 0, 0);");
    $query->bindValue(':id', $id);
    $query->bindValue(':team', $team);
    $query->bindValue(':coach', $coach);
    $query->bindValue(':arena', $arena);
    $result = $query->execute();
    if ($result) {
      $_SESSION['add'] = true;
      return ['id' => $id, 'team' => $team, 'coach' => $coach, 'arena' => $arena];
    } else {
      $_SESSION['add'] = false;
    }
  }
  public function getId($team_id)
  {
    $query = $this->conn->prepare("SELECT * FROM `team` WHERE `team`.`id` = :teamid");
    $query->bindValue(':teamid', $team_id);
    if ($query->execute())
      return $query->fetch(PDO::FETCH_ASSOC);
    else
      return false;
  }
  public function edit($team, $coach, $arena, $team_id)
  {
    $query = $this->conn->prepare("UPDATE `team` SET `team` = :team, `coach` = :coach, `arena` = :arena WHERE `team`.`id` = :id;");
    $query->bindValue(':team', $team);
    $query->bindValue(':coach', $coach);
    $query->bindValue(':arena', $arena);
    $query->bindValue(':id', $team_id);
    $result = $query->execute();
    if ($result) {
      $_SESSION['edit'] = true;
      return ['team' => $team, 'coach' => $coach, 'arena' => $arena];
    } else {
      $_SESSION['edit'] = false;
    }
  }
  public function remove($team_id)
  {
    $query = $this->conn->prepare("DELETE FROM team WHERE `team`.`id` = :id");
    $query->bindValue(':id', $team_id);
    $result = $query->execute();
    if ($result) {
      $_SESSION['remove'] = true;
      return true;
    } else {
      $_SESSION['remove'] = false;
      return false;
    }
  }
}
