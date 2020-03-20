<?php
  session_start();
  require 'scripts/connectDatabase.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Chart.JS links -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0-rc.1/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.js"></script>
    <!--To ensure proper rendering and touch zooming, include viewport meta tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/styleall.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Progress Page</title>
    <meta charset="utf-8">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.html"><img id="logo" src="images/navlogo.png" alt="logo"/> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="progress.php">Progress <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.html">Blog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="browse.php">Browse</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid" style="margin: 10px; padding-right: 30px">
      <div class="row">
        <div class="col" style="margin: 10px;">
          <div class="container">
            <h4> Overall Savings Progress </h4>
            <p> Seed automatically splits your overall savings target into quarter goals to help keep you motivated throughout your savings journey!</p>
          </div>
          <br>
          <canvas id="totalProgress"></canvas> 
        </div>
        <div class="col" style="margin: 10px;">
          <div class="container">
            <div class="row">
              <div class="col">
                <h4> Savings History </h4>
              </div>
              <div class="col text-right">
                <input id="check" type="checkbox" checked data-toggle="toggle" data-on="Recent" data-off="Historic" data-onstyle="success" data-offstyle="secondary" onchange="updateGraph()">
              </div>
            </div>
            <p> Recent savings view shows up to 5 recent deposits; historic savings shows all deposits with regard to the specified due date and goal amount. </p>
          </div>
          <br>
            <canvas style="display: none;" id="goalProgress"></canvas>
            <canvas id="goalProgress2"></canvas>
        </div>
      </div>
      
  </div>
    

 
</body>

<?php
  include 'scripts/goalCharts.php';
  include 'scripts/progressCharts.php';
?>

<!--Include these links to ensure Bootstrap can function -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Bootstrap Toggle links -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</html>