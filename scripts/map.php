<!-- 
  The code file has been adapted from the following sources:
  1. Google Maps API Simple Map - https://developers.google.com/maps/documentation/javascript/examples/map-simple
  The 'initMap' function loads a new Google Map element that centres on Brisbane
  2. InfoWindow Open Check - https://stackoverflow.com/questions/12410062/check-if-infowindow-is-opened-google-maps-v3
  The 'isInfoWindowOpen' function checks if an infoWindow is currently open. This is used to change the visual icons and provide feedback on click.
  3. Multiple Map Markers from Database - https://stackoverflow.com/questions/42084186/adding-multiple-markers-on-google-maps-from-mysql-database
  This source was used to help load markers based on database info and then fill respective markers with infowindow information.
-->
<?php
    require 'scripts/connectDatabase.php';
    session_start();
?>
<script>
var map;
// (1. Google Maps API Simple Map)
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: { lat: -27.446800, lng: 153.022960 } // centres on Brisbane
    });
    // End of (1)

    // Icons for map -> icon 1: unselected, icon 2: selected
    var icon = "images/icon-house_resized.png";
    var icon2 = "images/icon-house2_resized.png";

    // (2. InfoWindow Open Check) Checks whether or not a infoWindow is open
    function isInfoWindowOpen(infoWindow) {
        var map = infoWindow.getMap();
        return (map !== null && typeof map !== "undefined");
    }
    // End of (2)

    // Converts integer to dollar formatting
    function depositToDollars(deposit) {
        if (deposit.toString().length == 5) {
            return '$' + deposit.toString().substr(0,2) + ',' + deposit.toString().substr(-3);
        } else {
            return '$' + deposit.toString().substr(0,3) + ',' + deposit.toString().substr(-3);
        }
    }

    // (3. Multiple Map Markers from Database) Pulling mapdata from database
    <?php

    // If filter values have been set
    if (isset($_POST["minPrice"]) && isset($_POST["maxPrice"])) {
        // creating session variables for slider to use on page reload
        $_SESSION["minPrice"] = $_POST["minPrice"];
        $_SESSION["maxPrice"] = $_POST["maxPrice"];
        $db = new MySQLDatabase();
        $db->connect();
        $minprice = $_POST["minPrice"];
        $maxprice = $_POST["maxPrice"];

        // query database between min and max price from slider
        $query = "SELECT * FROM mapdata WHERE deposit BETWEEN " .intval($minprice)  ." AND " .intval($maxprice);
        $select = $db->query($query);
        foreach ($select as $key) {
            $entry[] = array('address' => $key['address'], 'lat' => $key['lat'], 'lng' => $key['lng'], 'bed' => $key['bed'], 'bath' => $key['bath'], 'car' => $key['car'], 'sqmetres' => $key['sqmetres'], 'deposit' => $key['deposit'], 'image' => $key['image']);
        }
        
        $markers = json_encode($entry);

        $db->disconnect();

        echo "var databaseInfo=$markers;\n";

        // If filter values have not been set
        } else {
        $db = new MySQLDatabase();
        $db->connect();

        $query = "SELECT * FROM mapdata";
        $select = $db->query($query);
        foreach ($select as $key) {
            $entry[] = array('address' => $key['address'], 'lat' => $key['lat'], 'lng' => $key['lng'], 'bed' => $key['bed'], 'bath' => $key['bath'], 'car' => $key['car'], 'sqmetres' => $key['sqmetres'], 'deposit' => $key['deposit'], 'image' => $key['image']);
        }
        
        $markers = json_encode($entry);

        $db->disconnect();

        echo "var databaseInfo=$markers;\n";
        }
        // End of (3)
    ?>

    // Changes marker icon when clicking a specific marker
    function addMarkerListener(markers, j) {
        markers[j].addListener('click', function () {
            if (isInfoWindowOpen(infowindow)) {
                markers[j].setIcon(icon2);
            } else {
                markers[j].setIcon(icon);
            }
        });
    }

    var infowindow = new google.maps.InfoWindow();
    var markers = [];
    var marker;
    var j = 0;

    // Loops through databaseInfo and creates markers respectively
    for (var i in databaseInfo) {

        // creating variables from json object
        var lat = databaseInfo[i].lat;
        var lng = databaseInfo[i].lng;
        var address = databaseInfo[i].address;
        var bed = databaseInfo[i].bed;
        var bath = databaseInfo[i].bath;
        var car = databaseInfo[i].car;
        var sqmetres = databaseInfo[i].sqmetres
        var deposit = databaseInfo[i].deposit;
        deposit = depositToDollars(deposit);
        var image = databaseInfo[i].image;

        // Content and formatting for info window content
        var contentString = '<div id="content">' +
        '<div class="row">' +
        '<div class="col">' +
        '</br>' + 
        '<h1 class="text-center" id="firstHeading">' + address + '</h1>' +
        '</br>' +
        '<div id="bodyContent" class="row">' +
        '<div class="col-2">' +
        '</div>' +
        '<div class="col-2">' +
        '<img src="images/bed_resized.png">' +
        '</div>' +
        '<div class="col-1">' +
        '<p>' + bed + '</p>' +
        '</div>' +
        '<div class="col-2">' +
        '<img src="images/bath_resized.png">' +
        '</div>' +
        '<div class="col-1">' +
        '<p>' + bath + '</p>' +
        '</div>' +
        '</div>' +
        '<div id="bodyContent" class="row">' +
        '<div class="col-2">' +
        '</div>' +
        '<div class="col-2">' +
        '<img src="images/car_resized.png">' +
        '</div>' +
        '<div class="col-1">' +
        '<p>' + car + '</p>' +
        '</div>' +
        '<div class="col-2">' +
        '<img src="images/cent_resized.png">' +
        '</div>' +
        '<div class="col-1">' +
        '<p>' + sqmetres + '</p>' +
        '</div>' +
        '</div>' +
        '</br>' + 
        '<h2 class="text-center" id="secondHeading">' + deposit +'</h2>' +
        '</div>' +
        '<div id="property" class="col">' +
        '<img src="images/' + image + '">' +
        '</div>' +
        '</div>' +
        '</div>';

        // Creating a marker
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat,lng),
        map: map,
        icon: icon,
        title: address,
        name: contentString
        });

        // Adds content to infowindow when clicking a marker
        google.maps.event.addListener(marker, 'click', function (e) {
            if (isInfoWindowOpen(infowindow)) {
                infowindow.close();
            } else {
                infowindow.setContent(this.name);
                infowindow.open(map, this);
            }
        });

        // Pushing each marker created to 'markers' array
        markers.push(marker);

        // Adding individual onclick listeners for each marker
        addMarkerListener(markers, j);
        
        j++
    }

    // Accounts for icon change when clicking infowindow close or another marker
    document.onclick = function () {
        if (isInfoWindowOpen(infowindow)) {
            // do nothing
        } else {
            for (var n = 0; n < markers.length; n++) {
                markers[n].setIcon(icon);
            }
        }
    }
}
</script>