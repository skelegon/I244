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
?>

<h1>Propose a trade</h1>
  <div class="Product_Content">
      <form class="form-horizontal" action='' method="POST" enctype="multipart/form-data">
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
												$fetch_items = "SELECT name FROM 10153316_item WHERE seller_ID = $user_ID";
												$result = mysqli_query($connection, $fetch_items);
												while($row = mysqli_fetch_assoc($result)) {
													 echo "<option value=".$row["name"].">".$row["name"]."</option>";
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
