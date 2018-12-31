<?php
  ob_start();
  session_start();
?>
<!DOCTYPE html>
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
        $name = "";
        if(isset($_SESSION['username'])) {
          $name = $_SESSION['username'];
        }
        echo "<p id='welcome-text'> Welcome " . $name . "</p>";
      ?>
      <div class="image-container">
        <?php
          //login credentials for the mysql database
          $db_server = 'localhost:3308';
          $db_username = 'root';
          $db_password = '';
          $db_name = 'php_project';

          //tries to make the connection
          $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name) or die("could not connect");

          $select = "SELECT * FROM image_table";

          $result = $conn->query($select);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $index = $row['id'];
              $image_caption = $row['title'];
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
      include 'public/img.js';
    ?>
    </script>
  </body>
</html>
