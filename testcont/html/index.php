<?php


$dsn = sprintf('mysql:host=%s;port=%s;dbname=%s', 
     $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_NAME']);

try {
    $dbh = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    echo "接続成功\n";
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}
