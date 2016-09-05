<?php

$dir = dirname(__FILE__).'/';
require '../lib/Gibberish.php';

$trainingRequested = isset($_GET['train']);
$alreadyTrained = is_file($dir.'matrix.txt');

if ( $trainingRequested ) {
	$wasTrained = Gibberish::train($dir.'big.txt', $dir.'good.txt', $dir.'bad.txt', $dir.'matrix.txt');
	if ($wasTrained) {
	    include 'test.php';
	} else {
	    echo 'Training failed.';
	}
} else {
	if ( !$alreadyTrained ) {
			echo 'Needs training. <a href="?train">Click to Train</a>';
	} else {
		include 'test.php';
	}
}