
  <?php
  if(isset($_GET['msg'])){
    $message = "";
    if($_GET['msg']=="upload"){
      $message = "Pildi lisamine õnnestus.";
    } else if ($_GET['msg']=="change"){
      $message = "Pildi muutmine õnnestus.";
    }
    echo '<div style="border:1px solid #000; background:#BCE954; padding:5px;margin-bottom:10px">'.$message.'</div>';
  }
  ?>
  <div id="images">
    <?php
      foreach (kuva_pildid() as $pilt){
        echo '<a href="?mode=pilt&id='.$pilt['id'].'"><img src="'.$pilt['thumb'].'" alt="'.$pilt['pealkiri'].'" /></a>' . "\n";
      }
    ?>

    <!--
    <a href="?mode=pilt&id=0">
      <img src="Pictures\Thumbnails\t1.jpg" alt="Autor: Tundmatu  Pealkiri: Kass1">
    </a>
    <a href="?mode=pilt&id=1">
      <img src="Pictures\Thumbnails\t2.jpg" alt="Autor: Tundmatu  Pealkiri: Kass2">
    </a>
    <a href="?mode=pilt&id=2">
      <img src="Pictures\Thumbnails\t3.jpg" alt="Autor: Tundmatu  Pealkiri: Kass3">
    </a>
    <a href="?mode=pilt&id=3">
      <img src="Pictures\Thumbnails\t4.jpg" alt="Autor: Tundmatu  Pealkiri: Kass4">
    </a>
    <a href="?mode=pilt&id=4">
      <img src="Pictures\Thumbnails\t5.jpg" alt="Autor: Tundmatu  Pealkiri: Kass5">
    </a>
    <a href="?mode=pilt&id=5">
      <img src="Pictures\Thumbnails\t6.jpg" alt="Autor: Tundmatu  Pealkiri: Kass6">
    </a>
    <a href="?mode=pilt&id=6">
      <img src="Pictures\Thumbnails\t7.jpg" alt="Autor: Tundmatu  Pealkiri: Kass7">
    </a>
  -->
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
