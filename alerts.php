<?php
if (isset($_SESSION['add']) && $_SESSION['add'] == true) :
  ?>
  <div class="alert alert-success" role="alert">
    Added Successfully
  </div>
<?php
endif;
if (isset($_SESSION['add']) && $_SESSION['add'] == false) :
  ?>
  <div class="alert alert-danger" role="alert">
    Failed to Add!
  </div>
<?php
endif;
if (isset($_SESSION['remove']) && $_SESSION['remove'] == true) :
  ?>
  <div class="alert alert-danger" role="alert">
    Removed Successfully
  </div>
<?php
endif;
if (isset($_SESSION['remove']) && $_SESSION['remove'] == false) :
  ?>
  <div class="alert alert-danger" role="alert">
    Failed to remove!
  </div>
<?php
endif;
if (isset($_SESSION['edit']) && $_SESSION['edit'] == true) :
  ?>
  <div class="alert alert-success" role="alert">
    Edited Successfully
  </div>
<?php
endif;
if (isset($_SESSION['edit']) && $_SESSION['edit'] == false) :
  ?>
  <div class="alert alert-danger" role="alert">
    Failed to Edit!
  </div>
<?php
endif;
if (isset($_SESSION['error'])) :
  ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $_SESSION['error']; ?>
  </div>
<?php
endif;
if (isset($_SESSION['success'])) :
  ?>
  <div class="alert alert-success" role="alert">
    <?php echo $_SESSION['success']; ?>
  </div>
<?php
endif;
unset($_SESSION['add']);
unset($_SESSION['remove']);
unset($_SESSION['edit']);
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
