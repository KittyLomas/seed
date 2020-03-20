<!-- 
    This code file uses the following sources:
    1. ChartsJS custom tooltips - https://www.chartjs.org/docs/latest/configuration/tooltip.html#external-custom-tooltips
    This code snippet was adapted to customise the on-hover tooltips for each section of the progress pie chart
    2. Percentage inside pie chart - https://jsfiddle.net/htw0tw55/
    This code snippet was used to show to place a percentage text within the chart
 -->
<?php

    $db = new MySQLDatabase();
    $db->connect();

    $email = $_SESSION["email"];

    $query = "SELECT Goal, Total FROM USER WHERE Email='$email'";
    $result = $db->query($query);
    $array = mysqli_fetch_array($result);
    $goal = $array['Goal'];
    $total = $array['Total'];

    $db->disconnect();
    
?>
<script>

    <?php echo "var goal = $goal;\n"; ?>
    <?php echo "var total = $total;\n"; ?>

    if (total < (goal/4)) {
        // (1. ChartJS custom tooltips)
        var customTooltips = function(tooltipModel) {
            var newBody;
            // Tooltip Element
            var tooltipEl = document.getElementById('customTooltip');

            // Create element on first render
            if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'customTooltip';
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

                var innerHtml = '<thead>';

                titleLines.forEach(function(title) {
                    innerHtml += '<tr><th>' + title + '</th></tr>';
                });
                innerHtml += '</thead><tbody>';

                bodyLines.forEach(function(body, i) {
                    newBody = body[0].toString().split(': ');
                    var colors = tooltipModel.labelColors[i];
                    var style = 'background:' + colors.backgroundColor;
                    style += '; border-color:' + colors.borderColor;
                    var span = '<span style="' + style + '"></span>';
                    switch (newBody[0]) {
                        case "Goal 1":
                            innerHtml += '<tr><td>' + span + 'Goal 1 - $' + newBody[1] + '/$' + goal/4 + '</td></tr>';
                            break;
                        case "Goal 1.5":
                            var x = parseInt(newBody[1], 10);
                            var y = goal/4 - x;
                            innerHtml += '<tr><td>' + span + 'Goal 1 - $' + y + '/$' + goal/4 + '</td></tr>';
                            break;
                        default:
                            innerHtml += '<tr><td>' + span + newBody[0] + ' - Goal 1 Incomplete </td></tr>';
                            break;
                    }
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
            
            switch (newBody[0]) {
                case "Goal 1":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)';
                    break;
                case "Goal 1.5":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                default:
                    tooltipEl.style.backgroundColor = 'rgb(3, 0, 53)'
                    break;
            }
        }
        // End of (1)
    
        var ctx = document.getElementById('totalProgress').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            responsive: true,
            data: {
                labels: ["Goal 1", "Goal 1.5", "Goal 2", "Goal 3", "Goal 4"],
                datasets: [{
                    backgroundColor: ["rgb(97, 171, 103)", "rgb(3, 0, 53)", "rgb(3, 0, 53)", "rgb(3, 0, 53)", "rgb(3, 0, 53)"],
                    borderColor: ["rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)"],
                    borderWidth: [0, 0, 5, 5, 5],
                    data: [total, goal/4 - total, goal/4, goal/4, goal/4]
                }]
            },
            // (2. Percentage inside pie chart)
            plugins: [{
                beforeDraw: function (chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 200).toFixed(2);
                    ctx.font = fontSize + "em roboto";
                    ctx.fillStyle = "#9b9b9b";
                    ctx.textBaseline = "middle";

                    var text = Math.round(total/goal * 1000)/10 + "% saved",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            // End of (2)
            options: {
                tooltips: {
                    // Disable the on-canvas tooltip
                    enabled: false,
                    mode: 'index',
                    position: 'nearest',
                    custom: customTooltips
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 60,
                animation: {
                    duration: 2000,
                    animationRotate: true,
                }
            }
        });
    } else if (total < (goal/4 * 2)) {
        var customTooltips = function(tooltipModel) {
            var newBody;
            // Tooltip Element
            var tooltipEl = document.getElementById('customTooltip');

            // Create element on first render
            if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'customTooltip';
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

                var innerHtml = '<thead>';

                titleLines.forEach(function(title) {
                    innerHtml += '<tr><th>' + title + '</th></tr>';
                });
                innerHtml += '</thead><tbody>';

                bodyLines.forEach(function(body, i) {
                    newBody = body[0].toString().split(': ');
                    var colors = tooltipModel.labelColors[i];
                    var style = 'background:' + colors.backgroundColor;
                    style += '; border-color:' + colors.borderColor;
                    var span = '<span style="' + style + '"></span>';
                    switch (newBody[0]) {
                        case "Goal 1":
                        innerHtml += '<tr><td>' + span + 'Goal 1 Complete! </td></tr>';
                            break;
                        case "Goal 2":
                            innerHtml += '<tr><td>' + span + 'Goal 2 - $' + newBody[1] + '/$' + goal/4 + '</td></tr>';
                            break;
                        case "Goal 2.5":
                            var x = parseInt(newBody[1], 10);
                            var y = goal/4 - x;
                            innerHtml += '<tr><td>' + span + 'Goal 2 - $' + y + '/$' + goal/4 + '</td></tr>';
                            break;
                        default:
                            innerHtml += '<tr><td>' + span + newBody[0] + ' - Goal 2 Incomplete </td></tr>';
                            break;
                    }
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
            
            switch (newBody[0]) {
                case "Goal 1":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)';
                    break;
                case "Goal 2":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 2.5":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break
                default:
                    tooltipEl.style.backgroundColor = 'rgb(3, 0, 53)'
                    break;
            }
        }
    
        var ctx = document.getElementById('totalProgress').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            responsive: true,
            data: {
                labels: ["Goal 1", "Goal 2", "Goal 2.5", "Goal 3", "Goal 4"],
                datasets: [{
                    backgroundColor: ["rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(3, 0, 53)", "rgb(3, 0, 53)", "rgb(3, 0, 53)"],
                    borderColor: ["rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)"],
                    borderWidth: [5, 0, 0, 5, 5],
                    data: [goal/4, total - goal/4, goal/4 * 2 - total, goal/4, goal/4]
                }]
            },
            plugins: [{
                beforeDraw: function (chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 200).toFixed(2);
                    ctx.font = fontSize + "em roboto";
                    ctx.fillStyle = "#9b9b9b";
                    ctx.textBaseline = "middle";

                    var text = Math.round(total/goal * 1000)/10 + "% saved",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                tooltips: {
                    // Disable the on-canvas tooltip
                enabled: false,
                mode: 'index',
                position: 'nearest',
                custom: customTooltips
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 60,
                animation: {
                    duration: 2000,
                    animationRotate: true,
                }
            }
        });
    } else if (total < (goal/4) * 3) {
        var customTooltips = function(tooltipModel) {
            var newBody;
            // Tooltip Element
            var tooltipEl = document.getElementById('customTooltip');

            // Create element on first render
            if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'customTooltip';
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

                var innerHtml = '<thead>';

                titleLines.forEach(function(title) {
                    innerHtml += '<tr><th>' + title + '</th></tr>';
                });
                innerHtml += '</thead><tbody>';

                bodyLines.forEach(function(body, i) {
                    newBody = body[0].toString().split(': ');
                    var colors = tooltipModel.labelColors[i];
                    var style = 'background:' + colors.backgroundColor;
                    style += '; border-color:' + colors.borderColor;
                    var span = '<span style="' + style + '"></span>';
                    switch (newBody[0]) {
                        case "Goal 1":
                            innerHtml += '<tr><td>' + span + 'Goal 1 Complete! </td></tr>';
                            break;
                        case "Goal 2":
                            innerHtml += '<tr><td>' + span + 'Goal 2 Complete! </td></tr>';
                            break;
                        case "Goal 3":
                            innerHtml += '<tr><td>' + span + 'Goal 3 - $' + newBody[1] + '/$' + goal/4 + '</td></tr>';
                            break;
                        case "Goal 3.5":
                            var x = parseInt(newBody[1], 10);
                            var y = goal/4 - x;
                            innerHtml += '<tr><td>' + span + 'Goal 3 - $' + y + '/$' + goal/4 + '</td></tr>';
                            break;
                        default:
                            innerHtml += '<tr><td>' + span + newBody[0] + ' - Goal 3 Incomplete </td></tr>';
                            break;
                    }
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
            
            switch (newBody[0]) {
                case "Goal 1":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)';
                    break;
                case "Goal 2":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 3":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 3.5":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break
                default:
                    tooltipEl.style.backgroundColor = 'rgb(3, 0, 53)'
                    break;
            }
        }
    
        var ctx = document.getElementById('totalProgress').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            responsive: true,
            data: {
                labels: ["Goal 1", "Goal 2", "Goal 3", "Goal 3.5", "Goal 4"],
                datasets: [{
                    backgroundColor: ["rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(3, 0, 53)", "rgb(3, 0, 53)"],
                    borderColor: ["rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)"],
                    borderWidth: [5, 5, 0, 0, 5],
                    data: [goal/4, goal/4, total - goal/4 * 2, goal/4 * 3 - total, goal/4]
                }]
            },
            plugins: [{
                beforeDraw: function (chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 200).toFixed(2);
                    ctx.font = fontSize + "em roboto";
                    ctx.fillStyle = "#9b9b9b";
                    ctx.textBaseline = "middle";

                    var text = Math.round(total/goal * 1000)/10 + "% saved",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                tooltips: {
                    // Disable the on-canvas tooltip
                enabled: false,
                mode: 'index',
                position: 'nearest',
                custom: customTooltips
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 60,
                animation: {
                    duration: 2000,
                    animationRotate: true,
                }
            }
        });
    } else if (total < goal/4 * 4) {
        var customTooltips = function(tooltipModel) {
            var newBody;
            // Tooltip Element
            var tooltipEl = document.getElementById('customTooltip');

            // Create element on first render
            if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'customTooltip';
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

                var innerHtml = '<thead>';

                titleLines.forEach(function(title) {
                    innerHtml += '<tr><th>' + title + '</th></tr>';
                });
                innerHtml += '</thead><tbody>';

                bodyLines.forEach(function(body, i) {
                    newBody = body[0].toString().split(': ');
                    var colors = tooltipModel.labelColors[i];
                    var style = 'background:' + colors.backgroundColor;
                    style += '; border-color:' + colors.borderColor;
                    var span = '<span style="' + style + '"></span>';
                    switch (newBody[0]) {
                        case "Goal 1":
                            innerHtml += '<tr><td>' + span + 'Goal 1 Complete! </td></tr>';
                            break;
                        case "Goal 2":
                            innerHtml += '<tr><td>' + span + 'Goal 2 Complete! </td></tr>';
                            break;
                        case "Goal 3":
                            innerHtml += '<tr><td>' + span + 'Goal 3 Complete! </td></tr>';
                            break;
                        case "Goal 4":
                            innerHtml += '<tr><td>' + span + 'Goal 4 - $' + newBody[1] + '/$' + goal/4 + '</td></tr>';
                            break;
                        case "Goal 4.5":
                            var x = parseInt(newBody[1], 10);
                            var y = goal/4 - x;
                            innerHtml += '<tr><td>' + span + 'Goal 4 - $' + y + '/$' + goal/4 + '</td></tr>';
                            break;
                        default:
                            innerHtml += '<tr><td>' + span + newBody[0] + ' - Goal 4 Incomplete </td></tr>';
                            break;
                    }
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
            
            switch (newBody[0]) {
                case "Goal 1":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)';
                    break;
                case "Goal 2":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 3":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 4":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 4.5":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break
                default:
                    tooltipEl.style.backgroundColor = 'rgb(3, 0, 53)'
                    break;
            }
        }
    
        var ctx = document.getElementById('totalProgress').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            responsive: true,
            data: {
                labels: ["Goal 1", "Goal 2", "Goal 3", "Goal 4", "Goal 4.5"],
                datasets: [{
                    backgroundColor: ["rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(3, 0, 53)"],
                    borderColor: ["rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)"],
                    borderWidth: [5, 5, 5, 0, 0],
                    data: [goal/4, goal/4, goal/4, total - goal/4 * 3, goal/4 * 4 - total]
                }]
            },
            plugins: [{
                beforeDraw: function (chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 200).toFixed(2);
                    ctx.font = fontSize + "em roboto";
                    ctx.fillStyle = "#9b9b9b";
                    ctx.textBaseline = "middle";

                    var text = Math.round(total/goal * 1000)/10 + "% saved",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                tooltips: {
                    // Disable the on-canvas tooltip
                enabled: false,
                mode: 'index',
                position: 'nearest',
                custom: customTooltips
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 60,
                animation: {
                    duration: 2000,
                    animationRotate: true,
                }
            }
        });
    } else {
        var customTooltips = function(tooltipModel) {
            var newBody;
            // Tooltip Element
            var tooltipEl = document.getElementById('customTooltip');

            // Create element on first render
            if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'customTooltip';
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

                var innerHtml = '<thead>';

                titleLines.forEach(function(title) {
                    innerHtml += '<tr><th>' + title + '</th></tr>';
                });
                innerHtml += '</thead><tbody>';

                bodyLines.forEach(function(body, i) {
                    newBody = body[0].toString().split(': ');
                    var colors = tooltipModel.labelColors[i];
                    var style = 'background:' + colors.backgroundColor;
                    style += '; border-color:' + colors.borderColor;
                    var span = '<span style="' + style + '"></span>';
                    switch (newBody[0]) {
                        case "Goal 1":
                            innerHtml += '<tr><td>' + span + 'Goal 1 Complete! </td></tr>';
                            break;
                        case "Goal 2":
                            innerHtml += '<tr><td>' + span + 'Goal 2 Complete! </td></tr>';
                            break;
                        case "Goal 3":
                            innerHtml += '<tr><td>' + span + 'Goal 3 Complete! </td></tr>';
                            break;
                        case "Goal 4":
                            innerHtml += '<tr><td>' + span + 'Goal 4 Complete! </td></tr>';
                            break;
                    }
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
            
            switch (newBody[0]) {
                case "Goal 1":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)';
                    break;
                case "Goal 2":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 3":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
                case "Goal 4":
                    tooltipEl.style.backgroundColor = 'rgb(65, 180, 74)'
                    break;
            }
        }
    
        var ctx = document.getElementById('totalProgress').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            responsive: true,
            data: {
                labels: ["Goal 1", "Goal 2", "Goal 3", "Goal 4"],
                datasets: [{
                    backgroundColor: ["rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(97, 171, 103)", "rgb(97, 171, 103)"],
                    borderColor: ["rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)", "rgb(255, 255, 255)"],
                    borderWidth: [5, 5, 5, 5],
                    data: [goal/4, goal/4, goal/4, goal/4]
                }]
            },
            plugins: [{
                beforeDraw: function (chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 200).toFixed(2);
                    ctx.font = fontSize + "em roboto";
                    ctx.fillStyle = "#9b9b9b";
                    ctx.textBaseline = "middle";

                    var text = Math.round(total/goal * 1000)/10 + "% saved",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                tooltips: {
                    // Disable the on-canvas tooltip
                enabled: false,
                mode: 'index',
                position: 'nearest',
                custom: customTooltips
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 60,
                animation: {
                    duration: 2000,
                    animationRotate: true,
                }
            }
        });
    }

    
</script>