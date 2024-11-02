<?php
include_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['registroId'];
    $nome = $_POST['esp_nome'];
    $descricao = $_POST['esp_descr'];
    $situacao = $_POST['esp_situacao'];

    try {
        // Corrigido o parâmetro para o ID
        $query = "UPDATE especialidade SET esp_nome=:esp_nome, esp_descr=:esp_descr, esp_situacao=:esp_situacao WHERE esp_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id); // Mantido para o WHERE
        $stmt->bindParam(':esp_nome', $nome);        
        $stmt->bindParam(':esp_descr', $descricao);
        $stmt->bindParam(':esp_situacao', $situacao);

        $stmt->execute();

        header("Location: ../../model/especialidade/index.php?sucesso=2");
        exit();
    } catch (PDOException $e) {
        header("Location: ../../model/especialidade/index.php?erro=2");
        exit();
    }
}
?>
