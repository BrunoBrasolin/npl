<?php

use Classes\Errors;

require_once 'navbar.php'; ?>
<?php require_once 'connect.php'; ?>
<?php
if (!isset($_GET["gameid"])) {
  $_SESSION['error'] = "Failed to get Box Score";
  header("Location: games.php");
}
$game_id = $_GET["gameid"];
try {
  $game = $Game->getId($game_id);
  $stats = $Game->getStat($game_id);
} catch (Exception $e) {
  Errors::solveError($e);
}
if (empty($game)) {
  $_SESSION['error'] = "Failed to get Box Score";
  header("Location: games.php");
}
?>
<div class="info">
  <h3><b>Box Score</h3>
  <hr>
  <h3><b>Teams:</b> <?= $game['home_team'] ?> x <?= $game['away_team'] ?></h3>
  <hr>
  <h3><b>Score:</b> <?= $game['home_score'] ?> x <?= $game['away_score'] ?></h3>
  <hr>
  <h3><b>Game Date:</b> <?= $game['date'] ?></h3>
  <?php if (isset($_SESSION["status"]) && $_SESSION["status"] != 0) : ?>
    <hr>
    <a class="btn btn-primary" href="games_form.php?gameid=<?= $game['gameid'] ?>">Edit</a></td>
    <hr>
    <form action="games_delete.php" method="post">
      <input type="hidden" name="game_id" value="<?= $game['gameid'] ?>">
      <button class="btn-danger">Delete</i></button>
    </form>
    <hr>
  <?php endif ?>
</div>

