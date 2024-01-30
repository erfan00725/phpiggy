<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy'
], 'root', '');

$sqlFile = file_get_contents("./database.sql");

$db->conncection->query($sqlFile);

// try {

//     $db->conncection->beginTransaction();

//     $db->conncection->query("INSERT INTO products VALUES(99,'gloves')");

//     $search = 'gloves';

//     $query = "SELECT * FROM products WHERE name= ?";

//     $stmt = $db->conncection->prepare($query);

//     $stmt->execute([
//         $search
//     ]);

//     $db->conncection->commit();

//     var_dump($stmt->fetchAll(PDO::FETCH_NAMED));
// } catch (Exception $e) {
//     if ($db->conncection->inTransaction()) {
//         $db->conncection->rollBack();
//     }

//     echo "transaction failed!";
// }