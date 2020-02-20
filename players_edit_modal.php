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
            <option selected value="<?= $player['position_id'] ?>"><?= $player['position'] ?></option>
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
<script>
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
</script>
