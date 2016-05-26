<div class="container">
  <div class="row">

    <?php

    if(isset($_GET['del'])){
      $message = delete_product($_GET['del']);
      echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
    }

      $items = show_my_items();
      foreach($items as $key => $value){
        echo '<div class="row">
          <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
              <img src="'.$value[5].'" alt="">
              <div class="caption">
                <h4><a href="#">'.$value[1].'</a>
                </h4>
                <p>'.$value[9].'</p>
              </div>
            </div>
          </div>
          <div class ="controls">
            <a href="controller.php?mode=myproducts&del='.$value[0].'" style="border:1px solid #000; padding:5px; background-color:#ccc">Delete</a></br>
          </div>
        </div>';
      }
    ?>
