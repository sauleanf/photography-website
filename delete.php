<!-- FOR DELETING IMAGES -->
<?php
  //login credentials for the mysql database
  $db_server = 'localhost:3308';
  $db_username = 'root';
  $db_password = '';
  $db_name = 'php_project';

  //tries to make the connection
  $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

  //sees if the request method is post
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //gets the id of the photo from a hidden input field
    $id = $_POST['image-id'];

    //delete sql statement
    $delete = "DELETE FROM image_table WHERE ID =$id";

    //checks to see if the query was successful
    if($conn->query($delete) === TRUE) {
      //redirects to the dashboard if not
      header("Location: dashboard");
    }
    else {
      /*echoes error if there is one
      NEEDS TO BE MORE ELEGANT */
      echo mysqli_error($conn);
    }
  }


?>
