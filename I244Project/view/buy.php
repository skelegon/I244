<?php
$items = show_buy();
foreach($items as $key => $value){
  echo '<img src="'.$value[6].'" alt="" />'."<br />";
}
?>
