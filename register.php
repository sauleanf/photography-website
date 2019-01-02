<!DOCTYPE html>
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
    <div class="full-window">
      <form method="post" class="form-box">
        <div class="form-group">
          <label for="inputEmail">
            Email
          </label>
          <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Enter new email">
        </div>
        <div class="form-group">
          <label for="inputUsername">
            Username
          </label>
          <input name="username" type="text" class="form-control" id="inputUsername" placeholder="Enter new username">
        </div>
        <div class="form-group">
          <label for="inputPassword1"> Password</label>
          <input name="password1" type="text" class="form-control" id="inputPassword1" placeholder="Enter password">
        </div>
        <div class="form-group">
          <label for="inputPassword2"> Password </label>
          <input name="password2" type="text" class="form-control" id="inputPassword2" placeholder="Retype password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <?php
        if(isset($_SESSION['username'])) {
          header('Location: dashboard');
        }

        //checks to see if the request method is post
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
          //checks to see if the password input fields equal one another
          if($_POST['password1'] === $_POST['password2']) {
            //login credentials for the mysql database
            $db_server = 'localhost:3308';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'php_project';

            //tries to make the connection
            $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name) or die("could not connect");

            //gets the username from the post request
            $username = $_POST['username'];

            //gets the email from the post request
            $email = $_POST['email'];

            //hashes the password to be stored
            $hashed_password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            //sql statement to insert into the user table
            $insert = "INSERT INTO users_table (email, username, password) VALUES('" . $email ."','" . $username . "', '" . $hashed_password . "')";

            //checks to see if the query is successful
            if($conn->query($insert) === TRUE) {
              echo '<div class="alert alert-success" role="alert"> <strong>Success</strong> Your account was successfully created! </div>';
            }
            //in case it wasn't
            else {
              echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> There was an error! </div>';
            }
          }
          //in case the passwords do not match
          else {
            echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> Passwords must match! </div>';
          }
        }
        include 'footer.php';
      ?>
    </div>
  </body>
</html>
