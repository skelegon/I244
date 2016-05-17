<div class="container">
  <div class="row">
    <div class="col-md-3">
      <p class="lead">Categories</p>
      <div class="list-group">
        <?php
          global $connection;
          $fetch_category = "SELECT category FROM 10153316_category ORDER BY category ASC";
          $result = mysqli_query($connection, $fetch_category);
          while($row = mysqli_fetch_assoc($result)) {
            echo '<a href="#" class="list-group-item">'.$row['category'].'</a>';
          }
          ?>
      </div>
    </div>

    <?php
      $items = show_items();
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
