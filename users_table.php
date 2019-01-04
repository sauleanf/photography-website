<head>
  <?php
    include 'head.php';
  ?>
</head>
<?php
  //this should not be in the production (final) version
  //for making the image storing sql table

  //tries to make the connection
  $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

  //create sql statement
  $create = "CREATE TABLE users_table (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255), username VARCHAR(255), password VARCHAR(255), UNIQUE (email))";

  //makes sure that query was successful
  if($conn->query($create) === TRUE) {
    echo "SUCCESS";
  }
  else {
    echo mysqli_error($conn);
  }
?>
