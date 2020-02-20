<?php
namespace Classes;

use Classes\Connection;
use Classes\Errors;
use PDO;
use PDOException;

require_once 'Classes/Connection.php';
require_once 'Classes/Errors.php';
require_once 'config.php';
class Account
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

  public function login($user, $pass)
  {
    $query = $this->conn->prepare("SELECT * FROM `account` WHERE user = :user;");
    $query->bindValue(':user', $user);
    if ($query->execute()) {
      if ($query->rowCount() > 0) {
        $row = $query->fetch();
        if (md5($pass) == $row['pass']) {
          $_SESSION["accountid"] = $row['accountid'];
          $_SESSION["user"] = $row['user'];
          header("Location: index.php");
        } else {
          $_SESSION["error"] = "Failed to login! <br> Check your Username or Password";
          header("Location: login_form.php");
        }
      }
    }
  }

  public function get()
  {
    $query = $this->conn->prepare("SELECT * FROM `account`;");
    $query->execute();
    $accounts = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      array_push($accounts, $result);
    }
    return $accounts;
  }

  public function set($fname, $lname, $user, $pass, $email)
  {
    $query = $this->conn->prepare("INSERT INTO `account` VALUES (NULL, :fname, :lname, :user, :pass, :email, DEFAULT, NULL, NOW(), NULL, 0, NULL);");
    $query->bindValue(':fname', $fname);
    $query->bindValue(':pass', $pass);
    $query->bindValue(':lname', $lname);
    $query->bindValue(':user', $user);
    $query->bindValue(':email', $email);
    if ($query->execute()) {
      header("Location: index.php");
    }
  }
}
