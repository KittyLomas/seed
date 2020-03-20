<?php
    require 'scripts/connectDatabase.php';

    session_start();
    $db = new MySQLDatabase();
    $db->connect();

    // Retrive inputs from form submission and store in variables
    $target = $_POST['target'];
    $frequency = $_POST['freq'];
    $due = $_POST['due'];
    // saving date in chart-appropriate format
    list($year, $month, $day) = explode('-', $due);
    $due = $year.'-'.$month.'-'.$day.'T00:00Z';
    $myemail = $_SESSION["email"];

    /* Adding additional variables as SESSION variables.
    $_SESSION["target"] = $_POST['target'];
    $_SESSION["freq"] = $_POST['freq'];
    $_SESSION["due"] = $_POST['due'];
    */

    // Set the goal, target and frequency for this current user
    $addGoals = "UPDATE USER SET Goal='$target', Due='$due', Frequency='$frequency' WHERE Email='$myemail'";
    // Send query
    $db->query($addGoals);

    // Direct to profile page
    header("Location: profile.php");
    $db->disconnect();
?>
