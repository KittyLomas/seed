<!--
    This code file uses the following sources:
    1. Connect mySQL database - INFS3202 Semester 1 2019 provided code; Associate Professor Helen Huang
    This snippet gives functions to connect, query and disconnect the seed database that is used in the application
-->
<!-- (1. Connect mySQL database) -->
<?php
class mySQLDatabase {

    private $link = null;
    private $dbhost = 'stablesquad.zones.eait.uq.edu.au';
    private $dbuser = 'root';
    private $dbpassword = 'stablesquad19';
    private $db = 'SEED';

    // Allows connections to the database
    function connect() {
        $this->link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpassword);
        if(!$this->link) {
            die('Not connected : ' . mysqli_connect_error());
        }
        $database = mysqli_select_db($this->link, $this->db);
        if(!$database){
            die ('Cannot use : ' . $this->db);
        }
    }

    // Allows queries to be performed on the database
    function query($query) {
        $result = mysqli_query($this->link, $query);
        if($result) {
            return $result;
        }
        else {
            die(mysqli_error($this->link));
        }
        return null;
    }

    // Allows disconnection from the database
    function disconnect() {
        mysqli_close($this->link);
    }
}
?>
<!-- End of (1) -->