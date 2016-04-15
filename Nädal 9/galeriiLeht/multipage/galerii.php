	<?php
	require_once('head.html');

  echo '<h3>Fotod</h3>';

	$pildid = array(
		array('big'=>'pildid/nameless1.jpg', 'alt'=>'nimetu 1'),
		array('big'=>'pildid/nameless2.jpg', 'alt'=>'nimetu 2'),
		array('big'=>'pildid/nameless3.jpg', 'alt'=>'nimetu 3'),
		array('big'=>'pildid/nameless4.jpg', 'alt'=>'nimetu 4'),
		array('big'=>'pildid/nameless5.jpg', 'alt'=>'nimetu 5'),
		array('big'=>'pildid/nameless6.jpg', 'alt'=>'nimetu 6')
	);

	echo 	'<div id="gallery">';

	foreach($pildid as $pilt) {
			echo '<img src="'.$pilt['big'].'" alt="'.$pilt['alt'].'"';
	}
	echo '</div>';


/*
	<div id="gallery">
		<img src="pildid/nameless1.jpg" alt="nimetu 1" />
		<img src="pildid/nameless2.jpg" alt="nimetu 2" />
		<img src="pildid/nameless3.jpg" alt="nimetu 3" />
		<img src="pildid/nameless4.jpg" alt="nimetu 4" />
		<img src="pildid/nameless5.jpg" alt="nimetu 5" />
		<img src="pildid/nameless6.jpg" alt="nimetu 6" />
	</div>
*/

require_once('foot.html');

?>
