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
      <textarea name="input" rows="3" cols="20" placeholder="Sisesta tekst"><?php if(isset($_POST['input'])){ echo htmlspecialchars($_POST['input']); } ?></textarea><br>
      <input type="color" name="taustavarv" value="<?php if(isset($_POST['taustavarv'])){ echo htmlspecialchars($_POST['taustavarv']); } ?>">Taustavärvus<br>
      <input type="color" name="tekstivarv" value="<?php if(isset($_POST['tekstivarv'])){ echo htmlspecialchars($_POST['tekstivarv']); } ?>">Tekstivärvus<br>

      Piirjoon<br>
        <input type="number" name="piirjooneLaius" value="<?php if(isset($_POST['piirjooneLaius'])){ echo htmlspecialchars($_POST['piirjooneLaius']); } ?>"min="0" max="20"> Piirjoone laius<br>
        <select name="piirjooneTyyp">
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'none'){ echo ' selected = "selected" ';} ?>>none</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'dotted'){ echo ' selected = "selected" ';} ?>>dotted</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'dashed'){ echo ' selected = "selected" ';} ?>>dashed</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'solid'){ echo ' selected = "selected" ';} ?>>solid</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'double'){ echo ' selected = "selected" ';} ?>>double</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'groove'){ echo ' selected = "selected" ';} ?>>groove</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'ridge'){ echo ' selected = "selected" ';} ?>>ridge</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'inset'){ echo ' selected = "selected" ';} ?>>inset</option>
          <option <?php if(isset($_POST['piirjooneTyyp']) && $_POST['piirjooneTyyp'] == 'outset'){ echo ' selected = "selected" ';} ?>>outset</option>
        </select><br>
        <input type="color" name="piirjooneVarvus" value="<?php if(isset($_POST['piirjooneVarvus'])){ echo htmlspecialchars($_POST['piirjooneVarvus']); } ?>">Piirjoone värvus<br>
        <input type="number" name="nurgaRaadius" value="<?php if(isset($_POST['nurgaRaadius'])){ echo htmlspecialchars($_POST['nurgaRaadius']); } ?>" min="0" max="100">Piirjoone nurga raadius(0-100px)<br>
        <input type="submit" value="esita">
    </form>
  </div>
</body>
</hmtl>
