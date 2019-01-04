<!DOCTYPE html>
<!-- RENDERS THE HOME PAGE -->
<?php
  //initializes the session
  ob_start();
  session_start();
?>
<html>
  <head>
    <?php
      include 'head.php';
    ?>
  </head>
  <body>
    <div class="main-container">
      <?php
        include 'navbar.php';
      ?>
      <?php
        //used to get the name of the session's user
        $name = "";

        //checks to see if there is a session available
        if(isset($_SESSION['username'])) {
          $name = $_SESSION['username'];
        }
        //adds the name of the sessions's user to the welcome string
        echo "<p id='welcome-text'> Welcome " . $name . "</p>";
      ?>
      <div id="tag-container">
        <button class="btn btn-primary" id="all-id"> No Tags </button>
        <button class="btn btn-primary" id="parkour-id"> Photography </button>
        <button class="btn btn-primary" id="photography-id"> Parkour </button>
      </div>
      <div class="image-container">
        <?php
          //login credentials for the mysql database
          $db_server = 'localhost';
          $db_username = 'root';
          $db_password = '';
          $db_name = 'php_project';

          //tries to make the connection
          $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name) or die("could not connect");

          //selects the data from the image_table
          $select = "SELECT * FROM image_table";

          //makes a query
          $result = $conn->query($select);

          //checks to see if there are more than 0 rows
          if ($result->num_rows > 0) {

            //gets the row as an array
            while($row = $result->fetch_assoc()) {

              //renders the image using the image php file
              include 'image.php';
            }
          }
        ?>
      </div>
      <?php
        include 'footer.php';
      ?>
    </div>
    <script>
    <?php
      include 'public/js/index.js';
    ?>
    </script>
  </body>
</html>
