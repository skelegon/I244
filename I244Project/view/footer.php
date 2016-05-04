</div>

<?php
$file = fopen("view/counts.txt", "r");

if(!$file){
  echo "ei saanud faili avada";
} else {
  $counter = (int)fread($file, 20);
  fclose($file);
  $counter++;

  $handle = fopen("view/counts.txt", "w");
  fwrite($handle, $counter);
  fclose($handle);
}
?>

<footer class="container-fluid text-center">
  <div id="time"></div>
  <div><?="Visits: " . $counter;?></div>
</footer>
</body>
</html>
