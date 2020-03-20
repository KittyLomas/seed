<?php
    require 'scripts/server.php';
    $db = new MySQLDatabase();
    $db->connect();

    // Retrive session variables and store
    $name = $_SESSION["name"];
    $email = $_SESSION["email"];
    $pass = $_SESSION["pass"];

    // Retrieve currency and total and store
    $query = "SELECT * FROM USER WHERE Email='$email'";
    $result = $db->query($query);
    $array = mysqli_fetch_array($result);
    $frequency = $array['Frequency'];
    $total = $array['Total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--To ensure proper rendering and touch zooming, include viewport meta tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type = "text/css" href = "styles/styleall.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Profile Page</title>
</head>

<body id="profile">
    
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
            <a class="nav-link" href="progress.php">Progress <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
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

    <div id="pageContainer">
        <div id="profileContent">
            <div id="userDetails"> 
                <!-- Display information from the database (values have been fetched from database above and stored) -->
                <h2> Welcome <?php echo $name ?>! </h2>
                <h3> Email: <?php echo $email ?> </h3>
                <h3> Frequency: <?php echo $frequency ?> </h3>
                <h3> Total: <?php echo $total ?> </h3>
                <a href="scripts/server.php?logout">Logout</a>
            </div>
            
            <!--Form for users to deposit cash to their SEED account
                Action of the form is the name and path of the current file
            -->
            <div id="updateSavings">
                <form id="updateTotal" action="scripts/deposit.php" onsubmit="return deposit()" method="POST">
                    <div>
                        <h2> Update my Account </h2>
                        <p> To deposit money in your account, simply enter the amount. To withdraw, enter the negative amount.
                        <label for="deposit">Update my savings by: </label>
                        <input id="deposit" name="deposit" class="form-control" type="number" placeholder="e.g., 400" required>
                        <input id="log" name="log" value="" type="hidden">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-dark" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="sideImage">
           <img src="images/houses.svg"/>
        </div>

    </div>

    <div>
        <button class="btn btn-outline-secondary" onclick=link_page()>I'd like to link to a partner</button>
        <script>
            function link_page() {
                window.location = "link.php";
            }
        </script>
    </div>

    <div>
        <a href="scripts/server.php?logout" class="badge badge-secondary">Logout</a>
    </div>
</body>
</html>


<script>
    function deposit() {
        setTimeout(refresh(), 20);
        document.getElementsbyName("deposit").value = NULL;
        return true;
    }

    function refresh() {
        window.location.reload();
    }
    // Gets current date/time for deposit logging
    const date = new Date();
    var day = (("0" + date.getDate()).substr(-2));
    var month = ("0" + (date.getMonth() + 1)).substr(-2);
    var hours = date.getHours();
    var minutes = (("0" + date.getMinutes()).substr(-2));
    var dateLog = date.getFullYear() + "-" + month + "-" + day + "T" + hours + ":" + minutes + "Z";
    document.getElementById('log').value = dateLog;
</script>

<!--Include these links to ensure Bootstrap can function -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

