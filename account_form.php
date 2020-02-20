<?php require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php require_once 'alerts.php'; ?>

<form action="account_add.php" method="post" class="forms">
  <h1 class="list_title">Create an Account</h1>

  <input type="hidden" name="accountid" id="accountid">

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username" autocomplete="off">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" autocomplete="off">
  </div>

  <div class="form-group">
    <label for="password">Confirm your Password</label>
    <input type="password" class="form-control" name="password" id="password" autocomplete="off">
  </div>

  <button type="submit" class="btn btn-outline-dark" value="add">Create Account</button>
</form>

<?php require_once 'footer.php'; ?>
