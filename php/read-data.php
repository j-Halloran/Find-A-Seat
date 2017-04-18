<?php
  $host = $_SERVER['HTTP_HOST'];
  $table = 'seat_table2';
  $servername = 'localhost';
  $username = 'findaseat';
  $password = 'findaseatroot';
  $dbname = 'findaseat';
  $seatdata = 0;

  //open db connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //select most recently uploaded data from table
  $sql = "SELECT * FROM seat_table2 ORDER BY id DESC LIMIT 1";
  $result = $conn->query($sql);
  /* fetch associative array */
   $row = $result->fetch_assoc();
   echo $row['seats'];
?>
