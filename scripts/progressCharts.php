<script>

    // Increases the x-axis of the graph to help show due date
    function dateUp(date) {
        var splitDay = parseInt((date.substr(8,2)), 10);
        var splitMonth = parseInt((date.substr(5,2)), 10);
        if (splitDay >= 26) {
            splitDay = 1;
            splitMonth += 1;
        } else {
            splitDay += 5;
        }
        return date.substr(0, 5) + splitMonth + '-' + splitDay + date.substr(-7);
    }

    <?php
    $db = new MySQLDatabase();
    $db->connect();

    $email = $_SESSION["email"];

    $query = "SELECT * FROM DEPOSIT WHERE Email='$email' ORDER BY depositID ASC";
    $select = $db->query($query);
    foreach ($select as $key) {
        $entry[] = array('depositID' => $key['depositID'], 'Email' => $key['Email'], 'Log' => $key['Log'], 'Amount' => $key['Amount']);
    }
    
    $graphMarkers = json_encode($entry);

    $query2 = "SELECT Goal, Due FROM USER WHERE Email='$email'";
    $select2 = $db->query($query2);
    $array = mysqli_fetch_array($select2);
    $goal = $array['Goal'];
    $due = $array['Due'];

    $db->disconnect();

    echo "var graphMarkers=$graphMarkers;\n";
    echo "var goal=$goal;\n";
    echo "var due='$due';\n";

    ?>

    function updateGraph() {
        if ((document.querySelector('div[class="toggle btn btn-success"]')) == null) {
            document.getElementById('goalProgress').style.display = 'block';
            document.getElementById('goalProgress2').style.display = 'none';
        } else {
            document.getElementById('goalProgress').style.display = 'none';
            document.getElementById('goalProgress2').style.display = 'block';
        }
    }

    var dataset = [];
    var runningAmount = 0;
    var recentDataset;

    for (var i in graphMarkers) {

        // creating variables from graphMarkers
        var log = graphMarkers[i].Log;
        var amount = graphMarkers[i].Amount;
        amount = parseInt(amount, 10);

        runningAmount += amount;
        dataset.push({t: log, y: runningAmount});
    }

    var tempDataset = dataset.reverse();
    switch (tempDataset.length) {
        case 1:
            recentDataset = tempDataset;
            break;
        case 2:
            recentDataset = [tempDataset[1], tempDataset[0]];
            break;
        case 3:
            recentDataset = [tempDataset[2], tempDataset[1], tempDataset[0]];
            break;
        case 4:
            recentDataset = [tempDataset[3], tempDataset[2], tempDataset[1], tempDataset[0]];
            break;
        default:
            recentDataset = [tempDataset[4], tempDataset[3], tempDataset[2], tempDataset[1], tempDataset[0]];
            break;
    }

    var customTooltips2 = function(tooltipModel) {
        var newBody;
        // Tooltip Element
        var tooltipEl = document.getElementById('customTooltip2');

        // Create element on first render
        if (!tooltipEl) {
            tooltipEl = document.createElement('div');
            tooltipEl.id = 'customTooltip2';
            tooltipEl.innerHTML = '<table></table>';
            document.body.appendChild(tooltipEl);
        }

        // Hide if no tooltip
        if (tooltipModel.opacity === 0) {
            tooltipEl.style.opacity = 0;
            return;
        }

        // Set caret Position
        tooltipEl.classList.remove('above', 'below', 'no-transform');
        if (tooltipModel.yAlign) {
            tooltipEl.classList.add(tooltipModel.yAlign);
        } else {
            tooltipEl.classList.add('no-transform');
        }

        function getBody(bodyItem) {
            return bodyItem.lines;
        }

        // Set Text
        if (tooltipModel.body) {
            var titleLines = tooltipModel.title || [];
            var bodyLines = tooltipModel.body.map(getBody);
            var titleDate;

            var innerHtml = '<thead>';

            titleLines.forEach(function(title) {
                titleDate = title;
            });
            innerHtml += '</thead><tbody>';

            bodyLines.forEach(function(body, i) {
                // setting up title variables
                var dateSplit = titleDate.substr(0,10).split('-');
                var year = dateSplit[0];
                var month = dateSplit[1];
                var day = dateSplit[2];
                var timeSplit = titleDate.substr(-6,5).split(':');
                var hours = timeSplit[0];
                var minutes = timeSplit[1];
                var shift = 'AM';
                if (hours > 12) {
                    hours = hours - 12
                    shift = 'PM';
                }
                var colors = tooltipModel.labelColors[i];
                var style = 'background:' + colors.backgroundColor;
                style += '; border-color:' + colors.borderColor;
                var span = '<span style="' + style + '"></span>';
                innerHtml += '<tr><td> Deposit Date: ' + day + '/' + month + '/' + year + ' at ' + hours + ':' + minutes + shift + '</td></tr>';
                innerHtml += '<tr><td> Total Deposits: $' + body + '</td></tr>';
            });
            innerHtml += '</tbody>';

            var tableRoot = tooltipEl.querySelector('table');
            tableRoot.innerHTML = innerHtml;
        }

        // `this` will be the overall tooltip
        var position = this._chart.canvas.getBoundingClientRect();

        // Display, position, and set styles for font
        tooltipEl.style.opacity = 1;
        tooltipEl.style.position = 'absolute';
        tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
        tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
        tooltipEl.style.fontSize = '1em';
        tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';
        tooltipEl.style.pointerEvents = 'none';
        tooltipEl.style.borderStyle = 'solid';
        tooltipEl.style.color = 'white';
        tooltipEl.style.borderColor = 'black';
        tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)';
    }

    var ctx = document.getElementById("goalProgress").getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        data: {
            labels: [graphMarkers[0].Log, dateUp(due)],
            datasets: [{
                fill: false,
                data: dataset,
                pointBackgroundColor: 'rgb(65, 180, 74)',
                borderColor: 'rgb(65, 180, 74)',
                pointHoverBackgroundColor: 'rgb(3, 0, 53)',
            }]
        },
        options: {
            tooltips: {
                    // Disable the on-canvas tooltip
                    enabled: false,
                    mode: 'index',
                    position: 'nearest',
                    custom: customTooltips2
                },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Time'
                    },
                    type: 'time',
                    time: {
                        unit: 'month'
                    },
                    distribution: 'linear',
                    gridLines: {
                        display: false
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Savings ($)'
                    },
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        max: goal
                    }
                }]
            },
            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'vertical',
                    scaleID: 'x-axis-0',
                    value: due,
                    borderColor: 'rgb(3, 0, 53)',
                    borderWidth: 4,
                    label: {
                        content: "Due Date",
                        enabled: true,
                        position: "bottom",
                        backgroundColor: 'rgba(0,0,0,0.5)',
                        xAdjust: 35,
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });

    var ctx2 = document.getElementById("goalProgress2").getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        responsive: true,
        data: {
            datasets: [{
                fill: false,
                data: recentDataset,
                pointBackgroundColor: 'rgb(65, 180, 74)',
                borderColor: 'rgb(65, 180, 74)',
                pointHoverBackgroundColor: 'rgb(3, 0, 53)',
            }]
        },
        options: {
            tooltips: {
                    // Disable the on-canvas tooltip
                    enabled: false,
                    mode: 'index',
                    position: 'nearest',
                    custom: customTooltips2
                },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Time'
                    },
                    type: 'time',
                    distribution: 'linear',
                    gridLines: {
                        display: false
                    },
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Savings ($)'
                    },
                    display: true,
                }]
            },
            legend: {
                display: false,
            }
        }
    });
</script>