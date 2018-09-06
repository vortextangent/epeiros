<?php

/**
 * Give this script a command line argument of the phpunit warning output about use statements (*in single quotes),
 * to get the proper use statement annotations for phpunit in return
 */
$phpUnitOutput = $argv[1];

$lines = explode("\n", $phpUnitOutput);

foreach ($lines as $key => &$line) {
    if (substr($line, 0, 1) !== '-') {
        unset($lines[$key]);
        continue;
    }
    $line = trim($line);
    $line = str_replace('- ', ' * @uses   \\', $line);
    $line = substr($line, 0, strpos($line, '::'));
}

$lines = array_unique($lines);
sort($lines);

echo "\nUse Annotations:\n\n";

for ($i = 0; $i < count($lines); $i++) {
    echo $lines[$i] . "\n";
}
