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
			$sql = ("SELECT * FROM 10153316_item WHERE status = '1' AND seller_ID <> $user AND category_ID = '".sanitize_for_db($connection, $cat)."'");
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
		$sql = "SELECT * FROM 10153316_item WHERE status <> '3'";
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
		$sql = ("SELECT * FROM `10153316_request` WHERE sellitem_ID IN (SELECT item_ID FROM 10153316_item WHERE seller_ID = '$user_ID') AND status = 5");
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}

function show_admin_cancelled_requests(){
	if (!isset($_SESSION['username'])) {
		header("Location: ?mode=login");
	} else {
		global $connection;
		$items = array();
		$user = get_user_info();
		$user_ID = $user['user_ID'];
		$sql = ("SELECT * FROM `10153316_request` WHERE sellitem_ID IN (SELECT item_ID FROM 10153316_item WHERE seller_ID = '$user_ID') AND status = 6");
		$result = mysqli_query($connection, $sql);
		return mysqli_fetch_all($result);
	}
}


function cancel_my_request($id){
	global $connection;
		$sql = ("UPDATE 10153316_request req, 10153316_item itm SET req.status='3' WHERE req.sellitem_ID = itm.item_ID AND req.request_ID = '".sanitize_for_db($connection, $id)."' AND itm.seller_ID = ".$_SESSION['userID']."");
		$result = mysqli_query($connection, $sql);
		if(mysqli_affected_rows($connection) > 0){
			$item_status = ("UPDATE 10153316_item SET status='1' WHERE item_ID = (SELECT sellitem_ID FROM 10153316_request WHERE request_ID = '$id') AND seller_ID = '".$_SESSION['userID']."'");
			$res = mysqli_query($connection, $item_status);
			return "Successfully cancelled!";
		} else {
			return "Not your request to cancel!";
		}
	}

	function cancel_user_request($id){
		if (!is_admin()){
			header("Location: ?mode=login");
		} else {
			global $connection;
			$sql = ("UPDATE 10153316_request SET status='3' WHERE seller_ID='".sanitize_for_db($connection, $id)."'");
			$result = mysqli_query($connection, $sql);
			return "Successfully cancelled user requests";
		}
	}

	function cancel_request_by_ID($id){
		if (!is_admin()){
			header("Location: ?mode=login");
		} else {
			global $connection;
			$sql = "UPDATE 10153316_request SET status='3' WHERE request_ID='".sanitize_for_db($connection, $id)."'";
			$result = mysqli_query($connection, $sql);
			return "Successfully cancelled requests";
		}
	}

function suspend_user_items($id) {
	if (!is_admin()){
		header("Location: ?mode=login");
	} else {
		global $connection;
		$get_status = "SELECT status FROM 10153316_item WHERE seller_ID='".sanitize_for_db($connection, $id)."'";
		$s = mysqli_query($connection, $get_status);
		$status = mysqli_fetch_assoc($s)['status'];

		$msg = "No item statuses were changed";
		$s = 1;
		if($status == 0) {
			$s = 1;
			$msg = "Successfully un-suspended user item";
		} else if ($status == 1) {
			$s = 0;
		 	$msg = "Successfully suspended user item";
		} else if ($status == 2) {
			$s = 0;
			$sql = ("UPDATE 10153316_item SET status='0' WHERE item_ID='".sanitize_for_db($connection, $id)."'");
			$result = mysqli_query($connection, $sql);
			$del_sell_requests = "UPDATE 10153316_request SET status='6' WHERE sellitem_ID IN (SELECT item_ID FROM 10153316_item WHERE seller_ID = '".sanitize_for_db($connection, $product_owner)."')";
			$del_sell = mysqli_query($connection, $del_sell_requests);
			$del_buy_requests = "UPDATE 10153316_request SET status='6' WHERE buyitem_ID IN (SELECT item_ID FROM 10153316_item WHERE seller_ID = '".sanitize_for_db($connection, $product_owner)."')";
			$del_buy = mysqli_query($connection, $del_buy_requests);

			return "Successfully suspended & deleted";
		}
		$sql = ("UPDATE 10153316_item SET status='".$s."' WHERE seller_ID = '$id'");
	  mysqli_query($connection, $sql);
		return $msg;
	}
}

