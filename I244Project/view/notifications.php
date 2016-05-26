<?php

if(isset($_GET['rmr'])){
  $message = remove_my_request($_GET['rmr']);
  echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
}

?>

<div class="container">
  <div class="row">
    <div>
      <h4>Accepted requests</h4>
        <?php
          $requests = show_accepted_requests();
          foreach($requests as $key => $value){
            echo '<div class="row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <p>'.$value[0].'</p>
                <p>'.$value[1].'</p>
                <p>'.$value[2].'</p>
                <p>'.$value[3].'</p>
                <p>'.$value[4].'</p>
                <div class ="controls">
                  <a href="controller.php?mode=notifications&rmr='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:#ccc">Remove</a></br>
                </div>
            </div>';
          }
        ?>
    </div>

    <div>
      <h4>Declined requests</h4>
        <?php
          $requests = show_declined_requests();
          foreach($requests as $key => $value){
            echo '<div class="row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <p>'.$value[0].'</p>
                <p>'.$value[1].'</p>
                <p>'.$value[2].'</p>
                <p>'.$value[3].'</p>
                <p>'.$value[4].'</p>
                <div class ="controls">
                  <a href="controller.php?mode=notifications&rmr='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:#ccc">Remove</a></br>
                </div>
            </div>';
          }
        ?>
      </div>
  </div>
</div>
