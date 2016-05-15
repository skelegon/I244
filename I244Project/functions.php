<?php

// Ühendus andmebaasiga
function connect_db(){
	global $connection;
	$host="localhost";
  $user="root";
  $pass="";
  $db="database";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

// Tagastab kasutaja info andmebaasist
function get_user_info(){
	global $connection;
  $username = $_SESSION['username'];
	$sql = "SELECT email, phone FROM 10153316_kylastajad WHERE username = '".$username."'";
	$res = mysqli_query($connection, $sql);
	return mysqli_fetch_assoc($res);
	}

function start_session(){
	session_start();
	}

function end_session(){
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
}

function show_index () {
  include('view/head.html');
  include('view/index.html');
  include('view/footer.php');
}

function show_buy () {
	if (!isset($_SESSION['username'])) {
			header("Location: ?mode=login");
		} else {
			global $connection;
			$items = array();
			$result = mysqli_query($connection, "SELECT * FROM 10153316_items");
			return mysqli_fetch_all($result);
		}
}


function show_about () {
  include('view/head.html');
  include('view/about.html');
  include('view/footer.php');
}

function show_users () {
  include('view/head.html');
  include('view/users.html');
  include('view/footer.php');
	}



function upload($name, $loc){
  $allowedExts = array("jpg", "jpeg", "gif", "png");
  $allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
  $extension = end(explode(".", $_FILES[$name]["name"]));

  if ( in_array($_FILES[$name]["type"], $allowedTypes)
   && ($_FILES[$name]["size"] < 100000) // see on 100kb
   && in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
    if ($_FILES[$name]["error"] > 0) {
      return "";
    } else {
      // vigu ei ole
			$ext = pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION);
			$filename = md5($_SESSION['username'].time().$_FILES['pic']["name"]).".".$ext;
      if (file_exists($loc."/".$filename)) {
				return $filename;
      } else {
        move_uploaded_file($_FILES[$name]["tmp_name"], $loc."/".$filename);
        return $filename;
      }
    }
  } else {
    return "";
  }
}

function show_addproduct() {
		include('view/head.html');
		include('view/addproduct.php');
		include('view/footer.php');
}

function show_default () {
  include('view/head.html');
  include('view/index.html');
  include('view/footer.php');
}

//Sisse logimine
function show_login() {
	if (isset($_SESSION['username'])) {
		show_index();
	} else {
		global $connection;
		if(!empty($_POST)) {
	    $errors=array();
	    if(!empty($_POST["username"])){
	      echo $_POST["username"];
	      $username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
	    } else {
	      $errors[]="Username not entered!";
	    }
	    if(!empty($_POST["password"])){
	      echo $_POST["password"];
	      $passwd = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
	    } else {
	      $errors[]="Password not entered!";
	    }
	    if (empty($errors)) {
	      $query = "SELECT id FROM 10153316_kylastajad WHERE username = '".$username."' AND passw = SHA1('".$passwd."')";
	      $result = mysqli_query($connection, $query) or die ("Päring ebaõnnestus!");
				//var_dump(mysqli_error($connection));
	      if (mysqli_num_rows($result) >= 1) {
	        $_SESSION['username']=$username;
					header('Location: ?mode=index');
	  		} else {
	  			echo "Wrong username or password! <a href=\"?mode=login\">Tagasi</a>";
	  		}
	    }
	  }
		include('view/head.html');
	  include('view/login.php');
	  include('view/footer.php');
	}
}

// välja logimine
function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?mode=login");
}

function register(){
	if (isset($_SESSION['username'])) {
		show_index();
	} else {
		global $connection;
		if(!empty($_POST)) {
			$errors=array();
			$notifications=array();

			if(!empty($_POST["username"])){
				echo $_POST["username"];
				$username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
			} else {
				$errors[]="Username not entered!";
			}
			if(!empty($_POST["password"])){
				echo $_POST["password"];
				$passwd = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
			} else {
				$errors[]="Password not entered!";
			}
			if(!empty($_POST["password_confirm"])){
				echo $_POST["password_confirm"];
				$passwd_conf = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password_confirm']));
			} else {
				$errors[]="Password not entered!";
			}

			if ($passwd != $passwd_conf){
				$errors[]="Entered passwords do not match";
			} else if ($passwd == $passwd_conf && empty($errors)){

				// Kontroll, kas  kasutajanimi juba andmebaasis olemas
				$query = "SELECT username FROM 10153316_kylastajad WHERE username = '".$username."'";
	      $result = mysqli_query($connection, $query);
	      if (mysqli_num_rows($result) >= 1) {
					$errors[]="Username already in use";
				} else {
					// lisab kasutja andmebaasi
					$query = "INSERT INTO `10153316_kylastajad`(`username`, `passw`) VALUES ('".$username."',SHA1('".$passwd."'))";
					$result = mysqli_query($connection, $query) or die ("Päring ebaõnnestus!");
					$notifications[]="Register successful";
				}
			} else {
					$errors[]="Error!";
			}
		}
	include('view/head.html');
  include('view/register.php');
	include('view/footer.php');
	}
}

?>
