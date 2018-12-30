<div class="card-image">
  <img src="<?php echo $image_link; ?>" class='image-box' data-toggle="modal" data-target="#<?php echo $index;?>">
  <p>
    <?php
      echo $image_caption;
    ?>
  </p>
  <div class="tag-strip">
    <?php
      if($row['parkour'] === '0') {
        echo '<button class="btn btn-primary"> Parkour </button>';
      }
      if($row['photography'] === '0') {
        echo '<button class="btn btn-primary"> Photography </button>';
      }
    ?>
  </div>

<!-- Modal -->
<div class="modal fade" id="<?php echo $index;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-white"><?php echo $image_caption;?></h5>
        <button class="close-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          echo "<img src=" . $image_link . " class='image-box-modal'>";
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
