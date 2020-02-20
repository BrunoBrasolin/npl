<?php

use Classes\Errors;

require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php require_once 'alerts.php'; ?>
<?php
try {
  $teams = $Team->get();
} catch (Exception $e) {
  Errors::solveError($e);
}
?>
<h1 class="list_title">Standings</h1>
<div class="tables">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
      <thead class="thead-light">
        <tr>
          <th scope="col">Team Name</th>
          <th scope="col">Games Played</th>
          <th scope="col">Wins</th>
          <th scope="col">Losses</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($teams as $team) : ?>
          <tr>
            <th scope="row"><a class="links" href="team_profile.php?team=<?= $team['id'] ?>"><?= $team['team'] ?></a></th>
            <td><?= $team['wins'] + $team['losses'] ?></td>
            <td><?= $team['wins'] ?></td>
            <td><?= $team['losses'] ?></td>
            <?php if (isset($_SESSION)) : ?>
              <td><button data-toggle="modal" data-target="#team_form_<?= $team['id'] ?>" class="btn btn-primary">Edit</button></td>
              <td><button data-toggle="modal" data-target="#team_delete_<?= $team['id'] ?>" class="btn btn-danger">Delete</button></td>
            <?php endif ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php foreach ($teams as $team) :
  include 'teams_edit_modal.php';
  include 'teams_delete_modal.php';
endforeach; ?>

<script>
  $(document).ready(function() {
    var request;
    var toast_loading;
  });
</script>

<?php require_once 'footer.php'; ?>
