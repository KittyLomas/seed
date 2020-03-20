<?php
  session_start();
  require 'scripts/connectDatabase.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--To ensure proper rendering and touch zooming, include viewport meta tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/styleall.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Link Your Account</title>
    <meta charset="utf-8">
</head>

<body>

  <!--Navigational bar using Bootstrap-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.html"><img id="logo" src="images/navlogo.png" alt="logo"/> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--Navigational bar is responsive. This is for mobile view-->
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

  <div class="container" style="margin: 10px;">
      <div class="row">
        <div class="col-lg" style="margin: 10px;">
          <p class="text-center"> Link Your Account! </p>
            <br>
            <p class="text-center">
            Do you have someone you want to purchase a house with? Well you're in luck because SEED fully supports
            your dream of purchasing that dream home with your special someone. Both you and your partner will be
            able to see each other's contributions along with your own, and you'll also be able to see when those
            deposits were made, pretty nifty huh? Saving with a partner has never been so easy!
            </p>
        </div>
        <div>
            <p>Here's How</p>
            <br>
            <p class="text-center">
                Step 1: Ensure that your partner has an existing account with us.
                
                Step 2: Who ever sends the invite link will be the goal that will be set, don't worry this can be
                changed later.

                Step 3: Submit the email of the account you'd like to link to.

                Once the person you'd like to link with has accepted your invitation, you should now be able to see
                their contributions as well.
            </p>
            <br>
            <div id="disappear" class="text-center">
                <form name="link" id="link" action="scripts/invite.php" method="POST">
                    <input id="linking" name="linking" type="text" placeholder="Registered email.." required>
                    <button type="submit">Link!</button>
                </form>
            </div>
        </div>
        
      </div>
      
  </div>
    

 
</body>

<!--Include these links to ensure Bootstrap can function -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Bootstrap Toggle links -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</html>