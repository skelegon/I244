<div class="container">
  <div class="row">

    <?php
    if(isset($_GET['del'])){
      $message = delete_product($_GET['del']);
      echo '<div style="border:1px solid #000; padding: 5px; background-color:orange">'.$message.'</div>';
    }?>

		<section class="content">
			<h2>My products</h2>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="table-container">
							<table class="table table-filter">
								<tbody>
                         <?php
                            $items = show_my_items();
                            foreach($items as $key => $value){
                              echo '<tr>
                                      <td>
                                        <div class="media">
                                          <img class="pull-left" src="'.$value[5].'" alt="">
                                          <div class="media-body">
                                            <span class="media-meta pull-right">Views: '.$value[11].'</span>
                                            <h4 class="title">'.$value[1].'</h4>
                                            <p class="description">Description: '.$value[8].'</p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class ="controls">
                                          <a href="controller.php?mode=myproducts&del='.$value[0].'" class="btn btn-lg btn-primary btn-block">Delete</a></br>
                                        </div>
                                      </td>
                                    </tr>';
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
