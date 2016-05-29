<div class="container">
  <div class="row">
    <?php
    if(isset($_GET['mod'])){
      $message = suspend_user($_GET['mod']);
      echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
    }
    ?>
    <section class="content">
      <h2>Users</h2>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="table-container">
              <table class="table table-filter">
                <tbody>
                  <?php
                    $users = show_usrs();
                    foreach($users as $key => $value){
                      echo '<tr><td>User: <b>'.$value[1].'</b></td><td>Name: <b>'.$value[3].' '.$value[4].'</b></td><td>Visits: <b>'.$value[5].'</b></td>';
                              if ($value[12] == 1) {
                                echo '<td><a href="controller.php?mode=users&mod='.$value[0].'" class = "btn-suspend">Suspend</a>';
                              } else {
                                echo '<td><a href="controller.php?mode=users&mod='.$value[0].'" class = "btn-unsuspend">Un-suspend</a>';
                              }
                              echo '</td></tr>';
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
