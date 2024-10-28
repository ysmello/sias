<?php

session_start();

include __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($email) && !empty($senha)) {

        // Buscar o cidadão e suas informações relacionadas ao usuário
        $sql = "SELECT u.usu_id, u.cidadao_cid_id, u.usu_tp, u.usu_senha, u.usu_situacao, c.cid_nome
                FROM usuario u
                INNER JOIN cidadao c ON u.cidadao_cid_id = c.cid_id
                WHERE c.cid_email = :email"; // Verifica se o email existe

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verifica se encontrou o usuário com o email fornecido
        if ($stmt->rowCount() === 1) { // Verifica se encontrou um usuário

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar se a conta está ativa
            if ($row['usu_situacao'] != 1) {
                // Conta inativa
                header("Location: ../../../index.php?erro=4"); // Erro para conta inativa
                exit();
            }

            // Verificar se a senha está correta
            if (password_verify($senha, $row['usu_senha'])) {

                // Senha correta, iniciar sessão
                $_SESSION['usu_id'] = $row['usu_id'];
                $_SESSION['cidadao_cid_id'] = $row['cidadao_cid_id'];
                $_SESSION['usu_tp'] = $row['usu_tp'];
                $_SESSION['cid_nome'] = $row['cid_nome'];

                // Atualizar a data de último acesso
                $update_sql = "UPDATE usuario SET usu_dt_ultimo_acesso = NOW() WHERE usu_id = :usu_id";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bindParam(':usu_id', $row['usu_id']);
                $update_stmt->execute();

                // Redirecionar o usuário após login
                header('Location: ../../../index.php?sucesso=2');
                exit();
            } else {
                // A senha está incorreta
                header("Location: ../../../index.php?erro=1"); // Erro de senha incorreta
                exit();
            }
        } else {
            // Usuário não encontrado
            header("Location: ../../../index.php?erro=2"); // Erro para usuário não encontrado
        }
    } else {
        // Campos vazios
        header("Location: ../../../index.php?erro=3"); // Erro para campos vazios
    }
}

$conn = null; // Fecha a conexão PDO
?>
