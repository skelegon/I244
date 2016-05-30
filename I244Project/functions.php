<?php

// Ühendus andmebaasiga
function connect_db(){
	global $connection;
	$host="localhost";
  $user="test";
  $pass="t3st3r123";
  $db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

// Tagastab kasutaja info andmebaasist
function get_user_info(){
	global $connection;
  $username = $_SESSION['username'];
	$sql = "SELECT email, phone, user_ID, type FROM 10153316_user WHERE username = '".$username."'";
	$res = mysqli_query($connection, $sql);
	return mysqli_fetch_assoc($res);
	}

	function get_items_owner_info($sellerID){
		global $connection;
	  $username = $_SESSION['username'];
		$sql = "SELECT username FROM 10153316_user WHERE user_ID = '".$sellerID."'";
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
	include('view/head.html');
  include('view/buy.php');
  include('view/footer.php');
}

function show_notifications () {
	include('view/head.html');
  include('view/notifications.php');
  include('view/footer.php');
}

function show_allitems () {
	include('view/head.html');
  include('view/allitems.php');
  include('view/footer.php');
}

function show_items($cat = null){
	if (!isset($_SESSION['username'])) {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$user = get_user_info()['user_ID'];
		$sql = "SELECT * FROM 10153316_item WHERE status = '1' AND seller_ID <> $user";
		if($cat != null){
			$sql = "SELECT * FROM 10153316_item WHERE status = '1' AND seller_ID <> $user AND category_ID = '".mysqli_real_escape_string($connection, $cat)."'";
		}
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function is_admin(){
	$type = get_user_info()['type'];
	return $type == 'admin';
}

function list_all_items(){
	if (!is_admin()){
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$sql = "SELECT * FROM 10153316_item";
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function show_usrs(){
	$logged = get_user_info();
	$admin = $logged['type'];
	if (!isset($_SESSION['username']) || $admin != "admin") {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$users = array();
		$result = mysqli_query($connection, "SELECT * FROM 10153316_user WHERE type = 'user'");
		return mysqli_fetch_all($result);
	}
}

function show_my_items(){
	if (!isset($_SESSION['username'])) {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$user = get_user_info();
		$user_ID = $user['user_ID'];
		$sql = "SELECT * FROM 10153316_item WHERE seller_ID = $user_ID AND status = '1'";
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function show_my_requests(){
	if (!isset($_SESSION['username'])) {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$user = get_user_info();
		$user_ID = $user['user_ID'];
		$sql = "SELECT * FROM `10153316_request` WHERE sellitem_ID in (select item_ID FROM 10153316_item where seller_ID = '$user_ID') AND status = 2";
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function show_incoming_requests(){
	if (!isset($_SESSION['username'])) {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$user = get_user_info();
		$user_ID = $user['user_ID'];
		$sql = "SELECT * FROM `10153316_request` WHERE buyitem_ID in (select item_ID FROM 10153316_item where seller_ID = '$user_ID') AND status = 2";
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function show_accepted_requests(){
	if (!isset($_SESSION['username'])) {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$user = get_user_info();
		$user_ID = $user['user_ID'];
		$sql = "SELECT * FROM `10153316_request` WHERE sellitem_ID in (select item_ID FROM 10153316_item where seller_ID = '$user_ID') AND status = 4";
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function show_declined_requests(){
	if (!isset($_SESSION['username'])) {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$user = get_user_info();
		$user_ID = $user['user_ID'];
		$sql = "SELECT * FROM `10153316_request` WHERE sellitem_ID IN (SELECT item_ID FROM 10153316_item WHERE seller_ID = '$user_ID') AND status = 5";
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function cancel_my_request($id){
	global $connection;

		//$sql = "UPDATE 10153316_request SET status='3' WHERE request_ID='".mysqli_real_escape_string($connection, $id)."' AND sellitem_ID = (SELECT )";

		$sql = "UPDATE 10153316_request req, 10153316_item itm SET req.status='3' WHERE req.sellitem_ID = itm.item_ID AND req.request_ID = '".mysqli_real_escape_string($connection, $id)."' AND itm.seller_ID = ".$_SESSION['userID']."";

		$result = mysqli_query($connection, $sql);
		if(mysqli_affected_rows($connection) > 0){
			//TODO: $item_status = "UPDATE 10153316_item SET status='1' WHERE item_ID = (SELECT sellitem_ID FROM 10153316_request WHERE request_ID = '$id') AND seller_ID = '".$_SESSION['userID']."'";
			return "Successfully deleted";
		} else {
			return "Successfully not deleted";
		}
	}


function cancel_user_request($id){
	global $connection;
	$sql = "UPDATE 10153316_request SET status='3' WHERE seller_ID='".mysqli_real_escape_string($connection, $id)."'";
	$result = mysqli_query($connection, $sql);
	$sql = "UPDATE 10153316_request SET status='3' WHERE seller_ID='".mysqli_real_escape_string($connection, $id)."'";
	$result = mysqli_query($connection, $sql);
	return "Successfully cancelled user requests: ..";
}

function suspend_user_items($id) {
	global $connection;
	$get_status = "SELECT status FROM 10153316_item WHERE seller_ID='".mysqli_real_escape_string($connection, $id)."'";
	$s = mysqli_query($connection, $get_status);
	$status = mysqli_fetch_assoc($s)['status'];
	$msg = "No item statuses were changed";
	$s = 1;
	if($status == 0) {
		$s = 1;
		$msg = "Successfully un-suspended user items: ..";
	} else if ($status == 1) {
		$s = 0;
	 	$msg = "Successfully suspended user items: ..";
	}
	$sql = "UPDATE 10153316_item SET status='".$s."' WHERE seller_ID = '$id'";
  mysqli_query($connection, $sql);
	return $msg;
}

function remove_my_request($id){
	global $connection;
	$sql = "UPDATE 10153316_request SET status='1' WHERE request_ID='".mysqli_real_escape_string($connection, $id)."'";
	$result = mysqli_query($connection, $sql);
	return "Successfully removed: ..";
}

function delete_product($id){
	global $connection;
	$sql = "UPDATE 10153316_item SET status='2' WHERE item_ID='".mysqli_real_escape_string($connection, $id)."'";
	$result = mysqli_query($connection, $sql);
	return "Successfully deleted: ..";
}

function product_status($id){
	if (!is_admin()){
		header("Location: ?mode=login");
	} else {
		global $connection;
		$status = get_item_info($id)['status'];
		if ($status == 1){
			$sql = "UPDATE 10153316_item SET status='2' WHERE item_ID='".mysqli_real_escape_string($connection, $id)."'";
			$result = mysqli_query($connection, $sql);
			return "Successfully suspended: ..";
		} else if($status == 2) {
			$sql = "UPDATE 10153316_item SET status='1' WHERE item_ID='".mysqli_real_escape_string($connection, $id)."'";
			$result = mysqli_query($connection, $sql);
			return "Successfully un-suspended: ..";
		}
	return "No changes";
}
}

function accept_request($id){
	global $connection;
	$sql = "UPDATE 10153316_request SET status='4' WHERE request_ID='".mysqli_real_escape_string($connection, $id)."'";
	$result = mysqli_query($connection, $sql);

	$first_item = "SELECT buyitem_ID FROM 10153316_request WHERE request_ID='".mysqli_real_escape_string($connection, $id)."'";
	$get_first =mysqli_query($connection, $first_item);
	$update_first="UPDATE 10153316_item SET status='0' WHERE item_ID = ".mysqli_fetch_assoc($get_first)['buyitem_ID']."";
	$first_result=mysqli_query($connection, $update_first);

	$second_item = "SELECT sellitem_ID FROM 10153316_request WHERE request_ID='".mysqli_real_escape_string($connection, $id)."'";
	$get_second =mysqli_query($connection, $second_item);
	$update_second="UPDATE 10153316_item SET status='0' WHERE item_ID = ".mysqli_fetch_assoc($get_second)['sellitem_ID']."";
	$second_result=mysqli_query($connection, $update_second);

	return "Successfully accepted: ..";
}

function decline_request($id){
	global $connection;
	$sql = "UPDATE 10153316_request SET status='5' WHERE request_ID='".mysqli_real_escape_string($connection, $id)."'";
	$result = mysqli_query($connection, $sql);
	return "Successfully declined: ..";
}

function show_requests() {
	include('view/head.html');
	include('view/traderequests.php');
	include('view/footer.php');
}

function show_myproducts () {
  include('view/head.html');
  include('view/myproducts.php');
  include('view/footer.php');
}

function show_about () {
  include('view/head.html');
  include('view/about.html');
  include('view/footer.php');
}

function show_users () {
  include('view/head.html');
  include('view/users.php');
  include('view/footer.php');
	}

function show_addpictures() {
	include('view/head.html');
	include('view/addpictures.php');
	include('view/footer.php');
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
	      $username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
	    } else {
	      $errors[]="Username not entered!";
	    }
	    if(!empty($_POST["password"])){
	      $passwd = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
	    } else {
	      $errors[]="Password not entered!";
	    }
	    if (empty($errors)) {
	      $query = "SELECT user_ID FROM 10153316_user WHERE username = '".$username."' AND password = SHA1('".$passwd."')";
	      $result = mysqli_query($connection, $query);

	      if (mysqli_num_rows($result) >= 1) {
					$userID = mysqli_fetch_assoc($result)['user_ID'];

					$query ="UPDATE 10153316_user SET visits=visits+1 WHERE user_ID = $userID";
					$result = mysqli_query($connection, $query);
	        $_SESSION['username']=$username;
					$_SESSION['userID']=$userID;
					header('Location: ?mode=index');
	  		} else {
	  			$errors[]="Wrong username or password! <a href=\"?mode=login\">BACK</a>";
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
				$username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
			} else {
				$errors[]="Username not entered!";
			}
			if(!empty($_POST["password"])){
				$passwd = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
			} else {
				$errors[]="Password not entered!";
			}
			if(!empty($_POST["password_confirm"])){
				$passwd_conf = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password_confirm']));
			} else {
				$errors[]="Password not entered!";
			}

			if(!empty($_POST["forename"])){
				$forename = mysqli_real_escape_string($connection, htmlspecialchars($_POST['forename']));
			} else {
				$errors[]="Forename not entered!";
			}

			if(!empty($_POST["surename"])){
				$surename = mysqli_real_escape_string($connection, htmlspecialchars($_POST['surename']));
			} else {
				$errors[]="Surename not entered!";
			}

			if(!empty($_POST["usrtel"])){
				$usrtel = mysqli_real_escape_string($connection, htmlspecialchars($_POST['usrtel']));
			} else {
				$errors[]="Phone number not entered!";
			}

			if(!empty($_POST["email"])){
				$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
			} else {
				$errors[]="E-mail address not entered!";
			}

			if (!empty($_POST["password_confirm"]) && !empty($_POST["password"])){
					if ($passwd != $passwd_conf){
					$errors[]="Entered passwords do not match";
				} else if ($passwd == $passwd_conf && empty($errors)){

					// Kontroll, kas  kasutajanimi juba andmebaasis olemas
					$query = "SELECT username FROM 10153316_user WHERE username = '".$username."'";
		      $result = mysqli_query($connection, $query);
		      if (mysqli_num_rows($result) >= 1) {
						$errors[]="Username already in use";
					} else {
						// lisab kasutja andmebaasi
						$query = "INSERT INTO `10153316_user`(`username`, `password`, `phone`, `email`, `forename`, `surename`) VALUES ('".$username."', SHA1('".$passwd."'), '".$usrtel."', '".$email."', '".$forename."', '".$surename."')";
						$result = mysqli_query($connection, $query);
						$notifications[]="Register successful";
					}
				} else {
						$errors[]="Error!";
				}
			}
		}
	include('view/head.html');
  include('view/register.php');
	include('view/footer.php');
	}
}

function view_item(){
	include('view/head.html');
	include('view/item.php');
	include('view/footer.php');
}

function get_item_info($id = null){
	global $connection;
	$i = "";
	if($id != null){
		$i = $id;
	} else {
		$i = $_GET['id'];
	}
	$sql = "SELECT * FROM 10153316_item WHERE item_ID = '".$i."'";
	$res = mysqli_query($connection, $sql);
	return mysqli_fetch_assoc($res);
}

function suspend_user($id){
	if (!is_admin()){
		header("Location: ?mode=login");
	} else {
		global $connection;
		$get_status = "SELECT status FROM 10153316_user WHERE user_ID='".mysqli_real_escape_string($connection, $id)."'";
		$status = mysqli_fetch_assoc(mysqli_query($connection, $get_status))['status'];
		if ($status == 1) {
			$sql = "UPDATE 10153316_user SET status='0' WHERE user_ID='".mysqli_real_escape_string($connection, $id)."'";
			$result = mysqli_query($connection, $sql);
			cancel_user_request($id);
			suspend_user_items($id);
			return "Successfully suspended: ..";
		}
		$sql = "UPDATE 10153316_user SET status='1' WHERE user_ID='".mysqli_real_escape_string($connection, $id)."'";
		$result = mysqli_query($connection, $sql);
		suspend_user_items($id);
		return "Successfully un-suspended: ..";
	}
}

?>
