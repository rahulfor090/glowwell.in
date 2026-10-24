<?php
$files = array_merge(
    glob(__DIR__ . '/*.php'),
    glob(__DIR__ . '/admin/*.php'),
    glob(__DIR__ . '/includes/*.php'),
    glob(__DIR__ . '/config/*.php')
);

$errors = 0;
foreach ($files as $file) {
    $output = [];
    $return_var = 0;
    exec("php -l " . escapeshellarg($file), $output, $return_var);
    if ($return_var !== 0) {
        echo "SYNTAX ERROR in $file:\n" . implode("\n", $output) . "\n";
        $errors++;
    } else {
        echo "OK: " . basename($file) . "\n";
    }
}

if ($errors === 0) {
    echo "\n=== ALL " . count($files) . " PHP FILES PASSED SYNTAX CHECK CLEANLY! ===\n";
} else {
    echo "\nFound $errors syntax errors!\n";
    exit(1);
}
