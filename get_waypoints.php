<?php

date_default_timezone_set('Australia/Sydney');
include 'db-config.php';

// $items = array();
// $group = array();
// $mygroup = array();
// $checked = array();
// $id = array();
$waypoints = array();
$count = 0;

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql = "SELECT * FROM a_waypoints";

 if ($result=mysqli_query($conn,$sql))  {  
    while ($row=mysqli_fetch_row($result))  { 
     
      $waypoints[$count] = array('id' => "$row[0]", 'name' => "$row[1]", 'lat' => "$row[2]", 'lon' => "$row[3]", 'elev' => "$row[4]", 'style' => "$row[5]", 'rwdir' => "$row[6]", 'rwlength' => "$row[7]", 'notes' => "$row[8]", 'dist' => "$row[9]");
      
     
      $count = $count + 1;
      
    }

  }  

echo json_encode($waypoints);

    mysqli_free_result($result);

$conn->close();

  ?>

