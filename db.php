<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=db12chut6rilvm", "uexh5jsi8shpy", "ird9wggh5yg5");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
