<?php require_once('head.html'); ?>

	<h3>Valiku tulemus</h3>

	<?php
	if(!empty($_GET)){
		echo 'Kasutaja valis pildi: '.$_GET['pilt'];
	} else {
		echo "Kasutaja ei valinud pilti!";

	}
?>

<?php require_once('foot.html'); ?>
