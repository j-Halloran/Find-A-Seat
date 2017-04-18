<?php
  $host = $_SERVER['HTTP_HOST'];
  $table = 'seat_table';
  $servername = 'localhost';
  $username = 'findaseat';
  $password = 'findaseatroot';
  $dbname = 'findaseat';
  $seatdata = -1;

  foreach ($_GET as $k => $v) {
    if($k == "seats-used"){
      $seatdata = intval($v);
    }
  }

  //if seat data is not in the post data, end the script
  if($seatdata<0||$seatdata>15){
    echo "Post data not in right form.";
    return -1;
  }

  //Database stuff
  $conn = new mysqli($servername,$username,$password);
  $sql = 'CREATE DATABASE IF NOT EXISTS findaseat';
  if(!$conn->query($sql) === true){
    echo "Error creating database: ". $conn->error;
  }

  //reopen connection now that database is sure to exist
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //check for the table, create it if necessary
  $sql = "CREATE TABLE IF NOT EXISTS seat_table2  (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    seats INT(10) UNSIGNED,
    cur_time datetime NOT NULL DEFAULT NOW()
  )";
  if (!$conn->query($sql) === TRUE) {
    echo "Error creating table: " . $conn->error;
  }

  //store the data in the table
  $sql = "INSERT INTO seat_table2 (seats)
  VALUES ('$seatdata')";
  if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  echo "Get Processed Successfully";
?>
