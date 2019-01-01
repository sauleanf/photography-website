<!-- CONTAIN THE ELEMENT FOR THE FOOTER -->
<div class="footer">
  <?php
    //for sharing on twitter
    $share_link = "Check this out!";
    $replace = str_replace(' ', '%20', $share_link );
    $tweet_link = "https://twitter.com/intent/tweet?text=" . $replace;
  ?>
  <a href="<?php echo $tweet_link; ?>" class="footer-a twitter" data-show-count="false">
    Tweet
  </a>
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  <a class="footer-a instagram">
    Instagram
  </a>
  <a class="footer-a youtube">
    Youtube
  </a>
</div>
