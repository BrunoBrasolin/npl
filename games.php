<?php

use Classes\Errors;

require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php require_once 'alerts.php'; ?>
<?php
try {
  $games = $Game->get();
  $teams = $Team->get();
} catch (Exception $e) {
  Errors::solveError($e);
}
?>
<h1 class="list_title">Schedule</h1>
<div class="tables">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
      <thead class="thead-light">
        <tr>
          <th scope="col">Home Team</th>
          <th scope="col">Away Team</th>
          <th scope="col">Home x Away Score</th>
          <th scope="col">Game Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($games as $game) : ?>
          <tr>
            <td><a class="links" href="team_profile.php?team=<?= $game['home_team_id'] ?>"><?= $game['home_team'] ?></a></td>
            <td><a class="links" href="team_profile.php?team=<?= $game['away_team_id'] ?>"><?= $game['away_team'] ?></a></td>
            <td><?= $game['home_score'] ?> x <?= $game['away_score'] ?></td>
            <td><?= $game['date'] ?></td>
            <td><a class="btn btn-primary" href="game_box_score.php?gameid=<?= $game['gameid'] ?>">Box Score</i></a></td>
            <?php if (isset($_SESSION)) : ?>
              <td> <button data-toggle="modal" data-target="#game_form_<?= $game['gameid'] ?>" class="btn btn-primary">Edit</button></td>
              <td><button data-toggle="modal" data-target="#game_delete_<?= $game['gameid'] ?>" class="btn btn-danger">Delete</button></td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php foreach ($games as $game) :
  include 'games_edit_modal.php';
  include 'games_delete_modal.php';
endforeach; ?>

<script>
  $(document).ready(function() {
    var request;
    var toast_loading;
  });
</script>

<?php require_once 'footer.php'; ?>
