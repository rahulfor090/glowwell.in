<?php
require_once __DIR__ . '/../config/db.php';
$pdo = get_pdo();

// Check columns in practices table
$stmt = $pdo->query("SHOW COLUMNS FROM practices");
$columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo "Existing columns in practices:\n" . implode(", ", $columns) . "\n\n";

$needed = [
    'badge' => "VARCHAR(100) DEFAULT 'Intellectual Property Rights'",
    'banner_title' => "VARCHAR(255) DEFAULT NULL",
    'banner_subtitle' => "TEXT DEFAULT NULL",
    'content' => "LONGTEXT DEFAULT NULL"
];

foreach ($needed as $col => $def) {
    if (!in_array($col, $columns)) {
        $pdo->exec("ALTER TABLE practices ADD COLUMN `$col` $def");
        echo "Added column: $col\n";
    } else {
        echo "Column already exists: $col\n";
    }
}

echo "\nDone!\n";
