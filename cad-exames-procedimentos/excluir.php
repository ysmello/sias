<?php
include 'conexao_db.php';

// Obter o ID do exame a ser excluído
$id = $_POST['id'];

// Verificar se o exame está em uso em outras tabelas
$checkSql = "SELECT COUNT(*) as total FROM agenda WHERE especialidade_has_profissional_profissional_prof_id = ?";
$stmt = $conn->prepare($checkSql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['total'] > 0) {
    echo "Não é possível excluir este Exame/Procedimento, pois ele está em uso.";
} else {
    // Se não estiver em uso, exclua o exame
    $deleteSql = "DELETE FROM exames_procedimentos WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Exame/Procedimento excluído com sucesso.";
    } else {
        echo "Erro ao excluir exame: " . $conn->error;
    }
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>