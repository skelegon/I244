<div class="container">
  <div class="row">
    <?php
      if(isset($_GET['del'])){
        $message = product_status($_GET['del']);
        echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
      }?>
      <section class="content">
        <h2>Items</h2>
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="table-container">
                <table class="table table-filter">
                  <tbody>
                    <?php
                    $items = list_all_items();
                    foreach($items as $value){
                      $sellerID = $value[10];
                      $username = get_items_owner_info($sellerID)['username'];
                      echo '<tr><td>Item: <b>'.$value[1].'</b></td><td>by user: <b>'.$username.'</b></td>';
                      if($value[14] == 2){
                        echo '<td><a href="controller.php?mode=allitems&del='.$value[0].'" class = "btn-unsuspend">Un-suspend</a>';
                      } else if ($value[14] == 1){
                        echo '<td><a href="controller.php?mode=allitems&del='.$value[0].'" class = "btn-suspend">Suspend</a>';
                      }
                      echo '</tr>';
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
