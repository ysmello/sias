<?php
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php'; // Caminho do autoload do Composer

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../controller/login');
$dotenv->load();


include __DIR__ . '/../../config/database.php'; // Inclui a configuração do banco de dados

// Verifica se o token foi passado na URL
$token = isset($_GET['token']) ? $_GET['token'] : '';

if (!empty($token)) {
    // Verifica se o token é válido
    $sql = "SELECT cid_cpf FROM cidadao WHERE reset_token = :token";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Token válido, exibe o formulário
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Redefinir Senha</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="overflow-hidden">
            <?php
                include __DIR__ . '/../../components/header.php'
            ?>  
            <div class="container d-flex justify-content-center align-items-center flex-column mt-5">
                <div class="w-50">      
                    <form method="POST" action="/controller/login/controller-redefinir-senha.php">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                        <div class="mb-3">
                            <label for="novaSenha" class="form-label">Informe a Nova Senha</label>
                            <input type="password" class="form-control" id="novaSenha" name="nova_senha" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Redefinir Senha</button>
                    </form>
                </div>    
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>  
        </body>
        <?php
            include __DIR__ . '/../../components/footer.php'
        ?>
        </html>                      
        <?php
    } else {
        echo "<div class='alert alert-danger'>Token inválido ou expirado!</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Token não fornecido!</div>";
}
?>
