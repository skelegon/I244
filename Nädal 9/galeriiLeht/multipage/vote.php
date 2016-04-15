<?php
require_once('head.html');

$pildid = array(
	array('big'=>'pildid/nameless1.jpg', 'alt'=>'nimetu 1', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless2.jpg', 'alt'=>'nimetu 2', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless3.jpg', 'alt'=>'nimetu 3', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless4.jpg', 'alt'=>'nimetu 4', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless5.jpg', 'alt'=>'nimetu 5', 'height'=>'100', 'name'=>'pilt'),
	array('big'=>'pildid/nameless6.jpg', 'alt'=>'nimetu 6', 'height'=>'100', 'name'=>'pilt')
);

echo 	'<h3>Vali oma lemmik :)</h3>';
echo '<form action="tulemus.php" method="GET">';
$counter = 1;

foreach ($pilid as $pilt) {
	echo '<p>';
	echo '<label for="p'.$counter.'"><img src="'.$pilt['big'].'" alt="'.$pilt['alt'].'" height="'$pilt['height'].'" /></label>'."\n";
	echo '<input type="radio" value="'.$counter.'" id="p'.$counter.'" name="'.$pilt['name'].'"/></p>'."\n";
	$counter++;
};

echo '<br/><input type="submit" value="Valin!"/></form>';

require_once('foot.html');
?>
