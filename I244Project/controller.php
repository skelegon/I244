<?php
  require_once("functions.php");
  start_session();

  if (isset($_GET["mode"])) {
    switch($_GET["mode"]) {
      case "home":
        show_index();
        break;
      case "input":
        show_input();
        break;
      case "output":
        show_output();
        break;
      case "users":
        show_users();
        break;
      case "about":
        show_about();
        break;
      case "login":
        if(isset($_SESSION['user'])){
        show_index();
      } else {
        show_login();
      }
        break;
      case "logout":
        end_session();
        show_index();
        break;
      default:
        show_default();
    }
  } else {
    show_default();
  }
  ?>
