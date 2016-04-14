<?php
  require_once("functions.php");

  include_once('view/head.html');
  if (isset($_GET["mode"])) {
    switch($_GET["mode"]) {
      case "home":
        include ('view/home.html');
        break;
      case "view":
        include ('view/view.html');
        break;
      case "control":
        include ('view/control.html');
        break;
      case "edit":
        include ('view/edit.html');
        break;
      case "users":
        include ('view/users.html');
        break;
      default:
        include ('view/home.html');
      }
  } else {
    include ('view/home.html');
  }
  include_once('view/foot.html');
?>
