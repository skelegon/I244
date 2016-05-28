<?php
$email = "";
$tel = "";
if(isset($_SESSION['username'])){
	$info = get_user_info();
	$email = $info['email'];
	$tel = $info['phone'];
	$user_ID = $info['user_ID'];
} else {
	header("Location: ?mode=login");
}

$errors=array();
$name = "";
$qty = "";
$unit = "";
$description="";

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
	if (empty($_POST["description"])) {
		$errors[]="Please fill item description";
	}
	if (empty($_POST["category"])) {
		$errors[]="Please choose item category";
	}

	if (empty($errors)){
		global $connection;
		//var_dump($_POST);
		$name=mysqli_real_escape_string($connection, $_POST["name"]);
		$condition=mysqli_real_escape_string($connection, $_POST["condition"]);
		$qty=mysqli_real_escape_string($connection, $_POST["qty"]);
		$unit=mysqli_real_escape_string($connection, $_POST["unit"]);
		$usrtel=mysqli_real_escape_string($connection, $_POST["usrtel"]);
		$email=mysqli_real_escape_string($connection, $_POST["email"]);
		$p = mysqli_real_escape_string($connection, upload("pic", "pictures/"));
		$description = mysqli_real_escape_string($connection, $_POST["description"]);
		$category = mysqli_real_escape_string($connection, $_POST["category"]);

		$sql = "INSERT INTO 10153316_item (name, cond, quantity, unit, thumbnail, phone, email, description, seller_ID, category_ID) VALUES ('$name', '$condition', '$qty', '$unit', 'pictures/".$p."', '$usrtel', '$email', '$description', '$user_ID', '$category')";
		$result = mysqli_query($connection, $sql);

		if (!$result) {
			$errors[] = "Upload failed";
		} else {
			$notifications[] = "Upload successful";
			$name = "";
			$qty =  "";
			$unit = "";
			$description="";
		}
} else {
	$name = isset($_POST['name']) ? $_POST['name'] : "";
	$condition = isset($_POST['condition']) ? $_POST['condition'] : "";
	$qty = isset($_POST['qty']) ? $_POST['qty'] : "";
	$unit = isset($_POST['unit']) ? $_POST['unit'] : "";
	$description = isset($_POST['description']) ? $_POST['description'] : "";
	$category = isset($_POST['category']) ? $_POST['category'] : "";
}
}


if (!empty($errors)) {
	echo'<div>';
  foreach($errors as $e):
    echo'<p style="border:1px solid #000; padding: 5px; background-color:red">'.$e.'</p>';
  endforeach;
echo '</div>';
}

if (!empty($notifications)) {
	echo'<div>';
  foreach($notifications as $n):
    echo'<p style="border:1px solid #000; padding: 5px; background-color:green">'.$n.'</p>';
  endforeach;
echo '</div>';
}
?>


<form class="form-signin" action='controller.php?mode=addproduct' method="POST" enctype="multipart/form-data">
  <h2 class="form-signin-heading">Add an item</h2>
	<h4 class ="form-signin-heading">Product information:</h4>

  <fieldset>
    <div class="control-group">
      <label class="control-label"  for="name">Name</label>
      <div class="controls">
        <input type="text" name="name" placeholder="Item name" value="<?=$name?>" class="form-control">
      </div>
    </div>

		<div class="control-group">
			<label class="control-label"  for="category">Category</label>
			<div class="controls">
				<select name="category" class="form-control">
					<?php
						global $connection;
						$fetch_category = "SELECT category_ID, category FROM 10153316_category";
						$result = mysqli_query($connection, $fetch_category);
						while($row = mysqli_fetch_assoc($result)) {
							 echo "<option value=".$row["category_ID"].">".$row["category"]."</option>";
						}
						?>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"  for="condition">Condition</label>
			<div class="controls">
				<select name="condition" class="form-control">
						<option value="new" <?php if(isset($condition) && $condition=="new") echo 'selected="selected"'; ?>>New</option>
						<option value="used" <?php if(isset($condition) && $condition=="used") echo 'selected="selected"'; ?>>Used</option>
				</select>
			</div>
		</div>

		<div class="control-group">
      <label class="control-label"  for="quantity">Quantity</label>
      <div class="controls">
        <input type="text" name="quantity" placeholder="Quantity" value="<?=$qty?>" class="form-control">
      </div>
    </div>

		<div class="control-group">
      <label class="control-label"  for="unit">Unit</label>
      <div class="controls">
        <input type="text" name="unit" placeholder="Unit" value="<?=$unit?>" class="form-control">
      </div>
    </div>

		<div class="control-group">
			<label class="control-label"  for="description">Description</label>
			<div class="controls">
				<input type="text" name="description" placeholder="Description" value="<?=$description?>" class="form-control">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"  for="pic">Display picture</label>
			<div class="controls">
				  <input type="file" name="pic" accept="image/*" class="form-control">
			</div>
		</div>

		<h4 class ="form-signin-heading">Contact information:</h4>

		<div class="control-group">
			<label class="control-label"  for="usrtel">Phone number</label>
			<div class="controls">
				  <input type="tel" name="usrtel" value="<?=$tel?>" class="form-control">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"  for="email">E-mail address</label>
			<div class="controls">
					<input type="email" name="email" value="<?=$email?>" class="form-control">
			</div>
		</div><br/>

		<div class ="controls">
    	<input type="submit" value="Next" class="btn btn-lg btn-primary btn-block"/></br>
		</div>

  </fieldset>
</form>
</div>
