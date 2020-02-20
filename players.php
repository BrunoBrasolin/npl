<?php

use Classes\Errors;

require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php require_once 'alerts.php'; ?>
<?php
if (isset($_GET['search'])) {
  $search = $_GET["search"];
  $header = "'$search'";
  try {
    $players = $Player->search($search);
  } catch (Exception $e) {
    Errors::solveError($e);
  }
  if (empty($players)) : ?>
    <div class="alert alert-warning" role="alert">
      No Players Found!
    </div>
  <?php
      require_once 'footer.php';
      exit();
    endif;
  } else {
    try {
      $players = $Player->get();
      $teams = $Team->get();
      $categories = $Category->get();
    } catch (Exception $e) {
      Errors::solveError($e);
    }
    $header = "All";
  }
  if (isset($_SESSION['search']) && $_SESSION['search'] == false) { ?>

<?php
}
unset($_SESSION['search']);
?>
<h1 class="list_title"><?= $header ?> Players</h1>
<div class="tables">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Team</th>
          <th scope="col">Number</th>
          <th scope="col">Position</th>
          <th scope="col">Category</th>
          <th scope="col">Year</th>
          <th scope="col">Age</th>
          <th scope="col">Sex</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($players as $player) : ?>
          <tr>
            <th scope="row"><?= $player['playerid'] ?></th>
            <th scope="row"><a class="links" href="player_profile.php?player=<?= $player['playerid'] ?>"><?= $player['name'] ?></a></th>
            <td><a class="links" href="team_profile.php?team=<?= $player['team_id'] ?>"><?= $player['team'] ?></td>
            <td><?= $player['number'] ?></td>
            <td><?= $player['position'] ?></td>
            <td><?= $player['category'] ?></td>
            <td><?= $player['year'] ?></td>
            <td><?= 2019 - $player['year'] ?></td>
            <td><?= $player['sex'] ?></td>
            <?php if (isset($_SESSION)) : ?>
              <td><button data-toggle="modal" data-target="#player_form_<?= $player['playerid'] ?>" class="btn btn-primary">Edit</button></td>
              <td><button data-toggle="modal" data-target="#player_delete_<?= $player['playerid'] ?>" class="btn btn-danger">Delete</button></td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php foreach ($players as $player) :
  if (empty($player['height'])) {
    $height = "placeholder=\"Null\"";
  } else {
    $height = "value=\"" . $player['height'] . "\"";
  }
  if ($player['sex_id'] == "1") {
    $checkedmale = "checked";
    $checkedfemale = "";
  } else if ($player['sex_id'] == "2") {
    $checkedfemale = "checked";
    $checkedmale = "";
  }
  include 'players_edit_modal.php';
  include 'players_delete_modal.php';
  ?>



<?php endforeach; ?>

<script>
  $(document).ready(function() {
    var request;
    var toast_loading;
  });
</script>

<?php require_once 'footer.php'; ?>
