<?php

use Classes\Errors;

require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php require_once 'alerts.php'; ?>
<?php
try {
  $players = $Player->get();
  $games = $Game->get();
  $stats = $Stat->get();
  $teams = $Team->get();
} catch (Exception $e) {
  Errors::solveError($e);
}
?>

<h1 class="list_title">All Stats</h1>

<div class="tables">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
      <thead class="thead-light sticky-top">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
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
        <?php foreach ($stats as $stat) : ?>
          <tr>
            <th scope="row"><?= $stat['playerid'] ?></th>
            <th scope="row"><a class="links" href="player_profile.php?player=<?= $stat['playerid'] ?>"><?= $stat['name'] ?></a></th>
            <td><?= $stat['min'] ?></td>
            <td><?= ($stat['2pm'] *  2) + ($stat['3pm'] * 3) + $stat['ftm'] ?></td>
            <td><?= $stat['2pm'] + $stat['3pm'] ?></td>
            <td><?= $stat['2pa'] + $stat['3pa'] ?></td>
            <td><?= round(($stat['2pm'] + $stat['3pm']) / ($stat['2pa'] + $stat['3pa']), 2) * 100 ?>%</td>
            <td><?= $stat['3pm'] ?></td>
            <td><?= $stat['3pa'] ?></td>
            <td><?= round(($stat['3pm'] / $stat['3pa']), 2) * 100 ?>%</td>
            <td><?= $stat['ftm'] ?></td>
            <td><?= $stat['fta'] ?></td>
            <td><?= round(($stat['ftm'] / $stat['fta']), 2) * 100 ?>%</td>
            <td><?= $stat['orebounds'] ?></td>
            <td><?= $stat['drebounds'] ?></td>
            <td><?= $stat['orebounds'] ?></td>
            <td><?= $stat['assists'] ?></td>
            <td><?= $stat['steals'] ?></td>
            <td><?= $stat['blocks'] ?></td>
            <td><?= $stat['turnovers'] ?></td>
            <?php if (isset($_SESSION)) : ?>
              <td><button data-toggle="modal" data-target="#stat_form_<?= $stat['statsid'] ?>" class="btn btn-primary">Edit</button></td>
              <td><button data-toggle="modal" data-target="#stat_delete_<?= $stat['statsid'] ?>" class="btn btn-danger">Delete</button></td>
          </tr>
      <?php endif;
      endforeach; ?>
      </tbody>
    </table>
  </div>
</div>


<?php foreach ($stats as $stat) :
  try {
    $game = $Game->getId($stat['game_id']);
  } catch (Exception $e) {
    Errors::solveError($e);
  }
  include 'stats_edit_modal.php';
  include 'stats_delete_modal.php';
endforeach; ?>

<script>
  $(document).ready(function() {
    var request;
    var toast_loading;
  });
</script>

<?php require_once 'footer.php'; ?>