<div class="stat_player_intro">
  <h3><?= $game['home_team'] ?> Box Score:</h3>
  <div class="stat_player_nostat">
    <div class="tables">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-dark">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">MIN</th>
              <th scope="col">PTS</th>
              <th scope="col">FGM</th>
              <th scope="col">FGA</th>
              <th scope="col">FG%</th>
              <th scope="col">3PM</th>
              <th scope="col">3PA</th>
              <th scope="col">3P%</th>
              <th scope="col">FTM</th>
              <th scope="col">FTA</th>
              <th scope="col">FT%</th>
              <th scope="col">OREB</th>
              <th scope="col">DREB</th>
              <th scope="col">REB</th>
              <th scope="col">AST</th>
              <th scope="col">STL</th>
              <th scope="col">BLK</th>
              <th scope="col">TOV</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($stats)) {
              foreach ($stats as $stat) {
                $team = $Team->getId($stat['team_id']);
                if ($team['id'] == $game['home_team_id'] && $stat['game_id'] == $game['gameid']) {
                  $points = ($stat['3pm'] * 3) + ($stat['2pm'] * 2) + $stat['ftm'];
                  $rebounds = $stat['orebounds'] + $stat['drebounds'];
                  $fgm = $stat['2pm'] + $stat['3pm'];
                  $fga = $stat['2pa'] + $stat['3pa'];
                  $fg = ($fgm / $fga) * 100;
                  $tg = ($stat['3pm'] / $stat['3pa']) * 100;
                  $ft = ($stat['ftm'] / $stat['fta']) * 100;

                  ?>
                  <tr>
                    <th scope="row"><?= $stat['playerid'] ?></th>
                    <th scope="row"><a class="links" href="player_profile.php?player=<?= $stat['playerid'] ?>"><?= $stat['name'] ?></a></th>
                    <td><?= round($stat['min'], 2) ?></td>
                    <td><?= round($points, 2) ?></td>
                    <td><?= round($fgm, 2) ?></td>
                    <td><?= round($fga, 2) ?></td>
                    <td><?= round($fg, 2) ?></td>
                    <td><?= round($stat['3pm'], 2) ?></td>
                    <td><?= round($stat['3pa'], 2) ?></td>
                    <td><?= round($tg, 2) ?></td>
                    <td><?= round($stat['ftm'], 2) ?></td>
                    <td><?= round($stat['fta'], 2) ?></td>
                    <td><?= round($ft, 2) ?></td>
                    <td><?= round($stat['orebounds'], 2) ?></td>
                    <td><?= round($stat['drebounds'], 2) ?></td>
                    <td><?= round($rebounds, 2) ?></td>
                    <td><?= round($stat['assists'], 2) ?></td>
                    <td><?= round($stat['steals'], 2) ?></td>
                    <td><?= round($stat['blocks'], 2) ?></td>
                    <td><?= round($stat['turnovers'], 2) ?></td>
                    <?php if (isset($_SESSION) && $_SESSION["status"] != 0) : ?>
                      <td><a class="btn btn-primary" href="stats_form.php?statid=<?= $stat['statsid'] ?>">Edit</i></a></td>
                      <td>
                        <form action="stats_delete.php" method="post">
                          <input type="hidden" name="stats_id" value="<?= $stat['statsid'] ?>">
                          <button class="btn-danger">Delete</button>
                        </form>
                      </td>
                  <?php endif;
                      } ?>
                  </tr>
                <?php } ?>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="stat_player_intro">
  <h3><?= $game['away_team'] ?> Box Score:</h3>
  <div class="stat_player_nostat">
    <div class="tables">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-dark">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th title="Minutes" scope="col">MIN</th>
              <th title="Points" scope="col">PTS</th>
              <th title="Field Goals Made" scope="col">FGM</th>
              <th title="Field Goals Attempted" scope="col">FGA</th>
              <th title="Field Goals Percentage" scope="col">FG%</th>
              <th title="3 Points Made" scope="col">3PM</th>
              <th title="3 Points Attempted" scope="col">3PA</th>
              <th title="3 Points Percentage" scope="col">3P%</th>
              <th title="Free Throw Made" cope="col">FTM</th>
              <th title="Free Throw Attempted" scope="col">FTA</th>
              <th title="Free Throw Percentage" scope="col">FT%</th>
              <th title="Offensive Rebounds" scope="col">OREB</th>
              <th title="Defensive Rebounds" scope="col">DREB</th>
              <th title="Total Rebounds" scope="col">REB</th>
              <th title="Assists" scope="col">AST</th>
              <th title="Steals" scope="col">STL</th>
              <th title="Blocks" scope="col">BLK</th>
              <th title="Tournovers" scope="col">TOV</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($stats)) {
              foreach ($stats as $stat) {
                $team = $Team->getId($stat['team_id']);
                if ($team['id'] == $game['away_team_id'] && $stat['game_id'] == $game['gameid']) {
                  $points = ($stat['3pm'] * 3) + ($stat['2pm'] * 2) + $stat['ftm'];
                  $rebounds = $stat['orebounds'] + $stat['drebounds'];
                  $fgm = $stat['2pm'] + $stat['3pm'];
                  $fga = $stat['2pa'] + $stat['3pa'];
                  $fg = ($fgm / $fga) * 100;
                  $tg = ($stat['3pm'] / $stat['3pa']) * 100;
                  $ft = ($stat['ftm'] / $stat['fta']) * 100;

                  ?>
                  <tr>
                    <th scope="row"><?= $stat['playerid'] ?></th>
                    <th scope="row"><a class="links" href="player_profile.php?player=<?= $stat['playerid'] ?>"><?= $stat['name'] ?></a></th>
                    <td><?= round($stat['min'], 2) ?></td>
                    <td><?= round($points, 2) ?></td>
                    <td><?= round($fgm, 2) ?></td>
                    <td><?= round($fga, 2) ?></td>
                    <td><?= round($fg, 2) ?></td>
                    <td><?= round($stat['3pm'], 2) ?></td>
                    <td><?= round($stat['3pa'], 2) ?></td>
                    <td><?= round($tg, 2) ?></td>
                    <td><?= round($stat['ftm'], 2) ?></td>
                    <td><?= round($stat['fta'], 2) ?></td>
                    <td><?= round($ft, 2) ?></td>
                    <td><?= round($stat['orebounds'], 2) ?></td>
                    <td><?= round($stat['drebounds'], 2) ?></td>
                    <td><?= round($rebounds, 2) ?></td>
                    <td><?= round($stat['assists'], 2) ?></td>
                    <td><?= round($stat['steals'], 2) ?></td>
                    <td><?= round($stat['blocks'], 2) ?></td>
                    <td><?= round($stat['turnovers'], 2) ?></td>
                    <?php if (isset($_SESSION) && $_SESSION["status"] != 0) : ?>
                      <td><a class="btn btn-primary" href="stats_form.php?statid=<?= $stat['statsid'] ?>">Edit</i></a></td>
                      <td>
                        <form action="stats_delete.php" method="post">
                          <input type="hidden" name="stats_id" value="<?= $stat['statsid'] ?>">
                          <button class="btn-danger">Delete</button>
                        </form>
                      </td>
                  <?php endif;
                      } ?>
                  </tr>
                <?php } ?>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>
