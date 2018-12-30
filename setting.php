<?php
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
        if(isset($_SESSION['username'])) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //login credentials for the mysql database
            $db_server = 'localhost:3308';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'php_project';

            //tries to make the connection
            $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

            $password_hashed = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $session_username = $_SESSION['username'];

            if($_POST['password1'] === $_POST['password2'] && $_POST['username'] === "") {
              $update = "UPDATE users SET password='$password_hashed' WHERE username='$session_username'";
              if($conn->query($update) === TRUE) {
                echo '<br> <div class="alert alert-success" role="alert"> <strong>Success</strong> Your settings were changed! </div>';
              }
              else {
                echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> There was an error! </div>';
              }
            }
            else if($_POST['password1'] !== $_POST['password2'])  {
              echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> Passwords must match! </div>';
            }
            else {
              $session_id = 1;
              $passed_username = $_POST['username'];
              $update = "UPDATE users SET username='$passed_username' WHERE id='$session_id'";

              if($conn->query($update) === TRUE) {
                echo '<div class="alert alert-success" role="alert"> <strong>Success</strong> Your username is now ' . $passed_username .' </div>';
              }
              else {
                echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> There was an error! </div>';
              }
            }
          }
        }
        else {
          header('Location: http://localhost/php_project/login');
        }

        include 'footer.php';
      ?>
      </div>
    </div>
  </body>
</html>
