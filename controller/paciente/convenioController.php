<?php
include __DIR__ . '/../../config/database.php';

$action = $_POST['action'];
$paciente_id = $_SESSION['paciente_id'];
$conv_id = $_POST['conv_id'] ?? null;
$situacao = $_POST['situacao'] ?? 1;

switch ($action) {
    case 'inserir':
        inserirConvenio($conn, $paciente_id, $conv_id, $situacao);
        break;
    case 'alterar':
        alterarSituacaoConvenio($conn, $paciente_id, $conv_id, $situacao);
        break;
    case 'visualizar':
        visualizarConvenios($conn, $paciente_id);
        break;
    case 'excluir':
        excluirConvenio($conn, $paciente_id, $conv_id);
        break;
    default:
        echo "Ação inválida!";
        break;
}

function inserirConvenio($conn, $paciente_id, $conv_id, $situacao) {
    $sql = "INSERT INTO paciente_conv (pac_id, conv_id, pac_conv_situacao) VALUES (:paciente_id, :conv_id, :situacao)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
    $stmt->bindParam(':conv_id', $conv_id, PDO::PARAM_INT);
    $stmt->bindParam(':situacao', $situacao, PDO::PARAM_INT);
    $stmt->execute();
    echo "Convênio inserido com sucesso!";
}

function alterarSituacaoConvenio($conn, $paciente_id, $conv_id, $situacao) {
    $sql = "UPDATE paciente_conv SET pac_conv_situacao = :situacao WHERE pac_id = :paciente_id AND conv_id = :conv_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
    $stmt->bindParam(':conv_id', $conv_id, PDO::PARAM_INT);
    $stmt->bindParam(':situacao', $situacao, PDO::PARAM_INT);
    $stmt->execute();
    echo "Situação do convênio alterada com sucesso!";
}

function visualizarConvenios($conn, $paciente_id) {
    $sql = "SELECT convenios.conv_nome, convenios.conv_cnpj, paciente_conv.pac_conv_situacao 
            FROM paciente_conv 
            JOIN convenios ON paciente_conv.conv_id = convenios.conv_id 
            WHERE paciente_conv.pac_id = :paciente_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
    $stmt->execute();
    $convenios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($convenios);
}

function excluirConvenio($conn, $paciente_id, $conv_id) {
    $sql = "DELETE FROM paciente_conv WHERE pac_id = :paciente_id AND conv_id = :conv_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
    $stmt->bindParam(':conv_id', $conv_id, PDO::PARAM_INT);
    $stmt->execute();
    echo "Convênio excluído com sucesso!";
}
?>
