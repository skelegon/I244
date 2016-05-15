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
  <div>
    <span id="time"></span>
    <a href="http://validator.w3.org/check?uri=referer">
    <span style="background:url('http://www.w3.org/Icons/valid-xhtml10')" class="validatorlogo"></span>
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <span style="background:url('http://jigsaw.w3.org/css-validator/images/vcss')" class="validatorlogo"></span>
    </a>
  </div>
  <div><?="Visits: " . $counter;?></div>
</footer>
</body>
</html>
