<?php

require_once("functions.php");
alusta_sessioon();
connect_db();

if (isset($_GET["mode"])) {
  switch($_GET["mode"]) {
    case "pealeht":
      kuva_pealeht();
      break;
    case "galeriivaade":
      kuva_galeriivaade();
      break;
    case "logisisse":
      if(isset($_SESSION['user'])){
      kuva_galeriivaade();
    } else {
      kuva_logisisse();
    }
      break;
    case "registreeri":
      kuva_registreeri();
      break;
    case "pilt":
      kuva_pilt();
      break;
    case "logivalja":
      lopeta_sessioon();
      kuva_pealeht();
      break;
    case "pildivorm":
      kuva_pildivorm();
      break;
    default:
      kuva_default();
  }
} else {
  kuva_default();
}
?>
