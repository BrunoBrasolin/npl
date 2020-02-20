<div id="team_form_<?= $team['id'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit team</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="team_<?= $team['id'] ?>">Team Name</label>
          <input type="text" class="form-control" name="team_<?= $team['id'] ?>" id="team_<?= $team['id'] ?>" value="<?= $team['team'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="coach_<?= $team['id'] ?>">Coach Name</label>
          <input type="text" class="form-control" name="coach_<?= $team['id'] ?>" id="coach_<?= $team['id'] ?>" value="<?= $team['coach'] ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="arena_<?= $team['id'] ?>">Arena</label>
          <input type="text" class="form-control" name="arena_<?= $team['id'] ?>" id="arena_<?= $team['id'] ?>" value="<?= $team['arena'] ?>" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="edit_team_<?= $team['id'] ?>" value="edit">Edit Team</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#edit_team_<?= $team['id'] ?>').click(function() {
    <?php if (isset($_SESSION)) : ?>
      var team = $('#team_<?= $team['id'] ?>').val();
      var coach = $('#coach_<?= $team['id'] ?>').val();
      var arena = $('#arena_<?= $team['id'] ?>').val();
      var team_id = <?= $team['id'] ?>;
      request = $.ajax({
        url: "teams_edit.php",
        method: "POST",
        data: {
          team: team,
          coach: coach,
          arena: arena,
          team_id: team_id
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
