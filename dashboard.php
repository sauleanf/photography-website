<!DOCTYPE html>
<!-- RENDERS THE DASHBOARD FOR THE ADMIN USER -->
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
        //login credentials for the mysql database
        $db_server = 'localhost:3308';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'php_project';

        //tries to make the connection
        $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

          //content of the image
          $content = addslashes(file_get_contents($_FILES['image']['tmp_name']));

          //location for the temporary file
          $location = "images/" . basename($_FILES['image']['tmp_name']);

          //echo $_FILES['image']['tmp_name'];

          //parkour tag is sent to 0 (false) and is only changed to 1 (true) if the button is pressed
          $parkour = 0;

          if(isset($_POST['parkour'])) {
            $parkour = 1;
          }

          //photography tag is sent to 0 (false) and is only changed to 1 (true) if the button is pressed
          $photography = 0;

          if(isset($_POST['photography'])) {
            $photography = 1;
          }

          //used to check if the upload was successful
          $upload_success = false;

          //title of the post
          $title = $_POST['file-caption'];

          //sql for the insertion
          $add = "INSERT INTO image_table (title, image, parkour, photography) VALUES ('$title', '$content', $parkour, $photography)";

          //checks to see if there was an error with uploading the file
          if($_FILES['image']['error'] == 0) {
            //makes the query
            if( $conn->query($add) === TRUE) {
              if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
                //sets that boolean to true, indicating that the upload was successful
                $upload_success = true;
              }
            }
          }
        }

        include 'navbar.php';

        //gets the name of the user
        $name = "";

        //checks to see if there is a session and redirects to the login page if there isn't
        if(isset($_SESSION['username'])) {
          $name = $_SESSION['username'];
        }
        else {
          header('Location: login');
        }

        //echoes a welcome statement with the user's name in it
        echo "<p class='dashboard-p'>" .  ucfirst($name) . "'s Dashboard </p>";

        /*checks to see if the $upload_success boolean is set and then uses bootstrap alerts to provide a response
        depending on the success of the upload */
        if(isset($upload_success)) {
          if($upload_success) {
            echo '<br> <div class="alert alert-success alert-custom" role="alert"> <strong class="strong-custom"> Success</strong> Post was made! </div>';
          }
          else {
            echo '<br> <div class="alert alert-danger alert-custom" role="alert"> <strong class="strong-custom">Error</strong> Post could not be uploaded! </div>';
          }
        }
      ?>
      <div class="dashboard-container">
        <div class="misc-container">
          <?php
            //sql statement for selection of the images (used for the deletion option on the dashboard)
            $select = "SELECT * FROM image_table";

            //result of the query
            $result = $conn->query($select);

            //checks to see if the number of rows is greater than 0
            if ($result->num_rows > 0) {
              //echoes an element that represents each image with the option to delete
              while($row = $result->fetch_assoc()) {
                echo "<div class='img-dashboard'> <img src='data:image/jpeg;base64," .base64_encode( $row['image'] ). "'  class='dashboard-box'>  <form enctype='application/x-www-form-urlencoded' class='block translate-up form-column' method='post' action='delete.php'> <input name='image-id' type='hidden' value='" . $row['id'] . "'> <br> <button type='submit' class='btn btn-danger danger block'> Delete </button> </form> <p class='translate-up-small p-title'>" . $row['title'] . "</p> </div>";
              }
            }
          ?>
        </div>
        <div class="file-container">
          <button type="button" class="btn btn-primary upload-btn" data-toggle="modal" data-target="#upload">
            Make a new post
          </button>
          <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-settings">
                <br>
                <div class="modal-title-container">
                  <h5 class="modal-title text-white">
                    Make a New Post
                  </h5>
                  <button class="close-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                  </button>
                </div>
                <br>
                <div class="modal-box">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="text-white" for="file-caption"> Caption </label>
                      <input type="text" class="form-control" id="file-caption" name="file-caption" required>
                      <br>
                      <br>
                      <label class="text-white" for="image"> Link </label>
                      <br>
                      <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" name="image" class="custom-file-input" id="image">
                          <label class="custom-file-label" for="image">Choose Image</label>
                        </div>
                      </div>
                    </div>
                    <div class="tag-select-container">
                      <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                          <input name="parkour" type="checkbox" id="parkour" checked autocomplete="off"> Parkour
                        </label>
                      </div>
                      <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                          <input name="photography" type="checkbox" id="photography" checked autocomplete="off"> Photography
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
          include 'footer.php';
        ?>
      </div>
    </div>
    <script>
      <?php
        include 'public/js/dashboard.js';
      ?>
    </script>
  </body>
</html>
