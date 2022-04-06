<?php
    include_once('database.php');
    
    if ($_GET["readingsCount"]){
      $data = $_GET["readingsCount"];
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $readings_count = $_GET["readingsCount"];
    }
    // default readings count set to 20
    else {
      $readings_count = 20;
    }

    $last_reading = getLastReadings();
    $last_reading_power = $last_reading["power"];
    $last_reading_voltage = $last_reading["voltage"];
    $last_reading_energy = $last_reading["energy"];
    $last_reading_cur1 = $last_reading["cur1"];
    $last_reading_cur2 = $last_reading["cur2"];
    $last_reading_cur_agg = $last_reading["cur_agg"];
    $last_reading_time = $last_reading["reading_time"];

    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    $last_reading_time = date("Y-m-d H:i:s", strtotime("$last_reading_time + 1 hours"));
    // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
    //$last_reading_time = date("Y-m-d H:i:s", strtotime("$last_reading_time + 7 hours"));

    $min_power = minReading($readings_count, 'power');
    $max_power = maxReading($readings_count, 'power');
    $avg_power = avgReading($readings_count, 'power');
    
    $min_voltage = minReading($readings_count, 'voltage');
    $max_voltage = maxReading($readings_count, 'voltage');
    $avg_voltage = avgReading($readings_count, 'voltage');
    
    $min_energy = minReading($readings_count, 'energy');
    $max_energy = maxReading($readings_count, 'energy');
    $avg_energy = avgReading($readings_count, 'energy');

    $min_cur1 = minReading($readings_count, 'cur1');
    $max_cur1 = maxReading($readings_count, 'cur1');
    $avg_cur1 = avgReading($readings_count, 'cur1');
    
    $min_cur2 = minReading($readings_count, 'cur2');
    $max_cur2 = maxReading($readings_count, 'cur2');
    $avg_cur2 = avgReading($readings_count, 'cur2');
    
    $min_cur_agg = minReading($readings_count, 'cur_agg');
    $max_cur_agg = maxReading($readings_count, 'cur_agg');
    $avg_cur_agg = avgReading($readings_count, 'cur_agg');
    
?>

<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <header class="header">
        <h1>📊 Home Automation System</h1>
        <form method="get">
            <input type="number" name="readingsCount" min="1" placeholder="Number of readings (<?php echo $readings_count; ?>)">
            <input type="submit" value="UPDATE">
        </form>
    </header>
<body onload = "JavaScript:AutoRefresh(30 * 1000);">
    <p>Last reading: <?php echo $last_reading_time; ?></p>
    <section class="content">
        
	    <div class="box gauge--1">
	    <h3>POWER</h3>
              <div class="mask">
			  <div class="semi-circle"></div>
			  <div class="semi-circle--mask"></div>
			</div>
		    <p style="font-size: 30px;" id="power">--</p>
		    <table cellspacing="5" cellpadding="5">
		        <tr>
		            <th colspan="3">Power: <?php echo $readings_count; ?> readings</th>
	            </tr>
		        <tr>
		            <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_power['min_amount']; ?> W</td>
                    <td><?php echo $max_power['max_amount']; ?> W</td>
                    <td><?php echo round($avg_power['avg_amount'], 2); ?> W</td>
                </tr>
            </table>
        </div>
        
        <div class="box gauge--2">
            <h3>VOLTAGE</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="voltage">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">Voltage: <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_voltage['min_amount']; ?> V</td>
                    <td><?php echo $max_voltage['max_amount']; ?> V</td>
                    <td><?php echo round($avg_voltage['avg_amount'], 2); ?> V</td>
                </tr>
            </table>
        </div>
        
        <div class="box gauge--3">
            <h3>ENERGY</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="energy">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">Energy: <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_energy['min_amount']; ?> Whr</td>
                    <td><?php echo $max_energy['max_amount']; ?> Whr</td>
                    <td><?php echo round($avg_energy['avg_amount'], 2); ?> Whr</td>
                </tr>
            </table>
        </div>
     
        <div class="box gauge--4">
            <h3>LOAD 1</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="cur1">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">Load 1: <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_cur1['min_amount']; ?> A</td>
                    <td><?php echo $max_cur1['max_amount']; ?> A</td>
                    <td><?php echo round($avg_cur1['avg_amount'], 2); ?> A</td>
                </tr>
            </table>
        </div>     

        <div class="box gauge--5">
            <h3>LOAD 2</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="cur2">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">Load 2: <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_cur2['min_amount']; ?> A</td>
                    <td><?php echo $max_cur2['max_amount']; ?> A</td>
                    <td><?php echo round($avg_cur2['avg_amount'], 2); ?> A</td>
                </tr>
            </table>
        </div>

        <div class="box gauge--6">
            <h3>TOTAL LOAD</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="cur_agg">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">Total Load: <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_cur_agg['min_amount']; ?> A</td>
                    <td><?php echo $max_cur_agg['max_amount']; ?> A</td>
                    <td><?php echo round($avg_cur_agg['avg_amount'], 2); ?> A</td>
                </tr>
            </table>
        </div>        
        
    </section>
