<?php

$servername = "localhost";
$username = "id18417377_homeauto";
$password = "H6YtPCd8cLa\97n%";
$dbname = "id18417377_automation";

$dbc = mysqli_connect($servername, $username, $password, $dbname);

 if (!$dbc){
    die("DATABASE CONNECTION FAILED:".mysqli_connect_error());
    exit();
 }


$load1 = mysqli_real_escape_string($dbc, $_GET['load1']);
$load2 = mysqli_real_escape_string($dbc, $_GET['load2']);

$query = "INSERT INTO sdata(load1, load2) VALUES ('" . $load1 . "', '" . $load2 . "')";

if(mysqli_query($dbc, $query))echo "Records added successfully!!!";

else "ERROR: Could not able to execute" .$query. " ".mysqli_error($dbc);

mysqli_close($dbc);

?>