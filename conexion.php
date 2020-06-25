<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ai13", "ai13", "ai2019");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET CHARACTER SET UTF8");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>