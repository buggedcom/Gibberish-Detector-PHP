<?php

    $dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
    require $dir.'lib'.DIRECTORY_SEPARATOR.'Gibberish.php';

    $train_result = Gibberish::train($dir.'big.txt', $dir.'good.txt', $dir.'bad.txt', $dir.'matrix.txt');
    if($train_result === true)
    {
        echo 'Library trained. Now run <a href="test.php">test.php</a>';
    }
    else
    {
        echo 'The library could not be trained. Check write permissions or something.';
    }