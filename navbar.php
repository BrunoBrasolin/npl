<?php require_once 'header.php'; ?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <a class="navbar-brand" href="index.php"><i class="fas fa-basketball-ball"></i> NPL</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="players.php">Players</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="stats.php">Stats</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="games.php">Schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teams.php">Standings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="learn.php">Learn more</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if (!isset($_SESSION["user"])) { ?>
        <li class="nav-item">
          <a class="nav-link" href="login_form.php">Login</a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      <?php } ?>
      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0" action="players.php" method="get">
          <input class="form-control mr-sm-2" type="search" name="search" id="search" autocomplete="off" placeholder="Search Player" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
      </li>
    </ul>
  </div>
</nav>


<nav class="navbar text-dark bg-dark navbar-dark" id="sidebar">
  <button type="button" class="close" aria-label="Close">
    <span aria-hidden="true" id="closeNav">&times;</span><br>
  </button>
  <a class="navbar-brand" href="index.php"><i class="fas fa-basketball-ball"></i> NPL</a>
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="players.php">Players</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="stats.php">Stats</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="games.php">Schedule</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="teams.php">Standings</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="learn.php">Learn more</a>
    </li>
    <?php if (isset($_SESSION["status"]) && $_SESSION["status"] != 0) : ?>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin Dashboard</a>
      </li>
    <?php endif ?>
  </ul>
  <ul class="nav navbar-nav">
    <?php if (!isset($_SESSION["user"])) { ?>
      <li class="nav-item">
        <a class="nav-link" href="login_form.php">Login</a>
      </li>
    <?php } else { ?>
      <li class="nav-item">
        <a class="nav-link" href="account.php"><?= $_SESSION["name"] ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    <?php } ?>
    <li class="nav-item">
      <form class="form-inline my-2 my-lg-0" action="players.php" method="get">
        <input class="form-control mr-sm-2" type="search" name="search" id="search" autocomplete="off" placeholder="Search Player" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </li>
  </ul>
</nav>


<span id="openNav" href="#" style="left: 0;">&#9776;</span>
