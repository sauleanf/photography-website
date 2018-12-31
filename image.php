<div class="card-image">
  <?php
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"  class="image-box" data-toggle="modal" data-target="#m' . $index . '"';
  ?>
  <br>

  <p>
    <?php
      echo $image_caption;
    ?>
  </p>
  <div class="tag-strip">
    <?php
      if($row['parkour'] === '0') {
        echo '<button class="btn btn-primary btn-margin"> Parkour </button>';
      }
      if($row['photography'] === '0') {
        echo '<button class="btn btn-primary "> Photography </button>';
      }
    ?>
  </div>

<!-- Modal -->
<div class="modal fade" id="<?php echo "m" . $index;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <br>
      <div class="modal-title-container">
        <h5 class="modal-title text-white">
          <?php echo $image_caption; ?>
        </h5>
        <button class="close-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <br>
      <div class="modal-box">
        <?php
          echo "<img id='$index' src='image_display?id=$index' class='image-box-modal' href='/php_project'>";
        ?>
        <div class="modal-share">
          <p class="modal-p"> Share </p>
          <a class="modal-a twitter">
            Twitter
          </a>
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
