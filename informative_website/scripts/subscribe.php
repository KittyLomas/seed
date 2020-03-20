<?php
require 'connectDatabase.php';

/* The following will only run if the form has been completed. */
$db = new MySQLDatabase();
$db->connect();

$name = $_POST["name"];
$email = $_POST["email"];
$age = $_POST["age"];
$first = $_POST["first"];

/* Store the current timestamp as log. */
$log = date("Ymd");

$query = "SELECT * FROM LIST WHERE Email='$email'";
$result = $db->query($query);
/* Checks to see if email already exists within the database*/
if($row = mysqli_fetch_array($result)) {
    if($email == $row['Email']) {
        echo "<script>alert('This user has already subscribed!');</script>"; 
        echo "<script>window.location='../index.html';</script>";
    } else {
        $sql = "INSERT INTO LIST (Name,Email,Log,Age,First) VALUES ('$name','$email','$log','$age','$first')";
        $insert = $db->query($sql);
        echo "<script>alert('Thanks for subscribing!');</script>";
        echo "<script>window.location='../index.html';</script>";
    }
} else {
    $sql = "INSERT INTO LIST (Name,Email,Log,Age,First) VALUES ('$name','$email','$log','$age','$first')";
    $insert = $db->query($sql);
    echo "<script>alert('Thanks for subscribing!');</script>";
    echo "<script>window.location='../index.html';</script>";
}
$db->disconnect();
?>