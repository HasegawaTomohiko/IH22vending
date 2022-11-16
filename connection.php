<?php
 
try {
    // DB接続
    $pdo = new PDO(
        'mysql:host=localhost;dbname=testdb;',

        'root',
        '',
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
 

    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
 

    $stmt->bindValue(':id', 1);
 
    $stmt->execute();
 

    foreach ($stmt as $row) {
        var_dump($row);
    }
 
} catch (PDOException $e) {
    echo $e->getMessage();
} finally {
    $pdo = null;
}
 
?>
