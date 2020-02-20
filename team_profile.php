<?php

use Classes\Errors;

require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php
if (!isset($_GET["team"])) {
  $_SESSION['error'] = "Failed to get Team Profile";
  header("Location: teams.php");
}
$team_id = $_GET["team"];
try {
  $players = $Player->getTeam($team_id);
  $team = $Team->getId($team_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
if (empty($team)) {
  $_SESSION['error'] = "Failed to get Team Profile";
  header("Location: teams.php");
}
?>
<h1 class="list_title"><?= $team['team'] ?></h1>
<h4 class="list_title"><b>Coach:</b> <?= $team['coach'] ?></h4>
<h4 class="list_title"><b>Arena:</b> <?= $team['arena'] ?></h4>
<br>
<div style="text-align:center">
  <a href="#" class="btn btn-primary" onclick="showTable();">All Players</a>
  <a href="#" class="btn btn-primary" onclick="showMaleTable();">Only Male Players</a>
  <a href="#" class="btn btn-primary" onclick="showFemaleTable();">Only Female Players</a>
</div>
<div class="tables">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
      <thead class="thead-light">
        <tr>
          <th scope="col">Player ID</th>
          <th scope="col">Name</th>
          <th scope="col">Number</th>
          <th scope="col">Position</th>
          <th scope="col">Category</th>
          <th scope="col">Year</th>
          <th scope="col">Age</th>
        </tr>
      </thead>
      <tbody id="male_table">
        <?php foreach ($players as $player) : ?>
          <?php if ($player['sex'] == 'Male') : ?>
            <tr>
              <th scope="row"><?= $player['playerid'] ?></th>
              <th scope="row"><a class="links" href="player_profile.php?player=<?= $player['playerid'] ?>"><?= $player['name'] ?></a></th>
              <td><?= $player['number'] ?></td>
              <td><?= $player['position'] ?></td>
              <td><?= $player['category'] ?></td>
              <td><?= $player['year'] ?></td>
              <td><?= date('Y') - $player['year'] ?></td>
              <?php if (isset($_SESSION)) : ?>
                <td><button data-toggle="modal" data-target="#player_form_<?= $player['playerid'] ?>" class="btn btn-primary">Edit</button></td>
                <td><button data-toggle="modal" data-target="#player_delete_<?= $player['playerid'] ?>" class="btn btn-danger">Delete</button></td>
              <?php endif ?>
            </tr>
          <?php endif ?>
        <?php endforeach ?>
      </tbody>
      <tbody id="female_table">
        <?php foreach ($players as $player) : ?>
          <?php if ($player['sex'] == 'Female') : ?>
            <tr>
              <th scope="row"><?= $player['playerid'] ?></th>
              <th scope="row"><a class="links" href="player_profile.php?player=<?= $player['playerid'] ?>"><?= $player['name'] ?></a></th>
              <td><?= $player['number'] ?></td>
              <td><?= $player['position'] ?></td>
              <td><?= $player['category'] ?></td>
              <td><?= $player['year'] ?></td>
              <td><?= date('Y') - $player['year'] ?></td>
              <?php if (isset($_SESSION)) : ?>
                <td><button data-toggle="modal" data-target="#player_form_<?= $player['playerid'] ?>" class="btn btn-primary">Edit</button></td>
                <td><button data-toggle="modal" data-target="#player_delete_<?= $player['playerid'] ?>" class="btn btn-danger">Delete</button></td>
              <?php endif ?>
            </tr>
          <?php endif ?>
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
  ?>
  <div id="player_form_<?= $player['playerid'] ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Player</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body forms">
          <div class="form-group">
            <label for="name_<?= $player['playerid'] ?>">Name</label>
            <input type="text" class="form-control" name="name_<?= $player['playerid'] ?>" id="name_<?= $player['playerid'] ?>" value="<?= $player['name'] ?>" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="height_<?= $player['playerid'] ?>">Height</label>
            <input type="text" class="form-control" name="height_<?= $player['playerid'] ?>" id="height_<?= $player['playerid'] ?>" <?= $height ?> autocomplete="off">
          </div>

          <div class="form-group">
            <label for="number_<?= $player['playerid'] ?>">Number</label>
            <input type="number" class="form-control" name="number_<?= $player['playerid'] ?>" id="number_<?= $player['playerid'] ?>" min="0" max="99" value="<?= $player['number'] ?>" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="team_id_<?= $player['playerid'] ?>">Team</label>
            <select class="form-control" id="team_id_<?= $player['playerid'] ?>" name="team_id_<?= $player['playerid'] ?>">
              <option selected value="<?= $player['team_id'] ?>"><?= $player['team'] ?></option>
              <?php foreach ($teams as $team) : ?>
                <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="position_id_<?= $player['playerid'] ?>">Position</label>
            <select class="form-control" id="position_id_<?= $player['playerid'] ?>" name="position_id_<?= $player['playerid'] ?>">
              <option selected value="<?= $player['team_id'] ?>"><?= $player['position'] ?></option>
              <option value="1">Point Guard</option>
              <option value="2">Shooting Guard</option>
              <option value="3">Small Forward</option>
              <option value="4">Power Forward</option>
              <option value="5">Center</option>
            </select>
          </div>

          <div class="form-group">
            <label for="category_id_<?= $player['playerid'] ?>">Category</label>
            <select class="form-control" id="category_id_<?= $player['playerid'] ?>" name="category_id_<?= $player['playerid'] ?>">
              <option selected value="<?= $player['category_id'] ?>"><?= $player['category'] ?></option>
              <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>"> <?= $category['category'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="year_<?= $player['playerid'] ?>">Year</label>
            <input type="number" class="form-control" name="year_<?= $player['playerid'] ?>" id="year_<?= $player['playerid'] ?>" value="<?= $player['year'] ?>" autocomplete="off">
          </div>

          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1_<?= $player['playerid'] ?>" name="sex_<?= $player['playerid'] ?>" class="custom-control-input" value="1" <?= $checkedmale ?>>
            <label class="custom-control-label" for="customRadioInline1_<?= $player['playerid'] ?>">Male</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2_<?= $player['playerid'] ?>" name="sex_<?= $player['playerid'] ?>" class="custom-control-input" value="2" <?= $checkedfemale ?>>
            <label class="custom-control-label" for="customRadioInline2_<?= $player['playerid'] ?>">Female</label>
          </div>
          <br><br>
          <button type="submit" class="btn btn-outline-dark" id="edit_player_<?= $player['playerid'] ?>" value="edit">Edit Player</button>
        </div>
      </div>
    </div>
  </div>

  <div id="player_delete_<?= $player['playerid'] ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Are you Sure?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <button type="submit" class="btn btn-danger" id="delete_player_<?= $player['playerid'] ?>" value="delete">Yes</button>
          <button type="submit" class="btn btn-success" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<script>
  function showMaleTable() {
    document.getElementById("male_table").style.display = "table-row-group";
    document.getElementById("female_table").style.display = "none";
  }

  function showFemaleTable() {
    document.getElementById("male_table").style.display = "none";
    document.getElementById("female_table").style.display = "table-row-group";
  }

  function showTable() {
    document.getElementById("male_table").style.display = "table-row-group";
    document.getElementById("female_table").style.display = "table-row-group";
  }

  $(document).ready(function() {
    var request;
    var toast_loading;
    <?php foreach ($players as $player) : ?>
      $('#edit_player_<?= $player['playerid'] ?>').click(function() {
        <?php if (isset($_SESSION)) : ?>
          var player_id = <?= $player['playerid'] ?>;
          var name = $('#name_<?= $player['playerid'] ?>').val();
          var height = $('#height_<?= $player['playerid'] ?>').val();
          var team_id = $('#team_id_<?= $player['playerid'] ?>').val();
          var number = $('#number_<?= $player['playerid'] ?>').val();
          var position_id = $('#position_id_<?= $player['playerid'] ?>').val();
          var category_id = $('#category_id_<?= $player['playerid'] ?>').val();
          var year = $('#year_<?= $player['playerid'] ?>').val();
          var sex = $("[name=\"sex_<?= $player['playerid'] ?>\"]:checked").val();
          request = $.ajax({
            url: "players_edit.php",
            method: "POST",
            data: {
              player_id: player_id,
              name: name,
              height: height,
              team_id: team_id,
              number: number,
              position_id: position_id,
              category_id: category_id,
              year: year,
              sex: sex
            },
            beforeSend: function() {
              toast_loading = M.toast({
                html: 'Loading...',
                classes: 'rounded bg-primary'
              });
            },
            success: function(data) {
              M.toast({
                html: 'Edit Succefully',
                classes: 'bg-success',
                displayLength: 1000,
                completeCallback: function() {
                  location.reload()
                }
              });
              setTimeout(location.reload.bind(location), 60000);
              console.log(data);
            },
            error: function(xhr, ajaxOptions, throwError) {
              console.log("Error: " + throwError);
            },
            complete: function() {
              toast_loading.dismiss();
              $('.modal').modal('hide');
            }
          });
        <?php endif; ?>
      });
      $('#delete_player_<?= $player['playerid'] ?>').click(function() {
        <?php if (isset($_SESSION)) : ?>
          var player_id = <?= $player['playerid'] ?>;
          request = $.ajax({
            url: "players_delete.php",
            method: "POST",
            data: {
              player_id: player_id
            },
            beforeSend: function() {
              toast_loading = M.toast({
                html: 'Loading...',
                classes: 'rounded bg-primary'
              });
            },
            success: function(data) {
              M.toast({
                html: 'Deleted Succefully',
                classes: 'bg-danger',
                displayLength: 1000,
                completeCallback: function() {
                  location.reload()
                }
              });
              setTimeout(location.reload.bind(location), 60000);
              console.log(data);
            },
            error: function(xhr, ajaxOptions, throwError) {
              console.log("Error: " + throwError);
            },
            complete: function() {
              toast_loading.dismiss();
              $('.modal').modal('hide');
            }
          });
        <?php endif; ?>
      });
    <?php endforeach; ?>
  });
</script>

<?php require_once 'footer.php'; ?>
