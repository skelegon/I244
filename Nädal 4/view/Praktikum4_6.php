<?php
$pealkiri = "";
$autor = "";
$id = "none";
if(isset($_GET["id"]) && $_GET['id'] != "none"){
  $pildi_info = hangi_pildi_info($_GET["id"]);
  if(!empty($pildi_info)){
    $pealkiri = htmlspecialchars($pildi_info['pealkiri']);
    $autor = htmlspecialchars($pildi_info['autor']);
    $id = $pildi_info['id'];
  }
}

function upload($name, $loc){
  $allowedExts = array("jpg", "jpeg", "gif", "png");
  $allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
  $extension = end((explode(".", $_FILES[$name]["name"])));

  if ( in_array($_FILES[$name]["type"], $allowedTypes)
   && ($_FILES[$name]["size"] < 100000) // see on 100kb
   && in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
    if ($_FILES[$name]["error"] > 0) {
      return "";
    } else {
      // vigu ei ole
      if (file_exists($loc."/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
        return $_FILES[$name]["name"];
      } else {
        // kõik ok, aseta pilt
        move_uploaded_file($_FILES[$name]["tmp_name"], $loc."/" . $_FILES[$name]["name"]);
        return $_FILES[$name]["name"];
      }
    }
  } else {
    return "";
  }
}

	global $connection;

	$errors=array();
	if (!empty($_POST)){
    //$pilt="Pictures/".$_POST["pic"];
		if (empty($_POST["autor"])) {
			$errors[]="autor kohustuslik";
		}
		if (empty($_POST["pealkiri"])) {
			$errors[]="pealkiri kohustuslik";
		}
		if (empty($_FILES["pic"]["name"])) {
			$errors[]="pilt kohustuslik";
		}
		if (empty($_FILES["tmb"]["name"])) {
			$errors[]="thumbnail kohustuslik";
		}
		if (empty($errors)){
      $autor=mysqli_real_escape_string($connection, $_POST["autor"]);
      $pealkiri=mysqli_real_escape_string($connection, $_POST["pealkiri"]);
      $p = mysqli_real_escape_string($connection, upload("pic", "Pictures/"));
      $t = mysqli_real_escape_string($connection, upload("tmb", "Pictures/Thumbnails/"));

      if(!empty($p) && !empty($t)){
        if(isset($_GET['id']) && $_GET['id'] != "none"){
          $sql = "UPDATE 10153316_pildid SET thumb='Pictures/Thumbnails/".$t."', pilt='Pictures/".$p."', pealkiri='".$pealkiri."', autor='".$autor."'  WHERE id=".$_GET['id']."";
          $result = mysqli_query($connection, $sql);
          var_dump(mysqli_error($connection));
          if ($result) {
            //kuva_galeriivaade();
            header('Location: kontroller.php?mode=galeriivaade&msg=change');
          } else {
            echo "Pildi muutmine ebaõnnestus.";
          }
        } else {
          $sql = "INSERT INTO 10153316_pildid (thumb, pilt, pealkiri, autor) VALUES ('Pictures/Thumbnails/".$t."', 'Pictures/".$p."', '$pealkiri', '$autor')";
    			$result = mysqli_query($connection, $sql);
          if ($result) {
            //kuva_galeriivaade();
            header('Location: kontroller.php?mode=galeriivaade&msg=upload');
          } else {
            echo "Pildi üleslaadimine ebaõnnestus.";
          }
        }

      } else {
        echo "Pildi üleslaadimine ebaõnnestus.";
      }

      /*
			$sql = "INSERT INTO 10153316_pildid (thumb, pilt, pealkiri, autor) VALUES ('$thumb', '$pilt', $pealkiri, '$autor')";
			$result = mysqli_query($connection, $sql);
			if ($result){
				kuva_galeriivaade ();
			}
      */
    } else {
      echo '<div style="border:1px solid #000; background:red">Upload ebaõnnestus: '.implode(', ', $errors).'</div>';
    }
	}



 ?>
<div id="upload">
  <form action="?mode=pildivorm&id=<?=$id?>" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <th>Autor</th>
        <th><input name="autor" type="text" value="<?=$autor?>"></th>
      </tr>
				<tr>
        <th>Pealkiri</th>

        <th><input name="pealkiri" type="text" value="<?=$pealkiri?>"></th>
      </tr>
				<tr>
					<th>Suur pilt</th>
					<th>
						<input type="file" name="pic" accept="image/*">
			  		<input type="submit">
					</th>
      </tr>
				<tr>
					<th>Väike pilt</th>
					<th>
						<input type="file" name="tmb" accept="image/*">
						<input type="submit">
					</th>
				</tr>
				<tr>
        <th colspan="2"><input type="submit" value="Lae üles"></th>
      </tr>
    </table>
  </form>
</div>
