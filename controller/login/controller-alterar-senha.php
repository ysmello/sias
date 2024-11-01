<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usu_id'])) {
    // Redireciona para a página de login se o ID do usuário não estiver na sessão
    header('Location: /');
    exit();
}

include __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $novaSenha = $_POST['senha'] ?? '';
    $confirmaSenha = $_POST['confirma-senha'] ?? '';

    // Verificar se o ID do usuário está na sessão
    $userId = $_SESSION['usu_id'] ?? null; // Corrigido para usar 'usu_id'
    if (!$userId) {
        header('Location: ../../../index.php?erro=9'); // Usuário não autenticado
        exit();
    }

    // Validar se as senhas são iguais
    if ($novaSenha !== $confirmaSenha) {
        header('Location: ../../../index.php?erro=10'); // Senhas não coincidem
        exit();
    }

    // Validar comprimento da senha
    if (strlen($novaSenha) !== 8) {
        header('Location: ../../../index.php?erro=11'); // Senha com comprimento incorreto
        exit();
    }

    try {
        // Atualizar a senha no banco de dados para o usuário logado
        $stmt = $conn->prepare("UPDATE usuario SET usu_senha = :novaSenha WHERE usu_id = :userId");

        // Hash da nova senha
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        $stmt->bindParam(':novaSenha', $senhaHash);
        $stmt->bindParam(':userId', $userId);

        if ($stmt->execute()) {
            header('Location: ../../../index.php?sucesso=6'); // Senha alterada com sucesso
        } else {
            header('Location: ../../../index.php?erro=12'); // Erro ao atualizar senha
        }
        
    } catch (PDOException $e) {
        header('Location: ../../../index.php?erro=13'); // Erro de banco de dados
    }
    exit();
} else {
    header('Location: ../../../index.php');
    exit();
}


?>
