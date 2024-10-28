<?php
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php'; // Caminho corrigido para o autoload do Composer

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__);
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
        <div class="container mt-5">
            <h2>Redefinir Senha</h2>
            <form method="POST" action="controller/controller-redefinir-senha.php">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <div class="mb-3">
                    <label for="novaSenha" class="form-label">Nova Senha</label>
                    <input type="password" class="form-control" id="novaSenha" name="nova_senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Redefinir Senha</button>
            </form>
        </div>
        <?php
    } else {
        echo "<div class='alert alert-danger'>Token inválido ou expirado!</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Token não fornecido!</div>";
}
?>
