<div id="images">
<?php
  foreach ($pildid as $pilt){
    echo '<a href="'.$pilt['big'].'"><img src="'.$pilt['small'].'" alt="'.$pilt['alt'].'" /></a>' . "\n";
  }
?>
</div>
<div id="hoidja" style="display:none;">
    <div id="taust"></div>
    <div id="tabel">
        <div id="cell">
            <div id="sulge" onclick="hideDetails();">Sulge</div>
            <div id="sisu">
                <img id="suurpilt" src="Pictures/sign.jpg" alt="ajutine"/><br/>
                <span id="inf"></span>
            </div>
        </div>
    </div>
</div>
