<?php

function connect_db(){
  global $connection;
  $host="localhost";
  $user="test";
  $pass="t3st3r123";
  $db="test";
  $connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa mootoriga ühendust");
  mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function kuva_pildid(){
	global $connection;
	$pics = array();
	$sql = "SELECT id, thumb, pilt, pealkiri, autor, punktid FROM 10153316_pildid";
	$result = mysqli_query($connection, $sql);
	while($rida = mysqli_fetch_assoc($result)){
		$pics[] = $rida;
	}
	return $pics;
}


function alusta_sessioon(){
	// siin ees võiks muuta ka sessiooni kehtivusaega, aga see pole hetkel tähtis
	session_start();
	}

function lopeta_sessioon(){
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
 	 setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
}

function kuva_pealeht () {
  include('view/head.html');
  include('view/Praktikum4.html');
  include('view/foot.html');
}

function kuva_galeriivaade () {
  include('view/head.html');
  include('view/Praktikum4_2.php');
  include('view/foot.html');
}

function kuva_logisisse() {

  if(!empty($_POST)) {
    $errors=array();
    if(!empty($_POST["kasutajanimi"])){
      echo $_POST["kasutajanimi"];
      $username = htmlspecialchars($_POST['kasutajanimi']);
    } else {
      $errors[]="kasutajanimi sisestamata!";
    }
    if(!empty($_POST["parool"])){
      echo $_POST["parool"];
      $passwd = htmlspecialchars($_POST['parool']);
    } else {
      $errors[]="parool sisestamata!";
    }

    if (empty($errors)) {
      if ($username=="kasutaja" && $passwd=="parool") {
  			$_SESSION['user']=$username;
        $_SESSION['teade']="Sisselogimine õnnestus";
  			header("Location: ?mode=galeriivaade");
  		} else {
  			echo "Vale kasutajanimi või parool! <a href=\"?mode=logisisse\">Tagasi</a>";
  		}
    }
  }
  include('view/head.html');
  include ('view/Praktikum4_4.php');
  include('view/foot.html');
}

function kuva_pildivorm() {
  include('view/head.html');
  include('view/Praktikum4_6.html');
  include('view/foot.html');
}


function kuva_registreeri() {
  include('view/head.html');
  include ('view/Praktikum4_5.html');
  include('view/foot.html');
}

function kuva_pilt() {

	$pildid = kuva_pildid();

  /* $pildid = array(
    array('big'=>'Pictures/1.jpg', 'small'=>'Pictures/Thumbnails/t1.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass1'),
    array('big'=>'Pictures/2.jpg', 'small'=>'Pictures/Thumbnails/t2.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass2'),
    array('big'=>'Pictures/3.jpg', 'small'=>'Pictures/Thumbnails/t3.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass3'),
    array('big'=>'Pictures/4.jpg', 'small'=>'Pictures/Thumbnails/t4.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass4'),
    array('big'=>'Pictures/5.jpg', 'small'=>'Pictures/Thumbnails/t5.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass5'),
    array('big'=>'Pictures/6.jpg', 'small'=>'Pictures/Thumbnails/t6.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass6'),
    array('big'=>'Pictures/7.jpg', 'small'=>'Pictures/Thumbnails/t7.jpg', 'alt'=>'Autor: Tundmatu  Pealkiri: Kass7')
  );
	*/

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if(!is_numeric($id) || $id > count($pildid) || $id < 0){
        $id = 0;
      } else {
        $pilt = $pildid[$id];
        if ($id >= 1){
          $eelmine = $id-1;
        } else {
          $eelmine = $id;
        }
        if ($id < count($pildid)-1) {
          $jargmine = $id+1;
        } else {
          $jargmine = $id;
        }
        include ('view/pilt.html');
        $link = getimagesize($pilt['pilt']);
        echo "Width: ".$link[0].", height: ".$link[1];
    }
  }
}

function kuva_default() {
  include('view/head.html');
  include ('view/Praktikum4.html');
  include('view/foot.html');
}

function kuva_pic(){
	global $connection;
	if (!empty($_GET["id"])){
		$sql="SELECT * FROM 10153316_pildid WHERE id=".mysqli_real_escape_string($connection, $_GET["id"]);
		$result = mysqli_query($connection, $sql) or die("sellist pilti pole");
	 	$pic= mysqli_fetch_assoc($result);
		if ($pic) {
			kuva_pildivorm();
		}
	}
}

function lae_pilt(){
	global $connection;

	$errors=array();
	if (!empty($_POST)){
		if (empty($_POST["autor"])) {
			$errors[]="autor kohustuslik";
		}
		if (empty($_POST["pealkiri"])) {
			$errors[]="pealkiri kohustuslik";
		}
		if (empty($_POST["suur_pilt"])) {
			$errors[]="pilt kohustuslik";
		}
		if (empty($_POST["vaike_pilt"])) {
			$errors[]="pilt kohustuslik";
		}
		if (empty($errors)){
			$autor=mysqli_real_escape_string($connection, $_POST["autor"]);
			$pealkiri=mysqli_real_escape_string($connection, $_POST["pilt"]);
			$pilt=mysqli_real_escape_string($connection, $_POST["pilt"]);
			$thumb=mysqli_real_escape_string($connection, $_POST["thumb"]);

			$sql = "INSERT INTO 10153316_pildid (thumb, pilt, pealkiri, autor) VALUES ('$thumb', '$pilt', $pealkiri, '$autor')";
			$result = mysqli_query($connection, $sql);
			if ($result){
				kuva_galeriivaade ();
			}
		}
	}
}



?>
