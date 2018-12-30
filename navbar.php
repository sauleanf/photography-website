<div class="pos-f-t">
  <nav class="navbar navbar-light bg-light">
    <button class="navbar-toggler block-center custom-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-light p-4">
      <h4 class="text-black"> Options </h4>
      <div class="flex-row">
        <?php
          $status = "login";
          $href = "";
          $text = "Home";
          if($_SERVER['REQUEST_URI'] !== '/php_project/dashboard') {
            $href = "/dashboard";
            $text = "Dashboard";
          }
          $link = "";
          $settings = "";
          if(isset($_SESSION['username']))   {
            $status = "logout";
            $settings = "<a class='anchor-navbar' href='/php_project/setting'> Settings </a>";
            $link = "<a class='anchor-navbar' href='/php_project" . $href . "'> " . $text . " </a>";
          }
          echo $link ."<a class='anchor-navbar' href='$status'>" . ucfirst($status) . "</a>" . $settings;
        ?>
      </div>
    </div>
  </div>
</div>

<!-- <div class="navbar-custom">
  <nav class="navbar navbar-light bg-light">
    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="collapse" id="navbarContent">
    <div class="bg-light p-4">
      <h4 class="text-black"> Options </h4>
      <a class="anchor-navbar" href="login">
        <span>
          Login
        </span>
      </a>
    </div>
  </div>
</div> -->
