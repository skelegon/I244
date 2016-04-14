<?php

/**
* Guest counter
*/
function questCounter() {
  $file = fopen("counts.txt", "r");
  if(!$file){
    echo "ei saanud faili avada";
  } else {
    $counter = (int)fread($file, 20);
    fclose($file);
    $counter++;
    $handle = fopen("counts.txt", "w");
    fwrite($handle, $counter);
    fclose($handle);
  }
  return $counter;
}

?>
