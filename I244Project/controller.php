<?php
  require_once("functions.php");
  connect_db();
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
        if(isset($_SESSION['username'])){
        //logi();
        show_index();
      } else {
        show_login();
      }
        break;
      case "logout":
        logout();
        end_session();
        show_index();
        break;
      case "register":
        register();
        break;
      case "addproduct":
        show_addproduct();
        break;
      case "buy":
        include_once("view/buy.php");
        break;
      default:
        show_default();
        break;
    }
  } else {
    show_default();
  }
  ?>
