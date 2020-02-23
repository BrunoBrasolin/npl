<?php

use Classes\Errors;

require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php require_once 'alerts.php'; ?>
<?php
if (!isset($_GET["player"])) {
  $_SESSION['error'] = "Failed to get Player Profile";
  header("Location: players.php");
}
$player_id = $_GET['player'];
try {
  $stats = $Player->getStat($player_id);
  $player = $Player->getId($player_id);
  $players = $Player->get();
  $teams = $Team->get();
  $games = $Game->get();
} catch (Exception $e) {
  Errors::solveError($e);
}
if (empty($player)) {
  $_SESSION['error'] = "Failed to get Player Profile";
  header("Location: players.php");
}
?>
<div class="info">
  <h3><b>Player ID:</b> <?= $player['playerid'] ?></h3>
  <hr>
  <h3><b>Name:</b> <?= $player['name'] ?></h3>
  <hr>
  <b>Team:</b>
  <?= $player['team'] ?>
  <hr>
  <b>Height:</b>
  <?php if ($player['height'] == NULL) { ?>
    -
  <?php } else { ?>
    <?= $player['height'] ?> meters
  <?php } ?>
  <hr>
  <b>Number:</b>
  <?= $player['number'] ?>
  <hr>
  <b>Position:</b>
  <?= $player['position'] ?>
  <hr>
  <b>Category:</b>
  <?= $player['category'] ?>
  <hr>
  <b>Year:</b>
  <?= $player['year'] ?>
  <hr>
  <b>Age:</b>
  <?= 2019 - $player['year'] ?>
  <hr>
  <b>Sex:</b>
  <?= $player['sex'] ?>
  <?php if (isset($_SESSION)) : ?>
    <hr>
    <td><button data-toggle="modal" data-target="#player_form" class="btn btn-primary">Edit</button></td>
    <hr>
    <td><button data-toggle="modal" data-target="#player_delete" class="btn btn-danger">Delete</button></td>
    <hr>
  <?php endif ?>
</div>