function remove_my_request($id){
	global $connection;
	$get_user_ID = "SELECT seller_ID FROM 10153316_item WHERE item_ID = (SELECT sellitem_ID FROM 10153316_request WHERE request_ID = '".sanitize_for_db($connection, $id)."')";
	$uID = mysqli_fetch_assoc(mysqli_query($connection, $get_user_ID));
	if (isset($_SESSION['userID']) && $_SESSION['userID'] == $uID['seller_ID']) {
		global $connection;
		$sql = ("UPDATE 10153316_request SET status='1' WHERE request_ID='".sanitize_for_db($connection, $id)."'");
		$result = mysqli_query($connection, $sql);
		return "Successfully removed!";
	} else {
		return "Not your item to remove!";
	}
}

function delete_product($id){
	global $connection;
	$get_user_ID = "SELECT seller_ID FROM 10153316_item WHERE item_ID = $id";
	$uID = mysqli_fetch_assoc(mysqli_query($connection, $get_user_ID));
	if (isset($_SESSION['userID']) && $_SESSION['userID'] == $uID['seller_ID']) {
		$sql = ("UPDATE 10153316_item SET status='2' WHERE item_ID='".sanitize_for_db($connection, $id)."'");
		$result = mysqli_query($connection, $sql);
		return "Successfully deleted!";
	}
	return "Not your item to delete!";
}

function product_status($id){
	if (!is_admin()){
		header("Location: ?mode=login");
	} else {
		global $connection;
		$status = get_item_info($id)['status'];
		$product_owner = get_item_info($id)['seller_ID'];
		if ($status == 1){
			$sql = ("UPDATE 10153316_item SET status='0' WHERE item_ID='".sanitize_for_db($connection, $id)."'");
			$result = mysqli_query($connection, $sql);
			return "Successfully suspended";
		} else if($status == 2) {
			$sql = ("UPDATE 10153316_item SET status='0' WHERE item_ID='".sanitize_for_db($connection, $id)."'");
			$result = mysqli_query($connection, $sql);
			$del_sell_requests = "UPDATE 10153316_request SET status='6' WHERE status='2' AND sellitem_ID IN (SELECT item_ID FROM 10153316_item WHERE seller_ID = '".sanitize_for_db($connection, $product_owner)."')";
			$del_sell = mysqli_query($connection, $del_sell_requests);
			$del_buy_requests = "UPDATE 10153316_request SET status='6' WHERE status='2' AND buyitem_ID IN (SELECT item_ID FROM 10153316_item WHERE seller_ID = '".sanitize_for_db($connection, $product_owner)."')";
			$del_buy = mysqli_query($connection, $del_buy_requests);

			return "Successfully suspended & deleted";
		} else if($status == 0) {
			$sql = ("UPDATE 10153316_item SET status='1' WHERE item_ID='".sanitize_for_db($connection, $id)."'");
			$result = mysqli_query($connection, $sql);
			return "Successfully un-suspended";
		}
	return "No changes!";
}
}

function accept_request($id){
	global $connection;
	$get_user_ID = "SELECT seller_ID FROM 10153316_item WHERE item_ID = (SELECT buyitem_ID FROM 10153316_request WHERE request_ID = $id)";
	$uID = mysqli_fetch_assoc(mysqli_query($connection, $get_user_ID));
	if (isset($_SESSION['userID']) && $_SESSION['userID'] == $uID['seller_ID']) {
		$sql = ("UPDATE 10153316_request SET status='4' WHERE request_ID='".sanitize_for_db($connection, $id)."'");
		$result = mysqli_query($connection, $sql);

		$first_item = ("SELECT buyitem_ID FROM 10153316_request WHERE request_ID='".sanitize_for_db($connection, $id)."'");
		$get_first = mysqli_query($connection, $first_item);
		$update_first = ("UPDATE 10153316_item SET status='3' WHERE item_ID = ".mysqli_fetch_assoc($get_first)['buyitem_ID']."");
		$first_result = mysqli_query($connection, $update_first);

		$second_item = ("SELECT sellitem_ID FROM 10153316_request WHERE request_ID='".sanitize_for_db($connection, $id)."'");
		$get_second =mysqli_query($connection, $second_item);
		$update_second=("UPDATE 10153316_item SET status='3' WHERE item_ID = ".mysqli_fetch_assoc($get_second)['sellitem_ID']."");
		$second_result=mysqli_query($connection, $update_second);
	return "Successfully accepted!";
} else {
	return "Not your request to accept!";
}
}


