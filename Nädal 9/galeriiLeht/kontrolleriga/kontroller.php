<?php
require_once('head.html');

$pildid = array(
	array('big'=>'pildid/nameless1.jpg', 'alt'=>'nimetu 1', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless2.jpg', 'alt'=>'nimetu 2', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless3.jpg', 'alt'=>'nimetu 3', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless4.jpg', 'alt'=>'nimetu 4', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless5.jpg', 'alt'=>'nimetu 5', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless6.jpg', 'alt'=>'nimetu 6', 'height'=>'100', 'name'=>'pilt')
);


if (isset($_GET["nimi"])) {
  switch($_GET["nimi"]) {
    case "pealeht":
      include ("pealeht.html");
      break;
    case "galerii":
      include ("galerii.html");
      break;
    case "haaletamine":
      include ("vote.html");
      break;
    case "tulemus":
      include ("tulemus.php");
      break;
    default:
      include ("pealeht.html");
      break;
  }
} else {
  include ("pealeht.html");
}

require_once('foot.html');
?>