<div class="stat_player_intro">
  <div class="stat_player">
    <h3>Per Game Stats:</h3>
    <div class="tables">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-dark">
          <thead class="thead-light">
            <tr>
              <?php if (!empty($stats)) : ?>
                <th title="Minutes" scope="col">MIN</th>
                <th title="Points" scope="col">PTS</th>
                <th title="Field Goals Made" scope="col">FGM</th>
                <th title="Field Goals Attempted" scope="col">FGA</th>
                <th title="Field Goals Percentage" scope="col">FG%</th>
                <th title="3 Points Made" scope="col">3PM</th>
                <th title="3 Points Attempted" scope="col">3PA</th>
                <th title="3 Points Percentage" scope="col">3P%</th>
                <th title="Free Throw Made" cope="col">FTM</th>
                <th title="Free Throw Attempted" scope="col">FTA</th>
                <th title="Free Throw Percentage" scope="col">FT%</th>
                <th title="Offensive Rebounds" scope="col">OREB</th>
                <th title="Defensive Rebounds" scope="col">DREB</th>
                <th title="Total Rebounds" scope="col">REB</th>
                <th title="Assists" scope="col">AST</th>
                <th title="Steals" scope="col">STL</th>
                <th title="Blocks" scope="col">BLK</th>
                <th title="Tournovers" scope="col">TOV</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ($stats as $stat) :
                  @$total_dpm += $stat['2pm'];
                  @$total_dpa += $stat['2pa'];
                  @$total_tpm += $stat['3pm'];
                  @$total_tpa += $stat['3pa'];
                  @$total_ftm += $stat['ftm'];
                  @$total_fta += $stat['fta'];
                  @$total_assists += $stat['assists'];
                  @$total_orebounds += $stat['orebounds'];
                  @$total_drebounds += $stat['drebounds'];
                  @$total_steals += $stat['steals'];
                  @$total_blocks += $stat['blocks'];
                  @$total_turnovers += $stat['turnovers'];
                  @$total_min += $stat['min'];
                  @$x++;
                endforeach;
                @$total_tg = ($total_tpm / $total_tpa) * 100;
                @$total_fgm = $total_dpm + $total_tpm;
                @$total_fga = $total_dpa + $total_tpa;
                @$total_fg = ($total_fgm / $total_fga) * 100;
                @$total_ft = ($total_ftm / $total_fta) * 100;
                @$total_points = ($total_tpm * 3) + ($total_dpm * 2) + $total_ftm;
                @$total_rebounds = $total_orebounds + $total_drebounds;
            ?>
            <tr>
              <td><?= round((@$total_min / @$x), 2) ?></td>
              <td><?= round((@$total_points / @$x), 2) ?></td>
              <td><?= round((@$total_fgm / @$x), 2) ?></td>
              <td><?= round((@$total_fga / @$x), 2) ?></td>
              <td><?= round(@$total_fg, 2) ?></td>
              <td><?= round((@$total_tpm / @$x), 2) ?></td>
              <td><?= round((@$total_tpa / @$x), 2) ?></td>
              <td><?= round(@$total_tg, 2) ?></td>
              <td><?= round((@$total_ftm / @$x), 2) ?></td>
              <td><?= round((@$total_fta / @$x), 2) ?></td>
              <td><?= round(@$total_ft, 2) ?></td>
              <td><?= round((@$total_orebounds / @$x), 2) ?></td>
              <td><?= round((@$total_drebounds / @$x), 2) ?></td>
              <td><?= round((@$total_rebounds / @$x), 2) ?></td>
              <td><?= round((@$total_assists / @$x), 2) ?></td>
              <td><?= round((@$total_steals / @$x), 2) ?></td>
              <td><?= round((@$total_blocks / @$x), 2) ?></td>
              <td><?= round((@$total_turnovers / @$x), 2) ?></td>
              <?php
                unset($total_dpm, $total_dpa, $total_tpm, $total_tpa, $total_ftm, $total_fta, $total_assists, $total_orebounds, $total_drebounds, $total_steals, $total_blocks, $total_turnovers, $total_min, $x);
              ?>
              <?php
                if (empty($stats)) :
                  for ($i = 0; $i < 18; $i++) {
                    echo "<td> NAN </td>";
                  }
                endif; ?>
            </tr>
          <?php endif;
              if (empty($stats)) { ?>
            <p class="alert alert-danger" style="text-align: center; font-size: 150%;"> <b>No Stats</b></p>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="stat_player_intro">
  <h3>Carrer Games:</h3>
  <div class="stat_player_nostat">
    <?php if (!empty($stats)) :
      foreach ($stats as $stat) :
        try {
          $game = $Game->getId($stat['game_id']);
        } catch (Exception $e) {
          Errors::solveError($e);
        }
    ?>
        <div class="stat_player">
          <h4>vs <?= $stat['team'] ?>, <?= $game['date'] ?></h4>
          <div class="tables">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-dark">
                <thead class="thead-light">
                  <tr>
                    <th title="Minutes" scope="col">MIN</th>
                    <th title="Points" scope="col">PTS</th>
                    <th title="Field Goals Made" scope="col">FGM</th>
                    <th title="Field Goals Attempted" scope="col">FGA</th>
                    <th title="Field Goals Percentage" scope="col">FG%</th>
                    <th title="3 Points Made" scope="col">3PM</th>
                    <th title="3 Points Attempted" scope="col">3PA</th>
                    <th title="3 Points Percentage" scope="col">3P%</th>
                    <th title="Free Throw Made" cope="col">FTM</th>
                    <th title="Free Throw Attempted" scope="col">FTA</th>
                    <th title="Free Throw Percentage" scope="col">FT%</th>
                    <th title="Offensive Rebounds" scope="col">OREB</th>
                    <th title="Defensive Rebounds" scope="col">DREB</th>
                    <th title="Total Rebounds" scope="col">REB</th>
                    <th title="Assists" scope="col">AST</th>
                    <th title="Steals" scope="col">STL</th>
                    <th title="Blocks" scope="col">BLK</th>
                    <th title="Tournovers" scope="col">TOV</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $points = ($stat['3pm'] * 3) + ($stat['2pm'] * 2) + $stat['ftm'];
                  $rebounds = $stat['orebounds'] + $stat['drebounds'];
                  $fgm = $stat['2pm'] + $stat['3pm'];
                  $fga = $stat['2pa'] + $stat['3pa'];
                  $fg = ($fgm / $fga) * 100;
                  $tg = ($stat['3pm'] / $stat['3pa']) * 100;
                  $ft = ($stat['ftm'] / $stat['fta']) * 100;
                  ?>
                  <tr>
                    <td><?= round($stat['min'], 2) ?></td>
                    <td><?= round($points, 2) ?></td>
                    <td><?= round($fgm, 2) ?></td>
                    <td><?= round($fga, 2) ?></td>
                    <td><?= round($fg, 2) ?></td>
                    <td><?= round($stat['3pm'], 2) ?></td>
                    <td><?= round($stat['3pa'], 2) ?></td>
                    <td><?= round($tg, 2) ?></td>
                    <td><?= round($stat['ftm'], 2) ?></td>
                    <td><?= round($stat['fta'], 2) ?></td>
                    <td><?= round($ft, 2) ?></td>
                    <td><?= round($stat['orebounds'], 2) ?></td>
                    <td><?= round($stat['drebounds'], 2) ?></td>
                    <td><?= round($rebounds, 2) ?></td>
                    <td><?= round($stat['assists'], 2) ?></td>
                    <td><?= round($stat['steals'], 2) ?></td>
                    <td><?= round($stat['blocks'], 2) ?></td>
                    <td><?= round($stat['turnovers'], 2) ?></td>
                    <?php if (isset($_SESSION)) : ?>
                      <td><button data-toggle="modal" data-target="#stat_form_<?= $stat['statsid'] ?>" class="btn btn-primary">Edit</button></td>
                      <td><button data-toggle="modal" data-target="#stat_delete_<?= $stat['statsid'] ?>" class="btn btn-danger">Delete</button></td>
                    <?php endif ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    <?php endforeach;
    endif; ?>
    <?php if (empty($stats)) { ?>
      <p class="alert alert-danger" style="text-align: center; font-size: 150%;"> <b>No Games</b></p>
    <?php } ?>
    <?php if (isset($_SESSION)) : ?>
      <a class="btn btn-dark" id="add" href="stats_form.php?player_id=<?= $player['playerid'] ?>">ADD STAT</a></td>
    <?php endif; ?>
  </div>
</div>

<?php
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
<div id="player_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Player</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" value="<?= $player['name'] ?>" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="height">Height</label>
          <input type="text" class="form-control" name="height" id="height" <?= $height ?> autocomplete="off">
        </div>

        <div class="form-group">
          <label for="number">Number</label>
          <input type="number" class="form-control" name="number" id="number" min="0" max="99" value="<?= $player['number'] ?>" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="team_id">Team</label>
          <select class="form-control" id="team_id" name="team_id">
            <option selected value="<?= $player['team_id'] ?>"><?= $player['team'] ?></option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="position_id">Position</label>
          <select class="form-control" id="position_id" name="position_id">
            <option selected value="<?= $player['position_id'] ?>"><?= $player['position'] ?></option>
            <option value="1">Point Guard</option>
            <option value="2">Shooting Guard</option>
            <option value="3">Small Forward</option>
            <option value="4">Power Forward</option>
            <option value="5">Center</option>
          </select>
        </div>

        <div class="form-group">
          <label for="category_id">Category</label>
          <select class="form-control" id="category_id" name="category_id">
            <option selected value="<?= $player['category_id'] ?>"><?= $player['category'] ?></option>
            <?php foreach ($categories as $category) : ?>
              <option value="<?= $category['id'] ?>"> <?= $category['category'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="year">Year</label>
          <input type="number" class="form-control" name="year" id="year" value="<?= $player['year'] ?>" autocomplete="off">
        </div>

        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline1" name="sex" class="custom-control-input" value="1" <?= $checkedmale ?>>
          <label class="custom-control-label" for="customRadioInline1">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline2" name="sex" class="custom-control-input" value="2" <?= $checkedfemale ?>>
          <label class="custom-control-label" for="customRadioInline2">Female</label>
        </div>
        <br><br>
        <button type="submit" class="btn btn-outline-dark" id="edit_player" value="edit">Edit Player</button>
      </div>
    </div>
  </div>
</div>

<div id="player_delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Are you Sure?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <button type="submit" class="btn btn-danger" id="delete_player" value="delete">Yes</button>
        <button type="submit" class="btn btn-success" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<div id="add_image" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Image</h4>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="player_image.php" method="post">
          <input type="hidden" name="old_directory" id="old_directory" value="<?= $image->directory ?>">
          <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
          <input type="hidden" name="player_id" id="player_id" value="<?= $player['playerid'] ?>">
          <div class="custom-file">
            <p>
              <div><input name="image" class="custom-file-input" type="file" id="image"></div>
              <label class="custom-file-label" for="image">Choose file</label>
            </p>
          </div>
          <div><input type="submit" value="Salvar" class="btn btn-outline-dark"></div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php foreach ($stats as $stat) :
  try {
    $game = $Game->getId($stat['game_id']);
  } catch (Exception $e) {
    Errors::solveError($e);
  }
  include 'stat_edit_modal.php';
  include 'stat_delete_modal.php';
?>

<?php endforeach; ?>
<script>
  $(document).ready(function() {
    var request;
    var toast_loading;
    <?php if (isset($_SESSION)) : ?>
      $('#edit_player').click(function() {
        var player_id = <?= $player['playerid'] ?>;
        var name = $('#name').val();
        var height = $('#height').val();
        var team_id = $('#team_id').val();
        var number = $('#number').val();
        var position_id = $('#position_id').val();
        var category_id = $('#category_id').val();
        var year = $('#year').val();
        var sex = $("[name=\"sex\"]:checked").val();
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
      });
      $('#delete_player').click(function() {
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
                location.href = "players.php"
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
      });
    <?php endif; ?>

  });
</script>

<?php require_once 'footer.php'; ?>
