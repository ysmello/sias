<?php
include_once __DIR__ . '/../../config/database.php';

if (isset($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']); // Recebe IDs como array

    try {
        $query = "DELETE FROM especialidade WHERE esp_id IN (" . implode(',', array_fill(0, count($ids), '?')) . ")";
        $stmt = $conn->prepare($query);
        foreach ($ids as $index => $id) {
            $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
        }
        $stmt->execute();

        header("Location: ../../model/especialidade/index.php?sucesso=3");
        exit();
    } catch (PDOException $e) {
        header("Location: ../../model/especialidade/index.php?erro=2");
        exit();
    }
}
?>