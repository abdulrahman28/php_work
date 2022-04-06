<?php

  include_once('database.php');

  $api_key_value = "tPmAT5Ab3j7F9";

  $api_key = $location = $power = $voltage = $energy = $cur1 = $cur2 = $cur_agg = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
      $location = test_input($_POST["location"]);
      $power = test_input($_POST["power"]);
      $voltage = test_input($_POST["voltage"]);
      $energy = test_input($_POST["energy"]);
      $cur1 = test_input($_POST["cur1"]);
      $cur2 = test_input($_POST["cur2"]);
      $cur_agg = test_input($_POST["cur_agg"]);

      $result = insertReading($location, $power, $voltage, $energy, $cur1, $cur2, $cur_agg);
      echo $result;
    }
    else {
      echo "Wrong API Key provided.";
    }
  }
  else {
    echo "No data posted with HTTP POST.";
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
