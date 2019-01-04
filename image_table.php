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
  $create = "CREATE TABLE image_table (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), image LONGBLOB, parkour BIT, photography BIT)";

  //makes sure that query was successful
  if($conn->query($create) === TRUE) {
    echo "SUCCESS";
  }
  else {
    echo mysqli_error($conn);
  }
?>
