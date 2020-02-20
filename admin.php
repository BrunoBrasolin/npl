<?php

use Classes\Errors;

require_once 'navbar.php';
require_once 'connect.php';
require_once 'alerts.php';
try {
  $category = $Category->get();
  $games = $Game->get();
  $players = $Player->get();
  $teams = $Team->get();
} catch (Exception $e) {
  Errors::solveError($e);
}
?>

<div class="info">
  <h3>Manage</h3>
  <ul class="list-group">
    <a href="category_list.php" class="list-group-item list-group-item-dark list-group-item-action">Category</a>
  </ul>
</div>

<div class="info">
  <h3>Add</h3>
  <ul class="list-group">
    <button data-toggle="modal" data-target="#player_form" class="list-group-item list-group-item-dark list-group-item-action">Player</button>
    <button data-toggle="modal" data-target="#stat_form" class="list-group-item list-group-item-dark list-group-item-action">Stat</button>
    <button data-toggle="modal" data-target="#game_form" class="list-group-item list-group-item-dark list-group-item-action">Game</button>
    <button data-toggle="modal" data-target="#team_form" class="list-group-item list-group-item-dark list-group-item-action">Team</button>
    <button data-toggle="modal" data-target="#category_form" class="list-group-item list-group-item-dark list-group-item-action">Category</button>
  </ul>
</div>

