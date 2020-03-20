<?php
    require 'connectDatabase.php';
    session_start();
    if(isset($_POST["invite"])) {
        $db = new MySQLDatabase();
        $db->connect();

        $thisEmail = $_SESSION["email"];
        $theirEmail = $_POST["invite"];
        // Type depends on the message type
        // Type 100: User A sends link invite to User B
        $type = 100;

        // Check that theirEmail that is to be invited is a registered user
        $query = "SELECT * FROM USER WHERE Email = '$theirEmail'";
        $result = $db->query($query);
        if($fetch = mysqli_fetch_array($result)) {
            // Query to insert related values into MESSAGES Table
            $query = "INSERT INTO MESSAGES (Sender, Receiver, Type) VALUES ('$thisEmail', '$theirEmail', '$type')";
            // Sending query
            $db->query($query);
            echo "<script>window.location='../profile.php';</script>";
        } else {
            echo "<script>alert('That is not a registered account!');</script>";
            echo "<script>window.location='../profile.php';</script>";
        }
    }
    $db->disconnect();
?>