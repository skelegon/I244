<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Kodune ülesanne - 8. nädal</title>

    <?php

    $text="input";
    if (isset($_POST["input"]) && $_POST["input"]!="") {
        $text=htmlspecialchars($_POST["input"]);
    }

    $bg_col="#fff";
    if (isset($_POST['taustavarv']) && $_POST['taustavarv']!="") {
        $bg_col=htmlspecialchars($_POST['taustavarv']);
    }

    $txt_col="#000";
    if (isset($_POST['tekstivarv']) && $_POST['tekstivarv']!="") {
        $txt_col=htmlspecialchars($_POST['tekstivarv']);
    }

    $brd_wdth="2px";
    if (isset($_POST['piirjooneLaius']) && $_POST['piirjooneLaius']!="") {
        $brd_wdth=htmlspecialchars($_POST['piirjooneLaius']);
    }

    $brd_style="solid";
    if (isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp']!="") {
        $brd_style=htmlspecialchars($_POST['piirjooneTyyp']);
    }

    $brd_clr="#000";
    if (isset($_POST['piirjooneVarvus']) && $_POST['piirjooneVarvus']!="") {
        $brd_clr=htmlspecialchars($_POST['piirjooneVarvus']);
    }

    $arc_r="0px";
    if (isset($_POST['nurgaRaadius']) && $_POST['nurgaRaadius']!="") {
        $arc_r=htmlspecialchars($_POST['nurgaRaadius']);
    }
    ?>

    <style>
        #ekraan {
          height: 50px;
          width: 200px;
          margin-bottom: 50px;
          background-color: <?php echo $bg_col; ?>;
          color: <?php echo $txt_col; ?>;
          border-width: <?php echo $brd_wdth ?>;
          border-style: <?php echo $brd_style; ?>;
          border-color: <?php echo $brd_clr; ?>;
          border-radius: <?php echo $arc_r; ?>;
        }
    </style>
	</head>

<body>
  <div id = ekraan>
    <?php echo $text; ?>
  </div>

  <div>
    <form method="post" name="form">
      <textarea name="input" rows="3" cols="20" placeholder="Sisesta tekst"></textarea><br>
      <input type="color" name="taustavarv" value="#ffffff">Taustavärvus<br>
      <input type="color" name="tekstivarv" value="#000000">Tekstivärvus<br>

      Piirjoon<br>
        <input type="number" name="piirjooneLaius" min="0" max="20"> Piirjoone laius<br>
        <select name="piirjooneTyyp">
          <option value ="none">none</option>
          <option value ="dotted">dotted</option>
          <option value ="dashed">dashed</option>
          <option value ="solid">solid</option>
          <option value ="double">double</option>
          <option value ="groove">groove</option>
          <option value ="ridge">ridge</option>
          <option value ="inset">inset</option>
          <option value ="outset">outset</option>
        </select><br>
        <input type="color" name="piirjooneVarvus" value="#ffffff">Piirjoone värvus<br>
        <input type="number" name="nurgaRaadius" min="0" max="100">Piirjoone nurga raadius(0-100px)<br>
        <input type="submit" value="esita">
    </form>
  </div>
</body>
</hmtl>
