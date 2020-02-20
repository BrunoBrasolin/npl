<?php

use Classes\Errors;

require_once 'navbar.php';
require_once 'connect.php';
require_once 'alerts.php';

try {
  $categories = $Category->get();
} catch (Exception $e) {
  Errors::solveError($e);
}
?>
<h1 class="list_title">Manage Category</h1>
<div class="tables">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-dark">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Category</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category) : ?>
          <tr>
            <td><?= $category['id'] ?></td>
            <td><?= $category['category'] ?></td>
            <td><button data-toggle="modal" data-target="#category_form_<?= $category['id'] ?>" class="btn btn-primary">Edit</button></td>
            <td><button data-toggle="modal" data-target="#category_delete_<?= $category['id'] ?>" class="btn btn-danger">Delete</button></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
<?php
foreach ($categories as $category) :
  include 'category_edit_modal.php';
  include 'category_delete_modal.php';
endforeach; ?>

<script>
  $(document).ready(function() {
    var request;
    var toast_loading;
  });
</script>

<?php require_once 'footer.php' ?>
