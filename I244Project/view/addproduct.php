<?php
$email = "";
$tel = "";
if(isset($_SESSION['username'])){
	$info = get_user_info();
	$email = $info['email'];
	$tel = $info['phone'];
	$user_ID = $info['user_ID'];
} else {
	show_login();
}

$errors=array();
$name = "";
$qty = "";
$unit = "";
$unitprice ="";
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

		$sql = "INSERT INTO 10153316_item (name, cond, quantity, unit, thumbnail, phone, email, description, seller_ID) VALUES ('$name', '$condition', '$qty', '$unit', 'pictures/".$p."', '$usrtel', '$email', '$description', $user_ID)";
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
?>

<h1>Add an item</h1>
  <div class="Product_Content">
      <form class="form-horizontal" action='?mode=addproduct' method="POST" enctype="multipart/form-data">
          <fieldset>
              <h4>Product information:</h4>
                <div class="col-lg-12 form-group margin50">
                  <label class="col-lg-2"  for="Name">Name</label>
                  	<div class="col-lg-4">
                    	<input type="text" name="name" placeholder="Item name" value="<?=$name?>">
                    </div>
                </div>

								<div class="col-lg-12 form-group margin50">
                  <label class="col-lg-2"  for="Name">Category</label>
                  <div class="col-lg-4">
                    <select name="category">
											<?php
												global $connection;
												$fetch_category = "SELECT category FROM 10153316_category";
												$result = mysqli_query($connection, $fetch_category);

												while($row = mysqli_fetch_assoc($result)) {
													 echo "<option value=".$row["category"].">".$row["category"]."</option>";
												}
												?>
				            </select>
                  </div>
                </div>

                <div class="col-lg-12 form-group margin50">
                      <label class="col-lg-2"  for="Name">Condition</label>
                      <div class="col-lg-4">
                          <select name="condition">
                              <option value="new" <?php if(isset($condition) && $condition=="new") echo 'selected="selected"'; ?>>New</option>
                              <option value="used" <?php if(isset($condition) && $condition=="used") echo 'selected="selected"'; ?>>Used</option>
                          </select>
                      </div>
                </div>

                <div class="col-lg-12 form-group margin50">
                      <label class="col-lg-2"  for="Name">Quantity</label>
                      <div class="col-lg-4">
                          <input type="quantity" name="qty" min="0" placeholder="1" value="<?=$qty?>">
                      </div>
                </div>

                <div class="col-lg-12 form-group margin50">
                      <label class="col-lg-2"  for="Name">Unit</label>
                      <div class="col-lg-4">
                          <input type="text" name="unit" placeholder="pcs" value="<?=$unit?>">
                      </div>
                </div>

                <div class="col-lg-12 form-group margin50">
                      <label class="col-lg-2"  for="Name">Description</label>
                      <div class="col-lg-4">
                          <input type="text" name="description" placeholder="description" value="<?=$description?>">
                      </div>
                </div>

                <div class="col-lg-12 form-group margin50">
                      <label class="col-lg-2"  for="Name">Display picture</label>
                      <div class="col-lg-4">
                          <input type="file" name="pic" accept="image/*">
                      </div>
                </div>

              <h4>Contact information</h4>
              <div class="col-lg-12 form-group margin50">
                    <label class="col-lg-2"  for="Name">Phone number</label>
                    <div class="col-lg-4">
                        <input type="tel" name="usrtel" value="<?=$tel?>">
                    </div>
              </div>

              <div class="col-lg-12 form-group margin50">
                    <label class="col-lg-2"  for="Name">E-mail address</label>
                    <div class="col-lg-4">
                        <input type="email" name="email" value="<?=$email?>">
                    </div>
              </div>

							<div class ="controls">
              	<input type="submit" value="Next" class="btn btn-lg btn-primary btn-block"/></br>
							</div>
        </fieldset>
      </form>

	<?php if (isset($errors)):?>
			<?php foreach($errors as $error):?>
				<div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
			<?php endforeach;?>
	<?php endif;?>

	<?php if (isset($notifications)):?>
			<?php foreach($notifications as $notification):?>
				<div style="color:green;"><?php echo htmlspecialchars($notification); ?></div>
			<?php endforeach;?>
	<?php endif;?>

</div>
