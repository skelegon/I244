<div class="container">
  <div class="row">
    <div class="col-md-3">
      <p class="lead">Categories</p>
      <div class="list-group">
        <a href="controller.php?mode=buy" class="list-group-item">All</a>
        <?php
          global $connection;
          $fetch_category = ("SELECT category_ID, category FROM 10153316_category ORDER BY category ASC");
          $result = mysqli_query($connection, $fetch_category);
          while($row = mysqli_fetch_assoc($result)) {
            echo '<a href="controller.php?mode=buy&category='.$row['category_ID'].'" class="list-group-item">'.$row['category'].'</a>';
          }
          ?>
        </div>
    </div>


    <div class="col-md-9">
      <?php
      $cat = null;
      if(isset($_GET['category'])){
        $cat = $_GET['category'];
      }
        $items = show_items($cat);

        if (!empty($items)) {
          foreach($items as $key => $value){
            echo '
              <div class="col-sm-3 col-lg-3 col-md-3">
                <div class="thumbnail">
                  <img class="pict" src="'.$value[5].'" alt="pic">
                  <div class="caption">
                    <h4><a href="?mode=item&id='.$value[0].'">'.$value[1].'</a></h4>
                  </div>
                </div>
              </div>';
          }
        } else {
          echo '<div class="message"><p>There are currently no items to display.</p></div>';
        }?>
    </div>
  </div>
</div>
