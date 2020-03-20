<?php
require 'connectDatabase.php';

session_start();
$db = new MySQLDatabase();
$db->connect();

// Retrive session variables and store
$name = $_SESSION["name"];
$email = $_SESSION["email"];
$pass = $_SESSION["pass"];

// Query to select all fields from table USER for this user  
$query = "SELECT * FROM USER WHERE Email='$email'";
// Send query 
$result = $db->query($query);

// Fetch resulting row as an array that can be used, store in $thisEntry
$thisEntry = mysqli_fetch_array($result);

// Store frequency, target and total from the database 
$frequency = $thisEntry['Frequency'];
$target = $thisEntry['Goal'];
$total = $thisEntry['Total'];


// Store deposit amount from form input
$deposited = $_POST["deposit"];
$log = $_POST["log"];
if (is_null($total)) {
    // Total is currently null. Set it to the deposited amount 
    $addDeposit = "UPDATE USER SET Total='$deposited' WHERE Email='$email'";
    $depositLog = "INSERT INTO DEPOSIT (Email, Log, Amount) VALUES ('$email', '$log', '$deposited')";
} else {
    // Total is not null. Add this entry to the running total
    $addDeposit = "UPDATE USER SET Total=Total+'$deposited' WHERE Email='$email'";
    $depositLog = "INSERT INTO DEPOSIT (Email, Log, Amount) VALUES ('$email', '$log', '$deposited')";
}
$db->query($addDeposit);
$db->query($depositLog);
header("Location: ../profile.php");

$db->disconnect();
?>