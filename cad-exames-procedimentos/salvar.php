<?php
include 'conexao_db.php';

// Captura os dados do formulário
$nome = $_POST['exame'];
$protocolo = $_POST['protocolo'];
$nans = $_POST['nans'];
$status = $_POST['status'];

// Prepara e vincula
$stmt = $conn->prepare("INSERT INTO exames_procedimentos (nome, protocolo, nans, status) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $protocolo, $nans, $status);

// Executa a consulta
if ($stmt->execute()) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

// Fecha a conexão
$stmt->close();
$conn->close();

// Redireciona para a página de sucesso ou de volta ao formulário
header("Location: index.php");
exit();
?>