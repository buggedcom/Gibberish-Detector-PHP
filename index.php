<?php

require 'Gibberish.class.php';

$trainingDir = 'phrases';
$dir = dirname(__FILE__).'/'.$trainingDir.'/';
$big_text_file = $dir.'big.txt';
$good_text_file = $dir.'good.txt';
$bad_text_file = $dir.'bad.txt';
$matrix_file = $dir.'matrix.txt';
$test_file = $dir.'test.txt';

$trainingRequested = isset($_GET['train']);
$alreadyTrained = is_file($matrix_file);

if ( $trainingRequested ) {
	$trainingSuccessful = Gibberish::train(
		$big_text_file,
		$good_text_file,
		$bad_text_file,
		$matrix_file
		);
	if ($trainingSuccessful) {
	    runGibberishTest($matrix_file, $test_file);
	} else {
	    echo 'Training failed.';
	}
} else {
	if ( !$alreadyTrained ) {
			echo 'Needs training. <a href="?train">Click to Train</a>';
	} else {
		runGibberishTest($matrix_file, $test_file);
	}
}



?><?php



function runGibberishTest($matrix_file, $test_file)
{
	$matrix = unserialize(file_get_contents($matrix_file));

	echo '<h1>Gibberish Detector</h1>';
	echo '<p>'.nl2br(file_get_contents('../ABOUT')).'</p>';
	echo '<p>Gibberish Threshold = '.$matrix['threshold'].'<br />
	Anything above this value is classed as text, below or equal to this value, classed as gibberish.</p>';

	echo '<div><a href="?train" class="button">Re-train</a></div>';

	$handle = fopen($test_file, "r");
	if ($handle) {
	    while (($text = fgets($handle)) !== false) {
	        $htmlText = htmlentities($text, ENT_QUOTES, 'UTF-8');
	        $isGibberish = Gibberish::test($text, $matrix_file) === true;
	        $odds = Gibberish::test($text, $matrix_file, true);

	        echo $htmlText;
	        if ($isGibberish) {
	            echo ' = <strong style="color:gray">Gibberish';
	            echo ' ('.$odds.')';
	            echo '</strong><br><br>';
	        } else {
	            echo ' = <strong style="color:green">Looks Good';
	            echo ' ('.$odds.')';
	            echo '</strong><br><br>';
	        }
	    }

	    fclose($handle);
	} else {
	    // error opening the file.
	}
} // runTest

?>

<style type="text/css">
    .button {
        display: inline-block;
        margin: 10px;
        background: blue;
        color: white;
        font-weight: bold;
        text-decoration: none;
        padding: 10px;
    }
</style>