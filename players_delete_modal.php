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
<script>
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
</script>