<?php
    echo   '<h2> View Latest ' . $readings_count . ' Readings</h2>
            <table cellspacing="5" cellpadding="5" id="tableReadings">
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Power</th>
                    <th>Voltage</th>
                    <th>Energy</th>
                    <th>Load 1</th>
                    <th>Load 2</th>
                    <th>Total Load</th>
                    <th>Timestamp</th>
                </tr>';

    $result = getAllReadings($readings_count);
        if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["id"];
            $row_location = $row["location"];
            $row_power = $row["power"];
            $row_voltage = $row["voltage"];
            $row_energy = $row["energy"];
            $row_cur1 = $row["cur1"];
            $row_cur2 = $row["cur2"];
            $row_cur_agg = $row["cur_agg"];
            $row_reading_time = $row["reading_time"];
            // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
            $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 1 hours"));
            // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 7 hours"));

            echo '<tr>
                    <td>' . $row_id . '</td>
                    <td>' . $row_location . '</td>
                    <td>' . $row_power . '</td>
                    <td>' . $row_voltage . '</td>
                    <td>' . $row_voltage . '</td>
                    <td>' . $row_cur1 . '</td>
                    <td>' . $row_cur2 . '</td>
                    <td>' . $row_cur_agg . '</td>
                    <td>' . $row_reading_time . '</td>
                  </tr>';
        }
        echo '</table>';
        $result->free();
    }
?>

<script>
    var power = <?php echo $last_reading_power; ?>;
    var voltage = <?php echo $last_reading_voltage; ?>;
    var energy = <?php echo $last_reading_energy; ?>;
    var cur1 = <?php echo $last_reading_cur1; ?>;
    var cur2 = <?php echo $last_reading_cur2; ?>;
    var cur_agg = <?php echo $last_reading_cur_agg; ?>;
    
    setPower(power);
    setVoltage(voltage);
    setEnergy(energy);
    setCur1(cur1);
    setCur2(cur2);
    setCur_agg(cur_agg);
    
        function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }

    function setPower(curVal){

    	var minPower = 0;
    	var maxPower = 1000;

    	var newVal = scaleValue(curVal, [minPower, maxPower], [0, 180]);
    	$('.gauge--1 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#power").text(curVal + ' W');
    }

    function setVoltage(curVal){
    
    	var minVoltage = 0;
    	var maxVoltage = 250;

    	var newVal = scaleValue(curVal, [minVoltage, maxVoltage], [0, 180]);
    	$('.gauge--2 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#voltage").text(curVal + ' V');
    }
    
    function setEnergy(curVal){
    
    	var minEnergy = 0;
    	var maxEnergy = 1000;

    	var newVal = scaleValue(curVal, [minEnergy, maxEnergy], [0, 180]);
    	$('.gauge--3 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#energy").text(curVal + ' Whr');
    }    

    function setCur1(curVal){
    
    	var minCur1 = 0;
    	var maxCur1 = 20;

    	var newVal = scaleValue(curVal, [minCur1, maxCur1], [0, 180]);
    	$('.gauge--4 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#cur1").text(curVal + ' A');
    }
 
     function setCur2(curVal){
    
    	var minCur2 = 0;
    	var maxCur2 = 20;

    	var newVal = scaleValue(curVal, [minCur2, maxCur2], [0, 180]);
    	$('.gauge--5 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#cur2").text(curVal + ' A');
    }
    
    
     function setCur_agg(curVal){
    
    	var minCur_agg = 0;
    	var maxCur_agg = 100;

    	var newVal = scaleValue(curVal, [minCur_agg, maxCur_agg], [0, 180]);
    	$('.gauge--6 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#cur_agg").text(curVal + ' A');
    } 
    

    function scaleValue(value, from, to) {
        var scale = (to[1] - to[0]) / (from[1] - from[0]);
        var capped = Math.min(from[1], Math.max(from[0], value)) - from[0];
        return ~~(capped * scale + to[0]);
    }
</script>
</body>
</html>