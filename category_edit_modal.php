<div id="category_form_<?= $category['id'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="category">Category</label>
          <input type="text" class="form-control" name="category_<?= $category['id'] ?>" id="category_<?= $category['id'] ?>" value="<?= $category['category'] ?>" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="edit_category_<?= $category['id'] ?>" value="edit">Edit Category</button>
      </div>
    </div>
  </div>
</div>
<script>
  $('#edit_category_<?= $category['id'] ?>').click(function() {
    <?php if (isset($_SESSION)) : ?>
      var category = $('#category_<?= $category['id'] ?>').val();
      var category_id = <?= $category['id'] ?>;
      request = $.ajax({
        url: "category_edit.php",
        method: "POST",
        data: {
          category: category,
          category_id: category_id
        },
        beforeSend: function() {
          toast_loading = M.toast({
            html: 'Loading...',
            classes: 'rounded bg-primary'
          });
        },
        success: function(data) {
          if (data == "23000") {
            M.toast({
              html: 'Failed to Add<br>Duplicate Entery',
              classes: 'bg-danger'
            });
          } else {
            M.toast({
              html: 'Edit Succefully',
              classes: 'bg-success',
              displayLength: 1000,
              completeCallback: function() {
                location.reload()
              }
            });
            setTimeout(location.reload.bind(location), 60000);
          }
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
