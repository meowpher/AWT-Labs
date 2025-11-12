<?php

if ($argc < 3) {
    fwrite(STDERR, "Usage: php {$argv[0]} <file1> <file2> [outfile]\n");
    exit(1);
}

$file1 = $argv[1];
$file2 = $argv[2];
$outfile = $argv[3] ?? 'merged.txt';

if (!is_readable($file1)) {
    fwrite(STDERR, "Error: cannot read '{$file1}'\n");
    exit(1);
}
if (!is_readable($file2)) {
    fwrite(STDERR, "Error: cannot read '{$file2}'\n");
    exit(1);
}

$outHandle = @fopen($outfile, 'w');
if ($outHandle === false) {
    fwrite(STDERR, "Error: cannot open or create '{$outfile}' for writing\n");
    exit(1);
}

$inHandle = @fopen($file1, 'r');
if ($inHandle === false) {
    fclose($outHandle);
    fwrite(STDERR, "Error: failed to open '{$file1}'\n");
    exit(1);
}
stream_copy_to_stream($inHandle, $outHandle);
fclose($inHandle);

// Ensure there is a newline between files
fwrite($outHandle, PHP_EOL);

$inHandle = @fopen($file2, 'r');
if ($inHandle === false) {
    fclose($outHandle);
    fwrite(STDERR, "Error: failed to open '{$file2}'\n");
    exit(1);
}
stream_copy_to_stream($inHandle, $outHandle);
fclose($inHandle);

fclose($outHandle);

echo "Merged '{$file1}' and '{$file2}' into '{$outfile}'.\n";

exit(0);
?>