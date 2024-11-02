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

$userId = $_SESSION['usu_id']; 

if ($userId) {
    // Busca o nome do usuário no banco de dados
    $stmt = $conn->prepare("SELECT c.cid_nome FROM usuario u INNER JOIN cidadao c ON u.cidadao_cid_id = c.cid_id WHERE u.usu_id = :usu_id");
    $stmt->bindParam(':usu_id', $userId);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $userName = $user['cid_nome'];
    } else {
        echo "Usuário não encontrado com ID: " . htmlspecialchars($userId);
        exit();
    }
} else {
    echo "ID do usuário não foi passado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Status do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php 
include __DIR__ . '/../../components/header.php'; 
?>
<body class="overflow-hidden">
    <div class="container d-flex justify-content-center align-items-center flex-column mt-5 w-50">
        <div class="container">
            <form class="row g-3" method="POST" action="/controller/login/controller-excluir-usuario.php">
                <input type="hidden" name="usu_id" value="<?php echo htmlspecialchars($userId); ?>">
                <div class="col-md-12">
                    <h5 class="form-label">Deseja realmente excluir o usuário <strong><?php echo htmlspecialchars($userName); ?></strong>?</h5>
                </div>

                <!-- Botão de Confirmar Alteração do Status -->
                <div class="col-12">
                    <button type="submit" class="btn btn-danger w-100">Excluir</button>
                    <a href="/index.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                </div>
            </form>
        </div>    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
include __DIR__ . '/../../components/footer.php';
?>
</html>
