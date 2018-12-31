<html>
<head>
  <?php
    include 'head.php';
  ?>
</head>
<body>
  <div class="main-container center">
  <?php
    //login credentials for the mysql database
    $db_server = 'localhost:3308';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'php_project';

    //tries to make the connection
    $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");
    $image_id = $_GET['id'];
    $select = "SELECT * FROM image_table WHERE id=$image_id";

    $result = $conn->query($select) or die($conn->error);

    $row = $result->fetch_assoc();
    $index = $row['id'];
    $image_caption = $row['title'];
  ?>
  <a class='home-btn' href="/php_project"> </a>
  <img src="<?php echo 'image_display?id=' . $index; ?>" class='image-box' data-toggle="modal" data-target="#<?php echo "m" . $index;?>">
  <br>
  <p> <?php echo $image_caption; ?> </p>
  </div>
</body>
</html>
