<!-- CONTAIN THE ELEMENT FOR THE NAVBAR -->
<div class="pos-f-t">
  <nav class="navbar navbar-light bg-light">
    <button class="navbar-toggler block-center custom-toggler" type="button" data-toggle="collapse" data-target="#navbarOptions" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="collapse" id="navbarOptions">
    <div class="bg-light p-4">
      <h4 class="text-black"> Options </h4>
      <div class="flex-row">
        <?php
          //for the navlinks
          $status = "login";
          $href = "";
          $text = "Home";

          //checks to see if the page isn't the dashboard so it can render specific elements
          if($_SERVER['REQUEST_URI'] !== '/photography_site/dashboard') {
            $href = "/dashboard";
            $text = "Dashboard";
          }

          //used for the link and settings (if there is no session, they remain with no characters)
          $link = "";
          $settings = "";
          $register = "<a class='anchor-navbar' href='register'> Register </a>";
          
          //checks to see if there is a session
          if(isset($_SESSION['username']))   {
            $status = "logout";
            $settings = "<a class='anchor-navbar' href='setting'> Settings </a>";
            $link = "<a class='anchor-navbar' href='/photography_site" . $href . "'> " . $text . " </a>";
            $register = "";
          }
          //the navlink to the settings
          echo $link .  $settings . "<a class='anchor-navbar' href='/photography_site/$status'>" . ucfirst($status) . "</a>" . $register;
        ?>
      </div>
    </div>
  </div>
</div>
