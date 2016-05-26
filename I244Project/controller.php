<?php
  require_once("functions.php");
  connect_db();
  start_session();


  if (isset($_GET["mode"])) {
    switch($_GET["mode"]) {
      case "home":
        show_index();
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
      case "item":
        view_item();
        break;
      case "notifications":
        show_notifications();
        break;
      case "register":
        register();
        break;
      case "addproduct":
        show_addproduct();
        break;
      case "myproducts":
          show_myproducts();
          break;
      case "addpictures":
        show_addpictures();
        break;
      case "buy":
        show_buy();
        break;
      case "traderequests":
        show_requests();
        break;
      case "allitems":
        show_allitems();
        break;
      default:
        show_default();
        break;
    }
  } else {
    show_default();
  }
  ?>
