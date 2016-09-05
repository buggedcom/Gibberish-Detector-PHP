<?php

$dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
require_once '../lib/Gibberish.php';

$train_result = Gibberish::train($dir.'big.txt', $dir.'good.txt', $dir.'bad.txt', $dir.'matrix.txt');
if($train_result === true)
{
    include 'test.php';
}
else
{
    echo 'The library could not be trained. Check write permissions or something.';
}