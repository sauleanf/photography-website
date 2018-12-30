<?php
  //login credentials for the mysql database
  $db_server = 'localhost:3308';
  $db_username = 'root';
  $db_password = '';
  $db_name = 'php_project';

  //tries to make the connection
  $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['image-id'];
    $delete = "DELETE FROM image_table WHERE ID =$id";
    if($conn->query($delete) === TRUE) {
      header("Location: http://localhost/php_project/dashboard");
    }
    else {
      echo mysqli_error($conn);
    }
  }


?>
