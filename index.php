<?php

use Classes\Errors;

require 'Classes\Errors.php';

require_once 'navbar.php';
require_once 'connect.php'; ?>
<?php
$countSlideGames = 1;
try {
  $games = $Game->getCarousel();
} catch (Exception $e) {
  Errors::solveError($e);
}
?>

<div class="parallax-container">
  <div class="parallax"><img src="images/image1.jpg" /></div>
</div>
<div class="jumbotron jumbotron-fluid bg-dark text-white" id="jumbotron-index">
  <h1 class="display-4">National Prospects League</h1>
  <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos, dolor. Ratione, repudiandae fugit totam facere minus iure voluptates repellat suscipit molestias deserunt quis amet labore. Officia explicabo rerum itaque deleniti.</p>
  <a class="btn btn-outline-light" href="learn.php" role="button">Learn more</a>
</div>
<div class="parallax-container">
  <div class="parallax"><img src="images/image2.jpg"></div>
</div>
<div class="jumbotron jumbotron-fluid bg-dark text-white">
  <h1 class="display-4">National Prospects League</h1>
  <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos, dolor. Ratione, repudiandae fugit totam facere minus iure voluptates repellat suscipit molestias deserunt quis amet labore. Officia explicabo rerum itaque deleniti.</p>
  <a class="btn btn-outline-light" href="learn.php" role="button">Learn more</a>
</div>

<div class="bd-example" style="margin-top: 5%;">
  <div id="carouselGames" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselGames" data-slide-to="0" class="active"></li>
      <?php foreach ($games as $game) : ?>
        <li data-target="#carouselGames" data-slide-to="<?= $countSlideGames ?>"></li>
      <?php $countSlideGames++;
      endforeach; ?>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/image1.jpg" class="d-block w-100 h-100 image-carousel" alt="Basketball">
        <div class="carousel-caption d-none d-md-block">
          <h3>Recent Games</h3>
        </div>
      </div>
      <?php foreach ($games as $game) : ?>
        <div class="carousel-item">
          <img src="images/image<?= rand(3, 10) ?>.jpg" class="d-block w-100" alt="<?= $game['home_team'] ?> x <?= $game['away_team'] ?>">
          <div class="carousel-caption d-none d-md-block">
            <h3><?= $game['home_team'] . " " . $game['home_score'] . " x " . $game['away_team'] . " " . $game['away_score'] . ", " . $game['date']  ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
      <a class="carousel-control-prev" href="#carouselGames" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselGames" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('.parallax').parallax();
    });
  </script>

  <?php require_once 'footer.php'; ?>
