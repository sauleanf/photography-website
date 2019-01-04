<?php
  //login credentials for the mysql database
  $db_server = 'localhost';
  $db_username = 'root';
  $db_password = '';
  $db_name = 'php_project';
  
  //gets the image id
  $image_id = $_GET['id'];

  //tries to make the connection
  $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

  $select = "SELECT * FROM image_table WHERE id=$image_id" or die($conn->error);
  $result = $conn->query($select);
  $row = $result->fetch_assoc();
  header('Content-type: image/jpeg');

  echo $row['image'];
?>
