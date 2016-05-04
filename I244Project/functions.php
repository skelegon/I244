<?php
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

function show_input () {
  include('view/head.html');
  include('view/input.html');
  include('view/footer.php');
}

function show_output () {
  include('view/head.html');
  include('view/output.html');
  include('view/footer.php');
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

function show_login() {
  if(!empty($_POST)) {
    $errors=array();
    if(!empty($_POST["username"])){
      echo $_POST["username"];
      $username = htmlspecialchars($_POST['username']);
    } else {
      $errors[]="Please enter your username!";
    }

    if(!empty($_POST["password"])){
      echo $_POST["password"];
      $passwd = htmlspecialchars($_POST['password']);
    } else {
      $errors[]="Please enter your password!";
    }

    if (empty($errors)) {
      if ($username=="username" && $passwd=="password") {
  			$_SESSION['user']=$username;
        $_SESSION['notification']="Login successful";
  			header("Location: ?mode=index");
  		} else {
  				echo "Vale kasutajanimi või parool! <a href=\"?mode=login\">Tagasi</a>";
  		}
    }
  }
	include('view/head.html');
  include('view/login.php');
  include('view/footer.php');
}

function show_default () {
  include('view/head.html');
  include('view/index.html');
  include('view/footer.php');
}

?>
