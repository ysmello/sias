<?php
include_once __DIR__ . '/../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "SELECT * FROM especialidade WHERE esp_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $convenio = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($convenio);
    } catch (PDOException $e) {
        echo "Erro ao buscar Especialidade: " . $e->getMessage();
    }
}
?>
