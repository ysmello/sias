<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php'; // Caminho corrigido para o autoload do Composer

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include __DIR__ . '/../../config/database.php';

    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : ''; // Altere para obter o CPF

    if (!empty($cpf)) {
        $sql = "SELECT cid_nome, cid_email FROM cidadao WHERE cid_cpf = :cpf"; // Atualize a consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Gere um token para redefinição de senha
            $token = bin2hex(random_bytes(16));
            $resetLink = "localhost/model/login/redefinir-senha.php?token=$token";

            // Salvar o token no banco (exemplo, ajuste conforme a sua estrutura)
            $saveTokenSql = "UPDATE cidadao SET reset_token = :token WHERE cid_cpf = :cpf"; // Atualize a consulta
            $saveTokenStmt = $conn->prepare($saveTokenSql);
            $saveTokenStmt->bindParam(':token', $token);
            $saveTokenStmt->bindParam(':cpf', $cpf);
            $saveTokenStmt->execute();

            // Configuração do PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Configurações do servidor
                $mail->isSMTP();
                $mail->Host = 'smtp.zoho.com'; // Usando o Zoho Mail
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['GMAIL_USERNAME']; // Usar variável de ambiente para o nome de usuário
                $mail->Password = $_ENV['GMAIL_PASSWORD']; // Usar variável de ambiente para a senha
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configurações do e-mail
                $mail->setFrom($_ENV['GMAIL_USERNAME'], 'SIAS'); // Enviar como seu e-mail Zoho
                $mail->addAddress($user['cid_email'], $user['cid_nome']);
                $mail->isHTML(true);
                $mail->Subject = mb_encode_mimeheader('Redefinição de Senha', 'UTF-8');
                $mail->Body = "<p>Olá, {$user['cid_nome']}</p>
                                <p>Recebemos uma solicitação para redefinir sua senha. Clique no link abaixo para continuar:</p>
                                <p><a href='{$resetLink}'>Redefinir senha</a></p>
                                <p>Se você não solicitou a redefinição, ignore este e-mail.</p>";

                // Enviar o e-mail
                $mail->send();
                header('Location: ../../../index.php?sucesso=3'); // Redireciona com mensagem de sucesso
                exit();
            } catch (Exception $e) {
                echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
                header('Location: ../../../index.php?erro=5'); // Redireciona com mensagem de erro
                exit();
            }
        } else {
            header('Location: ../../../index.php?erro=2'); // Usuário não encontrado
            exit();
        }
    } else {
        header('Location: ../../../index.php?erro=3'); // Campos vazios
    }
}
