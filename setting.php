<!DOCTYPE html>
<!-- RENDERS THE SETTINGS FOR THE ADMIN USER -->
<?php
  //initializes the session
  ob_start();
  session_start();
?>
<html>
  <?php
    include 'head.php';
  ?>
  <body>
    <div>
      <div class="full-window">
        <form method="post" class="form-box">
          <div class="form-group">
            <label for="inputUsername">
              New Username
            </label>
            <input name="username" type="text" class="form-control" id="inputUsername" placeholder="Enter new username">
          </div>
          <div class="form-group">
            <label for="inputPassword1">New Password</label>
            <input name="password1" type="text" class="form-control" id="inputPassword1" placeholder="Enter new password">
          </div>
          <div class="form-group">
            <label for="inputPassword2"> New Password </label>
            <input name="password2" type="text" class="form-control" id="inputPassword2" placeholder="Retype new password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
      <?php
        //checks for a session
        if(isset($_SESSION['username'])) {
            //checks to see if the HTTP request method is a post
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //login credentials for the mysql database
            $db_server = 'localhost:3308';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'php_project';

            //tries to make the connection
            $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

            //hashes the password so that it isn't stored as in plaintext
            $password_hashed = password_hash($_POST['password1'], PASSWORD_DEFAULT);

            //gets the username from the session
            $session_username = $_SESSION['username'];

            /*checks to see if the passwords equal one another and if the username is empty
            (makes sure that password is being reset) */
            if($_POST['password1'] === $_POST['password2'] && $_POST['username'] === "") {

              //sql for the update statement
              $update = "UPDATE users SET password='$password_hashed' WHERE username='$session_username'";

              //checks to see if the query is successful (uses bootstrap alerts)
              if($conn->query($update) === TRUE) {
                echo '<br> <div class="alert alert-success" role="alert"> <strong>Success</strong> Your settings were changed! </div>';
              }
              else {
                echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> There was an error! </div>';
              }
            }
            //in case the passwords do not equal one another
            else if($_POST['password1'] !== $_POST['password2'])  {
              echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> Passwords must match! </div>';
            }
            //for resetting the username instead of the password
            else {
              //gets the session id (easy since there is only one user: the website maintainer)
              $session_id = 1;

              //gets the new username from the post request (form input field)
              $passed_username = $_POST['username'];

              //sql statement for the update
              $update = "UPDATE users SET username='$passed_username' WHERE id='$session_id'";

              //checks to see if the query was successful
              if($conn->query($update) === TRUE) {
                echo '<div class="alert alert-success" role="alert"> <strong>Success</strong> Your username is now ' . $passed_username .' </div>';
              }
              //in case it wasn't
              else {
                echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> There was an error! </div>';
              }
            }
          }
        }
        //redirects the visitor to the login page if the visitor is not signed in
        else {
          header('Location: login');
        }

        include 'footer.php';
      ?>
      </div>
    </div>
  </body>
</html>
