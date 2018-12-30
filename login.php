<?php
  ob_start();
  session_start();
?>
<html>
  <?php
    include 'head.php';
  ?>
  <body>
    <div class="full-window">
      <form method="post" class="form-box">
        <div class="form-group">
          <label for="inputUsername">Username</label>
          <input name="username" type="text" class="form-control" id="inputUsername" placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
      </form>
      <?php
        //login credentials for the mysql database
        $db_server = 'localhost:3308';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'php_project';

        //tries to make the connection
        $conn = new mysqli($db_server, $db_username, $db_password, $db_name);

        if($conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        //checks to see if the request is a post
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

          //verifies that the fields aren't empty
          if(!empty($_POST['username']) && !empty($_POST['password'])) {

            //gets the username from the form field (post)
            $username = $_POST['username'];

            //queries the db to find the user
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql);

            //gets the row from the db as an object
            $row = $result->fetch_assoc();

            //hashes the password entered
            $password = $_POST['password'];

            //checks to see if the hashed password matches the hashed one in the db
            if (password_verify($password, $row['password'])) {

              //starts a session
              $_SESSION['valid'] = true;
              $_SESSION['timeout'] = time();
              $_SESSION['username'] = $username;

              //redirects to the home page
              header('Location: http://localhost/php_project/dashboard');
            }
            //in case the password and/or username is wrong
            else {
              echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> Your login credentials were wrong! </div>';
            }
          }
          //in case the fields are empty
          else {
            echo '<br> <div class="alert alert-danger" role="alert"> <strong>Error</strong> One of the fields is the empty! </div>';
          }
        }
        include 'footer.php';
      ?>
    </div>
  </body>
</html>
