<div class="container">
  <div class="row">

    <?php
      $items = show_my_items();
      foreach($items as $key => $value){
        echo '<div class="row">
          <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
              <img src="'.$value[6].'" alt="">
              <div class="caption">
                <h4 class="pull-right">€'.$value[4].'</h4>
                <h4><a href="#">'.$value[1].'</a>
                </h4>
                <p>'.$value[9].'</p>
              </div>
            </div>
          </div>
        </div>';
      }
    ?>
  </div>
</div>