<div id="player_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Player</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Bruno Brasolin" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="height">Height</label>
          <input type="text" class="form-control" name="height" id="height" placeholder="1,75" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="number">Number</label>
          <input type="number" class="form-control" name="number" id="number" min="0" max="99" placeholder="9" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="team_id">Team</label>
          <select class="form-control" id="team_id" name="team_id">
            <option selected disabled>Choose One</option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="position">Position</label>
          <select class="form-control" id="position" name="position">
            <option selected disabled>Choose One</option>
            <option value="1">Point Guard</option>
            <option value="2">Shooting Guard</option>
            <option value="3">Small Forward</option>
            <option value="4">Power Forward</option>
            <option value="5">Center</option>
          </select>
        </div>
        <div class="form-group">
          <label for="category_id">Category</label>
          <select class="form-control" id="category_id" name="category_id">
            <option selected disabled>Choose One</option>
            <?php foreach ($category as $category1) : ?>
              <option value="<?= $category1['id'] ?>"> <?= $category1['category'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="year">Year</label>
          <input type="number" class="form-control" name="year" id="year" placeholder="2001" value="<?= $year ?>" autocomplete="off">
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sex_male" name="sex" class="custom-control-input" value="1">
          <label class="custom-control-label" for="sex_male">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sex_female" name="sex" class="custom-control-input" value="2">
          <label class="custom-control-label" for="sex_female">Female</label>
        </div>
        <br>
        <button type="submit" class="btn btn-outline-dark" id="add_player" value="add">Add Player</button>
      </div>
    </div>
  </div>
</div>

<div id="stat_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Stat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="player_id">Player</label>
          <select class="form-control" id="player_id" name="player_id">
            <option selected disabled>Choose One</option>
            <?php foreach ($players as $player) : ?>
              <option value="<?= $player['playerid'] ?>"> <?= $player['name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="team_against_id">Team Against</label>
          <select class="form-control" id="team_against_id" name="team_against_id">
            <option selected disabled>Choose One</option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="game_id">Game</label>
          <select class="form-control" id="game_id" name="game_id">
            <option selected disabled>Choose One</option>
            <?php foreach ($games as $game) : ?>
              <option value="<?= $game['gameid'] ?>"> <?= $game['home_team'] ?> x <?= $game['away_team'] ?>, <?= $game['date'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="2pm">2 Points Made</label>
          <input type="number" class="form-control" name="2pm" id="2pm" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="2pa">2 Points Attempt</label>
          <input type="number" class="form-control" name="2pa" id="2pa" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="3pm">3 Points Made</label>
          <input type="number" class="form-control" name="3pm" id="3pm" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="3pa">3 Points Attempt</label>
          <input type="number" class="form-control" name="3pa" id="3pa" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="ftm">Free Throw Made</label>
          <input type="number" class="form-control" name="ftm" id="ftm" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="fta">Free Throw Attempt</label>
          <input type="number" class="form-control" name="fta" id="fta" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="assists">Assists</label>
          <input type="number" class="form-control" name="assists" id="assists" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="drebounds">Defensive Rebounds</label>
          <input type="number" class="form-control" name="drebounds" id="drebounds" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="orebounds">Ofensive Rebounds</label>
          <input type="number" class="form-control" name="orebounds" id="orebounds" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="steals">Steals</label>
          <input type="number" class="form-control" name="steals" id="steals" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="blocks">Blocks</label>
          <input type="number" class="form-control" name="blocks" id="blocks" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="fouls">Fouls</label>
          <input type="number" class="form-control" name="fouls" id="fouls" min="0" max="5" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="turnovers">Turnovers</label>
          <input type="number" class="form-control" name="turnovers" id="turnovers" min="0" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="min">Minutes Played</label>
          <input type="number" class="form-control" name="min" id="min" min="0" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="add_stat" value="add">Add Stat</button>
      </div>
    </div>
  </div>
</div>

<div id="game_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Game</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="hometeamid">Home Team</label>
          <select class="form-control" id="home_team_id" name="home_team_id">
            <option selected disabled>Choose One</option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="awayteamid">Away Team</label>
          <select class="form-control" id="away_team_id" name="away_team_id">
            <option selected disabled>Choose One</option>
            <?php foreach ($teams as $team) : ?>
              <option value="<?= $team['id'] ?>"> <?= $team['team'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="homescore">Home Team Score</label>
          <input type="number" class="form-control" name="home_score" id="home_score" min="0" placeholder="100" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="awayscore">Away Team Score</label>
          <input type="number" class="form-control" name="away_score" id="away_score" min="0" placeholder="99" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="date">Game Date</label>
          <input type="date" class="form-control" name="date" id="date" placeholder="2018-24-05" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="add_game" value="add">Add Game</button>
      </div>
    </div>
  </div>
</div>

<div id="team_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Team</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="team">Team Name</label>
          <input type="text" class="form-control" name="team" id="team" placeholder="Team Name" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="coach">Coach Name</label>
          <input type="text" class="form-control" name="coach" id="coach" placeholder="Coach" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="arena">Arena</label>
          <input type="text" class="form-control" name="arena" id="arena" placeholder="Arena" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="add_team" value="add">Add Team</button>
      </div>
    </div>
  </div>
</div>

<div id="category_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body forms">
        <div class="form-group">
          <label for="category">Category</label>
          <input type="text" class="form-control" name="category" id="category" placeholder="U19" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-outline-dark" id="add_category" value="add">Add Category</button>
      </div>
    </div>
  </div>
</div>

<div id="loading" class="modal fade">
  <div class="spinner-border text-dark" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>

<script>
  $(document).ready(function() {
    var request;
    var toast_loading;

    $('#add_player').click(function() {
      var name = $('#name').val();
      var height = $('#height').val();
      var team_id = $('#team_id').val();
      var number = $('#number').val();
      var position = $('#position').val();
      var category_id = $('#category_id').val();
      var year = $('#year').val();
      var sex = $("[name='sex']:checked").val();
      request = $.ajax({
        url: "players_add.php",
        method: "POST",
        data: {
          name: name,
          height: height,
          team_id: team_id,
          number: number,
          position: position,
          category_id: category_id,
          year: year,
          sex: sex
        },
        beforeSend: function() {
          toast_loading = M.toast({
            html: 'Loading...',
            classes: 'rounded bg-primary'
          });
        },
        success: function(data) {
          if (data == "HY000") {
            M.toast({
              html: 'Failed to Add',
              classes: 'bg-danger'
            });
          } else if (data == "23000") {
            M.toast({
              html: 'Failed to Add<br>Duplicate Entery',
              classes: 'bg-danger'
            });
          } else {
            M.toast({
              html: 'Added Succefully',
              classes: 'bg-success'
            });
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
    });

    $('#add_stat').click(function() {
      var player_id = $('#player_id').val();
      var team_against_id = $('#team_against_id').val();
      var game_id = $('#game_id').val();
      var dpm = $('#2pm').val();
      var dpa = $('#2pa').val();
      var tpm = $('#3pm').val();
      var tpa = $('#3pa').val();
      var ftm = $('#ftm').val();
      var fta = $('#fta').val();
      var assists = $('#assists').val();
      var drebounds = $('#drebounds').val();
      var orebounds = $('#orebounds').val();
      var steals = $('#steals').val();
      var blocks = $('#blocks').val();
      var fouls = $('#fouls').val();
      var turnovers = $('#turnovers').val();
      var min = $('#min').val();
      if (dpm < 0 || dpa < 0 || tpm < 0 || tpa < 0 || ftm < 0 || fta < 0 || assists < 0 || drebounds < 0 || orebounds < 0 || steals < 0 || blocks < 0 || fouls < 0 || fouls > 5 || min < 0 || turnovers < 0) {
        M.toast({
          html: 'Failed to Add<br>Invalid Numbers',
          classes: 'bg-danger'
        });
      } else {
        request = $.ajax({
          url: "stats_add.php",
          method: "POST",
          data: {
            player_id: player_id,
            team_against_id: team_against_id,
            game_id: game_id,
            dpm: dpm,
            dpa: dpa,
            tpm: tpm,
            tpa: tpa,
            ftm: ftm,
            fta: fta,
            assists: assists,
            drebounds: drebounds,
            orebounds: orebounds,
            steals: steals,
            blocks: blocks,
            fouls: fouls,
            turnovers: turnovers,
            min: min
          },
          beforeSend: function() {
            toast_loading = M.toast({
              html: 'Loading...',
              classes: 'rounded bg-primary'
            });
          },
          success: function(data) {
            if (data == "HY000") {
              M.toast({
                html: 'Failed to Add',
                classes: 'bg-danger'
              });
            } else if (data == "23000") {
              M.toast({
                html: 'Failed to Add<br>Duplicate Entery',
                classes: 'bg-danger'
              });
            } else {
              M.toast({
                html: 'Added Succefully',
                classes: 'bg-success'
              });
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
      }
    });

    $('#add_game').click(function() {
      var home_team_id = $('#home_team_id').val();
      var away_team_id = $('#away_team_id').val();
      var home_score = $('#home_score').val();
      var away_score = $('#away_score').val();
      var date = $('#date').val();
      request = $.ajax({
        url: "games_add.php",
        method: "POST",
        data: {
          home_team_id: home_team_id,
          away_team_id: away_team_id,
          home_score: home_score,
          away_score: away_score,
          date: date
        },
        beforeSend: function() {
          toast_loading = M.toast({
            html: 'Loading...',
            classes: 'rounded bg-primary'
          });
        },
        success: function(data) {
          if (data == "HY000") {
            M.toast({
              html: 'Failed to Add',
              classes: 'bg-danger'
            });
          } else if (data == "23000") {
            M.toast({
              html: 'Failed to Add<br>Duplicate Entery',
              classes: 'bg-danger'
            });
          } else {
            M.toast({
              html: 'Added Succefully',
              classes: 'bg-success'
            });
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
    });

    $('#add_team').click(function() {
      var team = $('#team').val();
      var coach = $('#coach').val();
      var arena = $('#arena').val();
      request = $.ajax({
        url: "teams_add.php",
        method: "POST",
        data: {
          team: team,
          coach: coach,
          arena: arena
        },
        beforeSend: function() {
          toast_loading = M.toast({
            html: 'Loading...',
            classes: 'rounded bg-primary'
          });
        },
        success: function(data) {
          if (data == "HY000") {
            M.toast({
              html: 'Failed to Add',
              classes: 'bg-danger'
            });
          } else if (data == "23000") {
            M.toast({
              html: 'Failed to Add<br>Duplicate Entery',
              classes: 'bg-danger'
            });
          } else {
            M.toast({
              html: 'Added Succefully',
              classes: 'bg-success'
            });
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
    });

    $('#add_category').click(function() {
      var category = $('#category').val();
      request = $.ajax({
        url: "category_add.php",
        method: "POST",
        data: {
          category: category
        },
        beforeSend: function() {
          toast_loading = M.toast({
            html: 'Loading...',
            classes: 'rounded bg-primary'
          });
        },
        success: function(data) {
          if (data == "HY000") {
            M.toast({
              html: 'Failed to Add',
              classes: 'bg-danger'
            });
          } else if (data == "23000") {
            M.toast({
              html: 'Failed to Add<br>Duplicate Entery',
              classes: 'bg-danger'
            });
          } else {
            M.toast({
              html: 'Added Succefully',
              classes: 'bg-success'
            });
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
    });
  });
</script>

<?php require_once 'footer.php'; ?>
