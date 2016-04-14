<?php

function kuva_pealeht () {
  include('view/head.html');
  include ('view/Praktikum4.html');
  include('view/foot.html');
}

function kuva_galeriivaade () {
  include('view/head.html');
  include ('view/Praktikum4_2.php');
  include('view/foot.html');
}

function kuva_logisisse() {

  if(!empty($_POST)) {
      $errors=array();
      if(!empty($_POST["kasutajanimi"])){
        echo $_POST["kasutajanimi"];
      } else {
        $error[]="kasutajanimi sisestamata!";
      }

      if(!empty($_POST["parool"])){
        echo "2";
      } else {
        $error[]="parool sisestamata!";
      }
  }

  if (empty($errors)) {
    // kõik OK
    echo "kõik ok";
  }

  include('view/head.html');
  include ('view/Praktikum4_4.php');
  include('view/foot.html');

}

function kuva_registreeri() {
  include('view/head.html');
  include ('view/Praktikum4_5.html');
  include('view/foot.html');
}

function kuva_pilt() {

  $pildid = array(
    array('big'=>'Pictures/1.jpg', 'small'=>'Pictures/Thumbnails/t1.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass1'),
    array('big'=>'Pictures/2.jpg', 'small'=>'Pictures/Thumbnails/t2.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass2'),
    array('big'=>'Pictures/3.jpg', 'small'=>'Pictures/Thumbnails/t3.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass3'),
    array('big'=>'Pictures/4.jpg', 'small'=>'Pictures/Thumbnails/t4.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass4'),
    array('big'=>'Pictures/5.jpg', 'small'=>'Pictures/Thumbnails/t5.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass5'),
    array('big'=>'Pictures/6.jpg', 'small'=>'Pictures/Thumbnails/t6.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass6'),
    array('big'=>'Pictures/7.jpg', 'small'=>'Pictures/Thumbnails/t7.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass7')
  );

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if(!is_numeric($id) || $id > count($pildid) || $id < 0){
        $id = 0;
      } else {
        $pilt = $pildid[$id];
        if ($id >= 1){
          $eelmine = $id-1;
        } else {
          $eelmine = $id;
        }
        if ($id < count($pildid)-1) {
          $jargmine = $id+1;
        } else {
          $jargmine = $id;
        }
        include ('view/pilt.html');
    }
  }
}

function kuva_default() {
  include('view/head.html');
  include ('view/Praktikum4.html');
  include('view/foot.html');
}



?>
