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
        //login credentials for the mysql database
        $db_server = 'localhost:3308';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'php_project';

        //tries to make the connection
        $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
          $uploadOk = 1;
          $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
          $content = addslashes(file_get_contents($_FILES['image']['tmp_name']));

          $location = "images/" . basename($_FILES['image']['tmp_name']);

          $parkour = 0;
          if(isset($_POST['parkour'])) {
            $parkour = 1;
          }

          $photography = 0;
          if(isset($_POST['photography'])) {
            $photography = 1;
          }

          $upload_success = false;

          $title = $_POST['file-caption'];

          $add = "INSERT INTO image_table (title, image, parkour, photography) VALUES ('$title', '$content', $parkour, $photography)";

          if( $conn->query($add) === TRUE) {

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
              $upload_success = true;
            }
          }
          else {
            echo mysqli_error($conn);
          }
        }

        include 'navbar.php';
        $name = "";
        if(isset($_SESSION['username'])) {
          $name = $_SESSION['username'];
        }
        else {
          header('Location: http://localhost/php_project/login');
        }
        echo "<p class='dashboard-p'>" .  ucfirst($name) . "'s Dashboard </p>";
        if(isset($upload_success)) {
          if($upload_success) {
            echo '<br> <div class="alert alert-success alert-custom" role="alert"> <strong class="strong-custom"> Success</strong> Post was made! </div>';
          }
          else {
            echo '<br> <div class="alert alert-danger alert-custom" role="alert"> <strong class="strong-custom">Error</strong> Post was not made! </div>';
          }
        }
      ?>
      <div class="dashboard-container">
        <div class="misc-container">
          <?php
            $select = "SELECT * FROM image_table";
            $result = $conn->query($select);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<div class='img-dashboard'> <img src='data:image/jpeg;base64," .base64_encode( $row['image'] ). "'  class='dashboard-box'>  <form class='block translate-up form-column' method='post' action='delete.php'> <input name='image-id' type='hidden' value='" . $row['id'] . "'> <br> <button type='submit' class='btn btn-danger danger block'> Delete </button> </form> <p class='translate-up-small p-title'>" . $row['title'] . "</p> </div>";
              }
            }
          ?>
        </div>
        <div class="file-container">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Make a new post
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-settings">
                <div class="modal-header">
                  <h5 class="modal-title text-white" id="exampleModalLabel">Modal title</h5>
                  <button class="close-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <!-- <label for="text-file"> Caption </label>
                      <textarea type="text" class="form-control" id="text-file" style='resize: none'> </textarea> -->
                      <label class="text-white" for="file-caption"> Caption </label>
                      <input type="text" class="form-control" id="file-caption" name="file-caption" required>
                      <br>
                      <br>
                      <label class="text-white" for="image"> Link </label>
                      <br>
                      <input type="file" name="image" id="image" />
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
                    <!-- <div class="form-group">
                      <label for="photo-file"> Photo Upload </label>
                      <input type="file" class="form-control-file" id="photo-file">
                    </div> -->
                    <button type="submit" class="btn btn-primary">Upload</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--- -->
        </div>
      </div>
    </div>
    <script>
      <?php
        include 'public/dashboard.js';
      ?>
    </script>
    <?php
      include 'footer.php';
    ?>
  </body>
</html>
