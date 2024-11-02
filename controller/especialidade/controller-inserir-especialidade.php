<?php
include_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['esp_nome'];
    $descricao = $_POST['esp_descr'];
    $situacao = $_POST['esp_situacao'];

    try {
        $query = "INSERT INTO especialidade (esp_nome, esp_descr, esp_situacao) VALUES (:esp_nome, :esp_descr, :esp_situacao )";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':esp_nome', $nome);
        $stmt->bindParam(':esp_descr', $descricao);
        $stmt->bindParam(':esp_situacao', $situacao);
        $stmt->execute();

        header("Location: ../../model/especialidade/index.php?sucesso=1");
        exit();
    } catch (PDOException $e) {
        header("Location: ../../model/especialidade/index.php?erro=1");
        exit();
    }
}
?>
