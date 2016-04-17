<?php require_once('head.html'); ?>

	<h3>Valiku tulemus</h3>

	<?php
	if(!empty($_POST)){
		echo 'Kasutaja valis pildi: '.$_POST['pilt'];
	} else {
		echo "Kasutaja ei valinud pilti!";

	}
?>

<?php require_once('foot.html'); ?>
