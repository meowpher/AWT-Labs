<?php

if ($argc < 3) {
    fwrite(STDERR, "Usage: php {$argv[0]} <filename> <mode>\n");
    fwrite(STDERR, "Modes: upper | lower | title | invert\n");
    fwrite(STDERR, "Add --inplace to overwrite the input file.\n");
    exit(1);
}

$filename = $argv[1];
$mode = strtolower($argv[2]);
$inplace = in_array('--inplace', $argv, true);

if (!is_readable($filename)) {
    fwrite(STDERR, "Error: cannot read file '{$filename}'\n");
    exit(1);
}

$content = file_get_contents($filename);
if ($content === false) {
    fwrite(STDERR, "Error: failed to read file\n");
    exit(1);
}

mb_internal_encoding('UTF-8');

switch ($mode) {
    case 'upper':
        $out = mb_strtoupper($content);
        break;
    case 'lower':
        $out = mb_strtolower($content);
        break;
    case 'title':
        // mb_convert_case with MB_CASE_TITLE capitalizes words
        $out = mb_convert_case($content, MB_CASE_TITLE, 'UTF-8');
        break;
    case 'invert':
        // Invert case per Unicode-aware characters
        $chars = preg_split('//u', $content, -1, PREG_SPLIT_NO_EMPTY);
        $out = '';
        foreach ($chars as $ch) {
            $up = mb_strtoupper($ch);
            $low = mb_strtolower($ch);
            if ($ch === $up && $ch !== $low) {
                // already uppercase (and different from lowercase)
                $out .= $low;
            } elseif ($ch === $low && $ch !== $up) {
                // already lowercase
                $out .= $up;
            } else {
                // not a letter or no case variants
                $out .= $ch;
            }
        }
        break;
    default:
        fwrite(STDERR, "Error: unknown mode '{$mode}'\n");
        exit(1);
}

if ($inplace) {
    if (file_put_contents($filename, $out) === false) {
        fwrite(STDERR, "Error: failed to write to '{$filename}'\n");
        exit(1);
    }
    echo "File updated: {$filename}\n";
} else {
    $outFile = $filename . '.converted';
    if (file_put_contents($outFile, $out) === false) {
        fwrite(STDERR, "Error: failed to write to '{$outFile}'\n");
        exit(1);
    }
    echo "Converted content written to: {$outFile}\n";
}

exit(0);
?>