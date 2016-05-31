
<?php

if(isset($_GET['cmr'])){
  $message = cancel_my_request($_GET['cmr']);
  echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
}

if(isset($_GET['ar'])){
  $message = accept_request($_GET['ar']);
  echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
}

if(isset($_GET['dr'])){
  $message = decline_request($_GET['dr']);
  echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
}

?>
<div class="container">
  <div class="row">
    <section class="content">
      <h2>My requests</h2>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="table-container">
              <table class="table table-filter">
                <tbody>

                  <?php
                    $requests = show_my_requests();

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
                                  <p>You have sent a request to <b>'.$seller_name.'</b> to trade their item <b>'.$buyitem_name.'</b> for your item <b>'.$sellitem_name.'</b><a class="control-group controls btn btn-xs btn-primary btn-block" href="controller.php?mode=traderequests&cmr='.$value[0].'">Cancel</a></p>';
                      }
                    } else {
                      echo '<p>You have currently no active requests</p>';
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


      <section class="content">
        <h2>Incoming requests</h2>
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="table-container">
                <table class="table table-filter">
                  <tbody>

                    <?php
                      $requests = show_incoming_requests();
                      if(!empty($requests)){
                        foreach($requests as $key => $value){
                          global $connection;
                          $get_seller = ("SELECT username FROM 10153316_user WHERE user_ID in (SELECT seller_ID FROM 10153316_item where item_ID = '$value[1]')");
                          $seller = mysqli_fetch_assoc(mysqli_query($connection, $get_seller));
                          $seller_name = $seller['username'];

                          $get_buyitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[2]");
                          $buyitem = mysqli_fetch_assoc(mysqli_query($connection, $get_buyitem));
                          $buyitem_name = $buyitem['name'];

                          $get_sellitem = ("SELECT name FROM 10153316_item WHERE item_ID = $value[1]");
                          $sellitem = mysqli_fetch_assoc(mysqli_query($connection, $get_sellitem));
                          $sellitem_name = $sellitem['name'];

                          echo '<div class="row">
                                    <p>User <b>'.$seller_name.'</b> has requested to trade their item <b>'.$sellitem_name.'</b> for your item <b>'.$buyitem_name.'</b><a class=" control-group controls btn btn-xs btn-primary btn-block" href="controller.php?mode=traderequests&ar='.$value[0].'">Accept</a><a class="control-group controls btn btn-xs btn-primary btn-block" href="controller.php?mode=traderequests&dr='.$value[0].'">Decline</a></br></p>';
                        }
                      } else {
                        echo '<p>You have currently no active declined requests</p>';
                      };
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
</div>
</div>
