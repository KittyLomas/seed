<?php
    require_once "uq/auth.php";
    auth_require();

    require 'scripts/connectDatabase.php';
    $db = new MySQLDatabase();
    $db->connect();

    $jan = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201901..$'"))->num_rows);
    $feb = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201902..$'"))->num_rows);
    $mar = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201903..$'"))->num_rows);
    $apr = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201904..$'"))->num_rows);
    $may = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201905..$'"))->num_rows);
    $jun = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201906..$'"))->num_rows);
    $jul = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201907..$'"))->num_rows);
    $aug = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201908..$'"))->num_rows);
    $sep = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201909..$'"))->num_rows);
    $oct = $db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201910..$'");
    $oct = $oct->num_rows;
    $oct = (int)$oct;
    $nov = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201911..$'"))->num_rows);
    $dec = (int)(($db->query("SELECT Log FROM LIST WHERE Log REGEXP '^201912..$'"))->num_rows);

    $db->disconnect();
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>seed</title>


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        <link rel="stylesheet" href="./styles/main.css">

        <link href="https://fonts.googleapis.com/css?family=Monda|Montserrat" rel="stylesheet">

        <!-- Sourced from https://canvasjs.com/javascript-charts/null-data-chart/ -->
        <script>
            window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Subscribers Per Month"
                    },
                    axisX: {
                        title: "Month"
                    },
                    axisY: {
                        title: "Subscribers"
                    },
                    data: [{
                        type: "line",
                        name: "Monthly Subscribers For 2019",
                        connectNullData: true,
                        dataPoints: [
                            {x:01, y:<?php echo $jan;?>},
                            {x:02, y:<?php echo $feb;?>},
                            {x:03, y:<?php echo $mar;?>},
                            {x:04, y:<?php echo $apr;?>},
                            {x:05, y:<?php echo $may;?>},
                            {x:06, y:<?php echo $jun;?>},
                            {x:07, y:<?php echo $jul;?>},
                            {x:08, y:<?php echo $aug;?>},
                            {x:09, y:<?php echo $sep;?>},
                            {x:10, y:<?php echo $oct;?>},
                            {x:11, y:<?php echo $nov;?>},
                            {x:12, y:<?php echo $dec;?>}
                        ]
                    }]
                });
                chart.render();
            }
        </script>
        
    </head>
    <body>

          <nav class="navbar clearfix">
            <h1 class="logo"><a href="./index.html">s e e d</a></h1>
            <ul class="nav">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li><a href="./subscribe.html">Subscribe</a></li>
                <li><a href="./stats.php">Statistics</a></li>
            </ul>
            <a class="nav-toggle" href="javascript:void(0)"><span class="nav-icon"></span></a>
        </nav>

         <section class="project-header">
            <div class="container">
                <div class="row">
                    <div class="twelve columns">
                                <img src="images/seedsta.png" > <br>
                    </div>
                </div>
            </div>
        </section>

        <main class="project-content">

            <div class="container">
                <div class="row project-info">

                         <div class="twelve columns">


    <p>Website Traffic</p>

    <div id="chartContainer" style="height: 300px; width: 600px;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
<br>

                    </div>

                    
                </div>
                <br> <br> <br> <br> <br> <br>


            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

        </main>

       
       <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="twelve columns">
                        <p>© 2019 &nbsp; The Stable Squad &nbsp; <a href="mailto:m.valdez@uq.net.au"><span class="highlight">Send Email</span></a> &nbsp; <h6><i> This site has been developed using <a href="https://getbootstrap.com/">Bootstrap</a> & <a href="http://getskeleton.com/">Skeleton.css</a></i></h6> </p> 

                    </div>
                </div>
            </div>
        </footer>




        <script src="scripts/main.js"></script>

        
        </html>