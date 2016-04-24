<?php require_once('head.html'); ?>

	<h3>Valiku tulemus</h3>

	<?php
	if(!empty($_POST)){
		if(!isset($_SESSION['voted_for'])){
			$_SESSION['voted_for']=$_POST['pilt'];
			echo 'Kasutaja valis pildi: '.$_POST['pilt'];
		} else {
			echo 'Uuesti hääletamine ebaõnnestus. Kasutaja juba eelnevalt valis pildi nr.'.$_SESSION['voted_for'];
		}
	} else {
		if (isset($_SESSION['voted_for'])){
			echo 'Kasutaja juba eelnevalt valis pildi nr.'.$_SESSION['voted_for'];
		} else {
			echo "Kasutaja ei valinud pilti!";
		}
	}
?>

<?php require_once('foot.html'); ?>
