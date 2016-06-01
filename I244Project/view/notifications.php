<?php

if(isset($_GET['rmr'])){
  $message = remove_my_request($_GET['rmr']);
  echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
}

?>

<div class="container">
  <div class="row">
    <section class="content">
      <h2>Accepted requests</h2>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="table-container">
              <table class="table table-filter">
                <tbody>

                  <?php
                    $requests = show_accepted_requests();

                    if(!empty($requests)){
                      foreach($requests as $key => $value){
                        global $connection;
                        $get_seller = ("SELECT username, email, phone FROM 10153316_user WHERE user_ID in (SELECT seller_ID FROM 10153316_item where item_ID = '$value[2]')");
                    		$seller = mysqli_fetch_assoc(mysqli_query($connection, $get_seller));
                        $seller_name = $seller['username'];
                        $seller_phone = $seller['phone'];
                        $seller_email = $seller['email'];

                        $get_buyitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[2]");
                        $buyitem = mysqli_fetch_assoc(mysqli_query($connection, $get_buyitem));
                        $buyitem_name = $buyitem['name'];

                        $get_sellitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[1]");
                        $sellitem = mysqli_fetch_assoc(mysqli_query($connection, $get_sellitem));
                        $sellitem_name = $sellitem['name'];

                        echo '<div class="row">
                                  <p>User <b>'.$seller_name.'</b> accepted your request to trade their item <b>'.$buyitem_name.'</b> for your item <b>'.$sellitem_name.'</b></p>
                                  <p>To complete the transaction, please contact the other party by phone: <b>'.$seller_phone.'</b> or by e-mail: <b>'.$seller_email.'</b>.</p>
                                  <div class="control-group">
                                    <div class="controls">
                                      <a class="btn btn-sm btn-primary btn-block" href="controller.php?mode=notifications&rmr='.$value[0].'">Remove</a>
                                    </div>
                                  </div>
                                </div>';
                      }
                    } else {
                      echo '<p>You have currently no active accepted requests</p>';
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>

  <div class="row">
    <section class="content">
      <h2>Declined requests</h2>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="table-container">
              <table class="table table-filter">
                <tbody>

                  <?php
                    $requests = show_declined_requests();
                    if(!empty($requests)){
                      foreach($requests as $key => $value){
                        global $connection;
                        $get_seller = ("SELECT username FROM 10153316_user WHERE user_ID in (SELECT seller_ID FROM 10153316_item where item_ID = '$value[2]')");
                        $seller = mysqli_fetch_assoc(mysqli_query($connection, $get_seller));
                        $seller_name = $seller['username'];

                        $get_buyitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[2]");
                        $buyitem = mysqli_fetch_assoc(mysqli_query($connection, $get_buyitem));
                        $buyitem_name = $buyitem['name'];

                        $get_sellitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[1]");
                        $sellitem = mysqli_fetch_assoc(mysqli_query($connection, $get_sellitem));
                        $sellitem_name = $sellitem['name'];

                        echo '<div class="row">
                                  <p>User <b>'.$seller_name.'</b> declined your request to trade their item <b>'.$buyitem_name.'</b> for your item <b>'.$sellitem_name.'</b></p>
                                  <div class="control-group">
                                    <div class="controls">
                                      <a class="btn btn-sm btn-primary btn-block" href="controller.php?mode=notifications&rmr='.$value[0].'">Remove</a>
                                    </div>
                                  </div>
                                </div>';
                      }
                    } else {
                      echo '<p>You have currently no active declined requests</p>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="row">
    <section class="content">
      <h2>Cancelled by admin</h2>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="table-container">
              <table class="table table-filter">
                <tbody>

                  <?php
                    $requests = show_admin_cancelled_requests();
                    if(!empty($requests)){
                      foreach($requests as $key => $value){
                        global $connection;
                        $get_seller = ("SELECT username FROM 10153316_user WHERE user_ID in (SELECT seller_ID FROM 10153316_item where item_ID = '$value[2]')");
                        $seller = mysqli_fetch_assoc(mysqli_query($connection, $get_seller));
                        $seller_name = $seller['username'];

                        $get_buyitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[2]");
                        $buyitem = mysqli_fetch_assoc(mysqli_query($connection, $get_buyitem));
                        $buyitem_name = $buyitem['name'];

                        $get_sellitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[1]");
                        $sellitem = mysqli_fetch_assoc(mysqli_query($connection, $get_sellitem));
                        $sellitem_name = $sellitem['name'];

                        echo '<div class="row">
                                  <p>Your request to trade <b>'.$sellitem_name.'</b> for user <b>'.$seller_name.'</b> uploaded item <b>'.$buyitem_name.'</b> was cancelled by admin.</p>
                                  <div class="control-group">
                                    <div class="controls">
                                      <a class="btn btn-sm btn-primary btn-block" href="controller.php?mode=notifications&rmr='.$value[0].'">Remove</a>
                                    </div>
                                  </div>
                                </div>';
                      }
                    } else {
                      echo '<p>Nothing to show here</p>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
