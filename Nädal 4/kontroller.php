<?php

require_once("functions.php");

if (isset($_GET["mode"])) {
  switch($_GET["mode"]) {
    case "pealeht":
      kuva_pealeht();
      break;
    case "galeriivaade":
      kuva_galeriivaade();
      break;
    case "logisisse":
      kuva_logisisse();
      break;
    case "registreeri":
      kuva_registreeri();
      break;
    case "pilt":
      kuva_pilt();
      break;
    default:
      kuva_default();
  }
} else {
  kuva_default();
}
?>
