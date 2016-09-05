<?php

$dir = dirname(__FILE__).DIRECTORY_SEPARATOR;

require_once '../lib/Gibberish.php';

$matrix_path = $dir.'matrix.txt';
$matrix = unserialize(file_get_contents($matrix_path));

echo '<h1>Gibberish Detector</h1>';
echo '<p>'.nl2br(file_get_contents('../ABOUT')).'</p>';
echo '<p>Gibberish Threshold = '.$matrix['threshold'].'<br />
Anything above this value is classed as text, below or equal to this value, classed as gibberish.</p>';

echo '<div><a href="?train" class="button">Re-train</a></div>';

$handle = fopen("test.txt", "r");
if ($handle) {
    while (($text = fgets($handle)) !== false) {
        $htmlText = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $isGibberish = Gibberish::test($text, $matrix_path) === true;
        $odds = Gibberish::test($text, $matrix_path, true);

        echo $htmlText;
        if ($isGibberish) {
            echo ' = <strong style="color:gray">Gibberish';
            echo ' ('.$odds.')';
            echo '</strong><br><br>';
        } else {
            echo ' = <strong style="color:green">Username';
            echo ' ('.$odds.')';
            echo '</strong><br><br>';
        }
    }

    fclose($handle);
} else {
    // error opening the file.
}

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