<?php

if ($argc < 2) {
    fwrite(STDERR, "Usage: php {$argv[0]} <filename> [text...]\n");
    fwrite(STDERR, "If text arguments are provided they will be written to the file.\n");
    fwrite(STDERR, "If no text is provided, text will be read from STDIN (Ctrl+D to finish).\n");
    exit(1);
}

$filename = $argv[1];

// Collect text to write: remaining CLI args or STDIN
if ($argc > 2) {
    $text = implode(' ', array_slice($argv, 2)) . PHP_EOL;
} else {
    // Read from STDIN
    fwrite(STDOUT, "Enter text (Ctrl+D to finish):\n");
    $text = '';
    while (!feof(STDIN)) {
        $line = fgets(STDIN);
        if ($line === false) break;
        $text .= $line;
    }
}

// Write the text to the file (overwrite)
$bytes = @file_put_contents($filename, $text);
if ($bytes === false) {
    fwrite(STDERR, "Error: failed to write to '{$filename}'\n");
    exit(1);
}

echo "Wrote {$bytes} bytes to '{$filename}'.\n";

// Read back the file contents
$content = @file_get_contents($filename);
if ($content === false) {
    fwrite(STDERR, "Error: failed to read from '{$filename}'\n");
    exit(1);
}

echo "File contents:\n";
echo "--------------------\n";
echo $content;
echo "--------------------\n";

exit(0);
?>