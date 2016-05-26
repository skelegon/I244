<?php
$item = get_item_info();

echo '<div class="row">
  <div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
      <img src="'.$item['thumbnail'].'" alt="">
      <div class="caption">
        <h4>'.$item['item_ID'].'</h4>
        <p>'.$item['name'].'</p>

      </div>
    </div>
  </div>
</div>';


	if(isset($_SESSION['username'])){
		$info = get_user_info();
		$user_ID = $info['user_ID'];
	} else {
		show_login();
	}
	$errors=array();

	if (!empty($_POST)){
		if (empty($_POST["trade"])) {
			$errors[]="Choose an item to trade!";
		}

		if (empty($errors)){
			global $connection;
			$comment=mysqli_real_escape_string($connection, $_POST["comment"]);
			$sellitem=mysqli_real_escape_string($connection, $_POST["trade"]);
      $buyitem=mysqli_real_escape_string($connection, $item['item_ID']);

      $change_status = "UPDATE 10153316_item SET status = '2' WHERE item_ID = $sellitem";
      $res = mysqli_query($connection, $change_status);

			$sql="INSERT INTO 10153316_request(sellitem_ID, buyitem_ID, comment, status) VALUES ('$sellitem', '$buyitem', '$comment', '2')";

			$result = mysqli_query($connection, $sql);
			if (!$result) {
				$errors[] = "Request failed";
			} else {
				$notifications[] = "Upload successful";
			}
	  }
  }

?>
  <div class="Product_Content">
      <form class="form-horizontal" action='controller.php?mode=item&id=<?=$_GET['id']?>' method="POST" enctype="multipart/form-data">
          <fieldset>
              <h4>Propose a trade</h4>
								<div class="col-lg-12 form-group margin50">
                  <label class="col-lg-2"  for="Name">My proposal:</label>
                  <div class="col-lg-4">
                    <select name="trade">
											<?php
												global $connection;
                        $user = get_user_info();
                        $user_ID = $user['user_ID'];
                        $username = $_SESSION['username'];
												$fetch_items = "SELECT item_ID, name FROM 10153316_item WHERE seller_ID = $user_ID AND status ='1'";
												$result = mysqli_query($connection, $fetch_items);
												while($row = mysqli_fetch_assoc($result)) {
													 echo "<option value=".$row["item_ID"].">".$row["name"]."</option>";
												}
												?>
				            </select>
                  </div>
                </div>

                <div class="col-lg-12 form-group margin50">
                      <label class="col-lg-2"  for="Name">Add a comment to your trade proposal:</label>
                      <div class="col-lg-4">
                          <input type="text" name="comment" placeholder="comment">
                      </div>
                </div>

							<div class ="controls">
              	<input type="submit" value="Submit" class="btn btn-lg btn-primary btn-block"/></br>
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
