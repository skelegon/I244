<?php

$pildid = array(
  array('big'=>'Pictures\1.jpg', 'small'=>'Pictures\Thumbnails\t1.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass1'),
  array('big'=>'Pictures\2.jpg', 'small'=>'Pictures\Thumbnails\t2.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass2'),
  array('big'=>'Pictures\3.jpg', 'small'=>'Pictures\Thumbnails\t3.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass3'),
  array('big'=>'Pictures\4.jpg', 'small'=>'Pictures\Thumbnails\t4.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass4'),
  array('big'=>'Pictures\5.jpg', 'small'=>'Pictures\Thumbnails\t5.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass5'),
  array('big'=>'Pictures\6.jpg', 'small'=>'Pictures\Thumbnails\t6.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass6'),
  array('big'=>'Pictures\7.jpg', 'small'=>'Pictures\Thumbnails\t7.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass7')
);


include_once('view/head.html');
if (isset($_GET["mode"])) {
  switch($_GET["mode"]) {
    case "pealeht":
      include ('view/Praktikum4.html'); break;
    case "galeriivaade":
      include ('view/Praktikum4_2.php'); break;
    case "logisisse":
      include ('view/Praktikum4_4.html'); break;
    case "registreeri":
      include ('view/Praktikum4_5.html'); break;
    case "pilt":
      if (isset($_GET["id"])) {
        $id = $_GET["id"];
        if(!is_numeric($id) || $id > count($pildid) || $id < 0){
          $id = 0;
        } else {
          $pilt = $pildid[$id];
          include ('view/pilt.html');
        }
      }

    default:
      include ('view/Praktikum4.html'); break;
  }
} else {
  include ('view/Praktikum4.html');
}
include_once('view/foot.html');

?>
