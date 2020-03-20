<?php
    require_once "uq/auth.php";
    auth_require();

    require 'scripts/connectDatabase.php';
    $db = new MySQLDatabase();
    $db->connect();

    $jan = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201901..$'");
    $feb = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201902..$'");
    $mar = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201903..$'");
    $apr = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201904..$'");
    $may = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201905..$'");
    $jun = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201906..$'");
    $jul = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201907..$'");
    $aug = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201908..$'");
    $sep = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201909..$'");
    $oct = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201910..$'");
    $nov = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201911..$'");
    $dec = $db->query("SELECT COUNT(Log) FROM LIST WHERE Log REGEXP '^201912..$'");

    $db->disconnect();
?>

<!DOCTYPE HTML>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
            <title>seed</title>

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="./styles/main.css">
            <link href="https://fonts.googleapis.com/css?family=Monda|Montserrat" rel="stylesheet">

            <script>
                window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
	    animationEnabled: true,
	    theme: "light2",
	    title:{ text: "Subscribers per Month"},
	    axisY:{ includeZero: false},
	    data: [{        
		    type: "line",       
		    dataPoints: [
			    { y: 450 },
			    { y: 414},
			    { y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
			    { y: 460 },
			    { y: 450 },
			    { y: 500 },
			    { y: 480 },
			    { y: 480 },
			    { y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
			    { y: 500 },
			    { y: 480 },
			    { y: 510 }
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

                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
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
</body>
</html>