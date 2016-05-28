<div class="product-content">
<?php
$item = get_item_info();

if (!empty($item['item_ID'])) {
  global $connection;
  $buyitem=mysqli_real_escape_string($connection, $item['item_ID']);
  $change_status = "UPDATE 10153316_item SET views = views+1 WHERE item_ID = $buyitem";
  $res = mysqli_query($connection, $change_status);
}

echo '<div class="row">
  <div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
      <img src="'.$item['thumbnail'].'" alt="">
      <div class="caption">
        <h4>'.$item['name'].'</h4>
        <p>'.$item['description'].'</p>
        <p>Condition: '.$item['cond'].'</p>
        <p>Quantity: '.$item['quantity'].' '.$item['unit'].'</p>
      </div>
    </div>
  </div>
</div>';

	if(isset($_SESSION['username'])){
		$info = get_user_info();
		$user_ID = $info['user_ID'];
	} else {
		header("Location: ?mode=login");
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
				$notifications[] = "Trade sent";
			}
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

    <form class="form-horizontal" action='controller.php?mode=item&id=<?=$_GET['id']?>' method="POST" enctype="multipart/form-data">
        <fieldset>
          <h2 class="form-signin-heading">Propose a trade</h2>

          <div class="control-group">
            <label class="control-label"  for="Name">My proposal:</label>
            <div class="controls">
              <select name="trade" class="form-control">
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
          </div><br />

              <div class="control-group">
                <label class="control-label"  for="Name">Include a comment:</label>
                <div class="controls">
                  <input type="text" name="comment" placeholder="comment" class="form-control">
                </div>
              </div><br />

              <div class="control-group">
                <div class="controls">
                  <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
                </div>
              </div><br />
      </fieldset>
    </form>
</div>
