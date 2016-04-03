<?php

$kassid= array(
		array('nimi'=>'Miisu', 'vanus'=>2, 'karva värv'=>'Punane', 'omanik'=>'Ralf', 'pilt'=>'Pictures/Thumbnails/t2.jpg'),
		array('nimi'=>'Tom', 'vanus'=>1, 'karva värv'=>'Hall', 'omanik'=>'Kati', 'pilt'=>'Pictures/Thumbnails/t4.jpg'),
  	array('nimi'=>'Liisu', 'vanus'=>4, 'karva värv'=>'Valge', 'omanik'=>'Mihkel', 'pilt'=>'Pictures/Thumbnails/t5.jpg'),
		array('nimi'=>'Vissi', 'vanus'=>1, 'karva värv'=>'Hall', 'omanik'=>'Laura', 'pilt'=>'Pictures/Thumbnails/t6.jpg')
  );
  foreach ($kassid as $kass) {
      include 'kass.html';
  };

?>
