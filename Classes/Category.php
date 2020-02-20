<?php

namespace Classes;

use Classes\Connection;
use Classes\Errors;
use PDO;
use PDOException;

require_once 'Classes/Connection.php';
require_once 'Classes/Errors.php';
require_once 'config.php';
class Category
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
    $query = $this->conn->prepare("SELECT * FROM `category`");
    $query->execute();
    $category = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($category, $result);
    }
    return $category;
  }
  public function set($category, $id)
  {
    $query = $this->conn->prepare("INSERT INTO `category` VALUES (:id, :category);");
    $query->bindValue(':id', $id);
    $query->bindValue(':category', $category);
    $result = $query->execute();
    $id = $this->conn->lastInsertId();
    if ($result) {
      $_SESSION['add'] = true;
      return ['id' => $id, 'category' => $category];
    } else {
      $_SESSION['add'] = false;
    }
  }
  public function edit($category, $category_id)
  {
    $query = $this->conn->prepare("UPDATE `category` SET `category` = :category WHERE `category`.`id` = :id;");
    $query->bindValue(':category', $category);
    $query->bindValue(':id', $category_id);
    $result = $query->execute();
    if ($result) {
      $_SESSION['edit'] = true;
      return ['category' => $category];
    } else {
      $_SESSION['edit'] = false;
    }
  }
  public function remove($category_id)
  {
    $query = $this->conn->prepare("DELETE FROM category WHERE `category`.`id` = :category_id");
    $query->bindValue(':category_id', $category_id);
    $result = $query->execute();
    if ($result) {
      $_SESSION['remove'] = true;
      return true;
    } else {
      $_SESSION['remove'] = false;
    }
  }
}
