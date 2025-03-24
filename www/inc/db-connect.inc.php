<?php
try {
    // Anslut till MariaDB-servern med rätt databasnamn
    $pdo = new PDO('mysql:host=mariadb;dbname=diary;charset=utf8mb4', 'root', 'root');
    
    // Sätt PDO att kasta undantag vid fel
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Anslutningen misslyckades: " . $e->getMessage();
    die();
}
?>
