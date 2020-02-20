<?php require_once 'navbar.php'; ?>
<?php require_once 'alerts.php'; ?>

<form action="login.php" method="POST" class="forms">
  <h1 class="list_title">Log In</h1>
  <br>
  <input type="text" class="form-control" name="user" id="user" placeholder="Type your username" autocomplete="off"><br>
  <input type="password" class="form-control" name="pass" id="pass" placeholder="Type your password" autocomplete="off"><br>
  <input type="checkbox" onclick="showPass();" id="checkbox" name="checkbox">
  <label for="checkbox">Show Password</label>
  <br>
  <button class="btn btn-outline-dark" type="submit" value="Login">Log In</button>
</form>

<script>
  function showPass() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>

<?php require_once 'footer.php'; ?>
