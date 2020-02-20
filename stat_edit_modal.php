<div id="stat_form_<?= $stat['statsid'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Stat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="player_id_<?= $stat['statsid'] ?>">Player</label>
          <select class="form-control" id="player_id_<?= $stat['statsid'] ?>" name="player_id_<?= $stat['statsid'] ?>">
            <option selected value="<?= $stat['playerid'] ?>"><?= $stat['name'] ?></option>
            <?php foreach ($players as $player) : ?>
              <option value="<?= $player['playerid'] ?>"> <?= $player['name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="team_against_id_<?= $stat['statsid'] ?>">Team Against</label>
          <select class="form-control" id="team_against_id_<?= $stat['statsid'] ?>" name="team_against_id_<?= $stat['statsid'] ?>">
            <option selected value="<?= $stat['team_against_id'] ?>"><?= $stat['team'] ?></option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="game_id_<?= $stat['statsid'] ?>">Game</label>
          <select class="form-control" id="game_id_<?= $stat['statsid'] ?>" name="game_id_<?= $stat['statsid'] ?>">
            <option selected value="<?= $stat['game_id'] ?>"><?= $game['home_team'] . " x "  . $game['away_team'] . ", " . $game['date'] ?></option>
            <?php foreach ($games as $game) : ?>
              <option value="<?= $game['gameid'] ?>"> <?= $game['home_team'] ?> x <?= $game['away_team'] ?>, <?= $game['date'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="2pm">2 Points Made</label>
          <input type="number" class="form-control" name="2pm_<?= $stat['statsid'] ?>" id="2pm_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['2pm'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="2pa">2 Points Attempted</label>
          <input type="number" class="form-control" name="2pa_<?= $stat['statsid'] ?>" id="2pa_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['2pa'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="3pm">3 Points Made</label>
          <input type="number" class="form-control" name="3pm_<?= $stat['statsid'] ?>" id="3pm_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['3pm'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="3pa">3 Points Attempted</label>
          <input type="number" class="form-control" name="3pa_<?= $stat['statsid'] ?>" id="3pa_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['3pa'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="ftm">Free Throw Made</label>
          <input type="number" class="form-control" name="ftm_<?= $stat['statsid'] ?>" id="ftm_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['ftm'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="fta">Free Throw Attempted</label>
          <input type="number" class="form-control" name="fta_<?= $stat['statsid'] ?>" id="fta_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['fta'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="assists">Assists</label>
          <input type="number" class="form-control" name="assists_<?= $stat['statsid'] ?>" id="assists_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['assists'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="drebounds">Defensive Rebounds</label>
          <input type="number" class="form-control" name="drebounds_<?= $stat['statsid'] ?>" id="drebounds_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['drebounds'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="orebounds">Ofensive Rebounds</label>
          <input type="number" class="form-control" name="orebounds_<?= $stat['statsid'] ?>" id="orebounds_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['orebounds'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="steals">Steals</label>
          <input type="number" class="form-control" name="steals_<?= $stat['statsid'] ?>" id="steals_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['steals'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="blocks">Blocks</label>
          <input type="number" class="form-control" name="blocks_<?= $stat['statsid'] ?>" id="blocks_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['blocks'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="fouls">Fouls</label>
          <input type="number" class="form-control" name="fouls_<?= $stat['statsid'] ?>" id="fouls_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['fouls'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="turnovers">Turnovers</label>
          <input type="number" class="form-control" name="turnovers_<?= $stat['statsid'] ?>" id="turnovers_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['turnovers'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="min">Minutes Played</label>
          <input type="number" class="form-control" name="min_<?= $stat['statsid'] ?>" id="min_<?= $stat['statsid'] ?>" min="0" value="<?= $stat['min'] ?>" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="edit_stat_<?= $stat['statsid'] ?>" value="edit">Edit Stat</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#edit_stat_<?= $stat['statsid'] ?>').click(function() {
    <?php if (isset($_SESSION)) : ?>
      var stat_id = <?= $stat['statsid'] ?>;
      var player_id = $('#player_id_<?= $stat['statsid'] ?>').val();
      var team_against_id = $('#team_against_id_<?= $stat['statsid'] ?>').val();
      var game_id = $('#game_id_<?= $stat['statsid'] ?>').val();
      var dpm = $('#2pm_<?= $stat['statsid'] ?>').val();
      var dpa = $('#2pa_<?= $stat['statsid'] ?>').val();
      var tpm = $('#3pm_<?= $stat['statsid'] ?>').val();
      var tpa = $('#3pa_<?= $stat['statsid'] ?>').val();
      var ftm = $('#ftm_<?= $stat['statsid'] ?>').val();
      var fta = $('#fta_<?= $stat['statsid'] ?>').val();
      var assists = $('#assists_<?= $stat['statsid'] ?>').val();
      var drebounds = $('#drebounds_<?= $stat['statsid'] ?>').val();
      var orebounds = $('#orebounds_<?= $stat['statsid'] ?>').val();
      var steals = $('#steals_<?= $stat['statsid'] ?>').val();
      var blocks = $('#blocks_<?= $stat['statsid'] ?>').val();
      var fouls = $('#fouls_<?= $stat['statsid'] ?>').val();
      var turnovers = $('#turnovers_<?= $stat['statsid'] ?>').val();
      var min = $('#min_<?= $stat['statsid'] ?>').val();
      request = $.ajax({
        url: "stats_edit.php",
        method: "POST",
        data: {
          stat_id: stat_id,
          player_id: player_id,
          team_against_id: team_against_id,
          game_id: game_id,
          dpm: dpm,
          dpa: dpa,
          tpm: tpm,
          tpa: tpa,
          ftm: ftm,
          fta: fta,
          assists: assists,
          drebounds: drebounds,
          orebounds: orebounds,
          steals: steals,
          blocks: blocks,
          fouls: fouls,
          turnovers: turnovers,
          min: min
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
</script>
