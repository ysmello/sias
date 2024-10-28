<?php
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php'; // Caminho corrigido para o autoload do Composer

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include __DIR__ . '/../../config/database.php';

    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $novaSenha = isset($_POST['nova_senha']) ? $_POST['nova_senha'] : '';

    if (!empty($token) && !empty($novaSenha)) {
        // Função para redefinir a senha
        $senhaAlterada = redefinirSenha($conn, $token, $novaSenha);

        if ($senhaAlterada) {
            header('Location: ../../../index.php?sucesso=4'); // Redireciona com mensagem de sucesso
        } else {
            header('Location: ../../../index.php?erro=6'); // Token inválido ou erro ao alterar a senha
        }
        exit();
    } else {
        header('Location: ../../../index.php?erro=7'); // Campos vazios
        exit();
    }
}

// Função para redefinir a senha
function redefinirSenha($conn, $token, $novaSenha) {
    try {
        // Hash a nova senha
        $hashedPassword = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualiza a senha e remove o token do banco de dados
        $sql = "UPDATE cidadao SET cid_senha = :novaSenha, reset_token = NULL WHERE reset_token = :token";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':novaSenha', $hashedPassword);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        return $stmt->rowCount() === 1; // Retorna verdadeiro se a senha foi alterada
    } catch (Exception $e) {
        // Se ocorrer um erro, você pode optar por registrar o erro ou exibir uma mensagem genérica
        return false;
    }
}
?>
