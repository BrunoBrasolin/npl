<?php

use Classes\Errors;

require_once 'connect.php';
$player_id = $_POST['player_id'];
$old_directory = $_POST['old_directory'];
if (!empty($old_directory)) {
  unlink($old_directory);
}
$image = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];
$extension = pathinfo($name, PATHINFO_EXTENSION);
$extension = strtolower($extension);
if (strstr('.jpg;.jpeg;.gif;.png', $extension)) {
  $newName = uniqid(time()) . '.' . $extension;
} else {
  echo 'Fail';
}
$directory = 'player_img/' . $newName;
if (move_uploaded_file($image, $directory)) {
  try {
    $Player->setImage($player_id, $directory);
  } catch (Exception $e) {
    Errors::solveError($e);
  }
} else {
  echo 'Fail2';
}
