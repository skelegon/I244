<?php
$pealkiri = "";
$autor = "";
$id = 0;
if(isset($_GET["id"])){
  $pildi_info = hangi_pildi_info($_GET["id"]);
  if(!empty($pildi_info)){
    var_dump($pildi_info);
    $pealkiri = htmlspecialchars($pildi_info['pealkiri']);
    $autor = htmlspecialchars($pildi_info['autor']);
    $id = $pildi_info['id'];
  }
}
 ?>
<div id="upload">
  <form action="?mode=pildivorm&id=<?=$id?>" method="POST">
    <table>
      <tr>
        <th>Autor</th>
        <th><input name="autor" type="text" value="<?=$autor?>"></th>
      </tr>
				<tr>
        <th>Pealkiri</th>

        <th><input name="pealkiri" type="text" value="<?=$pealkiri?>"></th>
      </tr>
				<tr>
					<th>Suur pilt</th>
					<th>
						<input type="file" name="pic" accept="image/*">
			  		<input type="submit">
					</th>
      </tr>
				<tr>
					<th>Väike pilt</th>
					<th>
						<input type="file" name="pic" accept="image/*">
						<input type="submit">
					</th>
				</tr>
				<tr>
        <th colspan="2"><input type="submit" value="Lae üles"></th>
      </tr>
    </table>
  </form>
</div>
