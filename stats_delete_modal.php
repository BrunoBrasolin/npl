<div id="stat_delete_<?= $stat['statsid'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Are you Sure?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <button type="submit" class="btn btn-danger" id="delete_stat_<?= $stat['statsid'] ?>" value="delete">Yes</button>
        <button type="submit" class="btn btn-success" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#delete_stat_<?= $stat['statsid'] ?>').click(function() {
    <?php if (isset($_SESSION)) : ?>
      var stat_id = <?= $stat['statsid'] ?>;
      request = $.ajax({
        url: "stats_delete.php",
        method: "POST",
        data: {
          stat_id: stat_id
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
