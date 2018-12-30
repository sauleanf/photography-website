<?php
  //login credentials for the mysql database
  $db_server = 'localhost:3308';
  $db_username = 'root';
  $db_password = '';
  $db_name = 'php_project';

  //tries to make the connection
  $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");
  $create = "CREATE TABLE image_table (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), link VARCHAR(255), parkour BIT, photography BIT)";
  if($conn->query($create) === TRUE) {
    echo "SUCCESS";
  }
  else {
    echo mysqli_error($conn);
  }
?>