function decline_request($id){
	global $connection;
	$get_user_ID = "SELECT seller_ID FROM 10153316_item WHERE item_ID = (SELECT buyitem_ID FROM 10153316_request WHERE request_ID = $id)";
	$uID = mysqli_fetch_assoc(mysqli_query($connection, $get_user_ID));
	if (isset($_SESSION['userID']) && $_SESSION['userID'] == $uID['seller_ID']) {
		$sql = ("UPDATE 10153316_request SET status='5' WHERE request_ID='".sanitize_for_db($connection, $id)."'");
		$result = mysqli_query($connection, $sql);
		return "Successfully declined!";
	} else {
		return "Not your request to decline!";
	}
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

  if (in_array($_FILES[$name]["type"], $allowedTypes)
   && ($_FILES[$name]["size"] < 100000)
   && in_array($extension, $allowedExts)) {
    if ($_FILES[$name]["error"] > 0) {
      return "";
    } else {
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
	      $username = (sanitize_for_db($connection, htmlspecialchars($_POST['username'])));
	    } else {
	      $errors[]="Username not entered!";
	    }
	    if(!empty($_POST["password"])){
	      $passwd = (sanitize_for_db($connection, htmlspecialchars($_POST['password'])));
	    } else {
	      $errors[]="Password not entered!";
	    }
	    if (empty($errors)) {
	      $query = ("SELECT user_ID FROM 10153316_user WHERE username = '".$username."' AND password = SHA1('".$passwd."')");
	      $result = mysqli_query($connection, $query);

				$check_status = ("SELECT status FROM 10153316_user where username = '".$username."' AND password = SHA1('".$passwd."')");
				$status = mysqli_fetch_assoc(mysqli_query($connection, $check_status))['status'];
				if (mysqli_num_rows($result) >= 1 && $status == 0 ) {
					$errors[]="User is banned!";
				} else if(mysqli_num_rows($result) >= 1 && $status == 1) {
					$userID = mysqli_fetch_assoc($result)['user_ID'];
					$query =("UPDATE 10153316_user SET visits=visits+1 WHERE user_ID = $userID");
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
				$username = sanitize_for_db($connection, $_POST['username']);
			} else {
				$errors[]="Username not entered!";
			}
			if(!empty($_POST["password"])){
				$passwd = mysqli_real_escape_string($connection, $_POST['password']);
			} else {
				$errors[]="Password not entered!";
			}
			if(!empty($_POST["password_confirm"])){
				$passwd_conf = mysqli_real_escape_string($connection, $_POST['password_confirm']);
			} else {
				$errors[]="Password not entered!";
			}

			if(!empty($_POST["forename"])){
				$forename = sanitize_for_db($connection, $_POST['forename']);
			} else {
				$errors[]="Forename not entered!";
			}

			if(!empty($_POST["surename"])){
				$surename = sanitize_for_db($connection, $_POST['surename']);
			} else {
				$errors[]="Surename not entered!";
			}

			if(!empty($_POST["usrtel"])){
				$usrtel = sanitize_for_db($connection, $_POST['usrtel']);
			} else {
				$errors[]="Phone number not entered!";
			}

			if(!empty($_POST["email"])){
				$email = sanitize_for_db($connection, $_POST['email']);
			} else {
				$errors[]="E-mail address not entered!";
			}

			if (!empty($_POST["password_confirm"]) && !empty($_POST["password"])){
					if ($passwd != $passwd_conf){
					$errors[]="Entered passwords do not match";
				} else if ($passwd == $passwd_conf && empty($errors)){

					// Kontroll, kas  kasutajanimi juba andmebaasis olemas
					$query = ("SELECT username FROM 10153316_user WHERE username = '".$username."'");
		      $result = mysqli_query($connection, $query);
		      if (mysqli_num_rows($result) >= 1) {
						$errors[]="Username already in use";
					} else {
						// lisab kasutja andmebaasi
						$query = ("INSERT INTO `10153316_user`(`username`, `password`, `phone`, `email`, `forename`, `surename`) VALUES ('".$username."', SHA1('".$passwd."'), '".$usrtel."', '".$email."', '".$forename."', '".$surename."')");
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
	$sql = ("SELECT * FROM 10153316_item WHERE item_ID = '".$i."'");
	$res = mysqli_query($connection, $sql);
	return mysqli_fetch_assoc($res);
}

function suspend_user($id){
	if (!is_admin()){
		header("Location: ?mode=login");
	} else {
		global $connection;
		$get_status = ("SELECT status FROM 10153316_user WHERE user_ID='".sanitize_for_db($connection, $id)."'");
		$status = mysqli_fetch_assoc(mysqli_query($connection, $get_status))['status'];
		if ($status == 1) {
			$sql = ("UPDATE 10153316_user SET status='0' WHERE user_ID='".sanitize_for_db($connection, $id)."'");
			$result = mysqli_query($connection, $sql);
			cancel_user_request($id);
			suspend_user_items($id);
			return "Successfully suspended!";
		}
		$sql = ("UPDATE 10153316_user SET status='1' WHERE user_ID='".sanitize_for_db($connection, $id)."'");
		$result = mysqli_query($connection, $sql);
		suspend_user_items($id);
		return "Successfully un-suspended!";
	}
}

function sanitize_for_db($con, $input){
 return mysqli_real_escape_string($con, strip_tags($input));
}


// For demo purposes only - to reset website to initial state
function reset_state(){
	if (is_admin()){
		global $connection;

		$items = "INSERT INTO `10153316_item` (`item_ID`, `name`, `cond`, `quantity`, `unit`, `thumbnail`, `phone`, `email`, `description`, `comment`, `seller_ID`, `views`, `requests`, `category_ID`, `status`) VALUES
		(51, 'Blue pants', 'Used', 1, 'set', 'pictures/6fdb46b0092ad21a48643575dbd4447f.jpg', '5050505', 'mati.testija@test.ee', 'Blue pants, rarely used, high quality, comfortable', '', 1, 0, 0, 2, '1'),
		(52, 'Bently', 'New', 1, 'pcs', 'pictures/183ac196ff683ca54ded95dc549df7fe.jpg', '5050505', 'mati.testija@test.ee', 'Looking to trade for a boat', '', 1, 0, 0, 3, '1'),
		(53, 'Toyota', 'Used', 1, 'pcs', 'pictures/e552f96951f4cded636695aace547268.png', '5050505', 'mati.testija@test.ee', 'Great car, good milage, looking to trade for a motorcycle', '', 1, 0, 0, 3, '1'),
		(54, 'Necklace', 'Used', 1, 'pcs', 'pictures/4ac27fc95a68a94cff40c4de8e2a8aa3.jpg', '5050505', 'mati.testija@test.ee', 'Nice white and blue necklace.', '', 1, 0, 0, 4, '1'),
		(55, 'Coffee table', 'Used', 1, 'pcs', 'pictures/a63803e7dd2c8476f13d16f36818969d.jpg', '555000', 'admin@test.ee', 'Small coffee table, wooden', '', 2, 0, 0, 5, '1'),
		(57, 'Treadmill', 'Used', 1, 'pcs', 'pictures/588dc02331ce8e945f0b5dc40a0c7459.jpg', '555000', 'admin@test.ee', 'Black treadmill, up to 100kg', '', 2, 0, 0, 1, '1'),
		(58, 'Beige pants', 'Used', 1, 'set', 'pictures/8c2d4769ce25655f90d35f80cc5013cd.jpg', '555000', 'admin@test.ee', 'Beige semi-formal pants, size 54', '', 2, 0, 0, 2, '1'),
		(59, 'Ring', 'New', 1, 'pcs', 'pictures/8f7b1035413b3a11494aa91070cdf4bd.jpg', '500500500', 'liina.tuisk@testikonto.ee', 'Silver engagement ring, real diamonds', '', 9, 0, 0, 4, '1'),
		(60, 'Diamond ring', 'New', 1, 'pcs', 'pictures/7ab1bba69392f9b293aa6f4fd141081b.jpg', '500500500', 'liina.tuisk@testikonto.ee', 'Platinum ring with a big diamond', '', 9, 0, 0, 4, '1'),
		(61, 'Nokia', 'Used', 1, 'pcs', 'pictures/e5f09910f1c9d3045987081a9a4744f2.jpg', '500500500', 'liina.tuisk@testikonto.ee', 'Nokia 3720, black, good battery', '', 9, 0, 0, 1, '1'),
		(63, 'Tool set', 'New', 1, 'set', 'pictures/d5cad32ca3ed27b83ba8ae1a711685c5.jpg', '46778712', 'john.smith@mail.ru', 'Set of 15 tools for household use', '', 10, 0, 0, 8, '1'),
		(64, 'Wrench', 'Used', 2, 'pcs', 'pictures/19480494a0b89fd67104abf981993f58.jpg', '46778712', 'john.smith@mail.ru', 'Good condition wrenches', '', 10, 0, 0, 8, '1'),
		(65, 'Silver necklace', 'Used', 1, 'pcs', 'pictures/7db474caee66c49e97c29cd595f16b4c.jpg', '46778712', 'john.smith@mail.ru', 'silver necklace with blue stone', '', 10, 0, 0, 4, '1'),
		(66, 'Mixer', 'Used', 1, 'pcs', 'pictures/5f6a958486c813adcbe5b7d9475abf63.jpg', '46778712', 'john.smith@mail.ru', 'Red kitchen mixer, rarely used', '', 10, 0, 0, 1, '1'),
		(68, 'Couch', 'New', 1, 'pcs', 'pictures/d759d7833fad55983d3b0cce786b2a5c.jpg', '521646461', 'miki.hiir@mikihiir.lv', 'Red couch, great for a livingroom', '', 11, 0, 0, 5, '1'),
		(70, 'Red jacket', 'Used', 1, 'pcs', 'pictures/a8c5977efb51c7671e70482d0e58dd05.jpg', '521646461', 'miki.hiir@mikihiir.lv', 'Wind jacket, waterproof', '', 11, 0, 0, 2, '1'),
		(71, 'Bike', 'Used', 1, 'pcs', 'pictures/d0207e4a3689065037b4089b5c573568.jpg', '5432165432', 'kat.seklaas@hehe.ee', 'Street bicycle, black', '', 12, 0, 0, 7, '1'),
		(72, 'Grill', 'Used', 1, 'pcs', 'pictures/cfa1bb7bd7025f9b9c17fe7778b6077f.jpg', '5432165432', 'kat.seklaas@hehe.ee', 'Garder grill, good condition, cleaned', '', 12, 0, 0, 6, '1'),
		(73, 'Chicken', 'Used', 1, 'pcs', 'pictures/e584c6ca033325bc08b23cfbf5c745ee.jpg', '5432165432', 'kat.seklaas@hehe.ee', 'Pet or food', '', 12, 0, 0, 6, '1')";

		mysqli_query($connection, "TRUNCATE TABLE 10153316_item");
		mysqli_query($connection, "TRUNCATE TABLE 10153316_request");
		mysqli_query($connection, $items);
		mysqli_query($connection, "UPDATE 10153316_user SET status='1'");



		header('Location: controller.php');
	}
}

?>
