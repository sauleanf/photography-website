<!-- CONTAIN THE ELEMENT FOR THE IMAGES ON THE HOME PAGE -->
<div class="card-image">
  <?php
    //renders the image (gets the value from the sql table)
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"  class="image-box" data-toggle="modal" data-target="#m' . $row['id'] . '"';
  ?>
  <br>
  <input type="hidden" value="<?php echo $row['parkour'] . $row['photography'] . "0"; ?>">
  <p>
    <?php
      $index = $row['id'];
      echo $row['title'];
    ?>
  </p>
  <div class="tag-strip">
    <?php
      //gets the tags for each image (weird bug with the boolean values 1 is false and 0 is true for some reason)
      if($row['parkour'] === '0') {
        echo '<span class="badge badge-secondary">Parkour</span>';
      }
      if($row['photography'] === '0') {
        echo '<span class="badge badge-secondary">Photography</span>';
      }
    ?>
  </div>
  <div class="modal fade" id="<?php echo "m" . $index;?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <br>
        <div class="modal-title-container">
          <h5 class="modal-title text-white">
            <?php
              //title of image
              echo $row['title'];
            ?>
          </h5>
          <button class="close-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <br>
        <div class="modal-box">
          <?php
            //for the image display in the image
            echo "<img id='$index' src='image_display?id=$index' class='image-box-modal' href='/photography_site'>";
          ?>
          <div class="modal-share">
            <p class="modal-p"> Share </p>
            <?php
              //for sharing on twitter
              $share_link = "Check this out! $site/image_view?id=" . $row['id'];
              $replace = str_replace(' ', '%20', $share_link );
              $tweet_link = "https://twitter.com/intent/tweet?text=" . $replace;
            ?>
            <a href="<?php echo $tweet_link; ?>" class="modal-a twitter" data-show-count="false">
              Tweet
            </a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            <a class="modal-a instagram">
              Instagram
            </a>
            <a class="modal-a youtube">
              Youtube
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
