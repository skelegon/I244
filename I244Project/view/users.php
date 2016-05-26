<?php

if(isset($_GET['mod'])){
  $message = suspend_user($_GET['mod']);
  echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
}
  $users = show_usrs();
  foreach($users as $key => $value){
    echo 'Kasutaja: '.$value[1].'</br>';
    echo 'Eesnimi: '.$value[6].'</br>';
    echo 'Perekonnanimi: '.$value[7].'</br>';

    echo '<div class ="controls">';
    if ($value[12] == 1) {
      echo '<a href="controller.php?mode=users&mod='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:green">Suspend</a></br>';
    } else {
      echo '<a href="controller.php?mode=users&mod='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:red">Un-suspend</a></br>';
    }
    echo '</div>';

  }
?>
