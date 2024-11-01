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
    function redefinirSenha($conn, $token, $novaSenha) {
        try {
            // Hash da nova senha
            $hashedPassword = password_hash($novaSenha, PASSWORD_BCRYPT);
            if ($hashedPassword === false) {
                header('Location: ../../../index.php?erro=8'); // Erro ao criar hash da senha
                exit();
            }

            // 1. Buscar o ID do cidadão com o token
            $sql = "SELECT cid_id FROM cidadao WHERE reset_token = :token";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $cidadao = $stmt->fetch();
                $cidadaoId = $cidadao['cid_id'];

                // 2. Atualizar a senha do usuário associado ao cidadao_cid_id
                $sqlUpdate = "UPDATE usuario SET usu_senha = :novaSenha WHERE cidadao_cid_id = :cidadaoId";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':novaSenha', $hashedPassword);
                $stmtUpdate->bindParam(':cidadaoId', $cidadaoId);
                $stmtUpdate->execute();

                if ($stmtUpdate->rowCount() === 1) {
                    // Remover o token do cidadão após o sucesso
                    $sqlRemoveToken = "UPDATE cidadao SET reset_token = NULL WHERE cid_id = :cidadaoId";
                    $stmtRemoveToken = $conn->prepare($sqlRemoveToken);
                    $stmtRemoveToken->bindParam(':cidadaoId', $cidadaoId);
                    $stmtRemoveToken->execute();

                    header('Location: ../../../index.php?sucesso=4'); // Redireciona com mensagem de sucesso
                    exit();
                } else {
                    header('Location: ../../../index.php?erro=6'); // Nenhum registro atualizado
                    exit();
                }
            } else {
                header('Location: ../../../index.php?erro=5'); // Token inválido ou expirado
                exit();
            }
        } catch (Exception $e) {
            header('Location: ../../../index.php?erro=9'); // Erro ao redefinir senha
            exit();
        }
    }

?>
