<?php
  $users = show_usrs();
  foreach($users as $key => $value){
    echo 'Kasutaja: '.$value[1].'</br>';
    echo 'Eesnimi: '.$value[6].'</br>';
    echo 'Perekonnanimi: '.$value[7].'</br>';
  }
?>
