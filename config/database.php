<?php
    $servername = "localhost";
    $username = "root";
    $password = "system";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=sias_db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>