<?php
if(isset($_GET['del'])){
  $message = product_status($_GET['del']);
  echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
}

  $items = list_all_items();
  echo '<table>';
  foreach($items as $value){
    $color = "blue";
    $label = "Cancelled by user";
    if($value[14] == 2){
      $color = "green";
      $label = "Un-suspend";
    } else if ($value[14] == 1){
      $color = "red";
      $label = "Suspend";
    }
    echo '<tr><td>'.$value[1].'</td><td><a href="controller.php?mode=allitems&del='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:'.$color.'">'.$label.'</a></td></tr>'."\n";
  }
  echo '</table>';
?>
