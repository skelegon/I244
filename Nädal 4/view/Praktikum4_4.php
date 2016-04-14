
    		<div id="login">
		      <form action="?mode=logisisse" method="POST">
		        <table>
		          <tr>
		            <th>Kasutajanimi</th>
		            <th><input name="kasutajanimi" type="text"</input></th>
		          </tr>
		          <tr>
		            <th>Parool</th>
		            <th><input name="parool" type="password"</input></th>
		          </tr>
		          <tr>
		            <th colspan="2"><input type="submit" value="Sumbit"></th>
		          </tr>
		        </table>
                <a href="?mode=registreeri">Sign up</a></br>
		      </form>
            <?php if (!empty($errors)):?>
              <?php foreach($errors as $e):?>
                <p style="color:red"><?php echo $e; ?></style>
              <?php endforeach;?>
            <?php endif;?>
    		</div>
