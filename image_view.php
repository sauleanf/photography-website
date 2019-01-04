<!DOCTYPE html>
<!-- FOR DISPLAYING INDIVIDUAL IMAGES (FOR SHARING) -->
<html>
  <head>
    <?php
      include 'head.php';
    ?>
  </head>
  <body>
    <div class="image-view-container center">
      <?php
        //site's url
        $site = 'localhost/photography_site/';

        //tries to make the connection
        $conn = new mysqli($db_server, $db_username, $db_password, $db_name) or die("could not connect");

        //gets the id of the image from the url
        $image_id = $_GET['id'];

        //select sql statement
        $select = "SELECT * FROM image_table WHERE id=$image_id";

        //makes the query and gets ONE row
        $result = $conn->query($select) or die($conn->error);

        //gets the row as an array
        $row = $result->fetch_assoc();

        //index is the id of the row
        $index = $row['id'];

        //image_caption is the title
        $image_caption = $row['title'];
      ?>
      <div id='view-image-container'>
        <div class="image-view-box-parent">
          <div class="share-view-container translate-down">
            <?php
              //for sharing on twitter
              $share_link = "Check this out! $site/image_view?id=" . $row['id'];
              $replace = str_replace(' ', '%20', $share_link );
              $tweet_link = "https://twitter.com/intent/tweet?text=" . $replace;
            ?>
            <a href="<?php echo $tweet_link; ?>" class="view-a twitter" data-show-count="false">
              Tweet
            </a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            <a class="view-a instagram">
              Instagram
            </a>
            <a class="view-a youtube">
              Youtube
            </a>
          </div>
          <img src="<?php echo 'image_display?id=' . $index; ?>" class='image-view-box'>
          <div class="hover-image">
            <p class="translate-up view-p">
              <?php
                echo $image_caption;
              ?>
            </p>
            <a class='home-btn translate-up' href="/photography-website"> </a>
          </div>
        </div>
      </div>
      <?php
        include 'footer.php';
      ?>
    </div>
  </body>
</html>
