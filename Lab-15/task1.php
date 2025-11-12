<?php

if ($argc < 2) {
    fwrite(STDERR, "Usage: php {$argv[0]} <filename>\n");
    exit(1);
}

$filename = $argv[1];

if (!is_readable($filename)) {
    fwrite(STDERR, "Error: cannot read file '{$filename}'\n");
    exit(1);
}

$content = file_get_contents($filename);

// Use Unicode character properties for accurate counts beyond ASCII
$uppercase = preg_match_all('/\p{Lu}/u', $content, $m);
$lowercase = preg_match_all('/\p{Ll}/u', $content, $m);
$digits    = preg_match_all('/\p{Nd}/u', $content, $m);
// Special symbols: any character that is not a letter (\p{L}), not a number (\p{N}) and not whitespace
$special   = preg_match_all('/[^\p{L}\p{N}\s]/u', $content, $m);

echo "Uppercase letters: {$uppercase}\n";
echo "Lowercase letters: {$lowercase}\n";
echo "Digits: {$digits}\n";
echo "Special symbols: {$special}\n";
?>