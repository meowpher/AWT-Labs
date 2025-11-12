<?php

$source = 'abc.txt';
$dest   = 'pqr.txt';

if (!is_file($source) || !is_readable($source)) {
    fwrite(STDERR, "Error: source file '{$source}' does not exist or is not readable\n");
    exit(1);
}

if (copy($source, $dest) === false) {
    fwrite(STDERR, "Error: failed to copy '{$source}' to '{$dest}'\n");
    exit(1);
}

echo "Successfully copied '{$source}' to '{$dest}'.\n";
?>