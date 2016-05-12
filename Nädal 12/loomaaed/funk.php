<?php

function connect_db(){
	global $connection;
	$host="localhost";
  $user="test";
  $pass="t3st3r123";
  $db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function logi(){
	if (isset($_SESSION['user'])) {
		kuva_puurid();
	} else {
		global $connection;
		if(!empty($_POST)) {
	    $errors=array();
	    if(!empty($_POST["user"])){
	      echo $_POST["user"];
	      $username = mysqli_real_escape_string($connection,htmlspecialchars($_POST['user']));
	    } else {
	      $errors[]="kasutajanimi sisestamata!";
	    }
	    if(!empty($_POST["pass"])){
	      echo $_POST["pass"];
	      $passwd = mysqli_real_escape_string($connection, htmlspecialchars($_POST['pass']));
	    } else {
	      $errors[]="parool sisestamata!";
	    }

	    if (empty($errors)) {
	      $query = "SELECT id FROM 10153316_kylastajad WHERE username = '".$username."' AND passw = SHA1('".$passwd."')";
	      $result = mysqli_query($connection, $query);
				//var_dump(mysqli_error($connection));
	      if (mysqli_num_rows($result) >= 1) {
	        $_SESSION['user']=$username;
					header('Location: ?page=loomad');
	  		} else {
	  			echo "Vale kasutajanimi või parool! <a href=\"?mode=login\">Tagasi</a>";
	  		}
	    }
	  }
	   include('views/login.html');
	}
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}
connect_db();

function kuva_puurid(){
	if (!isset($_SESSION['user'])) {
			header("Location: loomaaed.php?page=login");
		} else {
			global $connection;
			$puurid = array();
			$result = mysqli_query($connection, "SELECT DISTINCT puur as p FROM 10153316_loomaaed") or die("");
			foreach ($result as $value) {
				$loomad = mysqli_query($connection, "SELECT id, nimi, vanus, liik FROM 10153316_loomaaed WHERE puur = ".$value['p']) or die("");
				foreach ($loomad as $loom) {
					$puurid[$value['p']][] = $loom;
				}
			}
			include_once('views/puurid.html');
		}
}

function lisa(){

	if (!isset($_SESSION['user'])) {
		include_once('views/login.html');
	} else {
		$errors=array();
		if (!empty($_POST)){
			if (empty($_POST["nimi"])) {
				$errors[]="nimi kohustuslik";
			}
			if (empty($_POST["puur"])) {
				$errors[]="puur kohustuslik";
			}
			if (empty($_FILES["liik"]["name"])) {
				$errors[]="pilt kohustuslik";
			}
			if (empty($errors)){
				global $connection;
				$nimi=mysqli_real_escape_string($connection, $_POST["nimi"]);
				$puur=mysqli_real_escape_string($connection, $_POST["puur"]);
				$liik=mysqli_real_escape_string($connection, $_FILES["liik"]["name"]);
				$sql = "INSERT INTO 10153316_loomaaed (nimi, liik, puur) VALUES ('$nimi', 'pildid/".$liik."', '$puur')";
				$result = mysqli_query($connection, $sql);
				if (!$result) {
					echo "Pildi üleslaadimine ebaõnnestus.";
				} else {
					kuva_puurid();
				}
		include_once('views/loomavorm.html');
		}
	}
	include_once('views/loomavorm.html');
}
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

?>
