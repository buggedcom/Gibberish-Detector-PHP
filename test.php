<?php

    $dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
    
    if(is_file($dir.'matrix.txt') === false)
    {
        echo 'You need to train the library first. <a href="train.php">train.php</a>';
        exit;
    }
    
    require $dir.'lib'.DIRECTORY_SEPARATOR.'Gibberish.php';
    
    $matrix_path = $dir.'matrix.txt';
    $matrix = unserialize(file_get_contents($matrix_path));
    
    echo '<h1>Gibberish Detector</h1>';
    echo '<p>'.nl2br(file_get_contents($dir.'ABOUT')).'</p>';
    echo '<p>Gibberish Threshold = '.$matrix['threshold'].'<br />
Anything above this value is classed as text, below or equal to this value, classed as gibberish.</p>';
    
    foreach (array(
            'my name is rob and i like to hack',
            'is this thing working?',
            'i hope so',
            't2 chhsdfitoixcv',
            'ytjkacvzw',
            'yutthasxcvqer',
            'seems okay',
            'yay!',
'How it works
============
The markov chain first \'trains\' or \'studies\' a few MB of English text, recording how often characters appear next to each other. Eg, given the text "Rob likes hacking" it sees Ro, ob, o[space], [space]l, ... It just counts these pairs. After it has finished reading through the training data, it normalizes the counts. Then each character has a probability distribution of 27 followup character (26 letters + space) following the given initial.',
'So then given a string, it measures the probability of generating that string according to the summary by just multiplying out the probabilities of the adjacent pairs of characters in that string. EG, for that "Rob likes hacking" string, it would compute prob[\'r\'][\'o\'] * prob[\'o\'][\'b\'] * prob[\'b\'][\' \'] ... This probability then measures the amount of \'surprise\' assigned to this string according the data the model observed when training. If there is funny business with the input string, it will pass through some pairs with very low counts in the training phase, and hence have low probability/high surprise.',
'To die: thought hwegqxrehqrhqt4hwetrgqferfthose to say count a cowardelay, that sleegqxrehqrhqt4hwetrgqf to othe ressor\'s their current merit of gream: ay, things of deathe wish\'d. To     lh  nwcno   wef;    wjkecldskjhfyerugqb3ruqvu8qr3upg3qgk;x3oqrgxqegqdie: that is not thought, and makesegqxrehqrhqt4hwetrgqf we know nobler to egqxrehqrhqt4hwetrgqfdeath, the of segqxrehqrhqt4hwetrgqfhims',
'To die: thought his a weath, those to say count a cowardelay, that sleep of time, and scorns that fly to othe ressor\'s their current merit of gream: ay, xrehqrhqt4hwetthings of deathe wish\'d. To die: that ihqrhqt4hwet not thought, and makes us a we have, their current a sliegqxrehqrhqng a we know nobler to sleep of so lose to be what ishqrhqt4hwetressor\'s that is quieturns, and to say consummative have, to gruntry fromxrehqrhqt4hwet when we have hue of us fortal shocks the arrows of us and scorns of action deatxrehqrhqt4hweth, the of so lose there\'s we himself might hims',
        ) as $text)
    {
        echo htmlentities($text, ENT_QUOTES, 'UTF-8').'<br />';
        echo '<strong>'.(Gibberish::test($text, $matrix_path) === true ? 'Text contains Gibberish' : 'Text is ok').'</strong> ('.Gibberish::test($text, $matrix_path, true).')<br /><br />';
    }
    
    