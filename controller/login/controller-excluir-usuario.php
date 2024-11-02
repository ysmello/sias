<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usu_id'])) {
    header('Location: /');
    exit();
}

// Inclui o arquivo de configuração do banco de dados
include __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usu_id'])) {
    $userId = $_POST['usu_id'];
    
    try {
        // Inicia uma transação
        $conn->beginTransaction();

        // Prepara a instrução para atualizar o campo usu_situacao para 3 (exclusão lógica)
        $stmt = $conn->prepare("UPDATE usuario SET usu_situacao = 3 WHERE usu_id = :usu_id");
        $stmt->bindParam(':usu_id', $userId, PDO::PARAM_INT);

        // Executa a atualização
        if ($stmt->execute()) {
            // Confirma a transação
            $conn->commit();
            header('Location: /index.php?sucesso=7'); // Redireciona com sucesso
            exit();
        } else {
            // Caso a execução falhe, reverte a transação
            $conn->rollBack();
            header('Location: /index.php?erro=1');
            exit();
        }
        
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Erro ao excluir usuário: " . $e->getMessage();
        exit();
    }
} else {
    header('Location: /index.php?erro=1');
    exit();
}
?>
