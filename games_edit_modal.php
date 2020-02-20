<div id="game_form_<?= $game['gameid'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Game</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="home_team_id_<?= $game['gameid'] ?>">Home Team</label>
          <select class="form-control" id="home_team_id_<?= $game['gameid'] ?>" name="home_team_id_<?= $game['gameid'] ?>">
            <option selected value="<?= $game['home_team_id'] ?>"><?= $game['home_team'] ?></option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="away_team_id_<?= $game['gameid'] ?>">Away Team</label>
          <select class="form-control" id="away_team_id_<?= $game['gameid'] ?>" name="away_team_id_<?= $game['gameid'] ?>">
            <option selected value="<?= $game['away_team_id'] ?>"><?= $game['away_team'] ?></option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="home_score_<?= $game['gameid'] ?>">Home Team Score</label>
          <input type="number" class="form-control" name="home_score_<?= $game['gameid'] ?>" id="home_score_<?= $game['gameid'] ?>" min="0" value="<?= $game['home_score'] ?>" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="away_score_<?= $game['gameid'] ?>">Away Team Score</label>
          <input type="number" class="form-control" name="away_score_<?= $game['gameid'] ?>" id="away_score_<?= $game['gameid'] ?>" min="0" value="<?= $game['away_score'] ?>" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="date_<?= $game['gameid'] ?>">Game Date</label>
          <input type="date" class="form-control" name="date_<?= $game['gameid'] ?>" id="date_<?= $game['gameid'] ?>" value="<?= $game['date'] ?>" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="edit_game_<?= $game['gameid'] ?>" value="edit">Edit Game</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#edit_game_<?= $game['gameid'] ?>').click(function() {
    <?php if (isset($_SESSION)) : ?>
      var game_id = <?= $game['gameid'] ?>;
      var home_team_id = $('#home_team_id_<?= $game['gameid'] ?>').val();
      var away_team_id = $('#away_team_id_<?= $game['gameid'] ?>').val();
      var home_score = $('#home_score_<?= $game['gameid'] ?>').val();
      var away_score = $('#away_score_<?= $game['gameid'] ?>').val();
      var date = $('#date_<?= $game['gameid'] ?>').val();
      request = $.ajax({
        url: "games_edit.php",
        method: "POST",
        data: {
          game_id: game_id,
          home_team_id: home_team_id,
          away_team_id: away_team_id,
          home_score: home_score,
          away_score: away_score,
          date: date
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
              location.reload();
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
</script>
