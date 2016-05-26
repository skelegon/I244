
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

<div>
  <h4>My requests</h4>
    <?php
      $requests = show_my_requests();
      foreach($requests as $key => $value){
        echo '<div class="row">
          <div class="col-sm-4 col-lg-4 col-md-4">
            <p>'.$value[0].'</p>
            <p>'.$value[1].'</p>
            <p>'.$value[2].'</p>
            <p>'.$value[3].'</p>
            <p>'.$value[4].'</p>
            <div class ="controls">
              <a href="controller.php?mode=traderequests&cmr='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:#ccc">Cancel</a></br>
            </div>
        </div>';
      }
    ?>
</div>

<div>
  <h4>Incoming requests</h4>
    <?php
      $in_requests = show_incoming_requests();
      foreach($in_requests as $key => $value){
        echo '<div class="row">
          <div class="col-sm-4 col-lg-4 col-md-4">
            <p>'.$value[0].'</p>
            <p>'.$value[1].'</p>
            <p>'.$value[2].'</p>
            <p>'.$value[3].'</p>
            <p>'.$value[4].'</p>
            <div class ="controls">
                  <a href="controller.php?mode=traderequests&ar='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:#ccc">Accept</a></br>
            </div>
            <div class ="controls">
                  <a href="controller.php?mode=traderequests&dr='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:#ccc">Decline</a></br>
            </div>
        </div>';
      }
    ?>
</div>
</div>
</div>
