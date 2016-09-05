# Gibberish Detector PHP
Determines if text contains gibberish.

Example 1: You want phrases like "Hello, world" and never "dsfknifdkoindwsif32839hdd"

Example 2: You want usernames like "jamesjohn" and never "@H(*E*(@*(@EBUiujbn2mnn3"

## How does it work?

Markov Chains. In this case, they describe which letters should or should not to be next to each other. By showing examples of good text and bad text, it teaches the software how to guess what letter combinations look like gibberish and which letter combinations look reasonably likely to be good text.

## How do I use it?

1) Train the Markov Chains
```
$trainingSuccessful = Gibberish::train(
	$big_text_file,
	$good_text_file,
	$bad_text_file,
	$matrix_file
	);
```

2) Test new text against the Markov Chains
```
$oddsItsGoodText = Gibberish::test($inputText, $matrix_file, true);
```

## Who made it?

Originally written in Python by Rob Renaud.

Translated into PHP by Oliver Lillie.

Spruced up by Richard512
