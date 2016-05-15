<?php
$email = "";
$tel = "";
if(isset($_SESSION['username'])){
	$psk = get_user_info();
	$email = $psk['email'];
	$tel = $psk['phone'];
} else {
	show_login();
}

$errors=array();
$name = "";
$qty = "";
$unit = "";
$unitprice ="";

if (!empty($_POST)){
	if (empty($_POST["name"])) {
		$errors[]="Item name mandatory!";
	}
	if (empty($_POST["condition"])) {
		$errors[]="Please fill condition field!";
	}
	if (empty($_POST["qty"])) {
		$errors[]="Please fill quantity field!";
	}
	if (empty($_POST["unit"])) {
		$errors[]="Please fill the unit field!";
	}
	if (empty($_POST["usrtel"])) {
		$errors[]="Please fill contact number!";
	}
	if (empty($_POST["email"])) {
		$errors[]="Please fill contact e-mail!";
	}
	if (empty($_FILES["pic"]["name"])) {
		$errors[]="Please add a picture of the item!";
	}


	if (empty($errors)){
		global $connection;
		//var_dump($_POST);
		echo "sisend OK";
		$name=mysqli_real_escape_string($connection, $_POST["name"]);
		$condition=mysqli_real_escape_string($connection, $_POST["condition"]);
		$qty=mysqli_real_escape_string($connection, $_POST["qty"]);
		$unitprice=mysqli_real_escape_string($connection, $_POST["unitprice"]);
		$unit=mysqli_real_escape_string($connection, $_POST["unit"]);
		$usrtel=mysqli_real_escape_string($connection, $_POST["usrtel"]);
		$email=mysqli_real_escape_string($connection, $_POST["email"]);
		$p = mysqli_real_escape_string($connection, upload("pic", "pictures/"));
		//var_dump($p);

/*
		echo "<pre>";
		var_dump($name);
		var_dump($condition);
		var_dump($qty);
		var_dump($unitprice);
		var_dump($unit);
		var_dump($usrtel);
		var_dump($email);
		var_dump($p);
		echo "</pre>";
*/

		$sql = "INSERT INTO 10153316_items (name, cond, quantity, unitprice, unit, pic, phone, email) VALUES ('$name', '$condition', '$qty', '$unitprice', '$unit', 'pictures/".$p."', '$usrtel', '$email')";
		$result = mysqli_query($connection, $sql);

		if (!$result) {
			$errors[] = "Upload failed";
		} else {
			$notifications[] = "Upload successful";
			$name = "";
			$qty =  "";
			$unit = "";
			$unitprice ="";
		}

} else {
	$name = isset($_POST['name']) ? $_POST['name'] : "";
	$condition = isset($_POST['condition']) ? $_POST['condition'] : "";
	$qty = isset($_POST['qty']) ? $_POST['qty'] : "";
	$unit = isset($_POST['unit']) ? $_POST['unit'] : "";
	$unitprice = isset($_POST['unitprice']) ? $_POST['unit'] : "";
}
}
?>

<h1>Sell an item</h1>

<div class="inputform">
	<form action="?mode=addproduct" method="POST" enctype="multipart/form-data">
		<h4>Product information:</h4>
			<table >
				<tr>
					<th>Name</th>
					<th><input type="text" name="name" placeholder="Item name" value="<?=$name?>" /></th>
				</tr>
				<tr>
					<th>Condition</th>
					<th>
						<select name="condition">
							<option value="new" <?php if(isset($condition) && $condition=="new") echo 'selected="selected"'; ?>>New</option>
							<option value="used" <?php if(isset($condition) && $condition=="used") echo 'selected="selected"'; ?>>Used</option>
						</select>
					</th>
				</tr>
				<tr>
					<th>Quantity</th>
					<th><input type="quantity" name="qty" min="0" placeholder="1" value="<?=$qty?>"></th>
				</tr>
				<tr>
					<th>Unit</th>
					<th><input type="text" name="unit" placeholder="pcs" value="<?=$unit?>"></th>
				</tr>
				<tr>
					<th>Unit price</th>
					<th><input type="text" name="unitprice" placeholder="10" value="<?=$unitprice?>">€/unit</th>
				</tr>
				<tr>
					<th>Picture</th>
					<th><input type="file" name="pic" accept="image/*"></th>
				</tr>
			</table></br>

		<h4>Contact information</h4>
		<table>
			<tr>
				<th>Phone number</th>
				<th><input type="tel" name="usrtel" value="<?=$tel?>">
				</th>
			</tr>
			<tr>
				<th>E-mail address</th>
				<th><input type="email" name="email" value="<?=$email?>">

				</th>
			</tr>
		</table></br>

		<input type="submit" value="Add" class="btn btn-lg btn-primary btn-block"/></br>
	</form>

	<?php if (isset($errors)):?>
			<?php foreach($errors as $error):?>
				<div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
			<?php endforeach;?>
	<?php endif;?>
</div>
