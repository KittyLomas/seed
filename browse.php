<?php
require 'scripts/map.php';
require 'scripts/slider.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>Browse Properties</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link href="styles/styleall.css" type="text/css" rel="stylesheet" />
  <link href="styles/map.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
  <script src="scripts/jquery.ui.touch-punch.min.js"></script>
</head>

<body style="background-color: #030035;">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.html"><img id="logo" src="images/navlogo.png" alt="logo"/> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="progress.php">Progress <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.html">Blog</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="browse.php">Browse</a>
        </li>
        </ul>
      </div>
    </nav>
  <div id="browseContent">
    <div id="map"></div>
      <div id="sliderContent">
        <form name="slider" method="POST" action="browse.php">
          <div class="row">
            <div class="col" style="margin-top: 5px">
              <p>
                <label for="amount">Deposit Range:</label>
                <input type="text" id="amount">
              </p>
            </div>
            <div class="col-2" style="margin: 5px;">
              <button type="submit" class="btn btn-info btn-block">Filter</button>
            </div>
          </div>
          <div>
          <input type="hidden" id="min" name="minPrice" value=<?php echo $min; ?>>
            <div id="slider-range" style="margin-top: 4px;"></div>
            <input type="hidden" id="max" name="maxPrice" value=<?php echo $max; ?>>
          </div>
        </form>
      </div>
    </div>


</body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZYexXtXkAArwZj7jY49ARJU0ldw2Qe2E&callback=initMap" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>